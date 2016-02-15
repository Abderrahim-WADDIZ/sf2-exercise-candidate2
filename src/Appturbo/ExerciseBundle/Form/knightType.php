<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Appturbo\ExerciseBundle\Form;

use Appturbo\ExerciseBundle\Entity\Knight;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/**
 * Description of knightType
 *
 * @author WADDIZ
 */
class knightType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('strength','integer');
        $builder->add('weapon_power','integer');
    }
    
    public function getName() {
         return 'knight';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Appturbo\ExerciseBundle\Entity\knight'
        ));
    }
}
