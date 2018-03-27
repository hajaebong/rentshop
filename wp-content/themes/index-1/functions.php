<?php
function register_my_menu(){
	register_nav_menu('header-menu',__('Header Menu'));
}
add_action('init','register_my_menu');

function register_my_sidebar(){
	register_sidebar(array(('name')=>__('Main Sidebar')));
}
add_action('init','register_my_sidebar');

//커스텀 택소노미 구축
//워드프레스 초기화 할떄 훅을 호출,함수 실행
add_action('init','define_ingredient_taxonomy',0);
function define_ingredient_taxonomy(){
	//척번째 메개변수 택소노미이름, 두번째 객체타입 페이지나 링트도 가능 세번째 첫번째 계층적인지, 두번째: 관리자페이지에서 사용될 이름 세번째:사용자정의쿼리포스트도 이택소노미를 사용하냐?
	//네번째 택소노미를 볼떄 간략한 고유주소체계를 사용할지 여부
	register_taxonomy('ingredients','post',array('hierarchical'=>false,
	                                             'label'=>'Ingredients','query_var'=>true,'rewrite'=>true));
}

register_taxonomy('ingredients','post',array('hierarchical'=>false,
                                             'label'=>'Ingredients','query_var'=>true,'rewrite'=>true));
add_action('admin_menu','tax_page_meta_box');
function tax_page_meta_box(){
	foreach(get_object_taxonomies('page') as $taxes){
		$mytax=get_taxonomy($taxes);
		add_meta_box("tag-ings",$mytax->label,'post_tags-meta_box','page','side','core');
	}
}
//wp_tag_cloud 함수는 다양한 인수를 받을 수있지만 이예제에서는 taxonomy와 number라는 두개의 인수만 사용한다. 우선 taxonomy에 ingredients를 설정한다.
//이것은 커스텀 택소노미인 igredients에서 만든 택소노미 용어만 사용하겟다는 것을 의미,그다음으로 몇개를 출력할지 용어의 개수를 정한다.
//wp_tag_cloud(array('taxonomy'=>'ingredients','number'=>5));
////특정 택소노미 용어가 붙은 포스트만 출력 할 수있도록... 레시피에 nutmeg가 있는 포스트만 출력하려면 다음과 같이
//query_posts(array('ingredients'=>'nutmeg','showposts'=>15));
////각 포스트에 적용된 커스텀 택소노미 용어들도 쉽게 출력 할수 있으며, 워드 프레스의 get_the_term_l;ist함수를 이용한다. 이함수는 get_the_tag_list와 거의
////동일하게 동작하며 캐그대신 택소노미 용어를 출력하는 것만 다르다
//echo get_the_term_list($post->ID,'ingredients','Ingredients Used:',' , ','');
?>