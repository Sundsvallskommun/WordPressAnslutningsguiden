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

	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
				'page_title' 	=> 'Inställningar Sidan',
				'menu_title'	=> 'Aloq',
				'menu_slug' 	=> 'theme-generic-settings',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
		));
	}

	foreach (glob (__DIR__.'/functions/*.php') as $file) {
		include_once $file;
	}


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
	
	
	if (class_exists('MultiPostThumbnails')) {
		$types = array('post', 'page');
		foreach($types as $type) {
			new MultiPostThumbnails(array(
					'label' => 'Textbild',
					'id' => 'secondary-image',
					'post_type' => $type
			)
			);
		}
	}

	add_action("wp_ajax_contact_page", "contact_page");
	add_action("wp_ajax_nopriv_contact_page", "contact_page");

	function contact_page() {
		$return = array();
		if ( !wp_verify_nonce( $_REQUEST['nonce'], "contact-page-nonce")) {
			$return['error'] = __("Wrong verification. Please reload the page and try again.");
		}
		else {
			$data = $_REQUEST;
			/* Spamcheck */
			if ($data['website'] == '') {
				$mail = array();
				$mail[] = __('Sender first name').':'.$data['firstname'];
				$mail[] = __('Sender last name').':'.$data['lastname'];
				$mail[] = __('Sender telephone').':'.$data['phone'];
				if ($data['cell'] != '') {
					$mail[] = __('Sender cellphone').':'.$data['cell'];
				}
				$mail[] = __('Sender email').':'.$data['email'];
				if ($data['company'] != '') {
					$mail[] = __('Sender company').':'.$data['company'];
				}
				if ($data['location'] != '') {
					$mail[] = __('Sender location').':'.$data['location'];
				}
				$mail[] = __('Sender message').':';
				$mail[] = $data['message'];
				$to = base64_decode($data['mailto']);
				$sendmail = wp_mail($to, __('Contactform on website'), implode("\n", $mail));
				if ($sendmail) {
					$return['text'] = __('Thank you. We will get back to you as fast as we can.');
				}
				else {
					$return['error'] = __('Could not send the form. Please try again.');
				}
			}
			else {
				$return['error'] = __('Failed spamcheck. Please reload the page and try again.');
			}
		}
		echo json_encode($return);
		die;
	}



	add_action("wp_ajax_servanetlookup", "servanetlookup");
	add_action("wp_ajax_nopriv_servanetlookup", "servanetlookup");

	function servanetlookup() {
		$return = array();
		if ( !wp_verify_nonce( $_REQUEST['nonce'], "servanetlookup-nonce")) {
			$return['error'] = __("Wrong verification. Please reload the page and try again.");
		}
		else {
			$data = $_REQUEST;
			//http://www.example.com/admin/edit/citynetadressess/plain/connected?method=search&api_user=1234&api_key=abcd1234&search=Arholmagatan+12
			/*
			 * http://servanet.se/admin/edit/citynetadressess/plain/connected?method=search&api_user=47504&api_key=59bd313dfd623008411f0125a4721e88&search=Glassgränd+19
			 */
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
//					print_r($matchesRaw);
					$matches = array();
					if (count($matchesRaw) > 0) {
						foreach ($matchesRaw as $matchItem) {
//							$tempObj = new stdClass();
//							$tempObj->link = 'http://www.servanet.se'.(string)$matchItem->link;
//							$tempObj->address = (string)$matchItem->address;
//							$tempObj->source = (string)$matchItem->source;
//							$tempObj->type = (string)$matchItem->type;
//							$tempObj->area = (string)$matchItem->area;
//							$tempObj->city = (string)$matchItem->city;
//							$tempObj->zip = (string)$matchItem->zip;
//							$matches[] = $tempObj;
							$array = array();
							foreach($matchItem as $k => $v) {
								$array[$k] = (string)$v;
							}
							$matches[] = $array;
						}
						$return['results'] = $matches;
					}
					else {
						$return['error'] = 'Din sökning gav inga resultat.';
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
