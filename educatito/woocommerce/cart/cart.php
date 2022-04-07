<?php
/**
 * Cart Page
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

wc_print_notices();

do_action('woocommerce_before_cart');
?>
<div class="educatito-box">
    <form class="woo-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

        <?php do_action('woocommerce_before_cart_table'); ?>

        <div class="table-product">
            <table class="shop_table cart" cellspacing="1">
                <thead>
                    <tr>
                        <th class="woo-table-col-product"><?php echo esc_html__('Product', 'educatito'); ?></th>
                        <th class="woo-table-col-name"><?php echo esc_html__('Product name', 'educatito'); ?></th>
                        <th class="woo-table-col-price text-center"><?php echo esc_html__('Price', 'educatito'); ?></th>
                        <th class="woo-table-col-qty text-center"><?php echo esc_html__('Qty', 'educatito'); ?></th>
                        <th class="woo-table-col-total text-center"><?php echo esc_html__('Total', 'educatito'); ?></th>
                        <th class="product-remove text-right"><a href="%s" class="" title="%s"><i class="pe-7s-close"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php do_action('woocommerce_before_cart_contents'); ?>

                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            ?>
                            <tr class="woo-cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                <td class="woo-table-col-thumb">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('custom-product-size'), $cart_item, $cart_item_key);

                                    if (!$_product->is_visible())
                                        echo do_shortcode($thumbnail);
                                    else
                                        printf('<a href="%s">%s</a>', esc_url($_product->get_permalink($cart_item)), wp_kses_post($thumbnail));
                                    ?>
                                </td>

                                <td class="woo-table-col-title">
                                    <?php
                                    if (!$_product->is_visible())
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key)) . '&nbsp;';
                                    else
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s </a>', $_product->get_permalink($cart_item), $_product->get_title()), $cart_item, $cart_item_key));
                                    ?>
                                     <div class="author">
                                        <?php echo wc_get_product_category_list($cart_item['product_id'], ', ', '<span class="posted_in">' . esc_html__('by', 'educatito') . ' ', '</span>'); ?>
                                    </div>
                                    <?php
                                    // Meta data
                                    echo esc_attr(wc_get_formatted_cart_item_data($cart_item));

                                    // Backorder notification
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
                                        echo '<p class="backorder_notification">' . esc_html__('Available on backorder', 'educatito') . '</p>';
                                    ?>
                                </td>

                                <td class="woo-table-col-price text-center">
                                    <?php
                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key));
                                    ?>
                                </td>

                                <td class="woo-table-col-qty text-center">
                                   		<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
                                </td>

                                <td class="text-center">
                                    <?php
                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key));
                                    ?>
                                </td>

                                <td class="woo-product-remove text-center">
                                    <?php
                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><i class="fa fa-times" aria-hidden="true"></i></a>', esc_url(wc_get_cart_remove_url($cart_item_key)), esc_attr__('Remove this item', 'educatito')), $cart_item_key));
                                    ?>
                                </td>

                            </tr>
                            <?php
                        }
                    }

                    do_action('woocommerce_cart_contents');
                    ?>
                    <tr class="woo-action-wrap">
                        <td colspan="6" class="actions clearfix">
                            <div class="uk-grid uk-grid-collapse">
                                <div class="col-continue-shopping uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-1">
                                    <div class="wc-proceed-to-checkout">

                                        <p class="return-to-shop">
                                            <a class="bd-button bd-button-default wc-backward" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>"><?php echo esc_html__('Continue Shopping', 'educatito') ?></a>
                                        </p>

                                    </div>
                                </div>
                                <div class="col-update-cart uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-1">

                                    <input type="submit" class="bd-button bd-button-default" name="update_cart" value="<?php echo esc_attr__('Update Cart', 'educatito'); ?>" />

                                    <?php do_action('woocommerce_cart_actions'); ?>

                                    <?php wp_nonce_field('woocommerce-cart'); ?>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <?php do_action('woocommerce_after_cart_contents'); ?>
                </tbody>
            </table>
        </div>
        <?php do_action('woocommerce_after_cart_table'); ?>

    </form>

    <div class="uk-grid uk-grid-collapse col-action-shipping">
        <div class="col-as uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-1 col-discount-codes">
            <div class="col-title-action"><?php echo esc_html__('Discount Codes', 'educatito'); ?></div>

            <?php if (WC()->cart->coupons_enabled()) { ?>
                <div class="coupon">
                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php echo esc_attr__('Enter your coupon code', 'educatito'); ?>" /> <input type="submit" class="bd-button bd-button-default educatito-btn-apply-coupon" name="apply_coupon" value="<?php echo esc_attr__('Apply Coupon', 'educatito'); ?>" />
                    <?php do_action('woocommerce_cart_coupon'); ?>
                </div>
            <?php } ?>
        </div>
        <div class="cart-total uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-1">
            <div class="col-title-action"><?php echo esc_html__('Cart Total', 'educatito'); ?></div>
            <div class="cart-collaterals">
                <?php woocommerce_cart_totals(); ?>
            </div>
        </div>
    </div>
</div>
<?php do_action('woocommerce_after_cart'); ?>
