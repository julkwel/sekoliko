<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 */

namespace App\Command;

use App\Entity\AdministrationType;
use App\Entity\Administrator;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SekolikoCreateSchoolAdminCommand.
 */
class SekolikoCreateSchoolAdminCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'sekoliko:create:admin';

    /** @var UserPasswordHasherInterface */
    private $encoder;

    /** @var EntityManagerInterface */
    private $manager;

    /**
     * SekolikoCreateSchoolAdminCommand constructor.
     *
     * @param UserPasswordHasherInterface $userPasswordEncoder
     * @param EntityManagerInterface      $entityManager
     * @param string|null                 $name
     */
    public function __construct(UserPasswordHasherInterface $userPasswordEncoder, EntityManagerInterface $entityManager, string $name = null)
    {
        parent::__construct($name);
        $this->encoder = $userPasswordEncoder;
        $this->manager = $entityManager;
    }

    /**
     * Configuration and command description.
     */
    protected function configure()
    {
        $this->setDescription('Création utilisateur admin pour un établissement !');
    }

    /**
     * This command will create a superAdmin user for sekoliko application.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');
        $libelle = $helper->ask($input, $output, new Question('Type utilisateur (administration/direction ...) : '));
        $etablissement = $helper->ask($input, $output, new Question('Etablissement : '));
        $name = $helper->ask($input, $output, new Question('Nom : '));
        $username = $helper->ask($input, $output, new Question('Login : '));
        $passWord = $helper->ask($input, $output, new Question('Mots de passe : '));

        $type = new AdministrationType();
        $type->setLibelle($libelle);
        $this->manager->persist($type);

        $user = new User();
        $user
            ->setEtsName($etablissement)
            ->setUsername($username)
            ->setNom($name)
            ->setRoles(['ROLE_ADMIN'])
            ->setIsEnabled(true)
            ->setPassword($this->encoder->hashPassword($user, $passWord));

        $admin = new Administrator();
        $admin->setUser($user);
        $admin->setType($type);

        $this->manager->persist($admin);
        $this->manager->flush();

        $io->success('Création utilisateur '.$name.' pour l\'établissement '.$etablissement.' réussi');

        return 1;
    }
}
