<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * SupplementalPlaceDataType form.
 */
class SupplementalPlaceDataType extends AbstractType {

    /**
     * Add form fields to $builder.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('geonameId', null, array(
            'label' => 'Geonameid',
            'required' => true,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('geoname', null, array(
            'label' => 'Geoname',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('latitude', null, array(
            'label' => 'Latitude',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
        $builder->add('longitude', null, array(
            'label' => 'Longitude',
            'required' => false,
            'attr' => array(
                'help_block' => '',
            ),
        ));
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
            'data_class' => 'AppBundle\Entity\SupplementalPlaceData'
        ));
    }

}
