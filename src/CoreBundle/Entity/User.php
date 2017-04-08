<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="user")
     */
    protected $adminRoles;

    /**
     * @ORM\OneToMany(targetEntity="AuditLog", mappedBy="user")
     */
    protected $auditLogs;

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
     * @param \Mamf\AdminBundle\Entity\Role $adminRole
     *
     * @return User
     */
    public function addAdminRole(\Mamf\AdminBundle\Entity\Role $adminRole)
    {
        $this->adminRoles[] = $adminRole;
        $adminRole->addUser($this);
        return $this;
    }

    /**
     * Remove adminRole
     *
     * @param \Mamf\AdminBundle\Entity\Role $adminRole
     */
    public function removeAdminRole(\Mamf\AdminBundle\Entity\Role $adminRole)
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


    public function addAuditLog(AuditLog $auditLog)
    {
        $this->auditLogs[] = $auditLog;
        $auditLog->setUser($this);
        return $this;
    }

    /**
     * Remove child
     *
     * @param \Mamf\AdminBundle\Entity\Role $child
     */
    public function removeAuditLog(AuditLog $auditLog)
    {
        $this->auditLogs->removeElement($auditLog);
        $auditLog->setUser(null);
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
