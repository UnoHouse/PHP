<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="CoreBundle\Entity\PermissionRepository")
 * @ORM\Table(name="userpermission")
 * @ORM\HasLifecycleCallbacks()
 */
class Permission
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $path;


    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="permissions")
     */
    private $role;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $action;


    private $parent;

    private $children;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $value;

    public function setValue($value){
        $this->value = $value;
        return $this;
    }

    public function getValue(){
        return $this->value;
    }

    public function getFinalValue(){
        if(isset($this->parent) && $this->getParent()->getValue() && $this->getValue())
            return null;

        if((!isset($this->parent) || !$this->getParent()->getValue()) && !$this->getValue())
            return null;

        return $this->getValue();
    }


    public function setParent($parent){
        $this->parent = $parent;
        $parent->addChild($this);
        return $this;
    }

    public function getParent(){
        return $this->parent;
    }

    public function addChild($child){
        $this->children[] = $child;
    }

    public function setChildren($children){
        $this->children = $children;
        return $this;
    }

    public function getChildren(){
        return $this->children;
    }

    public function getParentPath(){
        $parts = explode('/',$this->getPath());
        if(sizeof($parts) > 1)
            array_pop($parts);
        else
            return null;
        $parent = implode('/', $parts);
        $parent = str_replace('/%', '', $parent);
        return $parent;
    }


    public function __toString() {
        return $this->path;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Permission
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set role
     *
     * @param CoreBundle\Entity\Role $role
     *
     * @return Permission
     */
    public function setRole(\CoreBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return CoreBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return Permission
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
}
