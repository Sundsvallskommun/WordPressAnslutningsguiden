<?php

register_post_type('offices', array(
    'labels'	=> array(
        'name'			=> __('Kontor'),
        'singular_name'	=> __('office')
    ),
    'public' 		=> true,
    'rewrite'		=> array('slug' => 'office', 'with_front'=> false),
    'supports'		=>	array('title', 'page-attributes')
));
