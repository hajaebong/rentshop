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

<?php
global $wpdb;
$field_key="address";
$field_value="12 Elm St";
//$result=$wpdb->query($wpdb->prepare("INSERT INTO {$wpdb->prefix}my_custom_table ( id, field_key, field_value ) VALUES ( %d, %s, %s )",10, $field_key, $field_value));
//echo $result;
//$wpdb->show_errors();
//$result=$wpdb->query($wpdb->prepare("delete from {$wpdb->prefix}my_custom_table where id='1' and field_key='address'"));
//$wpdb->print_error();
?>
