<?php
/*
 * Custom Functions.
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function educatito_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'educatito_javascript_detection', 0);

/*
 * SSL | Compatibility
 */
if (!function_exists('educatito_ssl')) {

    function educatito_ssl($echo = false) {
        $ssl = '';
        if (is_ssl()) {
            $ssl = 's';
        }
        if ($echo) {
            echo esc_attr($ssl);
        }
        return $ssl;
    }

}
/*
 * Load Header Template
 */
if (!function_exists('educatito_header')) {
    add_action("educatito_header_template", "educatito_header");

    function educatito_header() {
        global $educatito_options, $post;
        $jrb_logo_menu = (isset($educatito_options["jrb_logo_menu"]) && $educatito_options["jrb_logo_menu"] != '') ? $educatito_options["jrb_logo_menu"] : "v1";

        if ($post) {
            $meta_data = educatito_option_meta_id($post->ID);
        }
        if (!empty($meta_data)):
            if ((isset($meta_data->_jrb_header) && $meta_data->_jrb_header == 1) && (isset($meta_data->_jrb_custom_header_layout) && $meta_data->_jrb_custom_header_layout == 1)) {
                $jrb_logo_menu = 'v' . $meta_data->_jrb_header_position;
            }
        endif;
        switch ($jrb_logo_menu) {
            case 'v1':
                get_template_part('inc/headers/header', 'v1');
                break;
            case 'v2':
                get_template_part('inc/headers/header', 'v2');
                break;
            case 'v3':
                get_template_part('inc/headers/header', 'v3');
                break;
            default:
                get_template_part('inc/headers/header', 'v1');
        }
    }

}

/*
 * Get Data Theme Options 
 */
if (!function_exists('educatito_opts_get')) {

    function educatito_opts_get($opt_name) {
        global $educatito_options;
        if (isset($educatito_options[$opt_name])) {
            $option = $educatito_options[$opt_name];
        } else {
            $option = '';
        }
        return $option;
    }

}
/*
 * Add Classes Body
 */
if (!function_exists('educatito_add_body_classes')) {

    function educatito_add_body_classes($classes) {
        global $educatito_options;
        $classes[] = 'educatito-body';
        if (isset($educatito_options['jrb_layout']) && ($educatito_options['jrb_layout'] == "boxed")) {
            $classes[] = 'boxed';
        }
        if (isset($educatito_options['jrb_header_sticky']) && ($educatito_options['jrb_header_sticky'] == 1)) {
            $classes[] = 'educatito-sticky';
        }
        if (isset($educatito_options['jrb_custom_header_sticky']) && ($educatito_options['jrb_custom_header_sticky'] == 1)) {
            $classes[] = 'educatito-custom-header-sticky';
        }
        return $classes;
    }

}
add_filter('body_class', 'educatito_add_body_classes');
/*
 * Educatito Thumnail
 */
if (!function_exists('educatito_post_thumbnail')) :

    function educatito_post_thumbnail($size = 'thumbnail', $cus_size = array()) {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }
        if (is_singular()) :
            ?>
            <div class="educatito-post-thumbnail">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php else : ?>
            <a class="educatito-post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php
                if (empty($cus_size)) {
                    the_post_thumbnail($size, array('alt' => get_the_title()));
                } else {
                    the_post_thumbnail($cus_size, array('alt' => get_the_title()));
                }
                ?>
            </a>
        <?php
        endif;
    }

endif;

/*
 * Educatito Thumnail Intro
 */
if (!function_exists('educatito_thumbnail_intro')) :

    function educatito_thumbnail_intro($attach_id, $size = 'thumbnail') {
        $intro_image = wp_get_attachment_image($attach_id, $size);
        return $intro_image;
    }

endif;

/*
 * Educatito Social Site
 */
