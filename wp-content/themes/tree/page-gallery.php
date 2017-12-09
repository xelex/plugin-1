<?php
/**
 * Template Name: Галерея
 */
get_header(); // подключаем header.php ?>
<section>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // старт цикла ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // контэйнер с классами и id ?>
						<h1><?php the_title(); // заголовок поста ?></h1>
						<?php the_content(); // контент ?>

						<?php 

						$images = get_field('photoGallery');

						if( $images ): ?>
						    <ul class="photoGallery-list">
						        <?php foreach( $images as $image ): ?>
						            <li>
						                <a href="<?php echo $image['url']; ?>" data-lightbox="gallery">
						                     <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
						                </a>
						                <!-- <p><?php echo $image['caption']; ?></p> -->
						            </li>
						        <?php endforeach; ?>
						    </ul>
						<?php endif; ?>
					</article>
				<?php endwhile; // конец цикла ?>
</section>
<?php get_footer(); // подключаем footer.php ?>