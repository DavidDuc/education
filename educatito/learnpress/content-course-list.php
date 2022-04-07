<?php
/**
 * @author  JRB Themes
 * @package LearnPress/Templates
 * @version 3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $post, $wp_query, $lp_tax_query, $educatito_options;
$course = LP()->global['course'];
$post_id = get_the_ID();
$_lp_students = get_post_meta($post_id, '_lp_students', true);
$_lp_students2 = get_post_meta($post_id, '_lp_max_students', true);
?>
<div class="uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="course-item uk-clearfix educatito-hover-icon">
            <?php learn_press_course_thumbnail(); ?>
            <div class="educatito-course-content">
                <div class="flex-title-price">
                    <div class="title-meta">
                        <?php
                        if (!empty($educatito_options)) {
                            if (isset($educatito_options['jrb_archive_courses_show_title']) && $educatito_options['jrb_archive_courses_show_title'] == 1) {
                                do_action('learn_press_before_the_title');
                                the_title(sprintf('<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                                do_action('learn_press_after_the_title');
                            }
                        } else {
                            do_action('learn_press_before_the_title');
                            the_title(sprintf('<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                            do_action('learn_press_after_the_title');
                        }
                        ?>
                        <ul class="course-meta">
                            <li>
                                <?php $user_count = $course->get_users_enrolled('append') ? $course->get_users_enrolled('append') : 0; ?>
                                <?php echo esc_attr($user_count) . '/' . esc_attr($_lp_students2); ?><span><?php echo esc_html__(' Student', 'educatito'); ?></span>
                            </li>
                            <li><?php echo get_the_date('j M, Y'); ?></li>
                        </ul>
                    </div>
                    <?php learn_press_get_template( 'single-course/price.php' ); ?>
                </div>
                <div class="course-description">
                    <?php
                    if (!empty($educatito_options)) {
                        if (isset($educatito_options['jrb_archive_courses_show_excerpt']) && $educatito_options['jrb_archive_courses_show_excerpt'] == 1) {
                            echo the_excerpt(30);
                        }
                    } else {
                        echo the_excerpt(30);
                    }
                    ?>
                </div>
                <?php learn_press_course_instructor();
                ?>
            </div> 
        </div>
    </div>
</div>