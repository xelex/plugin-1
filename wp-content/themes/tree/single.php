<?php
/**
 * Шаблон отдельной записи (single.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); // подключаем header.php ?>
<section>
	
		<div class="row">
			<div class="<?php content_class_by_sidebar(); // функция подставит класс в зависимости от того есть ли сайдбар, лежит в functions.php ?>">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // старт цикла ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // контэйнер с классами и id ?>
						<h1><?php the_title(); // заголовок поста ?></h1>


						<?php 

						$images = get_field('post_galery');

						if( $images ): ?>
						    <div class="photoGallery-list post-page-gallery">
						        <?php foreach( $images as $image ): ?>
						            <div class="post-page-gallery-item">
						                <a href="<?php echo $image['url']; ?>" data-lightbox="gallery">
						                     <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
						                </a>
						                <!-- <p><?php echo $image['caption']; ?></p> -->
						            </div>
						        <?php endforeach; ?>
						    </div>
						<?php endif; ?>


						<?php the_content(); // контент ?>
					</article>
				<?php endwhile; // конец цикла ?>
				<?php $categ=get_the_category( $post->ID );?>
				<? if($categ[0]->term_id==2){
						next_post_link('%link', '<- Следующая новость', TRUE);
						previous_post_link('%link', 'Предыдущая новость ->', TRUE);
					}else{
						if($categ[0]->term_id==3){
							next_post_link('%link', '<- Следующая акция ->', TRUE);
							previous_post_link('%link', 'Предыдущая акция ->', TRUE);
						}else{
							next_post_link('%link', '<- Следующий пост ->', TRUE); 
							previous_post_link('%link', 'Предыдущий пост ->', TRUE);
						};
					};?>

			</div>
			<?php get_sidebar(); // подключаем sidebar.php ?>
		</div>
	
</section>
<?php get_footer(); // подключаем footer.php ?>
