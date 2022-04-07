<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;
?>
<div class="price-single" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
    <meta itemprop="price" content="<?php echo wp_kses_post($product->get_price()); ?>" />
    <meta itemprop="priceCurrency" content="<?php echo wp_kses_post(get_woocommerce_currency()); ?>" />
    <link itemprop="availability" href="http://schema.org/<?php echo wp_kses_post($product->is_in_stock()) ? esc_html__('InStock','educatito') : esc_html__('OutOfStock','educatito'); ?>" />
</div>
