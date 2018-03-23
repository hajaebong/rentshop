<?php
/**
 * Created by PhpStorm.
 * User: hjb9245
 * Date: 2018-03-19
 * Time: 오후 2:03
 */
//워드프레스 외부에서 언인스톨/삭제 명령이 실행되면 종료한다
if(!defined('ABSPATH')&&!defined('WP_UNINSTALL_PLUGIN')){
	exit;
}

//옵션테이블에서 옵션 배열을 제거한다.
delete_option('pp_options');

global $wpdb;

$table_name=$wpdb->prefix . "gmp_data";

$sql="drop table ".$table_name.";";
$wpdb->query($sql);

require_once(ABSPATH.'wp-admin/includes/upgrade.php');
dbDelta($sql);
?>