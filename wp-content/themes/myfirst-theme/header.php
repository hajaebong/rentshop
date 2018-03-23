<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>"><!--국가별  언어 설정 태그-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"><!--Html에 사용되는 캐릭터셋을 표시합니다.-->

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
    Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title><?php
            //현재 보이는 것을 기준으로 타이틀을 표시함
        global $page,$paged;
        wp_title('|',true, 'right');

        //블로그 이름 추가
        bloginfo('name');

        //homepage 나 front page 에 대해 블로그 태그라인을 표시
        $site_description=get_bloginfo('description','display');
        if($site_description && (is_home() || is_front_page()))
            echo "| $site_description";
        //글에 페이지가 있는 경우 페이지 표시
        if(($paged>=2)||($page>=2))
            echo '|'. sprintf( __('Page %s'), max($paged,$page));
        ?></title>
    <meta name="description" content="" />
    <meta name="author" content="kim" />

    <meta name="viewport" content="width=device-width initial-scale=1.0" />

    <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" title="no title" charset="utf-8"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php if(is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?><!--사용되는 페이지가 single.php
    이면서 댓글상자를 불러올 경우 comment-reply.js 라는 자바스크립트를 활성화 합니다. -->
    <?php wp_head(); ?><!--각종 플로그인에서 사용하는 자바 스크립트나 스타일 시트 파일이 삽입되는 곳 -->
</head>

<body <?php body_class(); ?>><!--페이지나 글에 따라 클래스 선택자를 자동으로 만들어 삽입해줍니다.-->
<div id="container">
    <div id="head-container">
        <header>
            <hgroup>
                <h1><a id="logo" title="<?php echo bloginfo('description');?>" href="<?php echo home_url(); ?>">
                        <?php bloginfo('name')?></a></h1>
                <h2><?php bloginfo('description') ?></h2>
            </hgroup>
        </header>
    </div><!--close head-container-->
    <nav>
        <?php wp_nav_menu(); ?>
    </nav>