<?php
/**
 * @author        JRB Themes
 * @package       tp-event/template
 * @version       1.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $wp_query;
$_wp_query = $wp_query;
?>
<?php
get_header();
global $educatito_options;
$show_blog_title_breadcrumb = isset($educatito_options['jrb_show_post_title_blog']) ? $educatito_options['jrb_show_post_title_blog'] : 1;
$show_blog_subtitle_breadcrumb = isset($educatito_options['jrb_show_post_breadcrumb_blog']) ? $educatito_options['jrb_show_post_breadcrumb_blog'] : 1;

educatito_title_bar_breadcrumb_blog($show_blog_title_breadcrumb, $show_blog_subtitle_breadcrumb);
?>

<?php
do_action('tp_event_before_main_content');
?>

<?php
do_action('tp_event_archive_description');
$all = $GLOBALS["educatito_all_events"];
$expired = $GLOBALS["educatito_expired_events"];
$happening = $GLOBALS["educatito_happening_events"];
$upcoming = $GLOBALS["educatito_upcoming_events"];
?>
<section class="educatito-events v10">
    <div class="uk-container uk-container-center educatito_layout_content">
        <div class="box" >
            <ul class="uk-subnav uk-subnav-pill" data-uk-switcher="{active:1,connect:'#switcher-content-a-fade', animation: 'fade'}">
                <li><a href="#"><?php
                        esc_html_e('All Event ', 'educatito');
                        printf(esc_html('(') . esc_attr($all->post_count) . esc_html(')'));
                        ?></a></li>
                <li><a href="#"><?php
                        esc_html_e('Happening ', 'educatito');
                        printf(esc_html('(') . esc_attr($happening->post_count) . esc_html(')'));
                        ?></a></li>
                <li><a href="#"><?php
                        esc_html_e('Upcoming ', 'educatito');
                        printf(esc_html('(') . esc_attr($upcoming->post_count) . esc_html(')'));
                        ?></a></li>
                <li><a href="#"><?php
                        esc_html_e('Expired ', 'educatito');
                        printf(esc_html('(') . esc_attr($expired->post_count) . esc_html(')'));
                        ?></a></li>
            </ul>
            <!-- /.menu-tab -->
            <ul id="switcher-content-a-fade" class="uk-switcher">
                <?php
                foreach (array('all', 'happening', 'upcoming', 'expired') as $type):
                    get_template_part("wp-events-manager/archive-event", $type);
                endforeach;
                ?>
            </ul>         
        </div>
    </div>
</section>
<?php
do_action('tp_event_after_main_content');
?>

<?php
do_action('tp_event_sidebar');
?>
<?php
if (is_active_sidebar('educatito_testimonial_footer')) :
    educatito_dynamic_sidebar('educatito_testimonial_footer');
endif;
?>
<?php get_footer(); ?>
