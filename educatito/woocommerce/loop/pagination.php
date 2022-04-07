<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.3.1
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $wp_query;

if ($wp_query->max_num_pages <= 1) {
    return;
}
?>
<nav class="educatito-woo-pagination educatito_pagination">
    <?php
    echo wp_kses_post(paginate_links(apply_filters('woocommerce_pagination_args', array(
        'base' => esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false)))),
        'format' => '',
        'add_args' => false,
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '<span class="fa fa-angle-left"></span>',
        'next_text' => '<span class="fa fa-angle-right"></span>',
        'type' => 'list',
        'end_size' => 3,
        'mid_size' => 3
    ))));
    ?>
</nav>