if (!function_exists('educatito_jrb_social_site')) {
    if (in_array('educatito-addons/init.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        educatito_insert_shortcode('educatito_social_site', 'educatito_jrb_social_site');
    }
    add_action('educatito_social_site', 'educatito_jrb_social_site');

    function educatito_jrb_social_site() {
        global $educatito_options;
        ob_start();
        ?>
        <div class="educatito-social-site">
            <ul class="social-site">
                <?php if (!empty($educatito_options['jrb_social_facebook'])): ?>
                    <li>
                        <a href="<?php echo esc_url($educatito_options['jrb_social_facebook']); ?>" class="facebook-hover social-educa" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($educatito_options['jrb_social_twitter'])): ?>
                    <li>
                        <a href="<?php echo esc_url($educatito_options['jrb_social_twitter']); ?>" class="twitter-hover social-educa" target="_blank"><i class="fa fa-twitter active"></i></a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($educatito_options['jrb_social_google'])): ?>
                    <li>
                        <a href="<?php echo esc_url($educatito_options['jrb_social_google']); ?>" class="google-hover social-educa" target="_blank"><i class="fa fa-google-plus"></i></a>
                    </li>
                <?php endif; ?>

                <?php if (!empty($educatito_options['jrb_social_pinterest'])): ?>
                    <li>
                        <a href="<?php echo esc_url($educatito_options['jrb_social_pinterest']); ?>" class="pinterest-hover social-educa" target="_blank"><i class="fa fa-pinterest"></i> </a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($educatito_options['jrb_social_linkedin'])): ?>
                    <li>
                        <a href="<?php echo esc_url($educatito_options['jrb_social_linkedin']); ?>"  class="linkedin-hover social-educa" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($educatito_options['jrb_social_instagram'])): ?>
                    <li>
                        <a href="<?php echo esc_url($educatito_options['jrb_social_instagram']); ?>" class="instagram-hover social-educa" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($educatito_options['jrb_social_slack'])): ?>
                    <li>
                        <a href="<?php echo esc_url($educatito_options['jrb_social_slack']); ?>" class="slack-hover social-educa" target="_blank"><i class="fa fa-slack" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?> 
            </ul>
        </div>
        <?php
        echo ob_get_clean();
    }

}
/*
 * Educatito Comment Number
 */
if (!function_exists('educatito_comment_number')):

    function educatito_comment_number() {
        ?>
        <a href="<?php comments_link(); ?>" class="comments_number">
            <?php echo esc_attr(get_comments_number(get_the_ID())) . ' ' . esc_html__('Comment', 'educatito'); ?>
        </a>
        <?php
    }

endif;

/*
 * Educatito Pagination
 */
if (!function_exists('educatito_pagination')):

    function educatito_pagination() {
        if (is_singular())
            return;
        global $wp_query;

        if ($wp_query->max_num_pages <= 1)
            return;

        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        $max = intval($wp_query->max_num_pages);

        if ($paged >= 1)
            $links[] = $paged;

        if ($paged >= 3) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if (( $paged + 2 ) <= $max) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }

        echo '<div class="educatito_pagination"><ul>' . "\n";

        if (get_previous_posts_link())
            printf('<li>%s</li>' . "\n", wp_kses_post(get_previous_posts_link('<span class="fa fa-angle-left"></span>')));

        if (!in_array(1, $links)) {
            $class = 1 == $paged ? ' class="active"' : '';

            printf('<li%s><a href="%s"><span>%s</span></a></li>' . "\n", wp_kses_post($class), esc_url(get_pagenum_link(1)), '1');

            if (!in_array(2, $links))
                echo '<li>...</li>';
        }

        sort($links);
        foreach ((array) $links as $link) {
            $class = $paged == $link ? ' class="active"' : '';
            printf('<li%s><a href="%s"><span>%s</span></a></li>' . "\n", wp_kses_post($class), esc_url(get_pagenum_link($link)), esc_attr($link));
        }

        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links))
                echo '<li>...</li>' . "\n";

            $class = $paged == $max ? ' class="active"' : '';
            printf('<li%s><a href="%s"><span>%s</span></a></li>' . "\n", wp_kses_post($class), esc_url(get_pagenum_link($max)), esc_attr($max));
        }

        if (get_next_posts_link())
            printf('<li>%s</li>' . "\n", wp_kses_post(get_next_posts_link('<span class="fa fa-angle-right"></span>')));

        echo '</ul></div>' . "\n";
    }

endif;

/*
 * Educatito Pagination 2
 */
