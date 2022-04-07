<?php
get_header();
global $educatito_options, $post;
$edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content single-post-content';
$sidebar_display = '';
if (!empty($educatito_options)) {
    if (is_active_sidebar('educatito_sidebar_blog') && (isset($educatito_options['jrb_sidebar_single_post']) && $educatito_options['jrb_sidebar_single_post'] != 'no_sidebar' )) {
        $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content ';
        $edu_content .= ($educatito_options['jrb_sidebar_single_post'] == 'sidebar_left') ? 'content-right' : 'content-left';
        if($educatito_options['jrb_sidebar_single_post'] == 'sidebar_left'){
            $sidebar_display = 'sidebar_display';
        }
    }
}elseif (is_active_sidebar('educatito_sidebar_blog')) {
    $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content blog-content ';
} else {
    $edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content blog-content ';
}
$show_blog_title_breadcrumb = isset($educatito_options['jrb_show_post_title_blog']) ? $educatito_options['jrb_show_post_title_blog'] : 1;
$show_blog_subtitle_breadcrumb = isset($educatito_options['jrb_show_post_breadcrumb_blog']) ? $educatito_options['jrb_show_post_breadcrumb_blog'] : 1;
educatito_title_bar_breadcrumb_blog($show_blog_title_breadcrumb, $show_blog_subtitle_breadcrumb);
?>
<div class="uk-container uk-container-center educatito_layout_content blog-detail">
    <div class="uk-grid <?php echo esc_attr($sidebar_display); ?>">
        <div class="<?php echo esc_attr($edu_content); ?>">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php get_template_part('inc/templates/content', get_post_format()); ?>
                    <?php
                    if (!empty($educatito_options)) {
                        //show navigaton
                        if(educatito_opts_get('jrb_post_show_post_nav')){
                            educatito_post_nav();
                        }
                        //show comment
                        if (educatito_opts_get('jrb_post_show_post_comment')):
                            comments_template();
                        endif;
                    }else {
                        educatito_post_nav();
                        comments_template();
                    }
                    ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php get_template_part('inc/templates/content', 'none'); ?>
            <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php 
if (is_active_sidebar('educatito_testimonial_footer')) :
    educatito_dynamic_sidebar('educatito_testimonial_footer');
endif;
?>
<?php get_footer(); ?>