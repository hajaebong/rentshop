<?php
/**
Created by PhpStorm.
User: hjb9245
Date: 2018-03-19
Time: 오후 2:03
Plugin Name: post products
Plugin URI: http://webdevstudio.com/support/wordpress-plugins
Description: Easily add products data to posts.
Author: brad ha
Version: 1.0
Author URI: http://webdevstudios.com
 */

//플러그인이 활성화되면 함수를 호출한다.
register_activation_hook(__FILE__,'pp_install');

//플로그인을 초기하 하는 액션훅
add_action('admin_init', 'pp_init');

//옵션 설정을 등록하는 액션훅
add_action('admin_init','pp_register_settings');

//post product 메뉴아이템을 추가하는 액션훅
add_action('admin_menu','pp_menu');

//글이 저장될때 메타박스의 데이터를 저장하기 위한 훅
add_action('save_post'.'pp_save_meta_box',10,2);

//post product 숏코드를 생성하는 액션훅
add_shortcode('pp', 'pp_shortcode');

//플러그인 위젯을 생성하는 액션훅
add_action('widgets_init','pp_register_widgets');

function pp_install(){
	//기본 옵션값을 설정한다.
	$pp_options_arr=array(
		"currency_sign"=>'$'
	);
	//기본 옵션값을 저장한다.
	update_option('pp_options',$pp_options_arr);
}

//post product 서브메뉴를 생성한다.add_options_page 함수를 사용하여 서브메뉴를 대시보드의 설정 메뉴 냐에 추가한다.
//관리자 에게만 보이도록 권한 설정
function pp_menu(){
	add_options_page(__('Post Products Settings Page', 'pp-plugin'),
		__('Post Products Settings','pp-plugin'),'administrator',
		__FILE__,'pp_settings_page');
}

//포스트 메타박스를 생성한다.
function pp_init(){
	//커스텀 메타박스를 생성한다.
	//메타 박스의 제목을 post products information 이라고 정했다. 위치는 측면
	add_meta_box('pp-meta',__('Post Products information','pp-plugin'),'pp_meta_box','post',
		'side','default');
}

//숏코드를 생성한다.
function pp_shortcode($atts, $content=null){
	//전역변수 초기화 이과정에서 숏코드에 사용할 $post->ID 값을 얻는다.
	global $post;
	//이어서 show라고 정의한 숏코드속성을 불어온다. 그리고 계속 옵션 배열값이 불어온다.
	extract(shortcode_atts(array(
		"show"=>''
	),$atts));

	//옵션배열을 로드한다.
	$pp_options=get_option('pp_options');
	//숏코드에 전달되는 값을 확인하여 어떤 값을 출력할지를 결정한다.만약 [pp show=price]라는 숏코드를 사용하면 제품가격이 출력
	if($show=="sku"){
		$pp_show=get_post_meta($post->ID,'pp_sku',true);
	}elseif($show=='price'){
		$pp_show=$pp_options['currency_sign'].get_post_meta($post->ID,'pp-price',true);
	}elseif($show=='weight'){
		$pp_show=get_post_meta($post->ID, 'pp_wight',true);
	}elseif($show=='color'){
		$pp_show=get_post_meta($post->ID,'pp_color',true);
	}elseif($show=='inventory'){
		$pp_show=get_post_meta($post->ID, 'pp_inventory',true);
	}
	return $pp_show;
}

