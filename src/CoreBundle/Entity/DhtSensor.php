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
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 */
class DhtSensor
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
    private $microcontrollerDate;

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
     * @return DateTime
     */
    public function getMicrocontrollerDate()
    {
        return $this->microcontrollerDate;
    }

    /**
     * @param DateTime $microcontrollerDate
     */
    public function setMicrocontrollerDate($microcontrollerDate)
    {
        $this->microcontrollerDate = $microcontrollerDate;
    }

}