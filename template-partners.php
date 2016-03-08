<?php 
/*
 * Template Name: Partners
 */

get_header();
the_post();


// wp_enqueue_script('googlemaps', "https://maps.googleapis.com/maps/api/js?sensor=false", null, null, true);
//wp_enqueue_script('contact', get_template_directory_uri().'/js/contact.js', null, null, true);
//	wp_enqueue_script('ion-rangeslider', get_template_directory_uri().'/js/ion.rangeSlider.min.js', null, null, true);
	wp_enqueue_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp', null, null, true);
	wp_enqueue_script('partnersjs', get_template_directory_uri().'/js/partners.js', null, null, true);

// $pages = get_pages(array('child_of' => get_the_ID(), 'sort_column' => 'menu_order'));

	$data = array();
	$fields = get_fields();
	$data['ingress'] = $fields['ingress'];
	$data['title'] = $fields['title'];
	$partners = $fields['partners'];
	$partnersList = array();

	foreach ($partners as $partner) {
		$newPartner = $partner;
		if ($partner['address'] != '') {
			$address = str_replace(array("\n", "\r"), ' ', trim($partner['address']));
			$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false';
			$geocode = json_decode(file_get_contents($url), true);
			if ($geocode['status'] == 'OK') {
				$newPartner['map'] = array(
					'lat' => $geocode['results'][0]['geometry']['location']['lat'],
					'lng' => $geocode['results'][0]['geometry']['location']['lng']
				);
			}
		}
		$partnersList[] = $newPartner;
	}
	$data['partners'] = $partnersList;

	Timber::render('twig/pagepartners.twig', $data);


	get_footer();
