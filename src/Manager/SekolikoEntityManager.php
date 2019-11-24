<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Manager;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class SekolikoEntityManager.
 */
class SekolikoEntityManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    private $parameterBag;

    /**
     * SekolikoEntityManager constructor.
     *
     * @param EntityManagerInterface $manager
     * @param ParameterBagInterface  $parameterBag
     */
    public function __construct(EntityManagerInterface $manager, ParameterBagInterface $parameterBag)
    {
        $this->em = $manager;
        $this->parameterBag = $parameterBag;
    }

    /**
     * @param object             $entity
     * @param User               $user
     * @param FormInterface|null $form
     *
     * @return bool
     */
    public function save($entity, User $user, FormInterface $form = null)
    {
        $this->customField($entity, $user);
        if (method_exists($entity, 'getUser')) {
            $this->customField($entity->getUser(), $user);
            $formChild = $form->getIterator();
            $brochureFile = $formChild['user']->get('photo')->getData();
            if ($brochureFile) {
                $this->uploadPhoto($brochureFile, $entity, $user);
            }
        }

        try {
            if (!$entity->getId()) {
                $this->em->persist($entity);
            }
            $this->em->flush();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * @param object $entity
     * @param User   $user
     *
     * @return object
     */
    public function customField($entity, User $user)
    {
        if (method_exists($entity, 'setEtsName')) {
            $entity->setEtsName($user->getEtsName());
        }
        if (method_exists($entity, 'setSchoolYear')) {
            $entity->setSchoolYear($user->getSchoolYear());
        }
        if (method_exists($entity, 'addSchoolYear')) {
            $entity->addSchoolYear($user->getSchoolYear());
        }

        return $entity;
    }

    /**
     * @param $brochureFile
     * @param $entity
     * @param $user
     *
     * @return bool
     */
    public function uploadPhoto($brochureFile, $entity, $user)
    {
        $fullPath = $this->parameterBag->get('brochures_directory').$user->getEtsName();
        $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
        // this is needed to safely include the file name as part of the URL
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
        // Move the file to the directory where brochures are stored
        try {
            $brochureFile->move($fullPath, $newFilename);
            $entity->getUser()->setPhoto($newFilename);

            return $entity;
        } catch (FileException $e) {
            dd($e->getMessage());

            return $entity;
        }
    }

    /**
     * @param $entity
     *
     * @return bool
     */
    public function remove($entity)
    {
        try {
            $this->em->remove($entity);
            $this->em->flush();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
