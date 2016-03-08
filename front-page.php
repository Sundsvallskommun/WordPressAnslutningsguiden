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

	$headerImage = array();
	$headerImage['image'] = get_template_directory_uri().'/img/header.jpg';
	$headerImage['logo'] = get_template_directory_uri().'/img/logo-servanet.png';
	Timber::render('twig/headerimage.twig', $headerImage);

	Timber::render('twig/intro.twig');

	$data = array();
	$data['nonce'] = wp_create_nonce("servanetlookup-nonce");
	$data['url'] = admin_url('admin-ajax.php');

	Timber::render('twig/anslutamotorn.twig', $data);


	/* Intresse */
	$data = array();
	$data['title'] = 'Intresse';
	$data['id'] = 'intresse';
	$data['ingress'] = "En grundförutsättning för att få fiber till ditt hus är att intresset bland dina grannar är tillräckligt stort. Här läser du mer om hur du anmäler intresse och vad som krävs för att vi ska påbörja ett projekt.";
	$data['items'] = array();
	$data['items'][] = array(
		'title'	=>	'Intresseanmälan',
		'application' => 1
	);
	$data['items'][] = array(
		'title'	=>	'Hjälp oss informera',
		'text' => '<p>Det krävs ett större antal intresserade för att vi ska börja titta på fibermöjligheterna i ditt område. Vill du ha fiber kan du prata med dina grannar och uppmana dem att anmäla sitt intresse till oss. Hör gärna av dig om du brinner lite extra för fiber och vill agera fiberambassadör för ditt område.</p>'
	);
	$data['items'][] = array(
		'title'	=>	'Projektering',
		'text' => '<p>När tillräckligt många visat intresse undersöker vi de ekonomiska förutsättningarna för att bygga ut fibernätet i ditt område. Några faktorer som spelar in är hur långt ifrån det befintliga nätet ni bor samt områdets geografi, terräng och markförhållanden.</p>'
	);
	Timber::render('twig/section.twig', $data);

	/* Beställningsstart */
	$data = array();
	$data['title'] = 'Beställning';
	$data['id'] = 'order';
	$data['ingress'] = "När vi har undersökt möjligheterna att fiberansluta ditt område och konstaterat att förutsättningarna är gynnsamma samlar vi in beställningar från er. Här läser du mer om tiden från informationsmöte till beslut om fiberutbyggnad.";
	$data['items'] = array();
	$data['items'][] = array(
		'title'	=>	'Informationsmöte',
		'text'	=> '<p>När projekteringen är avslutad kallas hela området till ett möte där du får information om vad det innebär att fiberansluta sig och hur många som behöver beställa för att vi ska ha möjlighet att bygga fiber till ditt område. Du får även veta anslutningspunktens placering, dit du ska gräva från villan.</p><p>Med dig får du en beställningsblankett med information om vad fiberanslutningen kostar.</p>'
	);
	$data['items'][] = array(
		'title'	=>	'Beställningsperiod',
		'text' => '<p>Efter informationsmötet följer en period, i vanliga fall på mellan två och tre veckor, när vi tar upp beställningar. Kom ihåg att det är antalet beställningar i området som avgör om bygget blir av. Vill du ha en fiberanslutning är det bästa du kan göra att engagera dina grannar och hjälpa oss att sprida information.</p><p>Efter sista beställningsdag börjar vi planera området och om vi får din beställning för sent kan vi inte garantera att du blir ansluten samtidigt som dina grannar.</p>'
	);
	$data['items'][] = array(
		'title'	=>	'Beslut',
		'text' => '<p>Efter sista beställningsdag ser vi om tillräckligt många har beställt för att vi ska kunna starta ett fiberprojekt i ditt område. Om målet inte nås blir området vilande.</p><p>Det innebär att ServaNet inte längre aktivt bearbetar området, men om intresset ökar är det möjligt att aktivera området igen i framtiden. Beroende på våra andra fiberprojekt kan det dröja innan vi har möjlighet att gör ett nytt försök hos dig.</p>'
	);
	Timber::render('twig/section.twig', $data);


	/* Utbyggnad */
	$data = array();
	$data['title'] = 'Utbyggnad';
	$data['id'] = 'expand';
	$data['ingress'] = "När vi fått in tillräckligt många beställningar meddelar vi vårt beslut om att bygga ut fibernätet i ditt område. Här kan du läsa om hur det går till och vad du själv bör tänka på och ta ställning till under utbyggnaden.";
	$data['items'] = array();
	$data['items'][] = array(
		'title'	=>	'Datum meddelas',
		'text'	=> '<p>När beställningsmålet uppnås meddelas du om att fiberdragningen blir av och får ett preliminärt byggstartsdatum. Datumet ligger vanligtvis tre till sex månader fram i tiden, bland annat beroende på årstid. Vi bygger bara under tjälfri säsong och vi ansluter inga villor på vintern.</p>'
	);
	$data['items'][] = array(
		'title'	=>	'Byggstartsmöte',
		'text' => '<p>Innan vi påbörjar grävningen kallas hela området till ett byggstartsmöte. Du får information om vad som händer i området och hur det kommer att påverka dig och dina grannar. Du får veta när du behöver vara färdig med din grävning och när vi beräknar ha anslutit hela området.</p>'
	);
	$data['items'][] = array(
		'title'	=>	'Vi gräver',
		'text' => '<p>Från befintligt fibernät gräver vi nu fiber till ditt område och till de projekterade anslutningspunkterna. Vi gräver på kommunal mark och sköter grävningen i eventuell asfalt.</p>'
	);
	$data['items'][] = array(
		'title'	=>	'Du gräver',
		'dig'	=>	1,
		'text' => '<p>Du gräver och lägger ner fiberslang mellan huset och anslutningspunkten. Sträckan är på din tomt och i vissa fall kan du behöva samordna grävningen med din granne för att ta dig till anslutningspunkten. Därefter borrar du hål i husväggen och drar in fiberslangen.</p>'
	);
	$data['items'][] = array(
		'title'	=>	'Installation',
		'text' => '<p>När alla i området har genomfört sin grävning kommer vi och installerar tjänstefördelare i era hus. Efter installationen behöver vi ungefär två veckor för att aktivera din anslutning. När vi har gjort det får du en leveransbekräftelse av oss och om du har beställt tjänst eller tecknat nätavtal kan du börja surfa.</p>'
	);
	$data['items'][] = array(
		'title'	=>	'Beställ leverantör',
		'text' => '<p>Med en anslutning till ServaNet kan du beställa tjänster inom internet, tv och telefoni från en mängd olika leverantörer. </p>'
	);
	Timber::render('twig/section.twig', $data);


	Timber::render('twig/later.twig');
	Timber::render('twig/dig.twig');
	get_footer();

