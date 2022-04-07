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

$user        = learn_press_get_current_user();
$course      = learn_press_get_the_course();
$user_course = $user->get_course_data( get_the_ID() );

if ( ! isset( $section ) ) {
	return;
}

$title = $section->get_title();
?>

<div class="section-header">

    <div class="section-left">

		<?php if ( $title ) { ?>
            <h5 class="section-title"><?php echo wp_kses_post($title); ?></h5>
		<?php } ?>

		<?php if ( $description = $section->get_description() ) { ?>
            <p class="section-desc"><?php echo wp_kses_post($description); ?></p>
		<?php } ?>

    </div>

	<?php if ( $user->has_enrolled_course( $section->get_course_id() ) ) { ?>

		<?php $percent = $user_course->get_percent_completed_items( '', $section->get_id() ); ?>

        <div class="section-meta">
            <div class="learn-press-progress section-progress" title="<?php echo intval( $percent ); ?>%">
                <div class="progress-bg">
                    <div class="progress-active primary-background-color" style="left: <?php echo wp_kses_post($percent); ?>%;"></div>
                </div>
            </div>
            <span class="step"><?php printf( __( '%d/%d', 'educatito' ), $user_course->get_completed_items( '', false, $section->get_id() ), $section->count_items( '', false ) ); ?></span>
            <span class="collapse"></span>
        </div>

	<?php } ?>

</div>
