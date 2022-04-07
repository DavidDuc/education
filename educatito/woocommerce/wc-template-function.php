<?php

add_theme_support('woocommerce');

/* * ------------- Template pages------------- * */
if (!function_exists('educatito_woocommerce_content')) {

    function educatito_woocommerce_content() {
        if (is_singular('product')) {
            wc_get_template_part('single', 'product');
        } else {
            wc_get_template_part('archive', 'product');
        }
    }

}



if (!function_exists('educatito_excerpt')) {

    function educatito_excerpt($limit) {
        global $post;
        $excerpt = explode(' ', $post->post_excerpt, $limit);
        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
        return $excerpt;
    }

}

/**

 * Change number of related products on product page

 * Set your own value for 'posts_per_page'

 */
add_filter('woocommerce_output_related_products_args', 'educatito_related_products_args');

function educatito_related_products_args($args) {

    $columns = 4;

    $args['posts_per_page'] = $columns; // 4 related products

    $args['columns'] = $columns; // arranged in 4 columns

    return $args;
}

/**

 * Change number of upsell display products on product page

 * Set your own value for 'posts_per_page'

 */
function woocommerce_upsell_display($posts_per_page = 4, $columns = 4, $orderby = 'rand') {

    if (is_active_sidebar('tbtheme-woo-single-sidebar'))
        $columns = 3;

    $posts_per_page = $columns;

    woocommerce_get_template('single-product/up-sells.php', array(
        'posts_per_page' => $posts_per_page,
        'orderby' => $orderby,
        'columns' => $columns
    ));
}

if (!function_exists('educatito_woocommerce_page_title')) {



    /**

     * woocommerce_page_title function.

     *

     * @param  boolean $echo

     * @return string

     */
    function educatito_woocommerce_page_title() {

        if (is_search()) {
            /* translators: %s: Search Results */
            $page_title = sprintf(__('Search Results: &ldquo;%s&rdquo;', 'educatito'), get_search_query());


            if (get_query_var('paged'))
                /* translators: %s: paged */
                $page_title .= sprintf(__('&nbsp;&ndash; Page %s', 'educatito'), get_query_var('paged'));
        } elseif (is_tax()) {

            $page_title = single_term_title("", false);
        } elseif (is_archive()) {

            $page_title = esc_html__('Shop', 'educatito');
        } elseif (is_single()) {

            $page_title = the_title();
        } else {

            $shop_page_id = wc_get_page_id('shop');

            $page_title = get_the_title($shop_page_id);
        }
        return $page_title;
    }

}

if (!function_exists('educatito_woocommerce_breadcrumb_defaults')) {

    /**

     * Output the WooCommerce Breadcrumb

     *

     * @access public

     * @return void

     */
    function educatito_woocommerce_breadcrumb_defaults($args = array()) {
        global $educatito_options;
        $delimiter = isset($educatito_options['jrb_product_breadcrumb_delimiter']) ? $educatito_options['jrb_product_breadcrumb_delimiter'] : '/';
        $args['delimiter'] = ' ' . $delimiter . ' ';
        return $args;
    }

}

if (!function_exists('woocommerce_breadcrumb')) {

    /**
     * Output the WooCommerce Breadcrumb.
     *
     * @param array $args
     */
    function woocommerce_breadcrumb($args = array()) {
        $args = wp_parse_args($args, apply_filters('woocommerce_breadcrumb_defaults', array(
            'delimiter' => '&nbsp;&#47;&nbsp;',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" >',
            'wrap_after' => '</nav>',
            'before' => '',
            'after' => '',
            'home' => _x('Home', 'breadcrumb', 'educatito')
        )));

        $breadcrumbs = new WC_Breadcrumb();

        if (!empty($args['home'])) {
            $breadcrumbs->add_crumb($args['home'], apply_filters('woocommerce_breadcrumb_home_url', home_url()));
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        wc_get_template('global/breadcrumb.php', $args);
    }

}

/* Custom add to cart style 2 */

if (!function_exists('woocommerce_template_loop_add_to_cart_2')) {

    function woocommerce_template_loop_add_to_cart_2($args = array()) {

        wc_get_template('loop/add-to-cart_2.php', $args);
    }

}

function educatito_add_compare_link( $product_id = false, $args = array() ) {

	extract( $args );
	if ( ! $product_id ) { 

		global $product;
                $productgetid = $product->get_id();
		$product_id = isset( $productgetid ) && $product->exists() ? $productgetid : 0;
	}

	// return if product doesn't exist
       	if ( empty( $product_id ) ) return;

	$action_add ='yith-woocompare-add-product';

	$url_args = array(
					'action' => 'yith-woocompare-add-product',
					'id' => $product_id
				);

	$add_product_url = wp_nonce_url( add_query_arg( $url_args ), $action_add );

	printf( '<div class="woocommerce product compare-button hi-icon"><a href="%s" class="%s " data-product_id="%d" title="%s">%s</a></div>', esc_url($add_product_url), 'compare', esc_attr($product_id), 'Compare', 'Compare' );
}
/**

 * Add quick view button in wc product loop

 */
function woocommerce_product_loop_tags() {

    global $post, $product;

    $tag_count = sizeof(get_the_terms($post->ID, 'product_tag'));

    echo wp_kses_post($product->get_tags(', ', '<span class="tagged_as">' . _n('Tag:', 'Tags:', $tag_count, 'educatito') . ' ', '.</span>'));
}

/**

 * Add quick view button in wc product loop

 */

function educatito_add_quick_view_button() {

	global $post, $product;

	echo '<div class="btn-quickview hi-icon"><a href="#" class="yith-wcqv-button" data-product_id="' . esc_attr($product->get_id()) . '"></a></div>';

}

function educatito_theme_sort_by_page($count) {

    global $educatito_options;

    $count = 9;

    if (isset($_GET['tb_sortby'])) {

        $count = sanitize_text_field(wp_unslash($_GET['tb_sortby']));
    } elseif (isset($educatito_options['jrb_products_per_page'])) {

        $count = intval($educatito_options['jrb_products_per_page']);
    }

    // else normal page load and no cookie

    return $count;
}

add_filter('loop_shop_per_page', 'educatito_theme_sort_by_page', 15);

add_filter('woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1);

function iconic_cart_count_fragments($fragments) {
    $fragments['span.ajax-count-cart'] = '<span class="number ajax-count-cart">' . WC()->cart->get_cart_contents_count() . '</span>';
    return $fragments;
}
