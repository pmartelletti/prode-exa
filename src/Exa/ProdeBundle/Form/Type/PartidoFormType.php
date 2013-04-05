<?php

namespace Exa\ProdeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class PartidoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('equipo1');
        $builder->add('equipo2');
        $builder->add('fecha');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
           'data_class' => 'Exa\ProdeBundle\Entity\Partido' 
        ));
    }

    public function getName()
    {
        return 'partido';
    }
    
    public function getParent() {
        return 'form';
    }
}

?>
