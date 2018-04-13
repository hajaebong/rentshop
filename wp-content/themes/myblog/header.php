<div class="jb-header">
	<h1 class="jb-site-title"><a href="<?php echo esc_url( home_url( '/' ) ) ?>"
	                             rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
	//탐색메뉴를 표시합니다.
	wp_nav_menu(
		array(
			//사용할 테마위치,사용자가 선택할수 있도록 register_nav_menu()등록
			'theme_location' => 'main menu',
			//포함할 계층구조의 레벨 수입니다. 0은 모두를 의미, 기본값은 0, 지금은 2단계 까지만 출력하라
			'depth'          => 2,
			//메뉴에 아무것도 없을때 무엇을 출력할지 정함, 기본값은 wp_page_menu로 페이지 목록이 나옵니다. false로 정하면 아무것도 안나옴
			'fallback_cd'    => false,
			'menu_id'        => 'jb-main-menu',
			'menu_class'     => 'jb-menu',
		)
	);
	?>
</div>