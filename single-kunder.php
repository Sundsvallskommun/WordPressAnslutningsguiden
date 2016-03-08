<?php
	$fields = get_fields();
	/* Is this a project? If not, redirect to start */
	if ($fields['is_project'] == 0) {
		header('Location: /', true, 301);
		die;
	}

	get_header();
	the_post();


	/**
	 * Loop and generate.
	 *
	 * Instead of having one page.twig that deals with all,
	 * we now let this file deal with each section.
	 * It's not better, nor worse, just another way.
	 *
	 * We always do the coloured box first.
	 */

	if (count($fields['ingress']) > 0) {
		/* Set default colors, in case they're missing */
		$data = array();
		$data['color1'] = '#f5f5f5';
		$data['color2'] = '#ededed';
		if ($fields['color1'] != '') {
			$data['color1'] = $fields['color1'];
		}
		if ($fields['color2'] != '') {
			$data['color2'] = $fields['color2'];
		}
		$data['colortext'] = $fields['color_text'];
		$data['text'] = array();
		foreach ($fields['ingress'] as $row) {
			$data['text'][] = $row['row'];
		}
		Timber::render('twig/full-height-box.twig', $data);


	}




	echo '<pre>';
	print_r($fields);
	echo '</pre>';

	echo __FILE__;

	get_footer();