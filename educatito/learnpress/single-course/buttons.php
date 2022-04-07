<?php
/**
 * @author  JRBthemes
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<div class="lp-course-buttons">

	<?php do_action( 'learn-press/before-course-buttons' ); ?>

	<?php
	do_action( 'learn-press/course-buttons' );
	?>

	<?php do_action( 'learn-press/after-course-buttons' ); ?>

</div>