if (!function_exists('educatito_pagination_2')):

    function educatito_pagination_2($the_query) {


        if ($the_query->max_num_pages <= 1)
            return;

        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        $max = intval($the_query->max_num_pages);

        if ($paged >= 1)
            $links[] = $paged;

        if ($paged >= 3) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if (( $paged + 2 ) <= $max) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }

        echo '<div class="educatito_pagination"><ul>' . "\n";

        if (get_previous_posts_link())
            printf('<li>%s</li>' . "\n", wp_kses_post(get_previous_posts_link('<span class="fa fa-angle-left"></span>')));

        if (!in_array(1, $links)) {
            $class = 1 == $paged ? ' class="active"' : '';

            printf('<li%s><a href="%s"><span>%s</span></a></li>' . "\n", wp_kses_post($class), esc_url(get_pagenum_link(1)), '1');

            if (!in_array(2, $links))
                echo '<li>...</li>';
        }

        sort($links);
        foreach ((array) $links as $link) {
            $class = $paged == $link ? ' class="active"' : '';
            printf('<li%s><a href="%s"><span>%s</span></a></li>' . "\n", wp_kses_post($class), esc_url(get_pagenum_link($link)), esc_attr($link));
        }

        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links))
                echo '<li>...</li>' . "\n";

            $class = $paged == $max ? ' class="active"' : '';
            printf('<li%s><a href="%s"><span>%s</span></a></li>' . "\n", wp_kses_post($class), esc_url(get_pagenum_link($max)), esc_attr($max));
        }

        if (get_next_posts_link())
            printf('<li>%s</li>' . "\n", wp_kses_post(get_next_posts_link('<span class="fa fa-angle-right"></span>')));

        echo '</ul></div>' . "\n";
    }

endif;
/*
 * Educatito hex2rgba
 */
if (!function_exists('educatito_hex2rgba')):

    function educatito_hex2rgba($color, $opacity = false) {
        $default = 'rgb(0,0,0)';
        if (empty($color))
            return $default;
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }
        $rgb = array_map('hexdec', $hex);
        if ($opacity) {
            if (abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }
        return $output;
    }

endif;
/*
 * Educatito Archive Content Filter Query
 */
if (!function_exists('educatito_archive_content_filter_query')) {

    function educatito_archive_content_filter_query($query) {
        if (is_admin()) {
            return;
        }
        if (!is_admin() && $query->is_main_query()) {
            if (isset($_GET['_cmdorder'])) {
                switch ($_GET['_cmdorder']) {
                    case "title_asc":
                        $query->set('orderby', 'title');
                        $query->set('order', 'ASC');
                        break;
                    case "title_desc":
                        $query->set('orderby', 'title');
                        $query->set('order', 'DESC');
                        break;
                    case "date_asc":
                        $query->set('orderby', 'date');
                        $query->set('order', 'ASC');
                        break;
                    case "date_desc":
                        $query->set('orderby', 'date');
                        $query->set('order', 'DESC');
                        break;
                    default:
                        break;
                }
            }
            if (isset($_GET['_cmdperpage'])) {
                $query->set('posts_per_page', sanitize_text_field(wp_unslash($_GET['_cmdperpage'])));
            }
            return;
        }
    }

}
add_filter('pre_get_posts', 'educatito_archive_content_filter_query');
/*
 * Educatito Dynamic Sidebar
 */
if (!function_exists('educatito_dynamic_sidebar')) {

    function educatito_dynamic_sidebar($sidebar_name) {
        if (is_active_sidebar($sidebar_name)) {
            dynamic_sidebar($sidebar_name);
        }
    }

}
/*
 * Educatito Get meta option custom page 
 */
if (!function_exists('educatito_option_meta_id')):

    function educatito_option_meta_id($post_id) {
        $meta_data = json_decode(get_post_meta($post_id, '_jrb_meta_data', true));
        return $meta_data;
    }

endif;
/*
 * Educatito Author Name
 */
if (!function_exists('educatito_get_author_name')):

    function educatito_get_author_name() {
        ob_start();
        $fname = get_the_author_meta('first_name');
        $lname = get_the_author_meta('last_name');
        $full_name = '';

        if (empty($fname)) {
            $full_name = $lname;
        } elseif (empty($lname)) {
            $full_name = $fname;
        } else {
            $full_name = "{$fname} {$lname}";
        }

        $authornames = $full_name;

        if (empty($authornames)) {
            $authornames = get_the_author();
        }

        echo esc_attr($authornames);
        return ob_get_clean();
    }

endif;

/*
 * Educatito Form Search Blog
 */
