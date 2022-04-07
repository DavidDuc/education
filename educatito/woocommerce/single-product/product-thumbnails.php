<?php

/**
 * Single Product Thumbnails
 *
 * @author 		JRB Themes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && has_post_thumbnail() ) {
    foreach ( $attachment_ids as $attachment_id ) {
		$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$image_title     = get_post_field( 'post_excerpt', $attachment_id );

		$attributes = array(
			'title'                   => $image_title,
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);

		$html = wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );

		echo wp_kses_post(apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id ));
	}
}
