<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
    <title><?php wp_title( '-', true, 'right' );
		echo wp_specialchars( get_bloginfo( 'name' ), 1 ) ?></title>
    <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ) ?>"/>
	<?php wp_head() // For plugins(제일중요한 함수 꼭들어가야함 header.php에) ?>
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo( 'rss2_url' ) ?>"
          title="<?php printf( __( '%s latest posts', 'sandbox' ), wp_specialchars( get_bloginfo( 'name' ), 1 ) ) ?>"/>
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo( 'comments_rss2_url' ) ?>"
          title="<?php printf( __( '%s latest comments', 'sandbox' ), wp_specialchars( get_bloginfo( 'name' ), 1 ) ) ?>"/>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>"/>
</head>

<body class="<?php sandbox_body_class() ?>">

<div id="wrapper" class="hfeed">

    <div id="header">
        <h1 id="blog-title"><span>
                <a href="<?php bloginfo( 'home' ) ?>/"
                 title="<?php echo esc_html( get_bloginfo( 'name' )) ?>"
                 rel="home">
                    <img id="logo" src="<?php bloginfo('template_directory'); ?>/img/logo_black.png" alt="My Stables Website" />
                    <?php bloginfo( 'name' ) ?>
                </a>
            </span>
        </h1>
        <?php
        if(is_category('Ponies')){?>
        <img id="raibow" src="<?php bloginfo('template_directory'); ?>/img/rainbow.png" alt="OMG Ponies!">
       <?php } ?>
        <div id="blog-description"><?php bloginfo( 'description' ) ?></div>
    </div><!--  #header -->

    <div id="access">
        <div class="skip-link"><a href="#content"
                                  title="<?php _e( 'Skip to content', 'sandbox' ) ?>"><?php _e( 'Skip to content', 'sandbox' ) ?></a>
        </div>
		<?php sandbox_globalnav() ?>
    </div><!-- #access -->
