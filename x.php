<?php
	$mouseFollowFacesLocation = '/includes/mouseFollowFaces/img/followMouse_faces';
	$successFacesNames = array('tricia_mcfadden','chris_phelan','chris_savage');
	$isIe = false;
	$isChrome = false;
	$isChromeFrame = false;
	$isFirefox = false;
	
	include('funcs.php');
	
	/* BROWSER DETECTION */
	if     	(isIe()) 			$isIe = true;
	else if (isChrome()) 		$isChrome = true;
	else if	(isChromeFrame()) 	$isChromeFrame = true;
	else if	(isFirefox()) 		$isFirefox = true;
	$ieVersion = ieVersion();
	
	if ($isIe) {
		/* COMPILE LESS TO CSS IF LESS FILE HAS BEEN UPDATED */
		include('/includes/lessphp/lessc.inc.php');
		lessc::ccompile('/styles/x.less', '/styles/x.css');
		lessc::ccompile('/styles/googleChromeFrame.less', '/styles/googleChromeFrame.css');
	}
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 lt-ie10" lang="en"> <![endif]-->
<!--[if IE 10]>    <html class="no-js ie10" lang="en"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
	<?php if ($isIe || $isChromeFrame) { ?>
		<meta http-equiv="X-UA-Compatible" content="chrome=IE8" />
	<?php } ?>
	<meta charset="utf-8" />
	<title><?php bloginfo('name'); ?></title>

	<!-- FOUNDATION ############################### -->
		<!-- Set the viewport width to device width for mobile -->
			<meta name="viewport" content="width=device-width" />
	  
		<!-- Foundation Framework CSS Files -->
			<link rel="stylesheet" href="/includes/foundation/stylesheets/foundation.css" />

			<?php if ($isIe) { ?>
				<?php if ($ieVersion < 9) { ?>
					<link rel="stylesheet" href="/includes/foundation/stylesheets/ie.css" />

					<!-- IE Fix for HTML5 Tags -->
					<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
				<?php } ?>
			<?php } ?>
	
	
	<!-- CUSTOM STUFF ############################### -->
		<!-- STYLES -->
			<?php /* MOUSE-FOLLOWING FACES */ ?>
			<link rel="stylesheet" type="text/css" href="/includes/mouseFollowFaces/css.css" />
			
			<?php if ($isIe) { ?>
				<link rel="stylesheet" type="text/css" href="/styles/x.css" />
				<?php if ($ieVersion < 9 && !$isChromeFrame) { ?>
					<link rel="stylesheet" type="text/css" href="/styles/googleChromeFrame.css" />
				<?php } ?>
			<?php } else { ?>
				<link rel="stylesheet/less" type="text/css" href="/styles/x.less" />
			<?php } ?>
			
			<?php if ($isIe) { ?> <link rel="stylesheet" type="text/css" href="/styles/ie.css"> <?php } ?>
			
			<?php if ($isFirefox) { ?> <link rel="stylesheet/less" type="text/css" href="/styles/ff.css" /> <?php } ?>
				
				
		<!-- SCRIPTS -->
			
			<?php /* ENABLE ALERT MESSAGE FOR CONSOLE.LOG IN OLD IE */ ?>
			<?php if ($isIe) { ?>
				<?php if ($ieVersion > 7 && $ieVersion < 9) { ?>
					<script>
						var alertFallback = false;
						if (typeof console === "undefined" || typeof console.log === "undefined") {
						 console = {};
						 if (alertFallback) {
							 console.log = function(msg) {
								  alert(msg);
							 };
						 } else {
							 console.log = function() {};
						 }
					   }
					</script>
				<?php } ?>
			<?php } ?>
			
			<!-- Parse Less -->
			<?php if (!$isIe) { ?>
				<script src="/includes/lesscss/less_1.3.0.js" type="text/javascript"></script>
			<?php } ?>
			
			<script>
				var isIE = false, isChrome = false, isFirefox = false;
				
				<?php if ($isIe) 			{ ?> isIE = true; <?php } ?>
				<?php if ($isChrome) 		{ ?> isChrome = true; <?php } ?>
				<?php if ($isChromeFrame) 	{ ?> isChromeFrame = true; <?php } ?>
				<?php if ($isFirefox) 		{ ?> isFirefox = true; <?php } ?>
			</script>
			
			<?php wp_enqueue_script("jquery", true); ?>
			<?php
				/* We add some JavaScript to pages with the comment form
				 * to support sites with threaded comments (when in use).
				 */
				if ( is_singular() && get_option( 'thread_comments' ) )
					wp_enqueue_script( 'comment-reply' );
			?>
	
	<?php if (!$isIe || ($isIe && $ieVersion > 8)) { ?>
		<?php wp_head(); ?>
	<?php } else if ($isIe && $ieVersion == 8) { ?>
		<script src="/includes/foundation/javascripts/jquery-1.7.1.min.js"></script>
	<?php } ?>

