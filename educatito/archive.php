<?php
get_header();
global $educatito_options;
$edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content archive-content';
$sidebar_display = '';
if (is_active_sidebar('educatito_sidebar_archive') && ($educatito_options['jrb_sidebar_archive'] != 'no_sidebar' )) {
    $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content archive-content ';
    $edu_content .= ($educatito_options['jrb_sidebar_archive'] == 'sidebar_left') ? 'content-right' : 'content-left';
    if ($educatito_options['jrb_sidebar_archive'] == 'sidebar_left') {
        $sidebar_display = 'sidebar_display';
    }
}
$show_blog_title_breadcrumb = isset($educatito_options['jrb_show_post_title_blog']) ? $educatito_options['jrb_show_post_title_blog'] : 1;
$show_blog_subtitle_breadcrumb = isset($educatito_options['jrb_show_post_breadcrumb_blog']) ? $educatito_options['jrb_show_post_breadcrumb_blog'] : 1;
educatito_title_bar_breadcrumb_blog($show_blog_title_breadcrumb, $show_blog_subtitle_breadcrumb);
?>
<div class="uk-container uk-container-center educatito_layout_content latest-post post-list blog-v2">
    <div class="uk-grid <?php echo esc_attr($sidebar_display); ?>">
        <div class="<?php echo esc_attr($edu_content); ?>">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php get_template_part('inc/templates/content', 'blog-list'); ?>
                <?php endwhile; ?>
                <?php
                educatito_pagination();
                ?>
            <?php else : ?>
                <?php get_template_part('inc/templates/content', 'none'); ?>
            <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>