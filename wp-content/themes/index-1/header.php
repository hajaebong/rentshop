<!DOCTYPE>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri()?>" type="text/css" media="screen">gkwo
	<link rel="pinkback" href="<?php bloginfo('pinkback_url'); ?>">
	<?php if(is_singular() && get_option('thread_comments')) wp_enqueue_scripts('comment-rely'); ?>
	<?php wp_head(); ?>
</head>
<body>
<div id="header">
<?php wp_nav_menu(); ?>
</div>