<?php
/**
 * Шаблон шапки (header.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); // вывод атрибутов языка ?> class="var1">
<head>
	<meta charset="<?php bloginfo( 'charset' ); // кодировка ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php /* RSS и всякое */ ?>
	<link rel="alternate" type="application/rdf+xml" title="RDF mapping" href="<?php bloginfo('rdf_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="Comments RSS" href="<?php bloginfo('comments_rss2_url'); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="stylesheet" href="<?echo get_template_directory_uri();?>/css/slick.css">
	<link rel="stylesheet" href="<?echo get_template_directory_uri();?>/css/slick-theme.css">
	<link rel="stylesheet" href="<?echo get_template_directory_uri();?>/css/lightbox.css">
	<link rel="stylesheet" href="<?echo get_template_directory_uri();?>/css/main.css">
	
	<link sizes="57x57" href="/wp-content/themes/tree/images/57.png" rel="apple-touch-icon">
    <link sizes="114x114" href="/wp-content/themes/tree/images/114.png" rel="apple-touch-icon">
    <link sizes="72x72" href="/wp-content/themes/tree/images/72.png" rel="apple-touch-icon">
    <link sizes="144x144" href="/wp-content/themes/tree/images/144.png" rel="apple-touch-icon">
    <link sizes="60x60" href="/wp-content/themes/tree/images/60.png" rel="apple-touch-icon">
    <link sizes="120x120" href="/wp-content/themes/tree/images/120.png" rel="apple-touch-icon">
    <link sizes="76x76" href="/wp-content/themes/tree/images/76.png" rel="apple-touch-icon">
    <link sizes="152x152" href="/wp-content/themes/tree/images/152.png" rel="apple-touch-icon">
    <link sizes="196x196" href="/wp-content/themes/tree/images/196.png" rel="icon" type="image/png">
    <link sizes="128x128" href="/wp-content/themes/tree/images/128.png" rel="icon" type="image/png">
    <link sizes="96x96" href="/wp-content/themes/tree/images/96.png" rel="icon" type="image/png">
    <link sizes="16x16" href="/wp-content/themes/tree/images/16.png" rel="icon" type="image/png">
    <link sizes="32x32" href="/wp-content/themes/tree/images/32.png" rel="icon" type="image/png">

	<?php /* Все скрипты и стили теперь подключаются в functions.php */ ?>

	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); // необходимо для работы плагинов и функционала ?>
<? if($post->ID==14){ ?>
	<style>.header-page-block { height: 100px;}</style>
    <? }; ?>
</head>
<body <?php body_class(); // все классы для body ?>>
<div id="modal-posts-window" class="modal-posts-window modal-window"></div>
<div id="modal-loginForm" class="modal-posts-window modal-window">
	<? echo do_shortcode('[loginform]'); ?>
		
