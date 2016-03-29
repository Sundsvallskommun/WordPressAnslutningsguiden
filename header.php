<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
	<head>
		<meta charset="utf-8">
		<?php if (stristr($_SERVER['SERVER_NAME'], 'aloq')) {?>
		<meta name="robots" content="nofollow, noindex">
		<?php }?>
		<?php if (is_search()) { ?>
		<title>Sökresultat för "<?php echo the_search_query();?>" - <?php bloginfo('name');?></title>
		<?php
		}
		else {
		?>
		<title><?php wp_title(' - ', true, 'right');?></title>
		<?php } ?>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0, width=device-width">

		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/favicon/manifest.json">
		<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon.ico">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/favicon/mstile-144x144.png">
		<meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/favicon/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">

		<script src="<?php echo get_template_directory_uri();?>/js/vendor/modernizr-2.6.2.min.js"></script>
		<?php wp_head(); ?>
		
	</head>
	<?php
		$classes = array();
		if (is_front_page()) {
			$classes[] = 'frontpage';
		}
		else {
			$classes[] = 'subpage';
		}

	?>
	<body class="<?php echo implode(' ', $classes);?>">

	<?php
		$header = array();
		$header['logo'] = get_template_directory_uri().'/img/logo-servanet.png';
		$header['menu'] = get_template_directory_uri().'/img/ikon-meny.png';

		Timber::render('twig/header.twig', $header);
	?>
