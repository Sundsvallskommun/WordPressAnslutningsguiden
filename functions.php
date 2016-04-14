<?php
/*
 * Functions file
 */
	add_theme_support( 'post-thumbnails' );

	/* Prevent åäö etc in uploaded filenames */
	add_filter('sanitize_file_name', 'sa_sanitize_file_uploads', 10);

	function sa_sanitize_file_uploads($filename) {
		$sanitizedName = preg_replace("/[^\x20-\x7E]/", "-", $filename);
		return $sanitizedName;
	}

//	if( function_exists('acf_add_options_page') ) {
//		acf_add_options_page(array(
//				'page_title' 	=> 'Inställningar Sidan',
//				'menu_title'	=> 'Aloq',
//				'menu_slug' 	=> 'theme-generic-settings',
//				'capability'	=> 'edit_posts',
//				'redirect'		=> false
//		));
//	}

	/* To allow svg uploads */
	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'cc_mime_types');
	
	/* Handle contact form */
	add_action("wp_ajax_fg_contact", "fg_form_contact");
	add_action("wp_ajax_nopriv_fg_contact", "fg_form_contact");
	
	register_nav_menus(array(
		'main_menu'		=>	'Huvudmenyn',
	));
	
	
	add_action("wp_ajax_servanetlookup", "servanetlookup");
	add_action("wp_ajax_nopriv_servanetlookup", "servanetlookup");

	function servanetlookup() {
		$return = array();
		if ( !wp_verify_nonce( $_REQUEST['nonce'], "servanetlookup-nonce")) {
			$return['error'] = __("Wrong verification. Please reload the page and try again.");
		}
		else {
			$data = $_REQUEST;
			$apiuser = 47504;
			$apikey = '59bd313dfd623008411f0125a4721e88';
			$search = urlencode($data['string']);
			$url = 'http://www.servanet.se/admin/edit/citynetadressess/plain/connected?method=search&api_user='.$apiuser.'&api_key='.$apikey.'&search='.$search;
			$fetch = file_get_contents($url);
			if ($fetch) {
				$xml = new SimpleXMLElement($fetch);
				$xml = $xml->search;
				if ($xml->status == 'success') {
					$matchesRaw = $xml->response->matches->children();
					$matches = array();
					if (count($matchesRaw) > 0) {
						foreach ($matchesRaw as $matchItem) {
							$array = array();
							foreach($matchItem as $k => $v) {
								$array[$k] = (string)$v;
							}
							$matches[] = $array;
						}
						usort($matches, function($a, $b) {
							return strnatcasecmp($a['address'], $b['address']);
						});
						$return['results'] = array_values($matches);
					}
					else {
						$return['nothing'] = 'Din sökning gav inga resultat.';
					}
				}
				else {
					$return['error'] = 'Kunde inte söka.';
				}
			}
		}
		echo json_encode($return);
		die;
	}
