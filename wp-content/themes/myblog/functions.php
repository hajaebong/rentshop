<?php
function myblog_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	register_nav_menus( array(
		'main_menu'   => 'Main Menu',
		'footer_menu' => 'Footer Menu'
	) );
}

add_action( 'after_setup_theme', 'myblog_setup' );

function myblog_scripts() {
	wp_enqueue_style( 'myblog_style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'myblog_scripts' );


function pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'type'        => 'plain',
		'base'        => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'      => '?paged=%#%',
		'current'     => max( 1, get_query_var('paged') ),
		'total'       => $wp_query->max_num_pages,
		'prev_text'   => __('<&nbsp;'),
		'next_text'   => __('&nbsp;>'),
	) );
}

function jb_blog_widgets_init(){
	register_sidebar(array(
		'name'=>__('나의블로그사이드바'),
		'id'=>'sidebar-1',
		'before_widget'=>'<div class="jb-sidebar">',
		'after_widget'=>'</div>',
		'before_title'=>'<h2>',
		'after_title'=>'</h2>',
	));
}

add_action('widgets_init','jb_blog_widgets_init');
?>