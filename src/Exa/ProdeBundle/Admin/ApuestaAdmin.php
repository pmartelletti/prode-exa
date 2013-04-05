<?php

namespace Exa\ProdeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ApuestaAdmin extends Admin {
    

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('tarjetaApuestas')
            ->add('partido')
            ->add('prediccion')
            
        ;
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tarjetaApuestas')
            ->add('partido')            
            ->add('prediccion', null, array('required' => false))
            
        ;
    }
    
}

?>