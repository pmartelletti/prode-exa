<?php

namespace Exa\ProdeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class TarjetaApuestasFormType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('apuestas', 'collection', array('type' => new ApuestaFormType() ));
        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
           'data_class' => 'Exa\ProdeBundle\Entity\TarjetaApuestas' 
        ));
    }

    public function getName()
    {
        return 'tarjetaApuestas';
    }
    
    
}
?>
