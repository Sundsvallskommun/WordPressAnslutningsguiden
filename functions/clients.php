<?php

register_post_type('kunder', array(
    'labels'	=> array(
        'name'			=> __('Kunder'),
        'singular_name'	=> __('kund')
    ),
    'public' 		=> true,
    'rewrite'		=> array('slug' => 'kunder', 'with_front'=> true),
    'supports'		=>	array('title')
));
