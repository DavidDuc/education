<?php
/**
 * Lost password confirmation text.
 * @author  JRB Themes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();
wc_print_notice( __( 'Password reset email has been sent.', 'educatito' ) );
?>

<p><?php echo wp_kses_post(apply_filters( 'woocommerce_lost_password_message', __( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'educatito' ) ) ); ?></p>
