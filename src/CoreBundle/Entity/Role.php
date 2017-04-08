<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_role")
 * @ORM\HasLifecycleCallbacks()
 */
class Role
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Role", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Permission", mappedBy="role")
     */
    private $permissions;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="adminRoles")
     */
    protected $user;


    public function __toString() {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Role
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     *
     * @return Role
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add child
     *
     * @param \Mamf\AdminBundle\Entity\Role $child
     *
     * @return Role
     */
    public function addChildren(\Mamf\AdminBundle\Entity\Role $child)
    {
        $this->children[] = $child;
        $child->setParent($this);

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Mamf\AdminBundle\Entity\Role $child
     */
    public function removeChildren(\Mamf\AdminBundle\Entity\Role $child)
    {
        $child->setParent(null);
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @ORM\PrePersist
     */
    public function setRootParent() {

    }

    /**
     * Add child
     *
     * @param \Mamf\AdminBundle\Entity\Role $child
     *
     * @return Role
     */
    public function addChild(\Mamf\AdminBundle\Entity\Role $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Mamf\AdminBundle\Entity\Role $child
     */
    public function removeChild(\Mamf\AdminBundle\Entity\Role $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Add user
     *
     * @param \Mamf\AdminBundle\Entity\User $user
     *
     * @return Role
     */
    public function addUser(\Mamf\AdminBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Mamf\AdminBundle\Entity\User $user
     */
    public function removeUser(\Mamf\AdminBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add permission
     *
     * @param \Mamf\AdminBundle\Entity\Permission $permission
     *
     * @return Role
     */
    public function addPermission(\Mamf\AdminBundle\Entity\Permission $permission)
    {
        $this->permissions[] = $permission;

        return $this;
    }

    /**
     * Remove permission
     *
     * @param \Mamf\AdminBundle\Entity\Permission $permission
     */
    public function removePermission(\Mamf\AdminBundle\Entity\Permission $permission)
    {
        $this->permissions->removeElement($permission);
    }

    /**
     * Get permissions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}
