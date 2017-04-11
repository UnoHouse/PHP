<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Swagger\Annotations as SWG;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @SWG\Definition(required={"name"}, type="object", @SWG\Xml(name="User"))
 */
class User extends BaseUser
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @SWG\Property(format="int64")
     */
    protected $id;


    /**
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="user")
     * @SWG\Property(@SWG\Xml(name="adminRoles", wrapped=true))
     */
    protected $adminRoles;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column( type="string", length=20)
     */
    private $accessStatus;


    public function __construct()
    {
        parent::__construct();
        $this->auditLogs = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);
        return $this;
    }

    /**
     * Add adminRole
     *
     * @param \CoreBundle\Entity\Role $adminRole
     *
     * @return User
     */
    public function addAdminRole(\CoreBundle\Entity\Role $adminRole)
    {
        $this->adminRoles[] = $adminRole;
        $adminRole->addUser($this);
        return $this;
    }

    /**
     * Remove adminRole
     *
     * @param \CoreBundle\Entity\Role $adminRole
     */
    public function removeAdminRole(\CoreBundle\Entity\Role $adminRole)
    {
        $adminRole->removeUser($this);
        $this->adminRoles->removeElement($adminRole);
    }

    /**
     * Get adminRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdminRoles()
    {
        return $this->adminRoles;
    }

    public function getAdminRoleIds()
    {
        $ids = array();
        foreach ($this->getAdminRoles() as $role) {
            $ids[] = $role->getId();
        }
        return $ids;
    }

    public function getAuditLogs()
    {
        return $this->auditLogs;
    }



    /**
     * Set accessStatus
     *
     * @param string $accessStatus
     *
     * @return Page
     */
    public function setAccessStatus($accessStatus)
    {
        $this->accessStatus = $accessStatus;

        return $this;
    }

    /**
     * Get accessStatus
     *
     * @return string
     */
    public function getAccessStatus()
    {
        return $this->accessStatus;
    }
}
