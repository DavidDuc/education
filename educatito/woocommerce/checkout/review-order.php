<?php
/**
 * Review order table
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="box-content">
    <div class="table-product">
        <table class="uk-table shop_table woocommerce-checkout-review-order-table">
            <thead>
                <tr>
                    <th class="product-name"><?php echo esc_html__('Products', 'educatito'); ?></th>
                    <th class="product-name"><?php echo esc_html__('Total', 'educatito'); ?></th>
                </tr>
            </thead>
            <tbody  class="woo-body">
                <?php
                do_action('woocommerce_review_order_before_cart_contents');

                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        ?>
                        <tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'woo-item', 'cart_item', $cart_item, $cart_item_key)); ?>">
                            <td class="woo-image">
                                <div class="product">
                                   
                                    <div class="text-product woo-name">
                                        <h3>
                                            <?php
                                            if (!$_product->is_visible())
                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key)) . '&nbsp;';
                                            else
                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s </a>', $_product->get_permalink($cart_item), $_product->get_title()), $cart_item, $cart_item_key));
                                            ?>
                                        </h3>
                                        <?php
                                        // Meta data
                                        echo esc_attr(wc_get_formatted_cart_item_data($cart_item));

                                        // Backorder notification
                                        if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
                                            echo '<p class="backorder_notification">' . esc_html__('Available on backorder', 'educatito') . '</p>';
                                        ?>
                                    </div>
                                </div>
                            </td>
                            <td class="product-total">
                                <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key)); ?>
                            </td>
                        </tr>
                        <?php
                    }
                }

                do_action('woocommerce_review_order_after_cart_contents');
                ?>
            </tbody>
        </table>
    </div>
</div>
