<!Doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ) ?>">
	<link rel="profile" href="gmpg.org/xfn/11">
	<?php wp_head() ?>
</head>
<body <?php body_class(); ?>>
<div class="jb-container">
	<?php get_header() ?>
	<div class="jb-content">
		<p>페이지를 찾을수가 없어요~~</p>
	</div>
	<?php get_sidebar()?>
	<div class="jb-footer">
		<p>Copyright © <?php bloginfo( 'name' ); ?>All Right Reserved.</p>
	</div>
</div>
<?php wp_footer() ?>
</body>

</html>