<?php

/**
 * Created by PhpStorm.
 * User: rafal
 * Date: 18.04.17
 * Time: 19:19
 */

namespace CoreBundle\Admin;

use CoreBundle\Entity\Apk;
use CoreBundle\Repository\ApkRepository;
use CoreBundle\Validator\VersionValidator;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
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
        /** @var ApkRepository $apkReader */
        $apkRepository = $this->getConfigurationPool()->getContainer()->get('apk.repository');
        /** @var UploadedFile $file */
        $file = $apk->getFile();
        $apk->setVersion($apkRepository->getVersionCodeFromAPK($file->getRealPath()));
    }

    /**
     * @param ErrorElement $errorElement
     * @param mixed $object
     */
    public function validate(ErrorElement $errorElement, $object)
    {
        /** @var ApkRepository $apkReader */
        $apkRepository = $this->getConfigurationPool()->getContainer()->get('apk.repository');
        /** @var VersionValidator $versionValidator */
        $versionValidator = $this->getConfigurationPool()->getContainer()->get('apk.validator.version');
        /** @var UploadedFile $file */
        $file = $object->getFile();
        $versionValidator->validate($apkRepository->getVersionCodeFromAPK($file->getRealPath()));
    }
}