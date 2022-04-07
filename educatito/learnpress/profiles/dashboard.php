<?php
/**
 * @author   JRBthemes
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

?>

<div class="learn-press-profile-dashboard">

	<?php
	/**
	 * Before dashboard
	 */
	do_action( 'learn-press/profile/before-dashboard' );

	/**
	 * Dashboard summary
	 */
	do_action( 'learn-press/profile/dashboard-summary' );

	/**
	 * After dashboard
	 */
	do_action( 'learn-press/profile/after-dashboard' );

	?>

</div>