<?php
/**
 * View Order
 * @author  JRB Themes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<p><?php
	/* translators: 1: order number 2: order date 3: order status */
	printf(
                /* translators: order number */
		esc_html__( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'educatito' ),
		'<mark class="order-number">' . esc_attr($order->get_order_number()) . '</mark>',
		'<mark class="order-date">' . esc_attr(wc_format_datetime( $order->get_date_created()) ) . '</mark>',
		'<mark class="order-status">' . esc_attr(wc_get_order_status_name( $order->get_status()) ) . '</mark>'
	);
?></p>

<?php if ( $notes = $order->get_customer_order_notes() ) : ?>
	<h2><?php esc_html_e( 'Order updates', 'educatito' ); ?></h2>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="woocommerce-OrderUpdate comment note">
			<div class="woocommerce-OrderUpdate-inner comment_container">
				<div class="woocommerce-OrderUpdate-text comment-text">
					<p class="woocommerce-OrderUpdate-meta meta"><?php echo wp_kses_post(date_i18n( __( 'l jS \o\f F Y, h:ia', 'educatito' )), strtotime( $note->comment_date ) ); ?></p>
					<div class="woocommerce-OrderUpdate-description description">
						<?php echo wp_kses_post(wpautop( wptexturize( $note->comment_content )) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order_id ); ?>
