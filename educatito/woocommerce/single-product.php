<?php
/**
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $educatito_options, $id_cat, $name_cat, $image, $alt;
get_header();
?>
<?php wc_get_template('title-bar-shop.php'); ?>
<?php
$edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 single-full-width educatito-content product-detail-content';
$col_sidebar = '';
if (is_active_sidebar('educatito_sidebar_shop') && ($educatito_options['jrb_woo_detail_layout'] != 'full' )) {
    $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content product-detail-content';
    $col_sidebar = 'uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 product-detail-sidebar';
    if (!empty($educatito_options['jrb_woo_detail_layout']) && $educatito_options['jrb_woo_detail_layout'] == 'left') {
        $col_sidebar .= ' sidebar-left';
        $edu_content .= ' content-right';
    } else {
        $col_sidebar .= ' sidebar-right';
        $edu_content .= ' content-left';
    }
}
?>
<div class="single-product detail-product">
    <div class="uk-container uk-container-center">
        <div class="uk-grid">
            <div class="<?php echo esc_attr($edu_content); ?>">

                <?php while (have_posts()) : the_post(); ?>

                    <?php wc_get_template_part('content', 'single-product'); ?>

                <?php endwhile; // end of the loop.  ?>
                <?php
                if (!empty($educatito_options)) {
                    if (isset($educatito_options['product-related']) && $educatito_options['product-related'] == 1)
                        do_action('woocommerce_output_related_products');
                }else {
                    do_action('woocommerce_output_related_products');
                }
                ?>
            </div>
            <?php if ($col_sidebar) { ?>
                <div class="educatito_sidebar <?php echo esc_attr($col_sidebar); ?>">
                    <div id="secondary" class="widget-area" role="complementary">
                        <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                            <?php educatito_dynamic_sidebar('educatito_sidebar_shop'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
if (is_active_sidebar('educatito_top_footer')) :
    ?>
    <div class="top_footer">
        <?php educatito_dynamic_sidebar('educatito_top_footer'); ?>
    </div>
    <?php
endif;
?>
<?php get_footer(); ?>
