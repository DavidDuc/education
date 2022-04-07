<?php
/**
 * Template for displaying archive course content
 *
 * @author  JRB Themes
 * @package LearnPress/Templates
 * @version 3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
get_header();
global $post, $wp_query, $lp_tax_query, $educatito_options;
$show_blog_title_breadcrumb = isset($educatito_options['jrb_show_post_title_blog']) ? $educatito_options['jrb_show_post_title_blog'] : 1;
$show_blog_subtitle_breadcrumb = isset($educatito_options['jrb_show_post_breadcrumb_blog']) ? $educatito_options['jrb_show_post_breadcrumb_blog'] : 1;

educatito_title_bar_breadcrumb_blog($show_blog_title_breadcrumb, $show_blog_subtitle_breadcrumb);
$course_layout = (isset($educatito_options['jrb_courses_templates']) && $educatito_options['jrb_courses_templates'] != '') ? $educatito_options['jrb_courses_templates'] : 'list';
$course_class = '';
if ($course_layout == 'list') {
    $course_class = 'course-list';
} else {
    $course_class = 'course-grid';
}
$edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content archive-content archive-course';
$col_sidebar = '';
$sidebar_display = '';
if (is_active_sidebar('educatito_sidebar_lp_course') && ($educatito_options['jrb_courses_layout'] != 'full' )) {

    $edu_content = 'uk-width-large-2-3 uk-width-medium-2-3 uk-width-small-1-1 uk-width-1-1 educatito-content archive-content archive-course';
    $col_sidebar = 'uk-width-large-1-3 uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 course-sidebar';
    if (!empty($educatito_options['jrb_courses_layout']) && $educatito_options['jrb_courses_layout'] == 'left') {
        $col_sidebar .= ' sidebar-left';
        $edu_content .= ' content-right';
        $sidebar_display = 'sidebar_display';
    } else {
        $col_sidebar .= ' sidebar-right';
        $edu_content .= ' content-left';
    }
}
$keyword = isset($_REQUEST['s']) ? sanitize_text_field(wp_unslash($_REQUEST['s'])) : '';
if ($keyword) {
    $keyword = strtoupper($keyword);
    $arr_query = array(
        'post_type' => 'lp_course',
        'post_status' => 'publish',
        'ignore_sticky_posts' => true,
        's' => $keyword,
        'posts_per_page' => '6'
    );
    $SearchQuery = new WP_Query($arr_query);
    ?>
    <div class="uk-container uk-container-center educatito_layout_content <?php echo esc_attr($course_class); ?>">
        <div class="uk-grid <?php echo esc_attr($sidebar_display); ?>">
            <div class="<?php echo esc_attr($edu_content); ?>">
                <div class="educatito-course-wrap">
                    <?php
                    if ($SearchQuery->have_posts()) :
                        ?>
                        <div class="uk-grid">
                            <?php
                            while ($SearchQuery->have_posts()) : $SearchQuery->the_post();
                                $_lpr_rating = get_post_meta(get_the_ID(), '_lpr_rating', true);
                                $course = LP()->global['course'];
                                $post_id = get_the_ID();
                                $_lp_students = get_post_meta($post_id, '_lp_students', true);
                                $_lp_students2 = get_post_meta($post_id, '_lp_max_students', true);
                                $thumb_id = get_post_thumbnail_id($post_id);
                                $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                                $url = wp_get_attachment_url($thumb_id);
                                $image = educatito_image_resize($url, 270, 200, true);
                                ?>
                                <?php learn_press_get_template_part('content', 'course-' . $course_layout); ?>

                            <?php endwhile; ?>

                        </div>
                        <?php
                        if (!empty($educatito_options)) {
                            if (isset($educatito_options['jrb_archive_courses_show_pagination']) && $educatito_options['jrb_archive_courses_show_pagination'] == 1) {
                                educatito_pagination_2($SearchQuery);
                            }
                        } else {
                            educatito_pagination_2($SearchQuery);
                        }
                        ?>
                    <?php else: ?>
                        <?php
                        learn_press_display_message(__('No course found.', 'educatito'), 'error');
                    endif;
                    ?>
                </div>
            </div>
            <div class="educatito_sidebar <?php echo esc_attr($col_sidebar); ?>">
                <div id="secondary" class="widget-area">
                    <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                        <?php educatito_dynamic_sidebar('educatito_sidebar_lp_course'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
if (is_active_sidebar('educatito_testimonial_footer')) :
    educatito_dynamic_sidebar('educatito_testimonial_footer');
endif;
get_footer();
?> 








