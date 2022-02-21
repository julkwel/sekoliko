<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 */

namespace App\Command;

use App\Entity\User;
use Couchbase\PasswordAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SekolikoCreateSuperAdminCommand.
 */
class SekolikoCreateSuperAdminCommand extends Command
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordEncoder;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * SekolikoCreateSuperAdminCommand constructor.
     *
     * @param UserPasswordHasherInterface $passwordEncoder
     * @param EntityManagerInterface      $entityManager
     * @param string|null                 $name
     */
    public function __construct(UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager, string $name = null)
    {
        parent::__construct($name);
        $this->passwordEncoder = $passwordEncoder;
        $this->manager = $entityManager;
    }

    /**
     * @var string
     */
    protected static $defaultName = 'sekoliko:create:super-admin';

    /**
     * Configuration and command description.
     */
    protected function configure()
    {
        $this->setDescription('Création utilisateur superAdmin pour Sekoliko');
    }

    /**
     * This command will create a superAdmin user for sekoliko application.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');

        $name = $helper->ask($input, $output, new Question('Nom : '));
        $username = $helper->ask($input, $output, new Question('Login : '));
        $passWord = $helper->ask($input, $output, new Question('Mots de passe : '));

        $user = $this->manager->getRepository(User::class)->findBy(['username' => $username]);

        if ($user) {
            $io->error('User already exist !');
            exit(1);
        }

        $user = new User();
        $user
            ->setIsEnabled(true)
            ->setUsername($username)
            ->setNom($name)
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setPassword($this->passwordEncoder->hashPassword($user, $passWord));

        $this->manager->persist($user);
        $this->manager->flush();
        $io->success('Création utilisateur '.$name.' réussi');

        return 1;
    }
}
