<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
  'key' => 'group_55659a66ee0b5',
  'title' => 'Event',
  'fields' => array (
    array (
      'key' => 'field_55659a7b0cbc1',
      'label' => 'Title',
      'name' => 'title',
      'type' => 'wysiwyg',
      'instructions' => '',
      'required' => 1,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'tabs' => 'visual',
      'toolbar' => 'simple',
      'media_upload' => 0,
    ),
    array (
      'key' => 'field_55659a960cbc2',
      'label' => 'Date',
      'name' => 'date',
      'type' => 'date_picker',
      'instructions' => '',
      'required' => 1,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'display_format' => 'd/m/Y',
      'return_format' => 'd/m/Y',
      'first_day' => 1,
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'event',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
));

endif;
