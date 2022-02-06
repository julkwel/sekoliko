<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Manager;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class SekolikoEntityManager.
 */
class SekolikoEntityManager
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /** @var ParameterBagInterface */
    protected ParameterBagInterface $parameterBag;

    /** @var TokenStorageInterface */
    protected TokenStorageInterface $tokenStorage;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * SekolikoEntityManager constructor.
     *
     * @param EntityManagerInterface $manager
     * @param ParameterBagInterface  $parameterBag
     * @param TokenStorageInterface  $tokenStorage
     * @param LoggerInterface        $logger
     */
    public function __construct(EntityManagerInterface $manager, ParameterBagInterface $parameterBag, TokenStorageInterface $tokenStorage, LoggerInterface $logger)
    {
        $this->em = $manager;
        $this->parameterBag = $parameterBag;
        $this->tokenStorage = $tokenStorage;
        $this->logger = $logger;
    }

    /**
     * @param object             $entity
     * @param User|null          $user
     * @param FormInterface|null $form
     *
     * @return bool
     */
    public function save(object $entity, User $user = null, FormInterface $form = null)
    {
        $user ? : $this->tokenStorage->getToken()->getUser();
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
            $this->logger->error('POST SAVE :'.$exception->getMessage());

            return false;
        }
    }

    /**
     * @param object $entity
     * @param User   $user
     *
     * @return object
     */
    public function customField(object $entity, User $user)
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
     * @param UploadedFile $brochureFile
     * @param object       $entity
     * @param User         $user
     *
     * @return object
     */
    public function uploadPhoto(UploadedFile $brochureFile, object $entity, User $user)
    {
        try {
            $newFilename = $this->doUpload($brochureFile, $user);
            $entity->getUser()->setPhoto($newFilename);

            return $entity;
        } catch (FileException $e) {
            $this->logger->error('File upload error : '.$e->getMessage());

            return $entity;
        }
    }

    /**
     * @param mixed $brochureFile
     * @param User  $user
     *
     * @return User
     */
    public function uploadPhotoEts(UploadedFile $brochureFile, User $user)
    {
        if ($brochureFile && $brochureFile instanceof UploadedFile) {
            try {
                $newFilename = $this->doUpload($brochureFile, $user);
                $user->setEtsLogo($newFilename);

                return $user;
            } catch (FileException $e) {
                $this->logger->error('FILE ETS UPLOAD : '.$e->getMessage());

                return $user;
            }
        }

        return $user;
    }

    /**
     * @param UploadedFile $brochureFile
     * @param User         $user
     *
     * @return User
     */
    public function uploadUserPhoto(UploadedFile $brochureFile, User $user)
    {
        if ($brochureFile && $brochureFile instanceof UploadedFile) {
            try {
                $newFilename = $this->doUpload($brochureFile, $user);
                $user->setPhoto($newFilename);

                return $user;
            } catch (FileException $e) {
                $this->logger->error('FILE USER UPLOAD : '.$e->getMessage());

                return $user;
            }
        }

        return $user;
    }

    /**
     * @param UploadedFile $brochureFile
     * @param User         $user
     *
     * @return string
     */
    public function doUpload(UploadedFile $brochureFile, User $user)
    {
        $fullPath = $this->parameterBag->get('brochures_directory').$user->getEtsName();
        $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
        // this is needed to safely include the file name as part of the URL
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
        $brochureFile->move($fullPath, $newFilename);

        return $newFilename;
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
            $this->logger->error('REMOVING ERROR : '.$exception->getMessage());

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
