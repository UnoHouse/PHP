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
use Knp\DoctrineBehaviors\Model\Blameable\Blameable;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;

/**
 * @ORM\Entity
 */
class PirSensor
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
    private $sensorNo;
    /**
     * @ORM\Column(type="datetime")
     */
    private $movementStarted;

    /**
     * @ORM\Column(type="datetime")
     */
    private $movementStopped;

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
    public function getMovementStarted()
    {
        return $this->movementStarted;
    }

    /**
     * @param mixed $movementStarted
     */
    public function setMovementStarted($movementStarted)
    {
        $this->movementStarted = $movementStarted;
    }

    /**
     * @return mixed
     */
    public function getMovementStopped()
    {
        return $this->movementStopped;
    }

    /**
     * @param mixed $movementStopped
     */
    public function setMovementStopped($movementStopped)
    {
        $this->movementStopped = $movementStopped;
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

}