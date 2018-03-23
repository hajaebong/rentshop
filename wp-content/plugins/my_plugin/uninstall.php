<?php
//플러그인 삭제
//플러그인을 삭제 하는 방법은 두가지
//하나는 uninstall.php사용, 다른하나는 언인스톨훅사용

//워드프레스 외부에서 언인스톨/삭제 명령이 완다면 종료한다.
if(!defined('ABSPATH') && !defined("WP_UNINSTALL_PLUGIN")){
	exit();
}

//옵션 테이블에서 옵션을 제거한다.
delete_option('gmp_options_arr');

//추가 옵션과 커스텁 테이블을 제거한다.
global $wpdb;
$table_name=$wpdb->perfix . "gmp_data";

//커스텀 테이블을 제거 하는 쿼리를 실행한다.

$sql="drop table " .$table_name. ";";
//테이블 삭제하는 쿼리를 실행한다.
$wpdb->query($sql);

require_once(ABSPATH.'wp_admin/includes/upgrade.php');
dbDelta($sql);
?>

