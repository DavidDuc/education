<?php
/**
 * @author  JRB Themes
 * @package LearnPress/Templates
 * @version 4.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $post, $wp_query, $lp_tax_query, $educatito_options;
$educatito_show_page_title = isset($educatito_options['jrb_page_show_page_title']) ? $educatito_options['jrb_page_show_page_title'] : 1;
$educatito_show_page_breadcrumb = isset($educatito_options['jrb_page_show_page_breadcrumb']) ? $educatito_options['jrb_page_show_page_breadcrumb'] : 1;
educatito_theme_title_bar_page($educatito_show_page_title, $educatito_show_page_breadcrumb);
?>
<div class="uk-container uk-container-center course-detail">
    <div class="uk-grid">
        <?php
        $course = LP()->global['course'];
        $is_required = $course->is_required_enroll();
        $user = learn_press_get_current_user();
        $is_enrolled = $user->has_enrolled_course($course->get_id());
       // $is_enrolled = $user->has('enrolled-course', $course->get_id());
        $date = get_the_date('j M, Y');
        ?>
        <div class="uk-width-large-2-3 uk-width-medium-2-3 uk-width-small-1-1 uk-width-1-1 educatito-content ">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/CreativeWork">
                <?php
                if (!empty($educatito_options)) {
                    if (isset($educatito_options['jrb_courses_detail_show_title']) && $educatito_options['jrb_courses_detail_show_title'] == 1) {
                        the_title('<h1 class="course-title" itemprop="name">', '</h1>');
                    }
                } else {
                    the_title('<h1 class="course-title" itemprop="name">', '</h1>');
                }
                ?>
                <?php
                if (!empty($educatito_options)) {
                    if (isset($educatito_options['jrb_courses_detail_show_info']) && $educatito_options['jrb_courses_detail_show_info'] == 1) {
                        ?>
                        <ul class="course-meta uk-clearfix">
                            <li>
                                <label><?php echo esc_attr($date); ?></label>
                            </li>
                            <li>
                                <?php learn_press_get_template( 'single-course/categories.php' ); ?>
                            </li>
                            <li>
                                <?php educatito_course_ratings(); ?>
                            </li>
                        </ul>
                        <?php
                    }
                } else {
                    ?>
                    <ul class="course-meta uk-clearfix">
                        <li>
                            <label><?php echo esc_attr($date); ?></label>
                        </li>
                        <li>
                            <?php learn_press_course_categories(); ?>
                        </li>
                        <li>
                            <?php educatito_course_ratings(); ?>
                        </li>
                    </ul>
                    <?php
                }
                ?>

                <?php
                if (!empty($educatito_options)) {
                    if (isset($educatito_options['jrb_courses_detail_show_thumbnail']) && $educatito_options['jrb_courses_detail_show_thumbnail'] == 1) {
                        learn_press_get_template('single-course/thumbnail.php');
                    }
                } else {
                    learn_press_get_template('single-course/thumbnail.php');
                }
                ?>

                <div class="course-summary">

                    <?php if ($is_enrolled || !$is_required) { ?>

                        <?php learn_press_get_template('single-course/content-learning.php'); ?>

                    <?php } else { ?>

                        <?php learn_press_get_template('single-course/content-landing.php'); ?>

                    <?php } ?>
                </div>

                <?php do_action('learn_press_after_single_course_summary'); ?>

            </article>
        </div>
        <div class="uk-width-large-1-3 uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 educatito_sidebar">
            <div class="course-payment">
                <?php educatito_course_info(); ?>
                <?php
                if (!$is_enrolled) {
                    learn_press_get_template( 'single-course/buttons.php' );
                } else {
                    do_action('educatito_end_course_payment');
                }
                ?>
            </div>
            <div class="course-author">
                <?php
                if (!empty($educatito_options)) {
                    if (isset($educatito_options['jrb_courses_detail_show_author']) && $educatito_options['jrb_courses_detail_show_author'] == 1) {
                        educatito_about_author();
                    }
                } else {
                    educatito_about_author();
                }
                ?>
            </div>
            <div class="widget-banner-course">
                <?php if (is_active_sidebar('educatito_banner_course_single')) { ?>
                    <?php educatito_dynamic_sidebar('educatito_banner_course_single'); ?>
                <?php } ?>
            </div>
        </div>
        <?php do_action('learn_press_after_single_course'); ?>
    </div>
</div>
<?php
if (!empty($educatito_options)) {
    if (isset($educatito_options['jrb_courses_detail_show_related']) && $educatito_options['jrb_courses_detail_show_related'] == 1) {
        ?>
        <div class="course-related">
            <div class="uk-container uk-container-center">
                <?php educatito_related_courses() ?>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="course-related">
        <div class="uk-container uk-container-center">
            <?php educatito_related_courses() ?>
        </div>
    </div>
    <?php
}
?>
