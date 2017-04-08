<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PermissionRepository extends EntityRepository
{

    public function findOrCreateBy($options){
        $entity = $this->findOneBy($options);
        if(!$entity){
            $entity = new Permission;
            foreach($options as $key => $value){
                $entity->{'set'.$key}($value);
            }
        }
        return $entity;
    }

}
