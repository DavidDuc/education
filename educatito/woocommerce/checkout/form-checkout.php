<?php
/**
 * Checkout Form
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
if (!defined('ABSPATH')) {
    exit;
}
?>

<?php
wc_print_notices();

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in()) {
    echo wp_kses_post(apply_filters('woocommerce_checkout_must_be_logged_in_message', esc_html__('You must be logged in to checkout.', 'educatito')));
    return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters('woocommerce_get_checkout_url', wc_get_checkout_url());
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url($get_checkout_url); ?>" enctype="multipart/form-data">
    <div class="educatito-box">
        <div class="uk-grid woo-checkout-panel">
            <div class = "col-billing-address uk-width-large-2-3 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 woo-panel-1">
                <?php if (sizeof($checkout->checkout_fields) > 0) : ?>

                    <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                    <div class="col2-set" id="customer_details">
                        <div class="col2-set-1">
                            <?php do_action('woocommerce_checkout_billing'); ?>
                        </div>
                    </div>

                    <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                <?php endif; ?>
            </div>
            <div class = "col-information uk-width-large-1-3 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 woo-panel-2">
                <div class="educatito-box">
                    <div class="woo-checkout-information-2">
                        <div class="woocommerce-billing-fields ro-customer-info">
                            <div class="box-title">
                                <h3><?php echo esc_html__('Information', 'educatito'); ?></h3>
                                <span><a class="ro-edit-customer-info" href="#!"><?php echo esc_html__('Edit', 'educatito'); ?></a></span>
                            </div>
                            <div class="woo-content">
                                <?php foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>

                                    <?php
                                    if ($checkout->get_value($key)) {
                                        if ($key == 'billing_address_2') {
                                            echo '<div class="woo-info"><p><span>ADDRESS-2: </span>' . esc_attr($checkout->get_value($key)) . '</p></div>';
                                        } else {
                                            echo '<div class="woo-info"><p><span>' . esc_attr($field['label']) . ': </span>' . esc_attr($checkout->get_value($key)) . '</p></div>';
                                        }
                                    }
                                    ?>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="educatito-box">
                    <div class="woocommerce-billing-fields">
                        <?php do_action('woocommerce_checkout_before_order_review'); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <div class="box-title">
                                <h3><?php echo esc_html__('Your Orders', 'educatito'); ?></h3>
                            </div>
                            <?php do_action('woocommerce_order_review'); ?>
                        </div>

                        <?php do_action('woocommerce_checkout_after_order_review'); ?>
                        <div class="col-cart-totals">
                            <div class="box-content">
                                <table class="uk-table accordion">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th><?php echo esc_html__('Subtotal', 'educatito'); ?></th>
                                            <td class="text-right"><?php wc_cart_totals_subtotal_html(); ?></td>
                                        </tr>

                                        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                                            <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                                                <th><?php wc_cart_totals_coupon_label($coupon); ?></th>
                                                <td><?php wc_cart_totals_coupon_html($coupon); ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

                                            <?php do_action('woocommerce_review_order_before_shipping'); ?>

                                            <?php wc_cart_totals_shipping_html(); ?>

                                            <?php do_action('woocommerce_review_order_after_shipping'); ?>

                                        <?php endif; ?>

                                        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                                            <tr class="fee">
                                                <th><?php echo esc_html($fee->name); ?></th>
                                                <td><?php wc_cart_totals_fee_html($fee); ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <?php if (wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart) : ?>
                                            <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                                                <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
                                                    <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                                                        <th><?php echo esc_html($tax->label); ?></th>
                                                        <td><?php echo wp_kses_post($tax->formatted_amount); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr class="tax-total">
                                                    <th><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
                                                    <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php do_action('woocommerce_review_order_before_order_total'); ?>

                                        <tr class="order-total">
                                            <th><?php echo esc_html__('Total', 'educatito'); ?></th>
                                            <td class="text-right"><?php wc_cart_totals_order_total_html(); ?></td>
                                        </tr>

                                        <?php do_action('woocommerce_review_order_after_order_total'); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-paymen-method">
                            <?php do_action('woocommerce_checkout_payment'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
