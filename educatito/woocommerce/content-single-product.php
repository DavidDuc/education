<?php
/**
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $educatito_options;
?>

<?php
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo esc_attr(get_the_password_form());
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="box-detail uk-clearfix">
        <?php do_action('woocommerce_before_single_product_summary'); ?>
        <div class="content-detail">
            <?php do_action('woocommerce_template_single_title'); ?>
            
            <?php do_action('woocommerce_template_single_rating'); ?>
            
            <?php do_action('woocommerce_template_single_price'); ?>

            <div class="description">
                <?php
                if (!empty($educatito_options)) {
                    if (isset($educatito_options['product-short-desc']) && $educatito_options['product-short-desc'])
                        do_action('woocommerce_template_single_excerpt');
                }else {
                    do_action('woocommerce_template_single_excerpt');
                }
                ?>
            </div>
            <div class="woo-controls">
                <?php do_action('woocommerce_template_single_add_to_cart'); ?>
            </div>
            <?php do_action('woocommerce_template_single_meta'); ?>
            <div class="share-link">
             <?php do_action('educatito_social_share'); ?>
            </div>
        </div>
    </div>
<?php do_action('woocommerce_output_product_data_tabs'); ?>
    <meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product -->

<?php do_action('woocommerce_after_single_product'); ?>