add_filter('get_search_form', 'educatito_get_search_form_template');
if (!function_exists('educatito_get_search_form_template')):

    function educatito_get_search_form_template($form) {
        $body_classes = get_body_class();
        $text_search = esc_html__('Search', 'educatito');
        $format = current_theme_supports('html5', 'search-form') ? 'html5' : 'xhtml';

        if ('html5' == $format) {
            $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
                        <label>
                            <input type="search" class="search-field" placeholder="' . esc_attr($text_search) . '" value="' . get_search_query() . '" name="s" />
                        </label>
			<button type="submit" class="educatito-btn-search educatito_button"><i class="uk-icon-search"></i></button>
                    </form>';
        } else {
            $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url('/')) . '">
                        <div>
                            <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr($text_search) . '"/>
                            <button type="submit" class="educatito-btn-search educatito_button"><i class="uk-icon-search"></i></button>
                        </div>
                    </form>';
        }
        return $form;
    }

endif;
/*
 * Educatito Form Search Blog Filter
 */
add_action('pre_get_posts', 'educatito_search_filter');
if (!function_exists("educatito_search_filter")):

    function educatito_search_filter($query) {
        if (!is_admin() && $query->is_main_query()) {
            if ($query->is_search) {
                $query->set('post_type', array('post'));
            }
            if (isset($query->query['pagename'])):
                if ($query->query['pagename'] == 'blog') {
                    $taxonomy_query = array('relation' => 'AND', array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array('post-format-video'), 'operator' => 'NOT IN'));
                    $query->set('tax_query', $taxonomy_query);
                }
            endif;
        }
    }

endif;
/*
 * Educatito next/previous post
 */
if (!function_exists('educatito_post_nav')) :

    function educatito_post_nav() {
        $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="educatito-navigation post-navigation uk-clearfix">
            <div class="nav-links">
                <?php
                previous_post_link('<div class="nav-previous">%link</div>', '<span class="educatito-btn"><i class="fa fa-angle-double-left" aria-hidden="true"></i>' . esc_attr__('Previous Post', 'educatito') . '</span><div class="title">%title</div>');
                next_post_link('<div class="nav-next">%link</div>', '<span class="educatito-btn">' . esc_attr__('Next Post', 'educatito') . '<i class="fa fa-angle-double-right" aria-hidden="true"></i></span><div class="title">%title</div>');
                ?>
            </div><!-- .nav-links -->
        </nav>
        <?php
    }

endif;

/*
 * Educatito Page Title
 */
if (!function_exists('educatito_theme_page_title')) {

    function educatito_theme_page_title() {
        ob_start();
        $body_classes = get_body_class();
        if (is_home()) {
            if (in_array("blog", $body_classes)) {
                echo esc_html__('Blog', 'educatito');
            } else {
                echo esc_html__('Home', 'educatito');
            }
        } elseif (is_search()) {
            echo esc_html__('Search Keyword: ', 'educatito');
            echo '<span class="keywork">' . get_search_query() . '</span>';
        } elseif (!is_archive()) {
            if (is_404()) {
                echo esc_html__('404 Error', 'educatito');
            } else {
                if (in_array("single-post", $body_classes)) {
                    the_title();
                } else {
                    the_title();
                }
            }
        } else {
            if (is_category()) {
                if (in_array("learnpress-page", $body_classes)) {
                    echo esc_html__('Category Courses', 'educatito');
                } else {
                    single_cat_title();
                }
            } elseif (get_post_type() == 'recipe' || get_post_type() == 'portfolio' || get_post_type() == 'lp_course' || get_post_type() == 'team' || get_post_type() == 'testimonial' || get_post_type() == 'tp_event' || get_post_type() == 'product') {
                $post_type = get_post_type_object(get_post_type());
                echo esc_attr($post_type->labels->singular_name);
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                /* translators: %s: search term */
                printf(esc_html__('Author: %s', 'educatito'), '<span class="vcard">' . esc_attr(educatito_get_author_name()) . '</span>');
            } elseif (is_day()) {
                /* translators: %s: day */
                printf(esc_html__('Day: %s', 'educatito'), '<span>' . get_the_date() . '</span>');
            } elseif (is_month()) {
                /* translators: %s: month */
                printf(esc_html__('Month: %s', 'educatito'), '<span>' . get_the_date('F Y') . '</span>');
            } elseif (is_year()) {
                /* translators: %s: year */
                printf(esc_html__('Year: %s', 'educatito'), '<span>' . get_the_date('Y') . '</span>');
            } elseif (is_tax('post_format', 'post-format-aside')) {
                echo esc_html__('Asides', 'educatito');
            } elseif (is_tax('post_format', 'post-format-gallery')) {
                echo esc_html__('Galleries', 'educatito');
            } elseif (is_tax('post_format', 'post-format-image')) {
                echo esc_html__('Images', 'educatito');
            } elseif (is_tax('post_format', 'post-format-video')) {
                echo esc_html__('Videos', 'educatito');
            } elseif (is_tax('post_format', 'post-format-quote')) {
                echo esc_html__('Quotes', 'educatito');
            } elseif (is_tax('post_format', 'post-format-link')) {
                echo esc_html__('Links', 'educatito');
            } elseif (is_tax('post_format', 'post-format-status')) {
                echo esc_html__('Statuses', 'educatito');
            } elseif (is_tax('post_format', 'post-format-audio')) {
                echo esc_html__('Audios', 'educatito');
            } elseif (is_tax('post_format', 'post-format-chat')) {
                echo esc_html__('Chats', 'educatito');
            } else {
                if (is_post_type_archive('lp_course')) {
                    echo esc_html__('Courses', 'educatito');
                } else {
                    echo esc_html__('Archives', 'educatito');
                }
            }
        }
        return ob_get_clean();
    }

}
/*
 * Educatito Page Breadcrumb
 */
