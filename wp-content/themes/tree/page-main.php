<?php
/**
 * Страница с кастомным шаблоном (page-custom.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Главная
 */
get_header(); // подключаем header.php ?>
<? $query = new WP_Query('cat=2,3,8');
if( $query->have_posts() ){
	?>
	<div class="cat-list">
	<?
	while( $query->have_posts() ){ $query->the_post();
	?>
		<div class="catList-item">
			<? $meta = new stdClass;
			foreach( (array) get_post_meta( $post->ID ) as $k => $v ) $meta->$k = $v[0]; echo $meta->book;?>
				<a href="<? echo get_permalink();?>">
					
					<div class="catList-item-img">
						
						<img src="<? echo get_the_post_thumbnail_url( $post->id, 'item-thumb' );?>" alt="">
					</div>
				</a>
				<div class="catList-item-body">
					<?php $categ=get_the_category( $post->ID );?>
					<a class="catList-item-catName" href="<? echo '/category/'.$categ[0]->slug;?>"><? echo $categ[0]->name;?></a>
					<a href="<? echo get_permalink();?>" class="catList-item-title"><?php the_title(); ?></a>
					<div class="idpost"><?php the_ID(); ?></div>
					<div class="catList-item-date">
						<?	echo get_the_date();?>
					</div>
				</div>
		</div>
		
	<?php
	}
	wp_reset_postdata(); // сбрасываем переменную $post
	?></div><?
} 
else echo 'Записей нет.';
?>

<?php get_footer(); // подключаем footer.php ?>