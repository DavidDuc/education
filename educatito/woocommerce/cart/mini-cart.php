<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
if (!defined('ABSPATH')) {

    exit; // Exit if accessed directly
}

if (function_exists('is_woocommerce')) {
    ?>

    <?php do_action('woocommerce_before_mini_cart'); ?>

    <ul class="cart-list">

        <?php if (!WC()->cart->is_empty()) : ?>

            <?php
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);



                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {

                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);

                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('custom-product-size'), $cart_item, $cart_item_key);

                    $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                    ?>

                    <li class="<?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'product-info', $cart_item, $cart_item_key)); ?>">
                        <div class="product-left">
                            <?php
                            echo wp_kses_post(apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                                    '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>', esc_url(wc_get_cart_remove_url($cart_item_key)), esc_attr__('Remove this item', 'educatito'), esc_attr($product_id), esc_attr($_product->get_sku())
                                            ), $cart_item_key));
                            ?>

                            <?php if (!$_product->is_visible()) : ?>

                                <?php echo wp_kses_post(str_replace(array('http:', 'https:'), '', $thumbnail)) . esc_attr($product_name) . '&nbsp;'; ?>

                            <?php else : ?>

                                <a href="<?php echo esc_url($_product->get_permalink($cart_item)); ?>">

                                    <?php echo wp_kses_post(str_replace(array('http:', 'https:'), '', $thumbnail)) . '&nbsp;'; ?>

                                </a>
                            </div> 
                            <div class="product-right">
                                <a href="<?php echo esc_url($_product->get_permalink($cart_item)); ?>">

                                    <?php echo esc_attr($product_name) . '&nbsp;'; ?>

                                </a>

                            <?php endif; ?>
                            <div class="price-number">
                                <?php echo esc_attr(wc_get_formatted_cart_item_data($cart_item)); ?>
                                <?php echo wp_kses_post(apply_filters('woocommerce_widget_cart_item_quantity', '<span class="price">' . $product_price . '</span><span class="qty">' . sprintf('%s %s', esc_html__('Qty:', 'educatito'), $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key)); ?>

                            </div>
                        </div>
                    </li>

                    <?php
                }
            }
            ?>

        <?php else : ?>

            <li class="empty"><?php echo esc_html__('No products in the cart.', 'educatito'); ?></li>

        <?php endif; ?>

    </ul><!-- end product list -->

    <?php if (!WC()->cart->is_empty()) : ?>

        <div class="toal-cart"><strong><?php echo esc_html__('Total', 'educatito'); ?>:</strong> <?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></div>

        <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

        <div class="cart-buttons">

            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="bd-button-cart bd-button bd-button-primary bd-button-text-white"><?php echo esc_html__('Cart', 'educatito'); ?></a>

            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="bd-button-checkout bd-button bd-button-primary bd-button-text-white"><?php echo esc_html__('Checkout', 'educatito'); ?></a>
        </div>

    <?php endif; ?>
    <?php
    do_action('woocommerce_after_mini_cart');
}
?>

