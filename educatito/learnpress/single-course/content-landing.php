<?php
/**
 * @author   JRBthemes
 * @package  Learnpress/Templates
 * @version  3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $educatito_options;
$review_is_enable = in_array('learnpress-course-review/learnpress-course-review.php', apply_filters('active_plugins', get_option('active_plugins')))
?>

<?php do_action('learn_press_before_content_landing'); ?>
<div class="content">
    <div class="course-description">
        <?php do_action('learn_press_begin_course_content_course_description'); ?>
        <div class="educatito-course-content">
            <?php echo the_content(get_the_ID()); ?>
        </div>
        <?php do_action('learn_press_end_course_content_course_description'); ?>
    </div>
    <?php
    if (!empty($educatito_options)) {
        if (isset($educatito_options['jrb_courses_detail_show_curriculum']) && $educatito_options['jrb_courses_detail_show_curriculum'] == 1) {
            ?>
            <div class="curriculum-course">
                <h3><?php echo esc_html__('Curriculum', 'educatito') ?></h3>
                <?php learn_press_get_template( 'single-course/curriculum.php' ); ?>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="curriculum-course">
            <h3><?php echo esc_html__('Curriculum', 'educatito') ?></h3>
            <?php learn_press_get_template( 'single-course/curriculum.php' ); ?>
        </div>
        <?php
    }
    ?>
    <?php
    if (!empty($educatito_options)) {
        if (isset($educatito_options['jrb_courses_detail_show_review_rating']) && $educatito_options['jrb_courses_detail_show_review_rating'] == 1) {
            ?>
            <?php if ($review_is_enable) : ?>
                <div class="course-review">
                    <?php educatito_course_review(); ?>
                </div>
            <?php endif; ?>
            <?php
        }
    } else {
        ?>
        <?php if ($review_is_enable) : ?>
            <div class="course-review">
                <?php educatito_course_review(); ?>
            </div>
        <?php endif; ?>
        <?php
    }
    ?>
</div>
<?php do_action('learn_press_after_content_landing'); ?>
