<?php
/**
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $product, $educatito_options, $image, $alt;

// Ensure visibility
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<div class="uk-width-large-1-4 uk-width-medium-1-2 uk-width-small-1-2 uk-width-1-1 product-item-wrap">
    <div <?php post_class('product-item'); ?>>
        <div class="box-img">
            <?php
            if (!empty($educatito_options)) {
                if (isset($educatito_options['jrb_archive_show_sale_flash_product']) && $educatito_options['jrb_archive_show_sale_flash_product'] == 1)
                    do_action('woocommerce_show_product_loop_sale_flash');
            }else {
                do_action('woocommerce_show_product_loop_sale_flash');
            }
            ?>
            <?php
            $postDate = strtotime(get_the_date('j F Y'));
            $todaysDate = time() - (7 * 86400);
            if ($postDate >= $todaysDate)
                echo '<span class="new">' . esc_html__('New', 'educatito') . '</span>';
            ?>
            <?php
            if (!empty($image)) {
                ?>
                <a href="<?php echo esc_url(the_permalink()); ?>">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                </a>
                <?php
            }
            ?>
            <div class="product-options">
                <div class="box-icon">
                    <?php
                    if (!empty($educatito_options)) {
                        if (isset($educatito_options['jrb_archive_show_add_to_cart_product']) && $educatito_options['jrb_archive_show_add_to_cart_product'] == 1) {
                            do_action('woocommerce_template_loop_add_to_cart');
                        }
                    } else {
                        do_action('woocommerce_template_loop_add_to_cart');
                    }
                    if (!empty($educatito_options)) {
                        if (isset($educatito_options['jrb_archive_show_quick_view_product']) && $educatito_options['jrb_archive_show_quick_view_product'] == 1) {
                            educatito_add_quick_view_button();
                        }
                    } else {
                        educatito_add_quick_view_button();
                    }
                    ?> 
                </div>
                <div class="box-content div-center uk-clearfix">
                    <?php if (!empty($educatito_options)) { ?>
                        <?php if (isset($educatito_options['jrb_archive_show_title_product']) && $educatito_options['jrb_archive_show_title_product'] == 1) { ?>
                            <div class="box-title">
                                <h3 class="title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_attr(the_title()); ?></a></h3>
                                <p>
                                    <?php echo wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in">' . esc_html__('by', 'educatito') . ' ', '</span>'); ?>
                                </p>
                            </div>
                        <?php } ?>
                        <?php if (isset($educatito_options['jrb_archive_show_price_product']) && $educatito_options['jrb_archive_show_price_product'] == 1) { ?>
                            <div class="product-price">
                                <?php
                                do_action('woocommerce_template_loop_price');
                                ?>
                            </div>
                        <?php } ?>
                        <?php
                    } else {
                        ?>
                        <div class="box-title">
                            <h3 class="title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_attr(the_title()); ?></a></h3>
                            <p>
                                <?php echo wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in">' . esc_html__('by', 'educatito') . ' ', '</span>'); ?>
                            </p>
                        </div>
                        <div class="product-price">
                            <?php
                            do_action('woocommerce_template_loop_price');
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>