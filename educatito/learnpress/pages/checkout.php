<?php
/**
 * Template for displaying content of page for processing checkout feature.
 *
 * @author   ThimPress
 * @package  LearnPress/Templates
 * @version  4.0.1
 */

defined( 'ABSPATH' ) or die;

get_header();
$educatito_show_page_title = isset($educatito_options['jrb_page_show_page_title']) ? $educatito_options['jrb_page_show_page_title'] : 1;
$educatito_show_page_breadcrumb = isset($educatito_options['jrb_page_show_page_breadcrumb']) ? $educatito_options['jrb_page_show_page_breadcrumb'] : 1;
educatito_theme_title_bar_page($educatito_show_page_title, $educatito_show_page_breadcrumb);
do_action( 'learn-press/before-main-content' );
do_action( 'learnpress/template/pages/checkout/before-content' );
?>

	<div id="learn-press-checkout" class="lp-content-wrap">
        <?php learn_press_get_template( 'checkout/form.php' ); ?>
	</div>

<?php
do_action( 'learnpress/template/pages/checkout/after-content' );
do_action( 'learn-press/after-main-content' );

get_footer();
