<?php
get_header();
$body_classes = get_body_class();
if (!in_array("learnpress-page", $body_classes)) {
    global $educatito_options, $post;
    if ($post) {
        $meta_data = educatito_option_meta_id($post->ID);
    }
    $educatito_show_page_title = isset($educatito_options['jrb_page_show_page_title']) ? $educatito_options['jrb_page_show_page_title'] : 1;
    $educatito_show_page_breadcrumb = isset($educatito_options['jrb_page_show_page_breadcrumb']) ? $educatito_options['jrb_page_show_page_breadcrumb'] : 1;

    $educatito_show_shop_title = isset($educatito_options['jrb_show_page_title_shop']) ? $educatito_options['jrb_show_page_title_shop'] : 1;
    $educatito_show_shop_breadcrumb = isset($educatito_options['jrb_show_page_breadcrumb_shop']) ? $educatito_options['jrb_show_page_breadcrumb_shop'] : 1;
    $title_bar = '';
    if (!empty($meta_data)) {
        if (isset($meta_data->_jrb_hidden_page_title)) {
            $title_bar = $meta_data->_jrb_hidden_page_title;
        }
    }
    if (!is_post_type_archive('lp_course')) {
        if (isset($title_bar) && $title_bar != '1') {
            if (class_exists('Woocommerce')) {
                if (is_checkout() || is_cart()) {
                    educatito_theme_title_bar_shop($educatito_show_shop_title, $educatito_show_shop_breadcrumb);
                } else
                    educatito_theme_title_bar_page($educatito_show_page_title, $educatito_show_page_breadcrumb);
            } else
                educatito_theme_title_bar_page($educatito_show_page_title, $educatito_show_page_breadcrumb);
        }
    }

    $edu_content = 'uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content page-content ';
    $sidebar_display = '';
    if (!empty($educatito_options)) {
        if (is_active_sidebar('educatito_sidebar_page') && (isset($educatito_options['jrb_sidebar_page']) && $educatito_options['jrb_sidebar_page'] != 'no_sidebar' )) {
            $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content page-content ';
            $edu_content .= ($educatito_options['jrb_sidebar_page'] == 'sidebar_left') ? 'content-right' : 'content-left';
            if ($educatito_options['jrb_sidebar_page'] == 'sidebar_left') {
                $sidebar_display = 'sidebar_display';
            }
        }
    }
    if (!empty($meta_data)):
        if (isset($meta_data->_jrb_show_sidebar) && $meta_data->_jrb_show_sidebar != '') {
            if (isset($meta_data->_jrb_educatito_show_sidebar) && $meta_data->_jrb_educatito_show_sidebar != '') {
                $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content page-content ';
                $edu_content .= 'content-right';
                $sidebar_display = 'sidebar_display';
            } else {
                $edu_content = 'uk-width-large-3-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 educatito-content page-content ';
                $edu_content .= 'content-left';
            }
        }
    endif;
    ?>
    <?php
    if (is_singular('lp_course')) {
        the_content();
    } elseif (is_post_type_archive('lp_course')) {
        if (have_posts()) : while (have_posts()) : the_post();
                ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php
        endif;
    }else {
        ?>
        <div class="uk-container uk-container-center">
            <div class="uk-grid <?php echo esc_attr($sidebar_display); ?>">
                <div id="main-content" class="<?php echo esc_attr($edu_content); ?>">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php
                            the_content();
                            wp_link_pages(array(
                                'before' => '<div class="page-link">' . esc_html__('Pages:', 'educatito'),
                                'after' => '</div>'
                            ));
                            ?>
                            <?php
                            if (!empty($educatito_options)) {
                                if (educatito_opts_get('jrb_page_comments')):
                                    comments_template();
                                endif;
                            }else {
                                comments_template();
                            }
                            ?> 
                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php get_template_part('content', 'none'); ?>
                    <?php endif; ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php } ?>
<?php }else { ?>
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <?php
            $educatito_show_page_title = isset($educatito_options['jrb_page_show_page_title']) ? $educatito_options['jrb_page_show_page_title'] : 1;
            $educatito_show_page_breadcrumb = isset($educatito_options['jrb_page_show_page_breadcrumb']) ? $educatito_options['jrb_page_show_page_breadcrumb'] : 1;
            educatito_theme_title_bar_page($educatito_show_page_title, $educatito_show_page_breadcrumb);
            ?>
            <div class="educa-page-content uk-clearfix">
                <?php
                the_content();
                wp_link_pages(array(
                    'before' => '<div class="page-link">' . esc_html__('Pages:', 'educatito'),
                    'after' => '</div>'
                ));
                ?>
            </div>
        </article>
    <?php endwhile; ?>
    <?php
}
get_footer();
