<?php

namespace Oh\GoogleMapFormTypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GoogleMapType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add($options['lat_name'], $options['type'], array_merge($options['options'], $options['lat_options']))
            ->add($options['lng_name'], $options['type'], array_merge($options['options'], $options['lng_options']))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'type' => 'text',  // the types to render the lat and lng fields as
            'options' => array(), // the options for both the fields
            'lat_options' => array(),   // the options for just the lat field
            'lng_options' => array(),    // the options for just the lng field
            'lat_name' => 'latitude',   // the name of the lat field
            'lng_name' => 'longitude',   // the name of the lng field
            'error_bubbling' => false,
            'map_width' => 300,     // the width of the map
            'map_height' => 300,     // the height of the map
            'default_lat' => 40.4167754,    // the starting position on the map
            'default_lng' => -3.70379019, // the starting position on the map
            'default_zoom' => 10,
            'include_js' => false, // If include js (only once for each template to avoid js problems)
            'include_jquery' => false,   // jquery needs to be included above the field (ie not at the bottom of the page)
            'include_gmaps_js' => false,     // is this the best place to include the google maps javascript?
            'search' => array( //Search box configuration -> false or empty array if you don't want a search box
                'translation_domain' => 'OhGoogleMapFormTypeBundle',
                'placeholder' => 'form.search.placeholder',
                'current_position' => 'form.search.current_position',
            ),
            'show_info' => array( //Show info configuration -> false or empty array if you don't want a show info
                'translation_domain' => 'OhGoogleMapFormTypeBundle',
                'title' => 'form.show_info.title',
                'text' => 'form.show_info.text'
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['lat_name'] = $options['lat_name'];
        $view->vars['lng_name'] = $options['lng_name'];
        $view->vars['map_width'] = $options['map_width'];
        $view->vars['map_height'] = $options['map_height'];
        $view->vars['default_lat'] = $options['default_lat'];
        $view->vars['default_lng'] = $options['default_lng'];
        $view->vars['include_jquery'] = $options['include_jquery'];
        $view->vars['include_gmaps_js'] = $options['include_gmaps_js'];
        $view->vars['default_zoom'] = $options['default_zoom'];
        $view->vars['include_js'] = $options['include_js'];
        $view->vars['search'] = $options['search'];
        $view->vars['show_info'] = $options['show_info'];
    }

    public function getParent()
    {
        return 'form';
    }

    public function getName()
    {
        return 'oh_google_maps';
    }
}
