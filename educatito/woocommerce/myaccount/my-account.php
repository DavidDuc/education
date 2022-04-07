<?php
/**
 * My Account page
 * @author  JRB Themes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();


do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce-MyAccount-content">
	<?php
		
		do_action( 'woocommerce_account_content' );
	?>
</div>
