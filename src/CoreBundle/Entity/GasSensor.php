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
class GasSensor
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
    private $sensorNo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $microcontrollerDate;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $sensorValue;

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
    public function getSensorNo()
    {
        return $this->sensorNo;
    }

    /**
     * @param mixed $sensorNo
     */
    public function setSensorNo($sensorNo)
    {
        $this->sensorNo = $sensorNo;
    }

    /**
     * @return mixed
     */
    public function getMicrocontrollerDate()
    {
        return $this->microcontrollerDate;
    }

    /**
     * @param mixed $microcontrollerDate
     */
    public function setMicrocontrollerDate($microcontrollerDate)
    {
        $this->microcontrollerDate = $microcontrollerDate;
    }

    /**
     * @return mixed
     */
    public function getSensorValue()
    {
        return $this->sensorValue;
    }

    /**
     * @param mixed $sensorValue
     */
    public function setSensorValue($sensorValue)
    {
        $this->sensorValue = $sensorValue;
    }

}