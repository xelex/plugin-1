<?php
/**
 * Шаблон отдельной записи (single.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); // подключаем header.php ?>
<section>
	<div class="container">
		<div class="row">
			<div class="<?php content_class_by_sidebar(); // функция подставит класс в зависимости от того есть ли сайдбар, лежит в functions.php ?>">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // старт цикла ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // контэйнер с классами и id ?>
						<h1><?php the_title(); // заголовок поста ?></h1>


						<?php 

						$images = get_field('photoGallery');

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
				<?php previous_post_link('%link', '<- Предыдущий пост: %title', TRUE); // ссылка на предыдущий пост ?> 
				<?php next_post_link('%link', 'Следующий пост: %title ->', TRUE); // ссылка на следующий пост ?> 

			</div>
			<?php get_sidebar(); // подключаем sidebar.php ?>
		</div>
	</div>
</section>
<?php get_footer(); // подключаем footer.php ?>