if (!function_exists('educatito_theme_page_breadcrumb')) {

    function educatito_theme_page_breadcrumb($delimiter) {

        ob_start();

        $body_classes = get_body_class();

        /* === OPTIONS === */
        $text['home'] = esc_html__('Home', 'educatito'); // text for the 'Home' link 
        /* translators: %s: Category */
        $text['category'] = esc_html__('Archive by Category "%s"', 'educatito'); // text for a category page
        /* translators: %s: tax */
        $text['tax'] = esc_html__('Archive for "%s"', 'educatito'); // text for a taxonomy page
        /* translators: %s: Search */
        $text['search'] = esc_html__('Search Results for "%s" Query', 'educatito'); // text for a search results page
        /* translators: %s: Tagged */
        $text['tag'] = esc_html__('Posts Tagged "%s"', 'educatito'); // text for a tag page
        /* translators: %s: author */
        $text['author'] = esc_html__('Articles Posted by %s', 'educatito'); // text for an author page
        $text['404'] = esc_html__('Error 404', 'educatito'); // text for the 404 page
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = esc_attr($delimiter); // delimiter between crumbs
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        /* === END OF OPTIONS === */
        global $post;
        $homeLink = esc_url(home_url('/'));
        $linkBefore = '<span typeof="v:Breadcrumb">';
        $linkAfter = '</span>';
        $linkAttr = ' rel="v:url" property="v:title"';
        $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
        if (is_home() || is_front_page()) {

            if (in_array("blog", $body_classes)) {
                echo wp_kses_post($before) . '<a href="' . esc_url($homeLink) . '">' . wp_kses_post($text['home']) . '</a> ' . wp_kses_post($after) . esc_attr($delimiter) . ' ';
                echo wp_kses_post($before) . esc_html__('Blog', 'educatito') . wp_kses_post($after);
            }

            if ($showOnHome == 1)
                echo '<div id="educatito-crumbs"><a href="' . esc_url($homeLink) . '">' . wp_kses_post($text['home']) . '</a></div>';
        } else {
            echo '<div id="educatito-crumbs">' . sprintf($link, esc_url($homeLink), wp_kses_post($text['home'])) . esc_attr($delimiter);

            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if (isset($thisCat->parent) && $thisCat->parent != 0) {
                    $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo wp_kses_post($cats);
                }
                echo wp_kses_post($before) . wp_kses_post(sprintf($text['category'], single_cat_title('', false))) . wp_kses_post($after);
            } elseif (is_post_type_archive('lp_course')) {
                echo wp_kses_post($before) . esc_html__('Course', 'educatito') . wp_kses_post($after);
            } elseif (is_tax()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if (isset($thisCat->parent) && $thisCat->parent != 0) {
                    $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo wp_kses_post($cats);
                }
                echo wp_kses_post($before) . wp_kses_post(sprintf($text['tax'], single_cat_title('', false))) . wp_kses_post($after);
            } elseif (is_search()) {
                echo wp_kses_post($before) . wp_kses_post(sprintf($text['search'], get_search_query())) . wp_kses_post($after);
            } elseif (is_day()) {
                echo sprintf($link, esc_url(get_year_link(get_the_time('Y'))), esc_attr(get_the_time('Y'))) . esc_attr($delimiter);
                echo sprintf($link, esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))), esc_attr(get_the_time('F'))) . esc_attr($delimiter);
                echo wp_kses_post($before) . esc_attr(get_the_time('d')) . wp_kses_post($after);
            } elseif (is_month()) {
                echo sprintf($link, esc_url(get_year_link(get_the_time('Y'))), esc_attr(get_the_time('Y'))) . esc_attr($delimiter);
                echo wp_kses_post($before) . esc_attr(get_the_time('F')) . wp_kses_post($after);
            } elseif (is_year()) {
                echo wp_kses_post($before) . esc_attr(get_the_time('Y')) . wp_kses_post($after);
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    printf(wp_kses_post($link), esc_url($homeLink) . '/' . wp_kses_post($slug['slug']) . '/', wp_kses_post($post_type->labels->singular_name));
                    if ($showCurrent == 1)
                        echo esc_attr($delimiter) . wp_kses_post($before) . get_the_title() . wp_kses_post($after);
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, $delimiter);
                    if ($showCurrent == 0)
                        $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                    $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                    echo wp_kses_post($cats);
                    if ($showCurrent == 1)
                        echo wp_kses_post($before) . get_the_title() . wp_kses_post($after);
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                if (isset($post_type)) {
                    echo wp_kses_post($before) . esc_attr($post_type->labels->singular_name) . wp_kses_post($after);
                }
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo wp_kses_post($cats);
                printf(wp_kses_post($link), esc_url(get_permalink($parent)), esc_attr($parent->post_title));
                if ($showCurrent == 1)
                    echo esc_attr($delimiter) . wp_kses_post($before) . get_the_title() . wp_kses_post($after);
            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1)
                    echo wp_kses_post($before) . get_the_title() . wp_kses_post($after);
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo wp_kses_post($breadcrumbs[$i]);
                    if ($i != count($breadcrumbs) - 1)
                        echo esc_attr($delimiter);
                }
                if ($showCurrent == 1)
                    echo esc_attr($delimiter) . wp_kses_post($before) . get_the_title() . wp_kses_post($after);
            } elseif (is_tag()) {
                echo wp_kses_post($before) . wp_kses_post(sprintf($text['tag'], single_tag_title('', false))) . wp_kses_post($after);
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo wp_kses_post($before) . wp_kses_post(sprintf($text['author'], esc_attr($userdata->display_name))) . wp_kses_post($after);
            } elseif (is_404()) {
                echo wp_kses_post($before) . wp_kses_post($text['404']) . wp_kses_post($after);
            }
            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ' (';
                echo esc_html__('Page', 'educatito') . ' ' . esc_attr(get_query_var('paged'));
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ')';
            }
            echo '</div>';
            return ob_get_clean();
        }
    }

}
/*
 * Educatito Title Bar Page
 */