</head>
<body>
	
	<?php if (!$isIe || ($isIe && $ieVersion > 7)) { ?>
		
		<!--
		<div id="backgroundContainer">
			<div id="backgroundTop">
			</div>
			<div id="backgroundBottom">
			</div>
		</div>
		-->

		<div id="contentContainer">
			<!--**************************************************
				HOME SECTION
			**************************************************-->
			<header id="home" class="sectionContainer">
				<div class="container">
					<div class="row">
						<div class="twelve columns">
							<div id="logo">
								<a href="<?php echo bloginfo('url'); ?>" title="Savage Workouts" rel="bookmark">
									<img src="/images/savage_bannerlogo.png" alt="Savage Workouts, est. 1996" />
								</a>
							</div>
						</div><!-- #Unique ID .twelve columns -->
					</div><!-- #Unique ID .row -->
				</div><!-- container -->
			</header><!-- #home -->

			<!--**************************************************
				MENU
			**************************************************-->
			<div id="menu" class="sectionContainer">
				<div class="container">
					<div class="row">
						<div class="twelve columns">
							<!--
							<dl class="sub-nav">
							  <dt><span>&#9733;</span> Nav <span>&#9733;</span></dt>
							  <dd class="active"><a href="#">Welcome</a></dd>
							  <dd><a href="about">About</a></dd>
							  <dd><a href="success">Success</a></dd>
							  <dd><a href="media">Media</a></dd>
							  <dd><a href="blog">Blog</a></dd>
							  <dd><a href="ready">Ready?</a></dd>
							</dl>
							-->
							
							<?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'menu_class' => 'nav-bar',
								'container' => false,
								'walker' => new My_Walker_Nav_Menu()
							)); ?>
							
							<!-- Menu Format:
							<ul class="nav-bar">
								<li>
									<span>&#9733;</span> Nav <span>&#9733;</span>
								</li>
								<li>
									<a href="#" class="main">Home</a>
								</li>
								<li class="has-flyout">
									<a href="#" class="main">About</a>
									<a href="#" class="flyout-toggle"><span></span></a>
									<div class="flyout small">
										<h5>Hey Chris,</h5>
										<p>This is an example submenu dropdown for your site's navigation. You'll be able to control what shows up in your menu and submenus.</p>
									</div>
								</li>
								<li class="has-flyout">
									<a href="#" class="main">Personal Training</a>
									<a href="#" class="flyout-toggle"><span></span></a>
									<div class="flyout">
										<h5>Hey Chris,</h5>
										<p>This is an example submenu dropdown for your site's navigation. You'll be able to control what shows up in your menu and submenus.</p>
									</div>
								</li>
								<li class="has-flyout">
									<a href="#" class="main">Contact</a>
									<a href="#" class="flyout-toggle"><span></span></a>
									<div class="flyout large right">
										<h5>Hey Chris,</h5>
										<p>This is an example submenu dropdown for your site's navigation. You'll be able to control what shows up in your menu and submenus.</p>
									</div>
								</li>
							</ul>
							-->
							
						</div><!-- #Unique ID .twelve columns -->
					</div><!-- #Unique ID .row -->
				</div><!-- container -->
			</div>

			<!--**************************************************
				WORDPRESS CONTENT
			**************************************************-->
			<div id="wpContent" class="sectionContainer">
				<div class="container">
					<div class="row">
						<div class="nine columns">
							<div class="content">
								<?php if ( have_posts() ) : ?>

									<?php //twentyeleven_content_nav( 'nav-above' ); ?>

									<?php /* Start the Loop */ ?>
									<?php while ( have_posts() ) : the_post(); ?>
										<?php 
											if (is_home() && file_exists('content-home.php')) {
												include( 'content-home.php' );
											}
											else if ( is_single() && file_exists('content-single.php') ) {
												include( 'content-single.php' );
											}
											else if ( is_page() && file_exists('content-page.php') ) {
												include( 'content-page.php' );
											}
											else if ( is_category() && file_exists('content-category.php') ) {
												include( 'content-category.php' );
											}
											else if ( is_tag() && file_exists('content-tag.php') ) {
												include( 'content-tag.php' );
											}
											else if ( is_tax() && file_exists('content-tax.php') ) {
												include( 'content-tax.php' );
											}
											else {
												include( 'content-default.php' );
											}
										?>

									<?php endwhile; ?>

									<?php // twentyeleven_content_nav( 'nav-below' ); ?>

								<?php else : ?>
								<?php endif; ?>
							</div>
						</div><!-- #Unique ID .twelve columns -->
						<aside id="sidebar" class="three columns">
							<?php include('sidebar.php'); ?>
						</aside>
					</div><!-- #Unique ID .row -->
				</div><!-- container -->
			</div>

			<!--**************************************************
				FOOTER
			**************************************************-->
			<footer id="footer" class="sectionContainer">
				<div class="container">
					<div class="row">
						<div class="one columns">
							
							<span class="left">&copy; <a href="<?php echo bloginfo('url'); ?>" title="Savage Workouts" rel="bookmark"><?php echo bloginfo('name'); ?></a></span>
						</div>
						<div class="ten columns">
							<?php wp_nav_menu( array(
								'theme_location' => 'footer',
								'menu_class' => 'footer nav-bar',
								'container' => false,
								//'walker' => new My_Walker_Nav_Menu()
							)); ?>
						</div>
						<div class="one column">
							<span class="right">
								<span>A site by </span>
								<div id="joePea">
									<div class="faces" style="width: auto; height: auto; ">
										<?php for ($i=2; $i<3; $i++) { ?>
											<div id="face<?php echo $i; ?>" class="face_container" data-id="<?php echo $i; ?>">
												<?php for ($j=0; $j<9; $j++) { ?>
													<div id="face<?php echo $i; ?>_<?php echo ($j+1); ?>" class="face">
														<img class="face_img" src="<?php echo $mouseFollowFacesLocation; ?>/joe_pea/<?php echo $j+1; ?>.jpg">
													</div>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								</div>
							</span>
							
						</div><!-- #Unique ID -->
					</div><!-- #Unique ID .row -->
				</div><!-- container -->
			</footer>
			
			

		</div><!-- #contentContainer -->

		
		<?php if (!$isIe || ($isIe && $ieVersion > 8)) { ?>
			<?php wp_footer(); ?>
		<?php } ?>
		
		<?php /* GOOGLE CHROME FRAME FOR IE < 9 */ ?>
		<?php if ($isIe && !$isChromeFrame) { ?>
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>
			<script src="/includes/googleChromeFrame/googleChromeFrame.js"></script>
		<?php } ?>

		<?php if (!$isIe || ($isIe && $ieVersion > 8)) { ?>
			<!-- jQuery -->
			<!--<script src="/includes/foundation/javascripts/jquery-1.7.1.min.js"></script>-->
			
			<!-- Foundation -->
			<script src="/includes/foundation/javascripts/modernizr.foundation.js"></script>
			<script src="/includes/foundation/javascripts/foundation.js"></script>
			
			<!-- Custom Scripts -->
			<script src="/includes/mouseFollowFaces/js.js"></script>
			<script><?php /* This is needed by x.js */ ?>
				var wp_thumbnail_size_w = <?php echo get_option('thumbnail_size_w', '90') ?>,
					wp_thumbnail_size_h = <?php echo get_option('thumbnail_size_h', '90') ?>;
			</script>
			<script src="/scripts/x.js"></script>
		<?php } ?>
	<?php } else { ?>
		<div style="position: absolute; width: 300px; left: 50%; top: 30%; margin-left: -150px;">
			<span style="color: #ffffff;">You should really consider upgrading your version of Internet Explorer. <a href="http://windows.microsoft.com/en-US/internet-explorer/downloads/ie">click here</a> to do so.</span>
		</div>
	<?php } ?>
</body>
</html>




