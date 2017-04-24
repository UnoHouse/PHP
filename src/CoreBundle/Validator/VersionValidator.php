<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 24.04.17
 * Time: 18:07
 */

namespace CoreBundle\Validator;

use CoreBundle\Entity\Apk;
use CoreBundle\Manager\ApkManager;
use Doctrine\ORM\EntityManager;

class VersionValidator
{
    /**
     * @var ApkManager
     */
    private $apkManager;

    public function __construct(ApkManager $apkManager)
    {
        $this->apkManager = $apkManager;
    }

    /**
     * @param Apk $apk
     */
    public function validate($apkVersion)
    {
        $latestApkVersion = $this->apkManager->getLatestAppVersion();
        if($latestApkVersion == null){
            return true;
        }
    }
}