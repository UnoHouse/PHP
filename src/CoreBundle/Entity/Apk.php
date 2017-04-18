<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 05.04.17
 * Time: 18:53
 */

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 */
class Apk
{
    use ORMBehaviors\Blameable\Blameable,
        ORMBehaviors\Timestampable\Timestampable;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $version;

    /**
     * @ORM\Column(type="string")
     */
    private $file;

    /**
     * @ORM\Column(type="string")
     */
    private $fileName;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $filePath
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }


    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }
        dump($this->getFile());
        exit;
        $this->getFile()->move(
            self::SERVER_PATH_TO_IMAGE_FOLDER,
            $this->getFile()->getClientOriginalName()
        );

        $this->setFileName($this->getFile()->getClientOriginalName());

        $this->setFile(null);
    }

    /**
     * Lifecycle callback to upload the file to the server
     */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }

}