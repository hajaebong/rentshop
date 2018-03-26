<?php
function register_my_menu(){
	register_nav_menu('header-menu',__('Header Menu'));
}
add_action('init','register_my_menu');

function register_my_sidebar(){
	register_sidebar(array(('name')=>__('Main Sidebar')));
}
add_action('init','register_my_sidebar');
?>