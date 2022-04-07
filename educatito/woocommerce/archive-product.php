<?php
/**
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $educatito_options, $id_cat, $name_cat, $image, $alt;

get_header();
?>
<?php wc_get_template('title-bar-shop.php'); ?>

<?php
$edu_content = 'uk-grid-collapse uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content product-content';
$col_sidebar = '';
$sidebar_display = '';
if (is_active_sidebar('educatito_sidebar_shop') && ($educatito_options['jrb_woo_layout'] != 'full' )) {

    $edu_content = 'uk-grid-collapse uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content product-content';
    $col_sidebar = 'uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 product-sidebar';
    if (!empty($educatito_options['jrb_woo_layout']) && $educatito_options['jrb_woo_layout'] == 'left') {
        $col_sidebar .= ' sidebar-left';
        $edu_content .= ' content-right';
        $sidebar_display = 'sidebar_display';
    } else {
        $col_sidebar .= ' sidebar-right';
        $edu_content .= ' content-left';
    }
}

$template = 'product-grid';
?>
<div class="archive-products <?php echo esc_attr($template); ?>">
    <div class="uk-container uk-container-center">
        <div class="uk-grid <?php echo esc_attr($sidebar_display); ?>">
            <div class="<?php echo esc_attr($edu_content); ?>">
                <?php do_action('woocommerce_archive_description'); ?>
                <?php if (have_posts()) : ?>
                    <?php
                    if (!empty($educatito_options)) {
                        if (isset($educatito_options['jrb_archive_show_catalog_ordering']) && $educatito_options['jrb_archive_show_catalog_ordering'] == 1) {
                            do_action('woocommerce_catalog_ordering');
                        }
                    } else {
                        do_action('woocommerce_catalog_ordering');
                    }
                    ?> 
                    <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        $post_id = get_the_ID();
                        $thumb_id = get_post_thumbnail_id($post_id);
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $url = wp_get_attachment_url($thumb_id);
                        $image = educatito_image_resize($url, 270, 270, true);
                        $layout_content = 'product';
                        wc_get_template_part('content', $layout_content);
                        ?>

                    <?php endwhile;   ?>

                    <?php woocommerce_product_loop_end(); ?>

                    <?php
                    if (!empty($educatito_options)) {
                        if (isset($educatito_options['jrb_archive_show_pagination_shop']) && $educatito_options['jrb_archive_show_pagination_shop'] == 1)
                            do_action('woocommerce_after_shop_loop');
                    }else {
                        do_action('woocommerce_after_shop_loop');
                    }
                    ?>

                <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

                    <?php wc_get_template('loop/no-products-found.php'); ?>

                <?php endif; ?>

            </div>
            <?php if ($col_sidebar) { ?>
                <div class="educatito_sidebar <?php echo esc_attr($col_sidebar); ?>">
                    <div id="secondary" class="widget-area">
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
