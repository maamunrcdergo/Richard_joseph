<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_page-banner-attributes',
		'title' => 'Page Banner Attributes',
		'fields' => array (
			array (
				'key' => 'field_banner_image',
				'label' => 'Banner Image',
				'name' => 'banner_image',
				'type' => 'image',
				'instructions' => 'Upload a image with .jpeg with maximum low resolution minimum size 2200X250 px',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_page_sub_title',
				'label' => 'Page Sub Title',
				'name' => 'page_sub_title',
				'type' => 'text',
				'default_value' => get_bloginfo('name'),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
