<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 18.04.17
 * Time: 21:05
 */

namespace CoreBundle\Constants;

class Upload
{
    const BASE_UPLOAD_DIR = 'uploads';
    const APK_UPLOAD_DIR_NAME = 'apk';

    public static function getApkUploadDir()
    {
        return self::BASE_UPLOAD_DIR . '/' . self::APK_UPLOAD_DIR_NAME;
    }
}