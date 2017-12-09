<?php
/**
 * tag template (tag.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); // подключаем header.php ?> 
<section>
	<div class="container">
		<h1><?php printf( single_tag_title('', false));?></h1>
				<div class="cat-list">
				<?php if (have_posts()) : while (have_posts()) : the_post(); // если посты есть - запускаем цикл wp ?>
					
					<div class="catList-item">
						<? $meta = new stdClass;
						foreach( (array) get_post_meta( $post->ID ) as $k => $v ) $meta->$k = $v[0]; echo $meta->book;?>
						<!-- <a href="<?php the_permalink(); ?>"> -->
							<a href="<? echo get_permalink();?>">
								<div class="catList-item-img"><?php the_post_thumbnail('large'); ?></div>
							</a>
							<div class="catList-item-body">
									<?php $categ=get_the_category( $post->ID );?>
								<div class="catList-item-catName"><? echo $categ[0]->name;?></div>
								<a href="<? echo get_permalink();?>" class="catList-item-title"><?php the_title(); ?></a>
								<div class="idpost"><?php the_ID(); ?></div>
								<div class="catList-item-date">
									<? echo get_the_date();?>
								</div>
							</div>
						<!-- </a> -->
					</div>
				<?php endwhile; // конец цикла
				else: echo '<p>Нет записей.</p>'; endif; // если записей нет, напишим "простите" ?>	 
			</div>
		<?php pagination(); // пагинация, функция нах-ся в function.php ?>
	</div>
</section>
<?php get_footer(); // подключаем footer.php ?>