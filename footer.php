<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Aloq
 * @since Aloq 1.0
 */
?>

<?php
//	wp_enqueue_script('menujs', get_template_directory_uri().'/js/menu.js', null, null, true);

	$footer = array();
	Timber::render('twig/footer.twig', $footer);
?>

	<link type="text/css" rel="stylesheet" href="//fast.fonts.net/cssapi/2dda8f53-35cb-4956-a88b-e64c43b1a597.css"/>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/normalize.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/main.css">
	<?php
		if (stristr($_SERVER['SERVER_NAME'], 'vm02')) {
			$cssFiles = [
				'style'
				,'footer'
				,'header'
				,'section'
				,'intro'
			];
			if (function_exists('extraCss')) {
				$cssFiles = array_merge($cssFiles, extraCss());
			}
			foreach ($cssFiles as $cssFile) {
				?>
				<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $cssFile; ?>.css?v=<?php echo time(); ?>">
				<?php
			}
		}
		else {
			?>
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/combined.min.css?v=<?php echo time(); ?>">
			<?php
		}
	?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/js/main.js?v=<?php echo time();?>"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		<?php if (!stristr($_SERVER['SERVER_NAME'], 'aloq')) {?>
		ga('create', '-', 'auto');
		ga('send', 'pageview');
		<?php } ?>
	</script>
		<?php wp_footer(); ?>
	</body>
</html>
