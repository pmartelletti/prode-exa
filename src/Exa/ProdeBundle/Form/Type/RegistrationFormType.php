<?php

namespace Exa\ProdeBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('name', null, array("label" => "Nombre Completo:"));
        parent::buildForm($builder, $options);
        $builder->add('equipo', null, array("label" => "Tu equipo del Exa:"));
        
        
    }

    public function getName()
    {
        return 'exa_prode_registration';
    }
}