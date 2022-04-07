<?php
/**
 * My Account Dashboard
 * @author      JRB Themes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<p><?php
	/* translators: 1: user display name 2: logout url */
	printf(
                /* translators: user */
		wp_kses_post( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'educatito' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
?></p>

<p><?php
	printf(
                /* translators: From your account dashboard */
		wp_kses_post( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a> and <a href="%3$s">edit your password and account details</a>.', 'educatito' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
?></p>

<?php
	do_action( 'woocommerce_account_dashboard' );

	do_action( 'woocommerce_before_my_account' );

	do_action( 'woocommerce_after_my_account' );

