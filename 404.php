<?php

	/* Page doesn't exist, does it map to a new one? */
	if (file_exists(__DIR__.'/404.csv')) {
		$paths = file_get_contents(__DIR__."/404.csv");
		$paths = explode("\n",$paths);
		$uri = $_SERVER["REQUEST_URI"];

		foreach ($paths as $path) {
			$parts = explode(";",$path);
			if (count($parts) == 2) {
				if ($uri === trim($parts[0])) {
					$new_uri = trim($parts[1]);
					if ($new_uri) {
						header("Location: ".$new_uri,true,301);
						die;
					}
				}
			}
		}
	}


	get_header();
	the_post();

	Timber::render('twig/404.twig', array());


get_footer();
