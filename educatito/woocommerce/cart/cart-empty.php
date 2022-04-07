<?php
/**
 * @author  JRB Themes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

wc_print_notices();
?>

<p class="cart-empty">
<?php esc_html_e('Your cart is currently empty.', 'educatito') ?>
</p>
<?php if (wc_get_page_id('shop') > 0) : ?>
    <p class="return-to-shop">
        <a class="educatito-return-to-shop bd-button bd-button-primary bd-button-text-white wc-backward" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
        <?php echo esc_html__('Return To Shop', 'educatito') ?>
        </a>
    </p>
<?php endif; ?>
