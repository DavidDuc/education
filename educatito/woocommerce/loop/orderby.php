<?php
/**
 * Show options for ordering
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
global $educatito_options;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="uk-grid result-catlog-wrap">
    <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1 product-catlog-orderby">
        <form class="woocommerce-ordering view-options" method="get">
            <span><?php echo esc_html__('Short by :', 'educatito'); ?></span>
            <label class="lb_select">
                <select id="sort_items_by" name="orderby" class="orderby">
                    <?php foreach ($catalog_orderby_options as $id => $name) : ?>
                        <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </form>
    </div>
    <div class="uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1 product-form-search">
        <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'educatito'); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', 'educatito'); ?>" />
            <button type="submit" class="educatito-btn-search educatito_button"><i class="uk-icon-search"></i></button>
            <input type="hidden" name="post_type" value="product" />
        </form>
    </div>
</div>
<div class="clear"></div>