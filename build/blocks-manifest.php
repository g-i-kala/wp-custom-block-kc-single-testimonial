<?php
// This file is generated. Do not modify it manually.
return array(
	'kc-single-testimonial' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/kc-single-testimonial',
		'version' => '0.1.0',
		'title' => 'KC Single Testimonial',
		'category' => 'widgets',
		'icon' => 'format-quote',
		'description' => 'Render a single testimonial from the testimonial CPT and ACF fields.',
		'supports' => array(
			'html' => false,
			'align' => array(
				'wide',
				'full'
			)
		),
		'attributes' => array(
			'testimonialId' => array(
				'type' => 'number',
				'default' => 0
			)
		),
		'textdomain' => 'kc-single-testimonial',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	)
);
