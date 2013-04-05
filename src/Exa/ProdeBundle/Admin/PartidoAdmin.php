<?php

namespace Exa\ProdeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PartidoAdmin extends Admin {
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('fecha')
            ->add('equipo1', null, array("label" => "Equipo local"))
            ->add('equipo2', null, array("label" => "Equipo visitante"))
            ->add('jugado', null, array('required' => false))
            ->add('resultado', 'choice', array('attr' => array('class' => 'input-mini'), 'required' => false, 'choices' => array("L" => "Local", "E" => "Empate", "V" => "Visitante")))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('fecha')
            ->add('jugado')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array("label" => "Equipos"))
            ->add('fecha')
            ->add('jugado')
            ->add('resultado')
        ;
    }
    
}

?>