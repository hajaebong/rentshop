<?php
/*
Plugin Name:My Awesome Plugin
Plugin URI: http://example.com/wordpress-plugins/my-plugin Description:
This is a brief description of my plugin Version: 1.0
Author:HA
Author URI: http://example.com
 */

register_activation_hook(__FILE__,'gmp_install');

function gmp_install(){
    global $wp_version;
        if(version_compare($wp_version,"2.9","<")) {
            deactivate_plugins(basename(__FILE__));
            wp_die("This plugin requires WordPress version 2.9 or higher.");
        }
}

register_activation_hook(__FILE__,'gmp_uninstall');

function gmp_uninstall(){

}

$howdy=__('Howdy Neighbor!','gmp-Plugin');
_e('Howdy neighbor!','gmp-plugin');
$error_number=6980;
$error_field="Email";
//$error=__('Error Code','gmp-plugin') . $error_number.':' .$error_field.__('is a required field','gmp-plugin');
printf(__('Error Code %1$d:2$s is a required field','gmp-plugin'),$error_number,$error_field);
?>

<?php
//$count=1;
//printf(__('You have %d new message','gmp-plugin'),$count); 신규 메세지가 하나라면

$count=34;
printf(__ngettext('you have %d mew message','You have %d new message',$count,'gmp-plugin'),$count);
//네개의 매개변수는 단수형, 복수형 실제 숫자와 플러그인룔 도메인 텍스트
?>

<?php
echo _c('Editor|user role','gmp-plugin');
echo _c('Editor|rich-text editor','gmp-plugin');
?>

<?php
add_action('init', 'gmp_init');

function gmp_init(){
    load_plugin_textdomain('gmp-plugin',false,
        plugin_basename(dirname(__File__).'/localization'));
}

if(!defined('WP_CONTENT_URL')){
    define('WP_CONTENT_URL', get_option('http://localhost/wordpress').'/wp-content');
}
if(!defined('WP_CONTENT_DIR')){
    define('WP_CONTENT_DIR', ABSPATH . 'wp_content');
}

if(!defined('WP_PLUGIN_URL')){
    define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
}

if(!defined('WP_PLUGIN_DIR')){
    define('WP_PLUGIN_DIR',WP_CONTENT_DIR . '/plugins');
}

if(!defined('WP_LANG_DIR')){
    define('WP_LANG_DIR', WP_CONTENT_DIR . '/languages');
}

//필터훅
function profanity_filter($content){
    $profanities=array("sissy","dummy");
    $content=str_ireplace($profanities,'[censored]',$content);
    return $content;
}

add_filter('the_content','profanity_filter');

//액션훅
function email_new_comment(){
    wp_mail('me@example.com',__('New blog comment','gmp-plugin'),
        __('There is a new comment on your website: http://example.com','gmp-plugin'));
}
add_action('comment_posts', 'email_new_comment');

function subscribeFooter($content){
    if(is_single()) {
        $content .= '<h3>' . __('Enjoy this article?', 'gmp-plugin') . '</h3>';
        $content .= '<p>' . __('Subscribe to our <a href="http://example.com/feed">RSS feed</a>!', 'gmp-plugin') . '</p>';
    }
    return $content;
}
add_filter('the_content', 'SubscribeFooter');

function custom_title($title){
    $title.='-' .__('By Example.com', 'gmp-plugin');
    return $title;
}

add_filter('the_title', 'custom_title');

function my_default_content($content){
    $content=__('For more great content please subscribe to my rss feed', 'gmp-plugin');
    return $content;
}
add_filter('default_content','my_default_content');

