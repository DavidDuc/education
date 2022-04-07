<?php
/**
 * @author  JRBthemes
 * @package  Learnpress/Templates
 * @version  4.0.2
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! isset( $section ) ) {
	return;
}
?>

<li<?php $section->main_class();?> id="section-<?php echo wp_kses_post($section->get_slug()); ?>" data-id="<?php echo wp_kses_post($section->get_slug()); ?>" data-section-id="<?php echo wp_kses_post($section->get_id());?>">

	<?php

	do_action( 'learn_press_curriculum_section_summary', $section );
	do_action( 'learn-press/section-summary', $section );
	?>

</li>