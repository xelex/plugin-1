<?php
/**
 * @package WordPress
 * @subpackage your-clean-template-3
 * Template Name: Карта посадок
 */
get_header(); // подключаем header.php ?>
<section>
	<div class="container">
		<div class="row">
			<div class="<?php content_class_by_sidebar(); // функция подставит класс в зависимости от того есть ли сайдбар, лежит в functions.php ?>">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // старт цикла ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // контэйнер с классами и id ?>
						<h1><?php the_title(); // заголовок поста ?></h1>
						<? the_content();?>
						<br>
						<div class="treeFrend-list">
						<?php 

$rows = get_field('treefrend');
if($rows)
{
	foreach($rows as $row)
	{
		?>

					<div class="catList-item">
						<a href="http://xn--80aefafasyxibtg7q.xn--p1ai/goszadanie-perevypolneno/">
									<div class="catList-item-img"><img width="700" height="467" src="<? echo $row['treefrend_ava'];?>" class="attachment-large size-large wp-post-image" ></div>
						</a>
							<div class="catList-item-body">
								<div class="treeFrend-item-name"><h3><? echo $row['treefrend_name'];?></h3></div><br>
								<div class="treeFrend-item-text">
									<? echo $socLink = $row['treefrend_text'];?>
								</div>
								<ul class="treesocList">
									<?php 
										$socLink = $row['treefrend_soc'];
										if($socLink)
										{
											foreach($socLink as $subrow)
											{
												echo '<li class="treesocList_item ' . $subrow['treefrend_soc_name'] . '"><a target="_blank" href="'.$subrow['treefrend_soc_link'].'" ></a></li>';
											}
										};
									?>
									
								</ul>
							</div>
					</div>
		<?
	}
};
?>
</div>
					</article>
				<?php endwhile; // конец цикла ?>
			</div>
			<?php get_sidebar(); // подключаем sidebar.php ?>
		</div>
	</div>
</section>
<?php get_footer(); // подключаем footer.php ?>