<?php
/**
 * Single Product Rating
 *
 * @author      JRB Themes
 * @package     WooCommerce/Templates
 * @version     3.1.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;

if (get_option('woocommerce_enable_review_rating') === 'no') {
    return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average = $product->get_average_rating();
?>
<div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
    <?php /* translators: %s: Rated */ ?>
    <div class="star-rating" title="<?php printf(esc_attr__('Rated %s out of 5', 'educatito'), esc_attr($average)); ?>">
        <span style="width:<?php echo ( ( esc_attr($average) / 5 ) * 100 ); ?>%">
            <?php /* translators: %s: out of */ ?>
            <strong itemprop="ratingValue" class="rating"><?php echo esc_attr($average); ?></strong> <?php printf(esc_html__('out of %1$s', 'educatito'), '<span itemprop="bestRating"></span>'); ?>
            <?php
            /* translators: %s: customer rating */
            printf(esc_html__('based on %s customer ratings', 'educatito'), '<span itemprop="ratingCount" class="rating">' . esc_attr($rating_count) . '</span>');
            ?>
        </span>
    </div>
</div>
