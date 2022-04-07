<?php
/**
 * The template for displaying product widget entries
 * @author  JRB Themes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

global $product;
?>

<li>
    <a href="<?php echo esc_url($product->get_permalink()); ?>">
        <?php echo wp_kses_post($product->get_image()); ?>
        <span class="product-title"><?php echo wp_kses_post($product->get_name()); ?></span>
    </a>
    <?php if (!empty($show_rating)) : ?>
        <?php echo wp_kses_post(wc_get_rating_html($product->get_average_rating())); ?>
    <?php endif; ?>
    <?php echo wp_kses_post($product->get_price_html()); ?>
</li>
