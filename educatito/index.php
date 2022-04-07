<?php
get_header();
global $educatito_options, $post;
$blog_post_layout = (isset($educatito_options['jrb_blog_layout']) && $educatito_options['jrb_blog_layout'] != '') ? $educatito_options['jrb_blog_layout'] : 'list';
$blog_post_class = '';
if ($blog_post_layout == 'list') {
    $blog_post_class = 'post-list blog-v2 latest-post';
} elseif ($blog_post_layout == 'grid-2-column') {
    $blog_post_class = 'blog-grid-2 blog-v1 latest-post';
} else {
    $blog_post_class = 'blog-v3 latest-post';
}
$edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content blog-content ';
$sidebar_display = '';
if (!empty($educatito_options)) {
    if (is_active_sidebar('educatito_sidebar_blog') && (isset($educatito_options['jrb_sidebar_blog']) && $educatito_options['jrb_sidebar_blog'] != 'no_sidebar' )) {
        $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content blog-content ';
        $edu_content .= ($educatito_options['jrb_sidebar_blog'] == 'sidebar_left') ? 'content-right' : 'content-left';
        if ($educatito_options['jrb_sidebar_blog'] == 'sidebar_left') {
            $sidebar_display = 'sidebar_display';
        }
    }
} elseif (is_active_sidebar('educatito_sidebar_blog')) {
    $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content blog-content ';
} else {
    $edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content blog-content ';
}
$show_blog_title_breadcrumb = isset($educatito_options['jrb_show_post_title_blog']) ? $educatito_options['jrb_show_post_title_blog'] : 1;
$show_blog_subtitle_breadcrumb = isset($educatito_options['jrb_show_post_breadcrumb_blog']) ? $educatito_options['jrb_show_post_breadcrumb_blog'] : 1;
educatito_title_bar_breadcrumb_blog($show_blog_title_breadcrumb, $show_blog_subtitle_breadcrumb);
if (isset($_GET['layout']) && $_GET['layout'] == 'list') {
    $blog_post_layout = 'list';
    $blog_post_class = 'post-list blog-v2 latest-post';
    if (isset($_GET['sidebar']) && $_GET['sidebar'] == 'left') {
        $sidebar_display = 'sidebar_display';
        $edu_content .= ' content-right';
    } else if (isset($_GET['sidebar']) && $_GET['sidebar'] == 'right') {
        $edu_content .= ' content-left';
    }
} else if (isset($_GET['layout']) && $_GET['layout'] == 'grid') {
    $blog_post_layout = 'grid-2-column';
    $blog_post_class = 'blog-grid-2 blog-v1 latest-post';
    if (isset($_GET['sidebar']) && $_GET['sidebar'] == 'left') {
        $sidebar_display = 'sidebar_display';
        $edu_content .= ' content-right';
    } else if (isset($_GET['sidebar']) && $_GET['sidebar'] == 'right') {
        $edu_content .= ' content-left';
    }
}
?>
<div class="uk-container uk-container-center educatito_layout_content <?php echo esc_attr($blog_post_class); ?>">
    <div class="uk-grid <?php echo esc_attr($sidebar_display); ?>">
        <div class="<?php echo esc_attr($edu_content); ?>">
            <?php
            if ($blog_post_layout == 'grid-2-column') {
                ?>
                <div class="educatito-blog-wrap">
                    <div class="uk-grid">
                        <?php
                    }
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            get_template_part('inc/templates/content', 'blog-' . $blog_post_layout);
                        endwhile;

                        if (!empty($educatito_options)) {
                            if (educatito_opts_get('jrb_show_navigation_post')):
                                educatito_pagination();
                            endif;
                        }else {
                            educatito_pagination();
                        }
                    else :
                        get_template_part('inc/templates/content', 'none');

                    endif;
                    if ($blog_post_layout == 'grid-2-column') {
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
if (is_active_sidebar('educatito_testimonial_footer')) :
    educatito_dynamic_sidebar('educatito_testimonial_footer');
endif;
?>
<?php
get_footer();
