<?php
/**
 * Simple product add to cart
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $woocommerce, $product;

if (!$product->is_purchasable())
    return;
?>

<?php
// Availability
$availability = $product->get_availability();

if ($availability['availability'])
    echo wp_kses_post(apply_filters('woocommerce_stock_html', '<p class="stock ' . esc_attr($availability['class']) . '">' . esc_html($availability['availability']) . '</p>', $availability['availability']));
?>

<?php if ($product->is_in_stock()) : ?>
    <div class="woo-quantity">
        <div>
            <?php do_action('woocommerce_before_add_to_cart_form'); ?>

            <form class="cart" method="post" enctype='multipart/form-data'>
                <?php do_action('woocommerce_before_add_to_cart_button'); ?>

                <?php
                if (!$product->is_sold_individually())
                    woocommerce_quantity_input(array(
                        'min_value' => apply_filters('woocommerce_quantity_input_min', 1, $product),
                        'max_value' => apply_filters('woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product)
                    ));
                ?>
                <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />

                <div class="product_action">
                    <button type="submit" class="single-cart-button bd-button bd-button-primary hi-icon"><?php echo esc_html__('Add to cart','educatito'); ?></button>
                    <?php
                     if (class_exists('YITH_WCWL')) {
                        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
                    }
                    ?>
                </div>
                <?php do_action('woocommerce_after_add_to_cart_button'); ?>
            </form>

            <?php do_action('woocommerce_after_add_to_cart_form'); ?>
        </div>
    </div>
<?php endif; ?>