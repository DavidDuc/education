<?php
/**
 * Single product short description
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>
<div>
    <?php
        echo wp_kses_post(apply_filters( 'woocommerce_short_description', $post->post_excerpt ));
    ?>
</div>
