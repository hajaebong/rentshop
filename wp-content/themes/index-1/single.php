<?php get_header(); ?>
	<p>이것은 single.php로 표현되는 중임</p>
<?php
if(have_posts()):
	while (have_posts()): the_post(); ?>
		<p>제목: <?php the_title(); ?></p>
		<?php the_content(); ?>
		<br>
		<?php
	endwhile;
endif;
?>
<?php get_footer(); ?>