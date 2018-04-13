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
		<h2>tag : <?php single_tag_title();?></h2>
		<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post(); ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php endwhile; ?>
		<?php endif ?>
	</div>
	<?php get_sidebar()?>
	<div class="jb-footer">
		<p>Copyright © <?php bloginfo( 'name' ); ?>All Right Reserved.</p>
	</div>
</div>
<?php wp_footer() ?>
</body>

</html>