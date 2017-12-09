<?php /**
 * Шаблон карты
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 * Template Name: Делатли посадки
 */

$id = $_REQUEST['id'];
if (!$id) {
	die("Sorry, no access here");
}
?>
Содержимое балуна для ID=<?php echo $id; ?>