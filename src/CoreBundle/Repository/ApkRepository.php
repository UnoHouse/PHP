<?php

namespace CoreBundle\Repository;

use CoreBundle\Reader\ApkVersionReader;
use CoreBundle\Validator\VersionValidator;

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 24.04.17
 * Time: 18:32
 */
class ApkRepository
{
    private $versionReader;
    private $versionValidator;

    public function __construct( ApkVersionReader $versionReader, VersionValidator $versionValidator)
    {
        $this->versionReader = $versionReader;
        $this->versionValidator = $versionValidator;
    }

    public function getVersionCodeFromAPK($apkLocation)
    {
        return $this->versionReader->getVersionCodeFromAPK($apkLocation);
    }

    public function getLatestAppVersion(){

    }
}