//post products 메타박스를 만든다.
function pp_meta_box($post,$box){
	//커스텀 메타박스 값을 가져온다.
	$pp_sku=get_post_meta($post->ID,'pp_sku',true);
	$pp_price=get_post_meta($post->ID,'pp_price',true);
	$pp_weight=get_post_meta($post->ID,'pp_weight',true);
	$pp_color=get_post_meta($post->ID,'pp_color',true);
	$pp_inventory=get_post_meta($post->ID,'pp_inventory',true);

	//테마박스폼을 출력한다.
	echo '<table>';
	echo '<tr>';
	echo  '<td>'.__('sku','pp-plugin').' :</td><td><input type="text"
			name="pp_sku" value="'.esc_attr($pp_sku).'" size="10"></td>';
	echo    '</tr><tr>';
	echo    '<td>'.__('price','pp-plugin').':</td><td><input type="text" name="pp_price" value="'.esc_attr($pp_price).'" 
             size="5"></td>';
	echo    '</tr><tr>';
	echo    '<td>'.__('Weight','pp-plugin').' :</td><td><input type="text"
			name="pp_weight" value="'.esc_attr($pp_weight).'" size="5"></td>';
	echo 	'</tr><tr>';
	echo 	'<td>'.__('Color','pp-plugin').' :</td><td><input type="text"
			name="pp_color" value="'.($pp_color).'" size="5"></td>';
	echo 	'</tr><tr>';
	echo 	'<td>inventory :</td><td><select name="pp_inventory" id="pp_inventory">
			<option value="'.__('in Stock','pp_plugin').'"
			'.(is_null($pp_inventory) || $pp_inventory==__('in Stock', 'pp-plugin') ?
			'selected="selected"':'').'>'.__('in Stock','pp-plugin').'</option>
			<option value="'.__('Backordered','pp-plugin').'"
			'.($pp_inventory==__('Backordered','pp-plugin') ? 'selected="selected"'
			: '').'>'.__('Backorderd','pp-plugin').'</option>
			<option value="'.__('out of Stock','pp_plugin').'">
			'.($pp_inventory==__('out of stock','pp-plugin') ?
			'selected="selected"': '').'>'.__('out of stock','pp-plugin').'</option>
			<option value="'.__('Discontinued','pp-plugin').'"
			'.($pp_inventory==__('Discontinued','pp-plugin') ?
			'selected="selected"' : '').'>'.__('Discontinued','pp-plugin').'</option>
			</select></td>';
	echo    '</tr>';
	//매타박스 솟코드 범례 영역을 출력한다.
	echo    '<tr><td colspan="2"><hr></td></tr>';
	echo    '<tr><td colspan="2"><stong>'
	        .__('Shortcode Legend','pp-plugin').'</stong></td></tr>';
	echo    '<tr><td>'.__('Sku', 'pp-plugin').':</td><td>[pp show=sku]</td></tr>';
	echo    '<tr><td>'.__('Price','pp-plugin')
	        .':</td><td>[pp show=price]</td></tr>';
	echo    '<tr><td>'.__('Weight','pp-plugin')
	        .'</td><td>[pp show=weight]</td></tr>';
	echo    '<tr><td>'.__('color','pp-plugin')
	        .'</td><td>[pp show=color]</td></tr>';
	echo    '<tr><td>'.__('inventory','pp-plugin')
	        .'</td><td>[pp show=inventory]</td></tr>';
	echo 	'</table>';
}

//메타박스 테이터를 저장한다.
function pp_save_meta_box($post_id,$post){
	//포스트가 수정본이면 메타박스 데이터를 저장하지 않는다.
	if($post->post_type=='revision'){
		//여기에 경고창 하나 띄워도 됨
		return;
	}
	//$_POST가 설정 되었다면 폼데이터를 처리한다.
	if(isset($_POST['pp_sku'])&& $_POST['pp_sku']!=''){
		//포스트id를 고유접두어로 삼아 메타박스 데이터를 포스트 메타로 저장한다.
		update_post_meta($post_id,'pp_sku',esc_attr($_POST['pp_sku']));
		update_post_meta($post_id,'pp_price',esc_attr($_POST['pp_price']));
		update_post_meta($post_id,'pp_weight',esc_attr($_POST['pp_weight']));
		update_post_meta($post_id,'pp_color',esc_attr($_POST['pp_color']));
		update_post_meta($post_id,'pp_inventory',esc_attr($_POST['pp_inventory']));
	}
}

//최신제품을 보여주는 위젯
//위젯을 등록한다.
function pp_register_widgets(){
	register_widget("pp_widget");//php 7.x이상 pp_widget 문자열에쌍따옴표해야함
}

//pp_widget 클래스
class pp_widget extends WP_Widget {
	//새 위젯을 구성한다. 생성자 함수, 커스텀 위젯의 제목과 설며으 클래스 이름을 설정한다.
	function pp_widget() {
		$widget_pos = array(
			'classname'   => 'pp_widget',
			'description' => __( 'Display Post products', 'pp_plugin' )
		);
		$this->WP_Widget( 'pp_widget', __( 'Post products widget', 'pp-plugin' ), $widget_pos );
	}

	//위젯 설정 폼 함수를 만든다.
	function form( $instance ) {
		$defaults        = array( 'title' => __( 'Products', 'pp-plugin' ), 'number_products' => '' );
		$instance        = wp_parse_args( (array) $instance, $defaults );
		$title           = strip_tags( $instance['title'] );
		$number_products = strip_tags( $instance['number_products'] );
		?>
        <p>
			<?php _e( 'Title', 'pp-plugin' ) ?>:
            <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>"
                   type="text" value="<?php echo esc_attr( $title ); ?>" size="2" maxlength="2">
        </p>
        <p><?php _e( 'Number of Products', 'pp-plugin' ); ?>: <input
                    name="<?php echo $this->get_field_name( 'number_products' ); ?>"
                    type="text" value="<?php echo esc_attr( $number_products ); ?>" size="2" maxlength="2">
        </p>
		<?php
	}

