<?php
//이와같은 방법으로 삽입하면 각종 스크립트와 스타일 시트를 불러오는 템플릿태그인 wp_head(); 에 의해 </head>바로 위에 나타납니다.
//그런데 테마를 수정하는데 필요한 주 스타일인 style.css 는 <link> 캐그에 의해 부트스트랩 스타일 시트보다 위에 삽입됩니다.
function my_styles(){
	wp_register_style('font-awesome-stylesheet', get_stylesheet_directory_uri().'/assets/css/font-awesome.css');
	wp_enqueue_style('font-awesome-stylesheet');

	wp_register_style('font-awesome-ie7-stylesheet',get_stylesheet_directory_uri().'/assets/css/font-awesome-ie7.css');
	wp_enqueue_style('font-awesome-ie7-stylesheet');

	wp_enqueue_script('bootstrap-script',get_stylesheet_directory_uri().'/assets/js/bootstrap.js',array('jquery'));
}

add_action('wp_enqueue_scripts','my_styles');


?>
