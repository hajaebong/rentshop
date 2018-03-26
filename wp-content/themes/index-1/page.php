<?php get_header(); ?>
	<p>현재페이지는 page.php로 표현되는 중입니다.</p>
<?php
if(have_posts()):
	while (have_posts()): the_post();?>
		<p>제목: <?php the_title(); ?></p>
		<?php the_content(); ?>
		<br>
		<?php
	endwhile;
endif;
?>
<?php get_footer(); ?>