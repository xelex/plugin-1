<?php
/**
 * Шаблон подвала (footer.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
</div>
		<footer>
			<div class="container-footer">
				<!-- <div class="row">
					<div class="col-md-12">
						<?php $args = array( // опции для вывода нижнего меню, чтобы они работали, меню должно быть создано в админке
							'theme_location' => 'bottom', // идентификатор меню, определен в register_nav_menus() в function.php
							'container'=> false, // обертка списка, false - это ничего
							'menu_class' => 'nav nav-pills bottom-menu', // класс для ul
					  		'menu_id' => 'bottom-nav', // id для ul
					  		'fallback_cb' => false
					  	);
						wp_nav_menu($args); // выводим нижние меню
						?>
					</div>
				</div> -->
				<div class="footer-coperight">Все права защищены</div>
				<div class="footer-cont">
					yaposadilderevo@mail.ru
				</div>
			</div>
		</footer>
	<script src="<?echo get_template_directory_uri();?>/js/slick.min.js"></script>
	<?php wp_footer(); // необходимо для работы плагинов и функционала  ?>
	</div>
	<script src="<?echo get_template_directory_uri();?>/js/lightbox.js"></script>
	
</div>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter46928628 = new Ya.Metrika({ id:46928628, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/46928628" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
</body>
</html>