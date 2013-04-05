<?php

namespace Exa\ProdeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TarjetaApuestasAdmin extends Admin {
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('usuario')
            ->add('fecha')
            ->add('calculado', null, array('required' => false))
            ->add('aciertos', null, array('required' => false))
            ->add('apuestas', 'sonata_type_collection', array('required' => false), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable'  => 'position'
            ))
            
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('usuario')
            ->add('fecha')
            ->add('aciertos')
            ->add('calculado')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('usuario')
            ->add('fecha')
            ->add('calculado')
            ->add('aciertos')
        ;
    }
    
    public function getBatchActions()
{
    // retrieve the default (currently only the delete action) actions
    $actions = parent::getBatchActions();

    // check user permissions
    if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')){
        $actions['calcular']= array(
            'label'            => "Calcular Resultados",
            'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
        );

    }

    return $actions;
}
    
}

?>