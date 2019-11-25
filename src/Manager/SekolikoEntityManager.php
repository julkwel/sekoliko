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
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class SekolikoEntityManager.
 */
class SekolikoEntityManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /** @var ParameterBagInterface */
    protected $parameterBag;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * SekolikoEntityManager constructor.
     *
     * @param EntityManagerInterface $manager
     * @param ParameterBagInterface  $parameterBag
     * @param TokenStorageInterface  $tokenStorage
     */
    public function __construct(EntityManagerInterface $manager, ParameterBagInterface $parameterBag, TokenStorageInterface $tokenStorage)
    {
        $this->em = $manager;
        $this->parameterBag = $parameterBag;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param object             $entity
     * @param User               $user
     * @param FormInterface|null $form
     *
     * @return bool
     */
    public function save($entity, User $user = null, FormInterface $form = null)
    {
        $user ?: $this->tokenStorage->getToken()->getUser();
        $this->customField($entity, $user);
        if (method_exists($entity, 'getUser')) {
            $this->customField($entity->getUser(), $user);
            $brochureFile = $form->get('user')->get('photo')->getData();
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
        if (method_exists($entity, 'setEtsLogo')) {
            $entity->setEtsLogo($user->getEtsLogo());
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
            // TODO remove on prod
            dd($e->getMessage());

            return $entity;
        }
    }

    /**
     * @param mixed $brochureFile
     * @param User  $user
     *
     * @return User
     */
    public function uploadPhotoEts($brochureFile, User $user)
    {
        if ($brochureFile) {
            $fullPath = $this->parameterBag->get('brochures_directory').$user->getEtsName();
            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
            // Move the file to the directory where brochures are stored
            try {
                $brochureFile->move($fullPath, $newFilename);
                $user->setEtsLogo($newFilename);

                return $user;
            } catch (FileException $e) {
                // TODO remove on prod
                dd($e->getMessage());

                return $user;
            }
        }

        return $user;
    }

    /**
     * @param mixed $brochureFile
     * @param User  $user
     *
     * @return User
     */
    public function uploadUserPhoto($brochureFile, User $user)
    {
        if ($brochureFile) {
            $fullPath = $this->parameterBag->get('brochures_directory').$user->getEtsName();
            $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
            // Move the file to the directory where brochures are stored
            try {
                $brochureFile->move($fullPath, $newFilename);
                $user->setPhoto($newFilename);

                return $user;
            } catch (FileException $e) {
                // TODO remove on prod
                dd($e->getMessage());

                return $user;
            }
        }

        return $user;
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
            // TODO remove on prod
            dd($exception);

            return false;
        }
    }

    /**
     * @return object|string
     */
    public function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }
}
