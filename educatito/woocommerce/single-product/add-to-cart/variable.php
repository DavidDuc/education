<?php
/**
 * Variable product add to cart
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $woocommerce, $product, $post;
$attribute_keys = array_keys($attributes);
do_action('woocommerce_before_add_to_cart_form');
?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo wp_kses_post(htmlspecialchars(json_encode($available_variations))) ?>">
    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if (empty($available_variations) && false !== $available_variations) : ?>
        <p class="stock out-of-stock"><?php echo esc_html__('This product is currently out of stock and unavailable.', 'educatito'); ?></p>
    <?php else : ?>
        <table class="variations">
            <tbody>
                <?php foreach ($attributes as $attribute_name => $options) : ?>
                    <tr>
                        <td class="label"><label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo esc_attr(wc_attribute_label($attribute_name)); ?></label></td>
                        <td class="value">
                            <?php
                            $selected = isset($_REQUEST['attribute_' . sanitize_title($attribute_name)]) ? wc_clean(urldecode(sanitize_text_field(wp_unslash($_REQUEST['attribute_' . sanitize_title($attribute_name)])))) : $product->get_variation_default_attribute($attribute_name);
                            wc_dropdown_variation_attribute_options(array('options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected));
                            echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__('Clear', 'educatito') . '</a>')) : '';
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <div class="single_variation_wrap" style="display:none;">
            <?php do_action('woocommerce_before_single_variation'); ?>
            <div class="woo-price clearfix">
                <div>
                    <p><?php echo esc_html__('Price:', 'educatito'); ?></p>
                </div>
                <div class="single_variation"></div>
            </div>
            <div class="woo-quantity clearfix">
                <div>
                    <p></p>
                </div>
                <div class="variations_button">
                    <?php woocommerce_quantity_input(); ?>
                    <div class="product_action">
                        <?php
                         if (class_exists('YITH_WCWL')) {
                            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
                        }
                        ?>
                        <button type="submit" class="single-cart-button bd-button bd-button-primary hi-icon"><?php echo esc_html('Add to cart','educatito'); ?></button>
                    </div>
                </div>
            </div>

            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
            <input type="hidden" name="product_id" value="<?php echo esc_attr($post->ID); ?>" />
            <input type="hidden" name="variation_id" value="" />

            <?php do_action('woocommerce_after_single_variation'); ?>
        </div>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <?php endif; ?>
    <?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>