	//위젯설정값을 저장 하는데 사용
	function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']           = strip_tags( esc_attr( $new_instance['title'] ) );
		$instance['number_products'] = intval( $new_instance['number_products'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		//전역변수 초기화
		global $post;
		//위젯에 사용할 $args값을 불러온다.
		extract( $args );
		//$args가 배열임 그안에 이런형태로 구성
//	$args = array(
//	'name'          => __( 'Sidebar name', 'theme_text_domain' ),
//	'id'            => 'unique-sidebar-id',    // ID should be LOWERCASE  ! ! !
//	'description'   => '',
//  'class'         => '',
//	'before_widget' => '<li id="%1$s" class="widget %2$s">',
//	'after_widget'  => '</li>',
//	'before_title'  => '<h2 class="widgettitle">',
//	'after_title'   => '</h2>' );

		echo $before_widget;
		$title           = apply_filters( 'widget-title', $instance['title'] );
		$number_products = empty( $instance['number_products'] ) ? '&nbsp;' : apply_filters( 'widget_number_products',
			$instance['number_products'] );
//만약 $title갑이 설정 되지 않았다면 이전에 정의 해둔 기본 값을 이용한다.
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		//WP_Query 이용해서 커스텀 루프생성,현재 루프는 메인 루프에 있지 않으므로 query_posts를 사용하는 대신WP_Query를 사용하여 커스톰 =루프를 생성
		$dispProducts = new WP_Query();
		//커스텀 루프를 생성하기 위해서 두개의 매개변수를 전달 해야 하는데 하나는 포스트 메타값, 다른 하나는 출력할 프로덕트의 개수다.
		//첫번째 값인 meta_key=pp_sku는 커스텀 메타값이 설정된 포스트만 반환하라는 의미, 두번째값은 showposts는 몇개의 포스트 프로덕트만 출력할 것인지 의미-이숫자는 유저 옵션값에 따름
		$dispProducts->query( 'meta_key=pp_sku&showposts=' . $number_products );
		while ( $dispProducts->have_posts() ): $dispProducts->the_post();
			//옵션 배열을 로드한다.
			$pp_options = get_option( 'pp_options' );
			//커스텀 메타값을 로드한다.
			$pp_price     = get_post_meta( $post->ID, 'pp-price', true );
			$pp_inventory = get_post_meta( $post->ID, 'pp_inventory', true );
			?><p><a href="<?php the_permalink(); ?>" rel="bookmark"
                    title="<?php the_title_attribute(); ?>Products Information">
				<?php the_title(); ?></a>
            </p><?php echo '<p>' . __( 'price', 'pp-plugin' ) . ':' . $pp_options['currency_sign'] . $pp_price . '</p>';
			//show inventory 옵션이 활성화 됐는지를 확인한다.
			if ( $pp_options['show_inventory'] ) {
				echo '<p>' . __( 'Stock', 'pp-plugin' ) . ':' . $pp_inventory . '</p>';
			}
			echo '<hr />';
		endwhile;
		echo $after_widget;
	}
}
	function pp_register_settings(){
		//설정배열을 등록한다.
		register_setting('pp-settings-group','pp_options');
	}

	function pp_settings_page(){
		//옵션배열을 로드한다. 모든 설정값을 배열에 저장하므로 pp_options라는 한개의 설정만 저장하면 된다.
        //플러그인 옵션 배열값을 불러온다.
		$pp_options=get_option('pp_options');
		//show inventory 옵션이 체크로 되어 있는지 확인한다.
        if(is_array($pp_options)){//비교연산에서 배열값을 체크할때 배열이 지정되지 않았을때 에러가 나므로 이구문을 추가한다.
		if($pp_options['show_inventory']){
			$checked='checked="checked"';
		}
		$pp_currency=$pp_options['show_inventory'];
        }
		?>
		<div class="wrap">
			<h2><?php _e('Post Products Options', 'pp-plugin'); ?></h2>

			<form method="post" action="options.php">
				<?php settings_fields('pp-setting-group'); //세팅폼과 이용자가 입력한 등록값을 연결 ?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('Show Product Inventory','pp-plugin'); ?></th>
						<td><input type="checkbox" name="pp_options[show_inventory]" <?php echo $checked; ?>></td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php _e('Currency Sign', 'pp-plugin'); ?></th>
						<td><input type="text" name="pp_options[currency_sign]"
						           value="<?php echo $pp_currency; ?>" size="1" maxlength="1"></td>
					</tr>
				</table>

				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes','pp-plugin'); ?>">
				</p>
			</form>
		</div>
<?php

    }
?>