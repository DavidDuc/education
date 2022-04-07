<?php
/*
  Template Name: Search Course
 */
get_header();
global $post, $wp_query, $lp_tax_query, $educatito_options;
$show_blog_title_breadcrumb = isset($educatito_options['jrb_show_post_title_blog']) ? $educatito_options['jrb_show_post_title_blog'] : 1;
$show_blog_subtitle_breadcrumb = isset($educatito_options['jrb_show_post_breadcrumb_blog']) ? $educatito_options['jrb_show_post_breadcrumb_blog'] : 1;
educatito_title_bar_breadcrumb_blog($show_blog_title_breadcrumb, $show_blog_subtitle_breadcrumb);
if (isset($_REQUEST['keyword']) || isset($_REQUEST['course_category']) || isset($_REQUEST['_lp_price']) ) {
    $keyword = isset($_REQUEST['keyword']) ? sanitize_text_field(wp_unslash($_REQUEST['keyword'])) : '';
    $course_category = isset($_REQUEST['course_category']) ? sanitize_text_field(wp_unslash($_REQUEST['course_category'])) : 0;
    $lp_price = isset($_REQUEST['_lp_price']) ? sanitize_text_field(wp_unslash($_REQUEST['_lp_price'])) : '';
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
    if ($course_category) {
        $v_args = array(
            'post_type' => 'lp_course',
            'orderby' => 'date',
            'paged' => $paged,
            'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'course_category',
                    'field' => 'slug',
                    'terms' => $course_category,
                ),
            ),
        );
    } elseif ($lp_price) {
        $v_args = array(
            'post_type' => 'lp_course',
            'orderby' => 'date',
            'order' => 'DESC',
            's' => $keyword,
            'paged' => $paged,
            'relation' => 'OR', // "OR"
            'meta_query' => array(
                array(
                    'key' => '_lp_price',
                    'value' => $lp_price,
                    'compare' => 'LIKE',
                )
            ),
        );
    } else {
        $v_args = array(
            'post_type' => 'lp_course', // your CPT
            'orderby' => 'date',
            'paged' => $paged,
            'order' => 'DESC',
            's' => $keyword,
        );
    }
    $SearchQuery = new WP_Query($v_args);
    ?>
    <div class="uk-container uk-container-center educatito_layout_content course-list course-search">
        <div class="uk-grid sidebar_display">
            <div class="uk-width-large-2-3 uk-width-medium-2-3 uk-width-small-1-1 uk-width-1-1 educatito-content archive-content archive-course content-right">
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
                                <div class="uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1">
                                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <div class="course-item">
                                            <div class="course-thumbnail">
                                                <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                                                </a>
                                            </div>
                                            <div class="educatito-course-content">
                                                <div class="flex-title-price">
                                                    <div class="title-meta">
                                                        <?php
                                                        do_action('learn_press_before_the_title');
                                                        the_title(sprintf('<h2 class="course-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                                                        do_action('learn_press_after_the_title');
                                                        ?>
                                                        <ul class="course-meta">
                                                            <li>
                                                                <?php $user_count = $course->get_users_enrolled('append') ? $course->get_users_enrolled('append') : 0; ?>
                                                                <?php echo esc_attr($user_count) . '/' . esc_attr($_lp_students2); ?><span><?php echo esc_html__(' Student', 'educatito'); ?></span>
                                                            </li>
                                                            <li><?php echo get_the_date('j M, Y'); ?></li>
                                                        </ul>
                                                    </div>
                                                    <?php learn_press_get_template( 'single-course/price.php' ); ?>
                                                </div>
                                                <div class="course-description">
                                                    <?php
                                                    echo the_excerpt(30);
                                                    ?>
                                                </div>
                                                <?php learn_press_course_instructor();
                                                ?>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            educatito_pagination_2($SearchQuery);
                            ?>
                        </div>
                        <?php
                    else:
                        learn_press_display_message(__('No course found.', 'educatito'), 'error');
                    endif;
                    ?>
                </div>
            </div>
            <div class="educatito_sidebar uk-width-large-1-3 uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 course-sidebar sidebar-left">
                <div id="secondary" class="widget-area">
                    <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                        <?php educatito_dynamic_sidebar('educatito_sidebar_lp_course'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } get_footer(); ?>