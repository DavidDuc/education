<?php
/**
 * Thankyou page
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if ($order) :
    ?>

    <?php if ($order->has_status('failed')) : ?>

        <p><?php echo esc_html__('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'educatito'); ?></p>
       <p><?php
            if (is_user_logged_in())
                echo esc_html__('Please attempt your purchase again or go to your account page.', 'educatito');
            else
                echo esc_html__('Please attempt your purchase again.', 'educatito');
            ?></p>

        <p>
            <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php echo esc_html__('Pay', 'educatito') ?></a>
            <?php if (is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php echo esc_html__('My Account', 'educatito'); ?></a>
            <?php endif; ?>
        </p>

    <?php else : ?>

        <p ><?php echo wp_kses_post(apply_filters('woocommerce_thankyou_order_received_text', __('Thank you. Your order has been received.', 'educatito'), $order)); ?></p>

        <ul class="order_details">

            <li class="order">
                <?php esc_html_e('Order number:', 'educatito'); ?>
                <strong><?php echo esc_attr($order->get_order_number()); ?></strong>
            </li>

            <li class="date">
                <?php esc_html_e('Date:', 'educatito'); ?>
                <strong><?php echo esc_attr(wc_format_datetime($order->get_date_created())); ?></strong>
            </li>

            <li class="total">
                <?php esc_html_e('Total:', 'educatito'); ?>
                <strong><?php echo wp_kses_post($order->get_formatted_order_total()); ?></strong>
            </li>

            <?php if ($order->get_payment_method_title()) : ?>

                <li class="method">
                    <?php esc_html_e('Payment method:', 'educatito'); ?>
                    <strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
                </li>

            <?php endif; ?>

        </ul>

    <?php endif; ?>

    <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
    <?php do_action('woocommerce_thankyou', $order->get_id()); ?>

<?php else : ?>

    <p><?php echo wp_kses_post(apply_filters('woocommerce_thankyou_order_received_text', __('Thank you. Your order has been received .', 'educatito'), null)); ?></p>

<?php endif; ?>