if (!function_exists('educatito_theme_title_bar_page')) {

    function educatito_theme_title_bar_page($educatito_show_page_title, $educatito_show_page_breadcrumb) {
        global $educatito_options;
        $delimiter = isset($educatito_options['jrb_page_breadcrumb_delimiter']) ? $educatito_options['jrb_page_breadcrumb_delimiter'] : '/';
        $class = array();
        $class[] = 'page-title-bar educatito_title_bar';
        if ($educatito_show_page_title || $educatito_show_page_breadcrumb) {
            ?>
            <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
                <div class="uk-container uk-container-center">
                    <div class="box uk-clearfix">
                        <?php if ($educatito_show_page_title) { ?>
                            <h1 class="educatito-title"><?php echo wp_kses_post(educatito_theme_page_title()); ?></h1>
                        <?php } ?>
                        <?php if ($educatito_show_page_breadcrumb) { ?>
                            <div class="educatito-breadcrumb"><?php echo wp_kses_post(educatito_theme_page_breadcrumb($delimiter)); ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }

}


/*
 * Educatito Title Bar Blog
 */
if (!function_exists('educatito_title_bar_breadcrumb_blog')) {

    function educatito_title_bar_breadcrumb_blog($educatito_show_page_title, $educatito_show_page_breadcrumb) {
        global $educatito_options;
        $delimiter = isset($educatito_options['jrb_blog_breadcrumb_delimiter']) ? $educatito_options['jrb_blog_breadcrumb_delimiter'] : '/';
        $class = array();
        $class[] = 'blog-title-bar educatito_title_bar';
        if ($educatito_show_page_title || $educatito_show_page_breadcrumb) {
            ?>
            <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
                <div class="uk-container uk-container-center">
                    <div class="box uk-clearfix">
                        <?php if ($educatito_show_page_title) { ?>
                            <h1 class="educatito-title"><?php echo wp_kses_post(educatito_theme_page_title()); ?></h1>
                        <?php } ?>
                        <?php if ($educatito_show_page_breadcrumb) { ?>
                            <div class="educatito-breadcrumb"><?php echo wp_kses_post(educatito_theme_page_breadcrumb($delimiter)); ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="uk-clearfix educatito-spacing"></div>
            <?php
        }
    }

}


/*
 * Educatito Title Bar Shop
 */
if (!function_exists('educatito_theme_title_bar_shop')) {

    function educatito_theme_title_bar_shop($educatito_show_page_title, $educatito_show_page_breadcrumb) {
        global $educatito_options;
        $delimiter = isset($educatito_options['educatito_product_breadcrumb_delimiter']) ? $educatito_options['educatito_product_breadcrumb_delimiter'] : '/';
        $class = array();
        $class[] = 'product-title-bar educatito_title_bar';
        if ($educatito_show_page_title || $educatito_show_page_breadcrumb) {
            ?>
            <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
                <div class="uk-container uk-container-center">
                    <div class="box uk-clearfix">
                        <?php if ($educatito_show_page_title) { ?>
                            <h1 class="educatito-title"><?php echo wp_kses_post(educatito_theme_page_title()); ?></h1>
                        <?php } ?>
                        <?php if ($educatito_show_page_breadcrumb) { ?>
                            <div class="educatito-breadcrumb"><?php echo wp_kses_post(educatito_theme_page_breadcrumb($delimiter)); ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="uk-clearfix educatito-spacing"></div>
            <?php
        }
    }

}

/*
 * Educatito Product Search
 */
add_action('pre_get_posts', 'educatito_product_search');
if (!function_exists('educatito_product_search')) {

    function educatito_product_search($query) {
        if (is_admin()) {
            return;
        }
        if (is_search()) {
            if ($query->is_main_query() && isset($_GET['post_type']) && $_GET['post_type'] == 'product') {
                $query->set('post_type', array('product'));
            }
            return;
        }
    }

}
/*
 * Educatito Post Count Product
 */
add_filter('loop_shop_per_page', 'educatito_new_loop_shop_per_page', 20);
if (!function_exists('educatito_new_loop_shop_per_page')) {

    function educatito_new_loop_shop_per_page($posts_per_page) {
        global $educatito_options;
        $posts_per_page = isset($educatito_options['jrb_products_per_page']) ? $educatito_options['jrb_products_per_page'] : 9;
        return $posts_per_page;
    }

}
/*
 * Educatito Post Count Portfolio
 */
if (!function_exists('educatito_post_count_archive_portfolio')) {

    function educatito_post_count_archive_portfolio($query) {
        global $educatito_options;
        $posts_per_page = isset($educatito_options['jrb_portfolio_per_page']) ? $educatito_options['jrb_portfolio_per_page'] : 12;
        if (!is_admin() && is_post_type_archive('portfolio')) {
            $query->set('posts_per_page', $posts_per_page);
            return;
        }
    }

}
add_action('pre_get_posts', 'educatito_post_count_archive_portfolio', 1);

if (!function_exists('educatito_image_resize')) {

    function educatito_image_resize($url, $width = null, $height = null, $crop = null, $single = true, $upscale = false) {
        $aq_resize = Aq_Resize::getInstance();
        return $aq_resize->process($url, $width, $height, $crop, $single, $upscale);
    }

}
/*
 * Educatito Page Loadding
 */
if (!function_exists('load_page_wrapper')) :

    function load_page_wrapper() {
        global $educatito_options;
        $use_loader = isset($educatito_options['use_page_loader']) ? $educatito_options['use_page_loader'] : 0;
        if ($use_loader == 1) {
            $layout_loader = isset($educatito_options['layout_loader']) ? $educatito_options['layout_loader'] : "style-1";
            ?>
            <?php if ($layout_loader == 'style-1') { ?>
                <div id="loader-wrapper">
                    <div id="loader">
                        <div class="load"></div>
                        <img src="<?php echo EDUCATITO_THEME_URI . '/assets/images/icon-logo.png'; ?>" alt="load-page">
                    </div>
                    <div class="loader-section section-left"></div>
                    <div class="loader-section section-right"></div>
                </div>
            <?php } elseif ($layout_loader == 'style-2') { ?>
                <div id="spinner-wrapper">
                    <div  class="spinnerload">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>
                </div>
            <?php } else { ?>
                <div id="cube-wrapper">
                    <div class="sk-cube-grid">
                        <div class="sk-cube sk-cube1"></div>
                        <div class="sk-cube sk-cube2"></div>
                        <div class="sk-cube sk-cube3"></div>
                        <div class="sk-cube sk-cube4"></div>
                        <div class="sk-cube sk-cube5"></div>
                        <div class="sk-cube sk-cube6"></div>
                        <div class="sk-cube sk-cube7"></div>
                        <div class="sk-cube sk-cube8"></div>
                        <div class="sk-cube sk-cube9"></div>
                    </div>
                </div>
                <?php
            }
        }
    }

    add_action('load_page_wrapper', 'load_page_wrapper');
endif;
/*
 * My Account
 */

add_filter('lostpassword_url', 'educatito_lostpassword_url', 10, 0);
if (!function_exists('educatito_lostpassword_url')) {

    function educatito_lostpassword_url() {
        return site_url('/forgot-password/');
    }

}
/* Get Upcoming events */
if (!function_exists('educatito_get_upcoming_events')) {

    function educatito_get_upcoming_events($args = array()) {
        $args = array(
            'post_type' => 'tp_event',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'tp_event_status',
                    'value' => array('upcoming'),
                    'compare' => 'IN',
                ),
            ),
        );
        return new WP_Query($args);
    }

}

/* Get expired events */
if (!function_exists('educatito_get_expired_events')) {

    function educatito_get_expired_events($args = array()) {
        $args = array(
            'post_type' => 'tp_event',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'tp_event_status',
                    'value' => array('expired'),
                    'compare' => 'IN',
                ),
            ),
        );

        return new WP_Query($args);
    }

}