</div>
<div class="overlay" id="overlay_form" style="display: none;" onclick="return close_all();"></div>
	<header>
		<div class="sidebar-block">
			<a href="/" class="mainP_link">
				<img src="<?echo get_template_directory_uri();?>/images/Logo-210.png" alt="" class="left-sidebar-logo">
			</a>
			<a href="" class="left-regTreeButton">Зарегистрировать посаженное дерево</a>
			<div class="left-menu-block">
				<div class="close-menu-btn">X</div>
				<?php $args = array( // опции для вывода верхнего меню, чтобы они работали, меню должно быть создано в админке
					'theme_location' => 'left', // идентификатор меню, определен в register_nav_menus() в functions.php
					'container'=> false, // обертка списка, тут не нужна
					'menu_id' => 'top-nav-ul', // id для ul
					'items_wrap' => '<ul id="%1$s" class=" %2$s">%3$s</ul>',
					'menu_class' => 'left-menu', // класс для ul, первые 2 обязательны
					'walker' => new bootstrap_menu(true) // верхнее меню выводится по разметке бутсрапа, см класс в functions.php, если по наведению субменю не раскрывать то передайте false		  		
					);
					wp_nav_menu($args); // выводим верхнее меню
				?>
			</div>
			<? get_sidebar();  ?>
			<div class="left-sidebar-block">
				
			</div>
			<ul class="left-socList">
				<li class="left-socList-item"><a target="_blank" href="https://vk.com/yaposadilderevo">
					<img src="<?echo get_template_directory_uri();?>/images/vk.png" alt="">
					<img class="hoverImg"src="<?echo get_template_directory_uri();?>/images/0-03-small.png" alt="">
				</a></li>
				<li class="left-socList-item"><a target="_blank" href="">
					<img src="<?echo get_template_directory_uri();?>/images/facebook.png" alt="">
					<img class="hoverImg" src="<?echo get_template_directory_uri();?>/images/0-01-small.png" alt="">
				</a></li>
				<li class="left-socList-item"><a target="_blank" href="https://www.instagram.com/yaposadilderevo/">
					<img src="<?echo get_template_directory_uri();?>/images/instagram.png" alt="">
					<img class="hoverImg"src="<?echo get_template_directory_uri();?>/images/0-02-small.png" alt="">
				</a></li>
				<li class="left-socList-item"><a target="_blank" href="https://twitter.com/Yaposadilderevo">
					<img src="<?echo get_template_directory_uri();?>/images/twitter.png" alt="">
					<img class="hoverImg"src="<?echo get_template_directory_uri();?>/images/0-04-small.png" alt="">
				</a></li>
				<li class="left-socList-item"><a target="_blank" href="https://www.youtube.com/channel/UCOJQY23nU1MHME_FrzTkD5g">
					<img src="<?echo get_template_directory_uri();?>/images/youTube.svg" alt="">
					<img class="hoverImg"src="<?echo get_template_directory_uri();?>/images/0-05-small.png" alt="">
				</a></li>
				
			</ul>
		</div>
	</header>
	<div class="body-page-block <? if(is_user_logged_in())echo 'logged';?>">
		<div class="header-page-block">
			<div class="header-pageBlock-row">
				<div class="mobile-toogleMenu-bnt"></div>
				<div class="header-page-search <?if(wp_is_mobile())echo "mobile";?>">
					<!-- <div class="closeIcon">X</div> -->
					<? get_search_form(); ?>
				</div>
				<?php $args = array( // опции для вывода верхнего меню, чтобы они работали, меню должно быть создано в админке
						'theme_location' => 'top', // идентификатор меню, определен в register_nav_menus() в functions.php
						'container'=> false, // обертка списка, тут не нужна
						'menu_id' => 'top-nav-ul', // id для ul
						'items_wrap' => '<ul id="%1$s" class=" %2$s">%3$s</ul>',
						'menu_class' => 'top-menu', // класс для ul, первые 2 обязательны
						'walker' => new bootstrap_menu(true) // верхнее меню выводится по разметке бутсрапа, см класс в functions.php, если по наведению субменю не раскрывать то передайте false		  		
					);
					wp_nav_menu($args); // выводим верхнее меню ?>
					<?  if(is_user_logged_in()){?>
						<div class="header-page-lkButton" onclick="return modal_box('modal-loginForm');">Личный кабинет</div>
					<?}else{?>
						<div class="header-page-lkButton" onclick="return modal_box('modal-loginForm');">Войти</div>
					<?};?>
			</div>
			<? if($post->ID!=14){ ?>
				<div class="header-pageBlock-row">
					<div class="header-tagsList">		
				
						<? $tags=get_tags(); 
						usort($tags, function($a,$b){
						    return ($a->count<$b->count);
						});
						$i=1;
						$count = count($tags);
						foreach ($tags as $tag) {
							echo '<a class="tag-cloud-link" rel="tag" href="/tag/'.$tag->slug.'">'.$tag->name.'</a>';
							// echo $tag->count;
							$i++;
							if($count>8){
								if($i==8){
									echo '<div class="header-tagsList_hidden">';
								};
							};
						};
						if($count>8){
							echo '</div>';						
						};?>
					</div>
					<div class="header-tagsList-fullButton">Все</div>
				</div>
			<? }; ?>
		</div>

		<div class="content-page-block">
			