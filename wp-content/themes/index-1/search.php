<?php get_header(); ?>
<p>현재 페이지는 search.php 로 표현중</p>
<p><?php printf(__('search results for %s'), get_search_query()); ?></p>
<?php
if(have_posts()):
	while(have_posts()):the_post();
	the_ID();?>:
	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<br>
		<?php
	endwhile;
endif;
	?>
<?php get_footer(); ?>
