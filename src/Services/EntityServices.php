<?php


namespace App\Services;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityServices
{
    private $em;
    private $container;

    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }

    /**
     * @param $_entity_name
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getAllListByEts($_entity_name)
    {
        $_user_ets = $this->getUserConnected()->getEtsNom();
        $_as_nom = $this->getUserConnected()->getAsName();

        $_array_find = [];
        if (is_callable($_entity_name, 'getEtsNom')) {
            $_array_find['etsNom'] = $_user_ets;
        }
        if (is_callable($_entity_name, 'getAsName')) {
            $_array_find['asName'] = $_as_nom;
        }

        return $this->em->getRepository($_entity_name)->findBy($_array_find, array('id' => 'DESC'));
    }

    /**
     * @return object|string
     *
     * Get utilisateur connecté
     */
    public function getUserConnected()
    {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @param $_entity_object
     * @param $_action
     *
     * @return bool
     */
    public function save($_entity_object, $_action)
    {
        try {
            if ('new' === $_action) {
                $this->em->persist($_entity_object);
            }
        } finally {
            $this->em->flush();
        }
        return true;
    }

    public function remove($_entity_object)
    {
        try{
            $this->em->remove($_entity_object);
            $this->em->flush();
        } catch (\Exception $exception){
            $exception->getMessage();
        }

        return true;
    }
    /**
     * Get Month List.
     *
     * @return array
     */
    public function getMonthList()
    {
        $_month = ['toutes les mois'];
        for ($m = 1; $m <= 12; ++$m) {
            array_push($_month, date('F', mktime(0, 0, 0, $m, 1)));
        }
        return $_month;
    }
}