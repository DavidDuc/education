<?php
/**
 * The template for displaying product search form
 * @author  JRB Themes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'educatito'); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', 'educatito'); ?>" />
    <button type="submit" class="educatito-btn-search educatito_button"><i class="uk-icon-search"></i></button>
    <input type="hidden" name="post_type" value="product" />
</form>
