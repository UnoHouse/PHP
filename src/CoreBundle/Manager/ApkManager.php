<?php

namespace CoreBundle\Manager;

use Doctrine\ORM\EntityManager;
use CoreBundle\Entity\Apk;

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 24.04.17
 * Time: 18:59
 */
class ApkManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getLatestAppVersion()
    {
        $repository = $this->entityManager->getRepository('CoreBundle:Apk');
        $row = $repository->findOneBy(array(), array('version' => 'asc'));
        
        return $row->getVersion();
    }
}