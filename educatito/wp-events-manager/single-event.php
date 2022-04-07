<?php
get_header();
global $educatito_options;
$show_blog_title_breadcrumb = isset($educatito_options['jrb_show_post_title_blog']) ? $educatito_options['jrb_show_post_title_blog'] : 1;
$show_blog_subtitle_breadcrumb = isset($educatito_options['jrb_show_post_breadcrumb_blog']) ? $educatito_options['jrb_show_post_breadcrumb_blog'] : 1;

educatito_title_bar_breadcrumb_blog($show_blog_title_breadcrumb, $show_blog_subtitle_breadcrumb);
?>

<?php
/**
 * tp_event_before_main_content hook
 */
do_action('tp_event_before_main_content');
?>
<div class="uk-container uk-container-center educatito_layout_content events-detail">
    <div class="uk-grid">
        <?php while (have_posts()) : the_post(); ?>

            <?php wpems_get_template_part('content', 'single-event'); ?>

        <?php endwhile; // end of the loop.  ?>
    </div>
</div>
<?php
// If comments are open or we have at least one comment, load up the comment template
?>


<?php
/**
 * hotel_booking_after_main_content hook
 *
 * @hooked tp_event_after_main_content - 10 (outputs closing divs for the content)
 */
do_action('tp_event_after_main_content');
?>

<?php
if (is_active_sidebar('educatito_testimonial_footer')) :
    educatito_dynamic_sidebar('educatito_testimonial_footer');
endif;
get_footer();
