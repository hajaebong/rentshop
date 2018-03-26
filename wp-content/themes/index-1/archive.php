<?php get_header(); ?>
	<p>보이는페이지는 archive.php로 표현됨</p>
	<p><?php single_cat_title('archive:'); ?>에 속한 글들</p>
<?php
if(have_posts()):
	while (have_posts()): the_post();
		the_ID();?>:
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<br>
		<?php
	endwhile;
endif;
?>
<?php get_footer(); ?>