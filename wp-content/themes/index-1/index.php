<?php get_header(); ?>
<div id="content">
	<p>테마만들기 시험중 테마명 하재봉테마</p>	
	<p>이미지 추가 시험</p>
	<img src="http://localhost/wordpress/wp-content/themes/index-1/images/apple.jpg" alt="">
	<hr>
	<?php
	if(have_posts()):
		while (have_posts()): the_post();?>
			<div class="test_box"><?php the_ID();?>:
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		<?php
		endwhile;
	endif;
	?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