function custom_css() {
	?>
    <style type="text/css">
        a {
            font-size: 14px;
            color: #000000;
            text-decoration: none;
        }

        a:hover {
            font-size: 14px;
            color: #000000;
            text-decoration: underline;
        }
    </style>
<?php
}
    add_action('wp_head','custom_css');

    function site_analytics(){
?>
        <script type="text/javascript">
            var gaJsHost=(("https:"==document.location.protocol)?"https://ssl.":"http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost +'google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E));
        </script><!--javascript 1.5에서는 unescape함수가 사용되지 않는다. 대신 decodeURI() 또는 decodeURIComponent()사용 -->

        <script type="text/javascript">
            var pageTracker= _gat._getTracker("UA-XXXXXX-XX");
            pageTracker._trackPageview();
        </script>
    <?php
    }
    add_action('wp_footer', 'site_analytics');
    $gmp_options_arr=array(
            "gmp_display_mode"=>'Christmas Tree',
            "gmp_default_browser"=>'Chrome',
            "gmp_favorite_book"=>'Professional Wordpress'
    );
    update_option('gmp_display_mode',$gmp_options_arr);
    $gmp_options_arr=get_option('gmp_plugin_options');
    $gmp_display_mode=$gmp_options_arr["gmp_display_mode"];
    $gmp_default_browser=$gmp_options_arr["gmp_default_browser"];
    $gmp_favorite_book=$gmp_options_arr["gmp_favorite_book"];
    delete_option('gmp_display_mode');
?>

<?php
//add_options_page('GMP Setting Page','GMP Setting', 'administrator', __FILE__,'gmp_settings_page');
?>

<?php
//커스텀 프러그인 세팅메뉴
   add_action('admin_menu','gmp_create_menu');
    function gmp_create_menu(){
        //탑레벨 메뉴를 생성한다.
        add_menu_page('GMP plugin Setting','GMP Setting','administrator',
            __FILE__, 'gmp_settings_page', plugins_url('/images/wordpress.png',__FILE__));
        //레지스터 설정 함수 호출
        add_action('admin_init','gmp_register_settings');
        //세개의 서브메뉴르 생성한다:이메일,템프릿,일반메뉴
        add_submenu_page(__FILE__,'email Settings Page', 'Email',
        'administrator',__FILE__.'_email_settings','gmp_settings_email');
        add_submenu_page(__FILE__,'Template Settings page', 'Template', 'administrator'
		    ,__FILE__.'_template_settings','gmp_settings_template');
        add_submenu_page(__FILE__,'General Settings Page','General',
            'administrator', __FILE__.'general_settings','gmp_settings_general');
    }

    function gmp_register_settings(){
     register_setting('gmp-settings-group','gmp_option_name');
     register_setting('gmp-settings-group','gmp_option_email');
     register_setting('gmp-settings-group','gmp_option_url');
    }
?>

<?php
function gmp_settings_page(){
?>
<div class="wrap">
    <h2><?php _e('GMP Plugin Options', 'gmp_plugin'); ?></h2>
    <form method="post" action="options.php">
        <?php settings_fields('gmp-settings-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scop="row"><?php _e('Name','gmp-plugin'); ?></th>
                <td><input type="text" name="gmp_option_name"
                           value="<?php echo get_option('gmp_option_name'); ?>"></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('Email','gmp-plugin'); ?></th>
                <td><input type="text" name="gmp_option_email"
                     value="<?php echo get_option('gmp_option_email'); ?>"></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php _e('URL','gmp-plugin'); ?></th>
                <td><input type="text" name="gmp_option_URL"
                           value="<?php echo get_option('gmp_option_URL'); ?>"></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes','gmp-plugin') ?>">
        </p>
    </form>
</div>
<?php
}
?>



<?php
    //두번째 옵션페이지 방식
    //세팅 섹션의 함수를 실행
    add_action('admin_init','gmp_settings_init');
    function gmp_settings_init(){
        //Setting>Reading 페이지에 새로운 세팅 섹션을 생성
        add_settings_section('gmp_setting_section','GMP Plugin Settings',
            'gmp_setting_section','reading');
        //각각의 설종 옵션을 등록
        add_settings_field('gmp_setting_enable_id','Enable GMP plugin?',
            'gmp_setting_enabled','reading','gmp_setting_section');
        add_settings_field('gmp_saved_setting_name_id','Your Name','gmp_setting_name',
            'reading', 'gmp_setting_section');
    register_setting('reading','gmp_setting_values');
    }

    function gmp_setting_section(){
        echo '<p>Configure the GMP Plugin options below</p>';
    }

    function gmp_setting_enabled(){
        //옵션배열을 로드한다.
        $gmp_options=get_option('gmp_setting_values');

        //옵션값이 존재하면 체크박스를 체크상태로 설정한다.
        if($gmp_options['enabled']){
            $checked='checked="checked"';
        }
        //체크박스 필드를 출력한다.
        echo '<input '.$checked.' name="gmp_setting_values[enabled]" type="checkbox">Enabled';
    }

    function gmp_setting_name(){
        //옵션배열을 로드 한다.
        $gmp_options=get_option('gmp_setting_values');
        //알맞는 배열 옵션삽을 로드한다.
        $name=$gmp_options['name'];
        //텍스트 폼 피드를 출력한다.
        echo '<input type="text" name="gmp_setting_values[name]" value="'.esc_attr($name).'">';
    }
?>

<?php
    add_action('add_meta_boxes','gmp_meta_box_init');
    //메타박스를 추가하고 그 데이터를 저장하는 함수
    function gmp_meta_box_init(){
        //커스텀 메타 박스 생성
        add_meta_box('gmp-meta',__('Product Information','gmp-plugin'),'gmp_meta_box',
            'post','side','default');
        //글이 저장 될때 메타박스의 데이터를 저장 하기 위한 훅
        add_action('save_post','pp_save_meta_box',10,2);
    }
    //매타박스와 폼요소 만들기
    function gmp_meta_box($post,$box){
        //커스텀 메타박스의 값을 설정
        $featured=get_post_meta($post->ID,'_gmp_type',true);
        $gmp_price=get_post_meta($post->ID,'_gmp_price',true);

        //커스텀 메타박스 입력 폼 출력
        echo '<p>'.__('Price','gmp-plugin'). ': <input type="text" 
        name="gmp_price" value="'.esc_attr($gmp_price).'" size="5"></p>
        <p>' .__('Type','gmp-plugin').' : 
        
        <select name="gmp_product_type" id="gmp_product_type">
              <option value="0" '.(is_null($featured)||$featured=='0' ? 'selected="selected" ' : '').'>Normal</option>
              <option value="1" '.($featured=='1' ? 'selected="selected" ' : '').'>Special</option>
              <option value="2" '.($featured=='2' ? 'selected="selected" ' : '').'>Featured</option>
              <option value="3" '.($featured=='3' ? 'selected="selected" ' : '').'>Clearance</option>
        </select>
        </p>';
    }

    function gmp_save_meta_box($post_id,$post){
        //글을 수정 하는 경우에는 메타박스 값을 저장하지 않음
        if($post->post_type=='revision'){
            return;
        }
        //POST값이 있으면 입력 폼의 값을 처리
        if(isset($_POST['gmp_product_type'])) {
	        //글의 id를 고유접두어로 하여, 메타박스의 값은 포스트의 메타정보로 저장
	        update_post_meta( $post_id, '_gmp_type', esc_attr( $_POST['gmp_product_type'] ) );
	        update_post_meta( $post_id, '_gmp_price', esc_attr( $_POST['gmp_price'] ) );
        }
    }
?>
<?php
//숏코드- 워드프레스에 복잡한 코드를 추가 할 필요 없이 개발자가 코드를 만들어 놓으면 플러그인을 설치하여 글이나 페이지를 만들때
//개발자가 만들어 놓은 [숏코드구문] 만 쓰면 해당 코드가 간단히 적용이 되는 것
function say_hello($atts,$content){
    $atts=shortcode_atts(array('bye,'=>0),
        $atts,'hello'
    );

    if($atts['bye']==1){
        return 'bye,'. $content;
    }else{
        return 'hello world!!!'. $content;
    }
}
add_shortcode('hello','say_hello')
?>

<?php
//위젯 생성
//위젯 액션훅 호출
add_action('widgets_init','gmp_register_widgets');

function gmp_register_widgets(){
    register_widget('gmp_widget');
}
//gmp_widget 클래스
class gmp_widget extends WP_Widget{
    //위젯처리 생성자
    function gmp_widget(){
        $widget_ops=array('classname'=>'gmp_widget','description'=>__('Example widget displays a user\'s bio.','gmp-plugin'));
        $this->WP_Widget('gmp_widget_bio',__('BIO Widget','gmp-plugin'),$widget_ops);
    }
    //어드민 대시보드의 위젯폼
    function form($instance){
        //이용자가 아무런 설정도 하지 않았을 경우를 대비 하여 기본값을 설정해 두는 것이다.
        $defaults=array('title'=>__('MY Bio','gmp_plugin'),'name'=>'','bio'=>'');
        //위젯설정에 해당하는 인스턴스  값을 가져온다.만약 위젯이 사이드바에 추가만 된 상태라면 저장될 설정값이 없으므로 이값도 빈 상태로 유지
        $instance=wp_parse_args((array)$instance,$defaults);
        $title=strip_tags($instance['title']);
        $name=strip_tags($instance['name']);
        $bio=strip_tags($instance['bio']);
?>
        <?php //마지막으로 위젯 설정용으로 세개의 폼필드를 출력한다. 데이터를 출력 할때는 필드 값에 esc_attr()같은 적당한 이스케이프 함수를 적용 해야 한다는것?>
    <p><?php _e('Title','gmp_plugin') ?>: <input class="widefat"
                                                        name="<?php echo $this->get_field_name('title'); ?>"
                                                        type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p><?php _e('Name','gmp_plugin'); ?>: <input class="widefat"
                                                        name="<?php echo $this->get_field_name('title'); ?>"
                                                        type="text" value="<?php echo esc_attr($name); ?>">
    </p>
    <p><?php _e('Bio','gmp_plugin'); ?>: <textarea class="widefat" name="<?php echo $this->get_field_name('bio'); ?>">
                                                        <?php echo esc_atts($bio);?></textarea>
    </p>
<?php
    }
    //위젯을 저장한다.
    function update($new_instance, $old_instance){
        $instance=$old_instance;
        $instance['title']=strip_tags($new_instance['title']);
        $instance['name']=strip_tags($new_instance['name']);
        $instance['bio']=strip_tags($new_instance['bio']);
        return $instance;
    }
    //위젯을 출력한다.
    function widget($args,$instance){
        extract($args);

        echo $args['before_widget'];

        $title=apply_filters('widget_title',$instance['title']);
        $name=empty($instance['name']) ? '&nbsp;' : apply_filters('widget_name', $instance['name']);
        $bio=empaty($instance['bio']) ? '&nbsp;' : apply_filters('widget_bio', $instance['bio']);

        if(!empaty($title)){
            echo $args['before_widget']. $title. $args['after_title'];
        }
        echo '<p>'.__('Name','gmp-plugin').':'. $name.'<p>';
        echo $args['after_title'];
    }
}
?>

<?php
//대시보드 위젯 생성
add_action('wp_dashboard_setup','gmp_add_dashboard_widget');
//대시보드위젯 함수를 생성하는 함수를 호출한다.첫번째 매개변수 위젯 ID 슬러그(CSS classname과 위젯 배열의 키),두번째 위젯출력 이름,
//세번째 위젯의 출력이름,네번째 제어용 콜백함수(대시보드 위젯에 폼 요소가 있을 경우 이를 처리)
function gmp_add_dashboard_widget(){
    wp_add_dashboard_widget('gmp_dash_widget',__('GMP Dashboard Widget'),'gmp_create_dashboard_widget');
}

//대시보드 위젯 콘텐츠 함수를 출력하는 함수
function gmp_create_dashboard_widget(){
    _e('Hello world! This is my Dashboard widget','gmp_plugin');
}
?>

<?php
add_option("gmp_db_version","1.0");
//커스텀 테이블 생성
register_activation_hook(__FILE__,'gmp_table_install');

function gmp_table_install(){
    global $wpdb;
    //커스텀 테이블 이름을 정의한다.
    $table_name=$wpdb->prefix."gmp_data";
    //테이블 구조번전을 정한다.
    $gmp_db_version="1.0";
    //테이블이 이미 있는지 여부를 확인한다.
    if($wpdb->get_var("show tables like '$table_name'") !=$table_name){
        //새 테이블을 만드는 쿼리를 작성한다.
        $sql="create table ".$table_name." (
        id mediumint(9) not null auto_increment, time bigint(11) 
        default '0' not null, name tinytext not null, 
        text text not null,
        url varcher(55) not null, unique key id (id)); ";
        require_once(ABSPATH."wp-admin/includes/upgrade.php");
        //테이블을 만드는 쿼리를 실행한다.
        dbDelta($sql);
        //테이블 구조 버전 너버를 저장한다.
        add_option("gmp_db_version, $gmp_db_version");
        }

        //만약 새로운 플러그인 버전에 맞게 테이블 구조를 업그레이드 하고 싶다면 먼저 테이블 버전 넘버를 비교한다.
        //    $install_ver=get_option("gmp_db_version");
        //    if($install_ver!=$gmp_db_version){
        //        //여기에 데이터 베이스 테이블을 업데이트
        //
        //        //테이블 버전을 업데이트
        //        update_option("gmp_db_version",$gmp_db_version);
        //    }
}
?>
<?php
//플러그인 언인스톨 하는 두번째 방법, 훅을 이용한 삭제
//그럼 이방법은 그냥 펑션에다가 넣으면 되는가?
if(function_exists('register_uninstall_hook')) {
	register_uninstall_hook( __FILE__, 'gmp_uninstall_hook' );
}
    function gmp_uninstall_hook(){
        delete_option('gmp_options_arr');
        //추가옵션과 커스텀체이블을 제거한다.
        global $wpdb;
        $table_name=$wpdb->perfix . "gmp_data";

        //커스텀 테이블을 저게하는 쿼리를 만든다.
        $sql="drop table ".$table_name.";";

        //테이블을 삭제하는 쿼리를 실행한다.
        $wpdb->query($sql);
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    //이방식과 register_deactivation_hook 방식의 차이점
    //register_uninstall_hook은 비활성화된 훅이 삭제될때 실행
    //반면 register_deactivation_hook은 플러그인이 비활성화될때 실행,이는 이용자가 어느 순가에 다시 이 플러그인을 활성화 할수 있다는 의미
    //만약 이용자가 플러그 인을 언젠가 다시 사용할 계획이라면 비활성화시에는 플러그인 설정값을 삭제하면 안될것이다.
?>
<!---->
<!--<form method="post">-->
<?php
//    //플러그인 보안
//    //워드프레스애서 다양한 작업 요청(옵션저장, 폼양식 제출, ajax요청)등이 불법적인 것인지 여부를 판단 하고자 비밀키를 생성
//    //비밀키는 폼양식 제출전에 생성된다.
//    //폼논스를 생성할때는 반드시 <form>태그 안에서 wp_nonce_field함수를 호출해야한다.
//    if(function_exists('wp_nonce_field')){
//        wp_nonce_field('gmp_nonce_check');
//    }
?>
<!--    Enter your name: <input type="text" name="text">-->
<!--    <input type="submit" name="submit" value="Save Options">-->
<!--</form>-->
<?php
//function gmp_update_options(){
//    if(isset($_POST['submit'])){
//        check_admin_referer('gmp_nonce_check');
//        //작업코드
//    }
//}
?>


