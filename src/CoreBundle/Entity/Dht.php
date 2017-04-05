<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 05.04.17
 * Time: 18:53
 */

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits;
use Knp\DoctrineBehaviors\Model;
/**
 * @ORM\Entity
 */
class Dht extends Base
{

    use Blameable,
        Timestampable;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $dhtNo;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $temp;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $humidity;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateArduino;

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
    public function getDhtNo()
    {
        return $this->dhtNo;
    }

    /**
     * @param mixed $dhtNo
     */
    public function setDhtNo($dhtNo)
    {
        $this->dhtNo = $dhtNo;
    }

    /**
     * @return mixed
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param mixed $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    /**
     * @return mixed
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @param mixed $humidity
     */
    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
    }

    /**
     * @return mixed
     */
    public function getDateArduino()
    {
        return $this->dateArduino;
    }

    /**
     * @param mixed $dateArduino
     */
    public function setDateArduino($dateArduino)
    {
        $this->dateArduino = $dateArduino;
    }


}