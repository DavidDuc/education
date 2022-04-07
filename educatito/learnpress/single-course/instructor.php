<?php
/**
 * @author  JRB Themes
 * @package LearnPress/Templates
 * @version 3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $course;
$course = LP_Global::course();
$lp_info = get_the_author_meta('lp_info');
?>
<div class="course-author">
    <?php echo wp_kses_post( $course->get_instructor()->get_profile_picture() ); ?>
    <div class="author-contain">
        <div class="value" itemprop="name">
            <?php echo wp_kses_post( $course->get_instructor_html() ); ?>
        </div>
        <?php if (isset($lp_info['major']) && $lp_info['major']) : ?>
            <p class="job"><?php echo esc_html($lp_info['major']); ?></p>
        <?php endif; ?>
    </div>
</div>