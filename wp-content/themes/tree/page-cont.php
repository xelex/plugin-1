<?php
/**
 * Template Name: Страница контактов
 */
get_header(); // подключаем header.php ?>
<section>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // старт цикла ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // контэйнер с классами и id ?>
						<h1><?php the_title(); // заголовок поста ?></h1>
						<?php the_content(); // контент ?>
					</article>
				<?php endwhile; // конец цикла ?>
				<div class="map-container-contctPage">
					<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ad83af89afbe1af6f650c94e2a8697687246a995483cf844404117b02a524fc05&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
				</div>
					<form action="" class="contact-form">
						<div class="form-container">
							<div class="form-cell">
							    <input type="text" name="name" id="cont-input-name">
							    <label for="cont-input-name">Ваше имя</label> 
							</div><div class="form-cell">
							    <input type="text" name="email" id="cont-input-email">
							    <label for="cont-input-email">Ваш email</label> 
							</div>
							<div class="form-cell">
								<textarea name="message" id="" cols="30" rows="10"></textarea><label for="message">Сообщение</label>
							</div>
				            <input type="submit" value="Отправить">
						</div>
		        </form>
				
</section>
<?php get_footer(); // подключаем footer.php ?>