<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * GenreType form.
 */
class GenreType extends AbstractType {

    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('genreName', null, array(
            'label' => 'Genre Name',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('genreSource', null, array(
            'label' => 'Genre Source',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('genreUsageNote', null, array(
            'label' => 'Genre Usage Note',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('genreUri', null, array(
            'label' => 'Genre Uri',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('broaderTermId', null, array(
            'label' => 'Broader Term Id',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('books');
    }

    /**
     * Define options for the form.
     *
     * Set default, optional, and required options passed to the
     * buildForm() method via the $options parameter.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Genre'
        ));
    }

}
