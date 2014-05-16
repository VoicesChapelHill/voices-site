<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Voices, the Chapel Hill Chorus</title>

<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/superfish/hoverIntent.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/superfish/superfish.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.anythingslider.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.anythingslider.fx.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.anythingslider.video.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/swfobject.js"></script>

<script type="text/javascript"> 
	var $j = jQuery.noConflict();
     $j(document).ready(function() { 
        $j('ul.sf-menu').superfish(); 
    }); 
</script>

<script type="text/javascript">
	var $j = jQuery.noConflict();
	$j(document).ready(function () {
		$j('#slider1').anythingSlider({
			width           : 960,
			height          : 380,
			delay           : 10000,
			resumeDelay     : 10000,
			startStopped    : false,
			autoPlay        : true,
			autoPlayLocked  : false,
			easing          : "swing",
			onSlideComplete : function(slider){
				// alert('Welcome to Slide #' + slider.currentPage);
			}
		});
	});
</script>    

<script type="text/javascript"> 
	var $j = jQuery.noConflict();
	$j(document).ready(function () {
		$j('#homeslider iframe').each(function() {
			var url = $j(this).attr("src")
			$j(this).attr("src",url+"&amp;wmode=Opaque")
		});
	});
</script>   
        
 	<?php wp_head(); ?>  
</head>

<body>

<div id="wrap">

	<div id="header"> <!-- pull from Header interface in WordPress -->
  		<a href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" border="0" alt="Voices the Chapel Hill Chorus" /></a>
        <div id="login"><a href="<?php echo site_url( '/members/' ); ?>">Member Login</a></div>
	</div>

	<div id="navbar"> 
		<?php wp_nav_menu( array( 'theme_location' => 'main-nav') ); ?><!-- pull from Custom Menu named Main Navigation -->    
	</div> <!-- close Navbar -->