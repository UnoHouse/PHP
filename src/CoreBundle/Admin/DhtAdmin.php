<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 18.04.17
 * Time: 19:19
 */

namespace CoreBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class DhtAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('dhtNo');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('dhtNo');
        $listMapper->addIdentifier('temp');
        $listMapper->addIdentifier('humidity');
        $listMapper->addIdentifier('createdBy');
        $listMapper->addIdentifier('createdAt');
        $listMapper->addIdentifier('updatedBy');
        $listMapper->addIdentifier('updatedAt');
    }
}