<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 05.04.17
 * Time: 18:53
 */

namespace CoreBundle\Entity;

use CoreBundle\Constants\Upload;
use CoreBundle\Constants\Base;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(type="integer")
     */
    private $version;

    /**
     * @Assert\File(mimeTypes={
     *     "application/vnd.android.package-archive",
     *     "application/zip"
     * })
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
        $this->setFileName($this->getVersion() . '-' . Base::BASE_APK_NAME);
        $this->getFile()->move(
            Upload::APK_UPLOAD_DIR,
            $this->getFileName()
        );

        $this->setFile(null);
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }

}