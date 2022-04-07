<?php
/**
 * Related Products
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if ($related_products) :
    ?>
    <div class="relate-products">
        <div class="bd-container uk-container-center">
            <div class="sec-title">
                <h3 class="title"><?php echo esc_html__('Related products', 'educatito'); ?></h3>
            </div>
            <div class="product-box uk-position-relative" data-uk-slider="{infinite: false}">
                <div class="educatito-product-wrap product-grid-hoverdir uk-slider-container">
                    <div class="uk-slider uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-4 uk-grid-width-small-1-2 uk-grid-width-1-1">
                        <?php
                        foreach ($related_products as $related_product) :
                            $post_object = get_post($related_product->get_id());
                            setup_postdata($GLOBALS['post'] = & $post_object);
                            $post_id = get_the_ID();
                            $thumb_id = get_post_thumbnail_id($post_id);
                            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                            $url = wp_get_attachment_url($thumb_id);
                            $image = educatito_image_resize($url, 270, 270, true);
                            ?>
                            <div class="product-item-wrap">
                                <div <?php post_class('product-item'); ?>>
                                    <div class="box-img">
                                        <?php do_action('woocommerce_show_product_loop_sale_flash'); ?>
                                        <?php
                                        $postDate = strtotime(get_the_date('j F Y'));
                                        $todaysDate = time() - (7 * 86400);
                                        if ($postDate >= $todaysDate)
                                            echo '<span class="new">' . esc_html__('New', 'educatito') . '</span>';
                                        ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            if (!empty($image)) {
                                                ?>
                                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                                                <?php
                                            }
                                            ?>
                                        </a>
                                        <div class="product-options">
                                            <div class="box-icon">
                                                <?php
                                                do_action('woocommerce_template_loop_add_to_cart');
                                                educatito_add_quick_view_button();
                                                ?> 
                                            </div>
                                            <div class="box-content div-center uk-clearfix">
                                                <div class="box-title">
                                                    <h3 class="title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_attr(the_title()); ?></a></h3>
                                                    <p>
                                                        <?php echo wc_get_product_category_list($post_id, ', ', '<span class="posted_in">' . esc_html__('by', 'educatito') . ' ', '</span>'); ?>
                                                    </p>
                                                </div>
                                                <div class="product-price">
                                                    <?php
                                                    do_action('woocommerce_template_loop_price');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
                <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>
            </div>
        </div>
    </div>

    <?php
endif;

wp_reset_postdata();