/* Get happening events */
if (!function_exists('educatito_get_happening_events')) {

    function educatito_get_happening_events($args = array()) {
        $args = array(
            'post_type' => 'tp_event',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'tp_event_status',
                    'value' => array('happening'),
                    'compare' => 'IN',
                ),
            ),
        );

        return new WP_Query($args);
    }

}
/* Get All events */
if (!function_exists('educatito_get_all_events')) {

    function educatito_get_all_events($args = array()) {
        $args = array(
            'post_type' => 'tp_event',
            'posts_per_page' => -1,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_status' => 'publish',
        );

        return new WP_Query($args);
    }

}
/* Hook get template archive event */
if (!function_exists('educatito_archive_event_template')) {

    function educatito_archive_event_template($template) {
        if (get_post_type() == 'tp_event' && is_post_type_archive('tp_event')) {
            $GLOBALS['educatito_happening_events'] = educatito_get_happening_events();
            $GLOBALS['educatito_upcoming_events'] = educatito_get_upcoming_events();
            $GLOBALS['educatito_expired_events'] = educatito_get_expired_events();
             $GLOBALS['educatito_all_events'] = educatito_get_all_events();
        }

        return $template;
    }

}
add_action('template_include', 'educatito_archive_event_template');
/**
 * Filter map single event 2.0
 */
if (!function_exists('educatito_filter_event_map')) {

    function educatito_filter_event_map($map_data) {
        $map_data['height'] = '210px';
        $map_data['map_data']['scroll-zoom'] = false;
        $map_data['map_data']['marker-icon'] = get_template_directory_uri() . '/assets/images/map_icon.png';

        return $map_data;
    }

}
add_filter('tp_event_filter_event_location_map', 'educatito_filter_event_map');

function my_enqueue() {
    ?>
    <script>
       jQuery(document).ready(function ($) {
        $("#learn-press-plugin-learnpress-woo-payment-educatito .plugin-icon img").attr('src', 'http://www.educa.jrbthemes.com/wp-content/uploads/2020/03/logo-jrb.png');
        });
    </script>
    <?php
}

add_action('admin_footer', 'my_enqueue');

