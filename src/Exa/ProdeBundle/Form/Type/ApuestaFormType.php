<?php

namespace Exa\ProdeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class ApuestaFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->add('partido', new PartidoFormType() );
        $builder->add('prediccion', 'choice', array(
            'choices' => array("L" => "local", "E" => "Empate", "V" => "Visitante"),
            'expanded' => true,
            'multiple' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => 'Exa\ProdeBundle\Entity\Apuesta',
        ));
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options) {
        parent::buildView($view, $form, $options);
    }

    public function getName()
    {
        return 'apuesta';
    }
    
    public function getParent() {
        return 'form';
    }
    
}

?>
