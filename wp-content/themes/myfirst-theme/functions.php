<?php
function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'extra-menu' => __( 'Extra Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

add_theme_support( 'menus' );

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => '사이드바 위젯',
        'id'   => 'sidebar-widgets',
        'description'   => '사이드바 위젯.',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => '콘텐트 위젯',
        'id'   => 'content-widgets',
        'description'   => '콘텐트 위젯.',
        'before_widget' => '<section id="%1$s" class="content-widgets %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => '푸터 위젯',
        'id'   => 'footer-widgets',
        'description'   => '푸터 위젯.',
        'before_widget' => '<section id="%1$s" class="footer-widgets %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}
?>
