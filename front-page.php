<?php 
	get_header();
	the_post();

//	wp_enqueue_script('slickjs', get_template_directory_uri().'/js/slick.min.js', null, null, true);
//	wp_enqueue_style('slickcss', get_template_directory_uri().'/css/slick.css', null, null, true);
//	wp_enqueue_style('slickcsstheme', get_template_directory_uri().'/css/slick-theme.css', null, null, true);

//	echo '<div class="slider">';
//	Timber::render('twig/full-height-box.twig', array('color1'=>'#ff0000', 'color2' =>'#00ff00'));
//	Timber::render('twig/full-height-box.twig', array('color1'=>'#0000ff', 'color2' =>'#000000'));
//	echo '</div>';

	$headerData = array();
	$headerData['image'] = get_field('background');
	if ($headerData['image'] == '') {
		$headerData['image'] = get_template_directory_uri().'/img/header.jpg';
	}

	$headerData['logo'] = get_field('logo');
	if ($headerData['logo'] == '') {
		$headerData['logo'] = get_template_directory_uri().'/img/logo-servanet-stor.png';
	}

	$headerData['title'] = get_field('title');
	if ($headerData['title'] == '') {
		$headerData['title'] = "Anslutningsguiden";
	}

	$headerData['subtitle'] = get_field('subtitle');
	if ($headerData['subtitle'] == "") {
		$headerData['subtitle'] = "Din hjälp till en trygg fiberanslutning";
	}

	Timber::render('twig/headerimage.twig', $headerData);


	$intro = array();
	$intro['top'] = array();

	$intro['top']['title'] = get_field('i_title');
	if ($intro['top']['title'] == '') {
		$intro['top']['title'] = 'Anslutningsguiden – För dig i villa';
	}

	$intro['top']['text'] = get_field('i_text');
	if ($intro['top']['text'] == '') {
		$intro['top']['text'] = 'Anslutningsguiden är till för dig som är intresserad av att fiberansluta din villa eller redan är på väg att få en anslutning. Här kan du läsa om förloppet – från intresseanmälan till färdig anslutning.';
	}

	$intro['bottom'] = array();
	$intro['bottom']['title'] = get_field('i_lower_title');
	if ($intro['bottom']['title'] == '') {
		$intro['bottom']['title'] = "Så här fungerar guiden";
	}

	$intro['bottom']['text'] = get_Field('i_lower_text');
	if ($intro['bottom']['text'] == '') {
		$intro['bottom']['text'] = "Att dra in fiber till ditt hushåll innehåller ett flertal etapper. Här kan du följa hela processen uppdelat i tre faser.";
	}

	$intro['image'] = get_field('i_image');
	if ($intro['image'] == '') {
		$intro['image'] = get_template_directory_uri().'/img/foto-intro.jpg';
	}
	Timber::render('twig/intro.twig', $intro);


	$data = array();
	$data['nonce'] = wp_create_nonce("servanetlookup-nonce");
	$data['url'] = admin_url('admin-ajax.php');

	$data['title'] = get_field('a_title');
	if ($data['title'] == '') {
		$data['title'] = 'Sök på din fiberstatus';
	}

	$data['text'] = get_field('a_text');
	if ($data['text'] == '') {
		$data['text'] = 'Som privatperson kan du söka på ditt gatunamn för att se om du är ansluten eller tillhör ett område som är påväg att anslutas.';
	}

	$data['bgimage'] = get_field('a_image');
	if ($data['bgimage'] == '') {
		$data['bgimage'] = get_template_directory_uri().'/img/foto-sundsvall.jpg';
	}

	Timber::render('twig/anslutamotorn.twig', $data);


	/* Sections */
	$sections = get_field('section');
//	echo '<pre>';
//	print_r($sections);die;

	foreach ($sections as $section) {
		Timber::render('twig/section_f_backend.twig', $section);
	}


	$after = array();
	$after['title'] = get_field('af_title');
	if ($after['title'] == '') {
		$after['title'] = 'Vill du efteransluta dig?';
	}
	$after['text'] = get_field('af_text');
	if ($after['text'] == '') {
		$after['text'] = 'Missade du tåget när vi drog fiber till ditt område, eller är du nyinflyttad och vill ansluta dig? Med fiber i området är möjligheterna stora att vi kan efteransluta ditt hus.';
	}
	$after['steps'] = get_field('af_steps');
	Timber::render('twig/after.twig', $after);


	$order = Array();
	$order['title'] = 'Beställa tjänsteleverantör';
	$order['title'] = get_field('tl_title');
	$order['rows'] = get_field('tl_rows');
	Timber::render('twig/order.twig', $order);

	$dig = array();
	$dig['title'] = get_field('dig_title');
	$dig['text'] = get_field('dig_text');
	$dig['video'] = get_field('video');
	Timber::render('twig/dig.twig', $dig);
	get_footer();

