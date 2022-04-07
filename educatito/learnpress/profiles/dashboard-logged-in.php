<?php
/**
 * @author   JRBthemes
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();

if ( ! $profile->is_current_user() ) {
	return;
}

$user = $profile->get_user();
?>

<p><?php echo sprintf( __( 'Hello <strong>%s</strong> (not %s? %s)', 'educatito' ), $user->get_display_name(), $user->get_display_name(), sprintf( '<a href="%s">%s</a>', $profile->logout_url(), __( 'Sign out', 'educatito' ) ) ); ?></p>