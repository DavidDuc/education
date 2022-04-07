<?php
/**
 * @author  JRB Themes
 * @package LearnPress/Templates
 * @version 3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $educatito_options;
$post_id = get_the_ID();
$thumb_id = get_post_thumbnail_id($post_id);
$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$url = wp_get_attachment_url($thumb_id);
$course_layout = (isset($educatito_options['jrb_courses_templates']) && $educatito_options['jrb_courses_templates'] != '') ? $educatito_options['jrb_courses_templates'] : 'list';
if ($course_layout == 'list') {
    $image = educatito_image_resize($url, 270, 200, true);
} else {
    $image = educatito_image_resize($url, 370, 250, true);
}
if (is_singular()) {
    if (has_post_thumbnail()) :
        ?>
        <div class="course-thumbnail">
            <?php the_post_thumbnail('full', array('alt' => get_the_title())); ?>
        </div>
        <?php
    endif;
} else {
    ?>
    <div class="course-thumbnail">
        <a href="<?php echo esc_url(get_the_permalink()); ?>">
            <img src="<?php echo esc_url($image); ?>" alt="<?php if (isset($alt)) echo esc_attr($alt); ?>">
        </a>
        <div class="hover-border">
            <a href="<?php echo esc_url(get_permalink()); ?>"><span class="fa fa-link"></span></a>
        </div>
    </div>
    <?php
}
