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

<?php global $course;
?>
<div class="course-curriculum" id="learn-press-course-curriculum">

    <?php
    /**
     * @deprecated
     */
    do_action( 'learn_press_before_single_course_curriculum' );

    /**
     * @since 3.0.0
     */
    do_action( 'learn-press/before-single-course-curriculum' );
    ?>

    <?php 
    if ( $curriculum = $course->get_curriculum() ) { ?>

        <ul class="curriculum-sections">
            <?php foreach ( $curriculum as $section ) {
                learn_press_get_template( 'single-course/loop-section.php', array( 'section' => $section ) );
            } ?>
        </ul>

    <?php } else { ?>

        <?php echo  esc_html__('Curriculum is empty', 'educatito')  ; ?>

    <?php } ?>

    <?php
    do_action( 'learn-press/after-single-course-curriculum' );
    do_action( 'learn_press_after_single_course_curriculum' );
    ?>

</div>