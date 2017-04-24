<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 18.04.17
 * Time: 19:19
 */

namespace CoreBundle\Admin;

use CoreBundle\Entity\Apk;
use CoreBundle\Reader\ApkReader;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ApkAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
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
        $listMapper->addIdentifier('fileName');
        $listMapper->addIdentifier('version');
        $listMapper->addIdentifier('createdBy');
        $listMapper->addIdentifier('createdAt');
        $listMapper->addIdentifier('updatedBy');
        $listMapper->addIdentifier('updatedAt');
    }

    public function prePersist($apk)
    {
        $this->saveFile($apk);
    }

    public function preUpdate($apk)
    {
        $this->saveFile($apk);
    }

    /**
     * @param Apk $apk
     */
    public function saveFile($apk)
    {
        /** @var ApkReader $apkReader */
        $apkReader = $this->getConfigurationPool()->getContainer()->get('apk.reader');
        /** @var UploadedFile $file */
        $file = $apk->getFile();
        $apk->setVersion($apkReader->getVersionCodeFromAPK($file->getRealPath()));
    }
}