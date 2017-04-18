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

class ApkAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('version', 'text');
        $formMapper
            ->add('file', 'file', array(
                'required' => false,
                'data_class' => null
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('version');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('version');
        $listMapper->addIdentifier('createdBy');
        $listMapper->addIdentifier('createdAt');
        $listMapper->addIdentifier('updatedBy');
        $listMapper->addIdentifier('updatedAt');
    }
}