<?php
/**
 * Шаблон формы поиска (searchform.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<form role="search" method="get" class="search-form form-inline" action="<?php echo home_url( '/' ); ?>">
	<div class="form-group">
		<label class="sr-only" for="search-field">Поиск</label>
		<input type="search" class="form-control input-sm" id="search-field" placeholder="Введите запрос" value="<?php echo get_search_query() ?>" name="s">
		<? if(wp_is_mobile()){?><div class="closeIcon">X</div><?};?>
	</div>
	<button type="submit" class="btn btn-default btn-sm">Искать</button>
</form>