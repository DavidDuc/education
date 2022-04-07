<?php

/**
 * Loop Rating
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;

if (get_option('woocommerce_enable_review_rating') === 'no')
    return;
?>

<?php if ($rating_html = wc_get_rating_html( $product->get_average_rating() )) : ?>
    <?php echo wp_kses_post($rating_html); ?>
<?php else: ?>
    <?php

    $rating = 0;
     /* translators: %s: star rating */
    $rating_html = '<div class="star-rating" title="' . sprintf(esc_attr__('Rated %s out of 5', 'educatito'), $rating) . '">';

    $rating_html .= '<span style="width:0%"><strong class="rating">' . $rating . '</strong> ' . esc_html__('out of 5', 'educatito') . '</span>';

    $rating_html .= '</div>';
    echo wp_kses_post($rating_html);
    ?>
<?php endif; ?>
