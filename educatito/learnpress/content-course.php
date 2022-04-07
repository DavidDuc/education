<?php
/**
 * @author  JRBthemes
 * @package LearnPress/Templates
 * @version 4.0.0
 */
/**
 * Prevent loading this file directly
 */
get_header();
defined('ABSPATH') || exit();

$user = LP_Global::user();
$course = LP()->global['course'];
$post_id = get_the_ID();
$_lp_students = get_post_meta($post_id, '_lp_students', true);
$_lp_students2 = get_post_meta($post_id, '_lp_max_students', true);
?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="course-item">
        <?php learn_press_course_thumbnail(); ?>
        <div class="educatito-course-content">
            <div class="author-price">
                <?php
                learn_press_course_instructor();
                 learn_press_get_template( 'single-course/price.php' );
                ?>
            </div>
            <div class="title">
                <?php
                do_action('learn_press_before_the_title');
                the_title(sprintf('<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                do_action('learn_press_after_the_title');
                ?>
            </div>
            <div class="course-description">
                <?php
                echo the_excerpt();
                ?>
            </div>
        </div> 
        <ul class="course-meta">
            <li>
                <?php $user_count = $course->get_users_enrolled('append') ? $course->get_users_enrolled('append') : 0; ?>
                <?php echo esc_attr($user_count) . '/' . esc_attr($_lp_students2); ?><span><?php echo esc_html__(' Student', 'educatito'); ?></span>
            </li>
            <li><?php echo get_the_date('j M, Y'); ?></li>
        </ul>
    </div>
</li>