<?php
/*
 * Learnpress Functions.
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 */

if (!function_exists('educatito_remove_learnpress_hooks')) {

    function educatito_remove_learnpress_hooks() {
        remove_action('learn_press_after_the_title', 'learn_press_course_thumbnail', 10);
        remove_action('learn_press_entry_footer_archive', 'learn_press_course_price');
        remove_action('learn_press_after_the_title', 'learn_press_print_rate', 10);
        remove_action('learn_press_course_landing_content', 'learn_press_course_price', 30);
        remove_action('learn_press_course_landing_content', 'learn_press_course_students', 40);
        remove_action('learn_press_course_landing_content', 'learn_press_course_payment_form', 40);
        remove_action('learn_press_course_landing_content', 'learn_press_course_enroll_button', 50);
        remove_action('learn_press_course_landing_content', 'learn_press_course_status_message', 50);
        remove_action('learn_press_course_landing_content', 'learn_press_course_content', 60);
        remove_action('learn_press_course_landing_content', 'learn_press_print_review', 80);
        remove_action('learn_press_course_learning_content', 'learn_press_add_review_button', 5);
        remove_action('learn_press_course_learning_content', 'learn_press_course_instructor', 10);
        remove_action('learn_press_course_learning_content', 'learn_press_course_content', 20);
        remove_action('learn_press_course_learning_content', 'learn_press_course_students');
        remove_action('learn-press/before-main-content', 'learn_press_search_form', 15);
        remove_action('learn_press_before_main_content', 'learn_press_search_form');
        remove_action('learn_press_course_content_course', 'learn_press_course_content_course_title');
        remove_action('learn_press_course_content_course', 'learn_press_course_content_course_description');
        remove_action('learn_press_course_lesson_quiz_before_title', 'learn_press_course_lesson_quiz_before_title', 10);
        remove_action('learn_press_course_content_lesson', 'learn_press_course_content_lesson_action');
        remove_action('learn_press_course_content_lesson', 'learn_press_course_content_next_prev_lesson');
        remove_all_actions('learn_press_add_profile_tab', 10);
        remove_action('learn_press_content_quiz_sidebar', 'learn_press_single_quiz_time_counter');
        remove_action('learn_press_quiz_questions_after_question_title_element', 'learn_press_quiz_hint');
        remove_action('learn_press_after_single_quiz_summary', 'learn_press_single_quiz_questions');
        remove_action('learn_press_after_question_content', 'learn_press_after_question_content');
        remove_action('learn_press_entry_footer_archive', 'learn_press_course_wishlist_button', 10);
        remove_action('learn_press_course_landing_content', 'learn_press_course_wishlist_button', 10);
        remove_action('learn_press_course_learning_content', 'learn_press_course_wishlist_button', 10);
        remove_action('learn_press_after_wishlist_course_title', 'learn_press_course_wishlist_button', 10);
        remove_action('learn_press_course_landing_content', 'learn_press_forum_link', 80);
        remove_action('learn_press_course_learning_content', 'learn_press_forum_link', 30);
        remove_action('bp_init', 'bp_core_wpsignup_redirect');
    }

}

add_action('after_setup_theme', 'educatito_remove_learnpress_hooks');

/**
 * Remove Rev Slider Metabox
 */
if (!function_exists('educatito_remove_revolution_slider_meta_boxes')) {

    function educatito_remove_revolution_slider_meta_boxes() {
        remove_meta_box('mymetabox_revslider_0', 'lpr_course', 'normal');
        remove_meta_box('mymetabox_revslider_0', 'lpr_lesson', 'normal');
        remove_meta_box('mymetabox_revslider_0', 'lpr_quiz', 'normal');
        remove_meta_box('mymetabox_revslider_0', 'lpr_question', 'normal');
    }

}
if (is_admin()) {
    add_action('do_meta_boxes', 'educatito_remove_revolution_slider_meta_boxes');
}

if (!function_exists('educatito_redirect_search_to_archive')) {

    function educatito_redirect_search_to_archive($template) {

        if (!empty($_REQUEST['ref']) && ( $_REQUEST['ref'] == 'course' )) {
            $template = learn_press_locate_template('search-content-course.php');
        }

        return $template;
    }

}
add_filter('template_include', 'educatito_redirect_search_to_archive');

/**
 * Create ajax handle for courses searching
 */
if (!function_exists('educatito_courses_searching_callback')) {

    function educatito_courses_searching_callback() {
        ob_start();
        $keyword = esc_attr(sanitize_text_field(wp_unslash($_REQUEST['keyword'])));
        if ($keyword) {
            $keyword = strtoupper($keyword);
            $arr_query = array(
                'post_type' => 'lpr_course',
                'post_status' => 'publish',
                'ignore_sticky_posts' => true,
                's' => $keyword
            );
            $search = new WP_Query($arr_query);

            $newdata = array();
            foreach ($search->posts as $post) {
                $newdata[] = array(
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'guid' => get_permalink($post->ID),
                );
            }

            ob_end_clean();
            if (count($search->posts)) {
                echo json_encode($newdata);
            } else {
                $newdata[] = array(
                    'id' => '',
                    'title' => '<i>' . esc_html__('No course found', 'educatito') . '</i>',
                    'guid' => '#',
                );
                echo json_encode($newdata);
            }
            wp_reset_postdata();
        }
        die();
    }

}
add_action('wp_ajax_nopriv_courses_searching', 'educatito_courses_searching_callback');
add_action('wp_ajax_courses_searching', 'educatito_courses_searching_callback');


/**
 * @param $user
 */
if (!function_exists('educatito_extra_user_profile_fields')) {

    function educatito_extra_user_profile_fields($user) {
        $user_info = get_the_author_meta('lp_info', $user->ID);
        ?>
        <h3><?php esc_html_e('LearnPress Profile', 'educatito'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <label for="lp_major"><?php esc_html_e('Major', 'educatito'); ?></label>
                    </th>
                    <td>
                        <input id="lp_major" class="regular-text" type="text" value="<?php echo isset($user_info['major']) ? $user_info['major'] : ''; ?>" name="lp_info[major]">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="lp_facebook"><?php esc_html_e('Facebook Account', 'educatito'); ?></label>
                    </th>
                    <td>
                        <input id="lp_facebook" class="regular-text" type="text" value="<?php echo isset($user_info['facebook']) ? $user_info['facebook'] : ''; ?>" name="lp_info[facebook]">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="lp_twitter"><?php esc_html_e('Twitter Account', 'educatito'); ?></label>
                    </th>
                    <td>
                        <input id="lp_twitter" class="regular-text" type="text" value="<?php echo isset($user_info['twitter']) ? $user_info['twitter'] : ''; ?>" name="lp_info[twitter]">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="lp_google"><?php esc_html_e('Google Plus Account', 'educatito'); ?></label>
                    </th>
                    <td>
                        <input id="lp_google" class="regular-text" type="text" value="<?php echo isset($user_info['google']) ? $user_info['google'] : ''; ?>" name="lp_info[google]">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="lp_linkedin"><?php esc_html_e('LinkedIn Plus Account', 'educatito'); ?></label>
                    </th>
                    <td>
                        <input id="lp_linkedin" class="regular-text" type="text" value="<?php echo isset($user_info['linkedin']) ? $user_info['linkedin'] : ''; ?>" name="lp_info[linkedin]">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="lp_youtube"><?php esc_html_e('Youtube Account', 'educatito'); ?></label>
                    </th>
                    <td>
                        <input id="lp_youtube" class="regular-text" type="text" value="<?php echo isset($user_info['youtube']) ? $user_info['youtube'] : ''; ?>" name="lp_info[youtube]">
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
    }

}

add_action('show_user_profile', 'educatito_extra_user_profile_fields');
add_action('edit_user_profile', 'educatito_extra_user_profile_fields');

if (!function_exists('educatito_save_extra_user_profile_fields')) {

    function educatito_save_extra_user_profile_fields($user_id) {

        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        update_user_meta($user_id, 'lp_info', $_POST['lp_info']);
    }

}
add_action('personal_options_update', 'educatito_save_extra_user_profile_fields');
add_action('edit_user_profile_update', 'educatito_save_extra_user_profile_fields');

/**
 * Update LearnPress features
 */
if (!function_exists('educatito_update_learnpress_features')) {

    function educatito_update_learnpress_features() {
        remove_post_type_support('lpr_course', 'comments');
        add_post_type_support('lpr_course', 'excerpt');
    }

}
add_action('init', 'educatito_update_learnpress_features', 100);

/**
 * Display ratings count
 */
if (!function_exists('educatito_course_ratings_count')) {

    function educatito_course_ratings_count() {
        if (in_array('learnpress-course-review/learnpress-course-review.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            $ratings = learn_press_get_course_rate_total(get_the_ID()) ? learn_press_get_course_rate_total(get_the_ID()) : 0;
            echo '<div class="course-comments-count">';
            echo '<div class="value"><i class="fa fa-comment"></i>';
            echo esc_html($ratings);
            echo '</div>';
            echo '</div>';
        } else {
            return;
        }
    }

}

/**
 * Display rating stars
 *
 * @param $rate
 */
if (!function_exists('educatito_print_rating')) {

    function educatito_print_rating($rate) {
        ?>
        <div class="review-stars-rated">
            <ul class="review-stars">
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
            </ul>
            <ul class="review-stars filled" style="<?php echo esc_attr('width: ' . ( $rate * 20 ) . '%') ?>">
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
            </ul>
        </div>
        <?php
    }

}

/**
 * Display table detailed rating
 */
if (!function_exists('educatito_detailed_rating')) {

    function educatito_detailed_rating($course_id, $total) {
        global $wpdb;
        $query = $wpdb->get_results($wpdb->prepare(
                        "
		SELECT cm2.meta_value AS rating, COUNT(*) AS quantity FROM $wpdb->posts AS p
		INNER JOIN $wpdb->comments AS c ON p.ID = c.comment_post_ID
		INNER JOIN $wpdb->users AS u ON u.ID = c.user_id
		INNER JOIN $wpdb->commentmeta AS cm1 ON cm1.comment_id = c.comment_ID AND cm1.meta_key=%s
		INNER JOIN $wpdb->commentmeta AS cm2 ON cm2.comment_id = c.comment_ID AND cm2.meta_key=%s
		WHERE p.ID=%d AND c.comment_type=%s
		GROUP BY cm2.meta_value", '_lpr_review_title', '_lpr_rating', $course_id, 'review'
                ), OBJECT_K
        );
        ?>
        <div class="detailed-rating">
            <?php for ($i = 5; $i >= 1; $i --) : ?>
                <div class="stars">
                    <div class="key"><?php ($i === 1) ? /* translators: %s: star */ printf(esc_html__('%s star', 'educatito'), esc_attr($i)) : /* translators: %s: stars */ printf(esc_html__('%s stars', 'educatito'), esc_attr($i)); ?></div>
                    <div class="bar">
                        <div class="full_bar">
                            <div style="<?php  if( $total && !empty($query[$i]->quantity) ) { echo esc_attr('width: ' . ( $query[$i]->quantity / $total * 100 ) . '%'); }else{ echo 'width: 0%'; } ?>"></div>
                        </div>
                    </div>
                    <div class="value"><?php echo empty($query[$i]->quantity) ? '0' : esc_html($query[$i]->quantity); ?></div>
                </div>
            <?php endfor; ?>
        </div>
        <?php
    }

}
/**
 * Display review button
 */
if (!function_exists('educatito_review_button')) {

    function educatito_review_button($course_id) {
        if (!get_current_user_id()) {
            return;
        }
        global $course;
        $is_required = $course->is_required_enroll();
        $user = learn_press_get_current_user();
        $is_enrolled = $user->has_enrolled_course($course->get_id());
        if ($is_enrolled || !$is_required) {
            if (!learn_press_get_user_rate()) {
                ?>
                <button class="write-a-review"><?php esc_html_e('Write a review', 'educatito'); ?></button>
                <div class="course-review-wrapper" id="course-review">
                    <div class="review-overlay"></div>
                    <div class="review-form" id="review-form">
                        <form>
                            <h3>
                                <?php esc_html_e('Write a review', 'educatito'); ?>
                                <a href="" class="close dashicons dashicons-no-alt"></a>
                            </h3>
                            <ul class="review-fields">
                                <?php do_action('learn_press_before_review_fields'); ?>
                                <li>
                                    <label><?php esc_html_e('Title', 'educatito'); ?> <span class="required">*</span></label>
                                    <input type="text" name="review_title" />
                                </li>
                                <li>
                                    <label><?php esc_html_e('Content', 'educatito'); ?><span class="required">*</span></label>
                                    <textarea name="review_content"></textarea>
                                </li>
                                <li>
                                    <label><?php esc_html_e('Rating', 'educatito'); ?><span class="required">*</span></label>
                                    <ul class="review-stars">
                                        <?php for ($i = 1; $i <= 5; $i ++) { ?>
                                            <li class="review-title" title="<?php echo esc_attr($i); ?>">
                                                <span class="dashicons dashicons-star-empty"></span></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php do_action('learn_press_after_review_fields'); ?>
                                <li class="review-actions">
                                    <button type="button" class="submit-review" data-id="<?php the_ID(); ?>"><?php esc_html_e('Add review', 'educatito'); ?></button>
                                    <button type="button" class="close"><?php esc_html_e('Cancel', 'educatito'); ?></button>
                                    <span class="ajaxload"><?php esc_html_e('Please wait...', 'educatito'); ?></span>
                                    <span class="error"></span>
                                    <?php wp_nonce_field('learn_press_course_review_' . get_the_ID(), 'review-nonce'); ?>
                                    <input type="hidden" name="rating" value="0">
                                    <input type="hidden" name="lp-ajax" value="add_review">
                                    <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
    }

}

/**
 * Process review
 */
if (!function_exists('educatito_process_review')) {

    function educatito_process_review() {

        if (in_array('learnpress-course-review/learnpress-course-review.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            $user_id = get_current_user_id();
            $course_id = isset($_POST['comment_post_ID']) ? sanitize_text_field(wp_unslash($_POST['comment_post_ID'])) : 0;
            $user_review = learn_press_get_user_rate($course_id, $user_id);
            if (!$user_review && $course_id) {
                $review_title = isset($_POST['review-course-title']) ? sanitize_text_field(wp_unslash($_POST['review-course-title'])) : 0;
                $review_content = isset($_POST['review-course-content']) ? sanitize_text_field(wp_unslash($_POST['review-course-content'])) : 0;
                $review_rate = isset($_POST['review-course-value']) ? sanitize_text_field(wp_unslash($_POST['review-course-value'])) : 0;
                learn_press_save_course_review($course_id, $review_rate, $review_title, $review_content);
            }
        } else {
            return;
        }
    }

}
add_action('learn_press_before_main_content', 'educatito_process_review');

/**
 * Display course ratings
 */
if (!function_exists('educatito_course_ratings')) {

    function educatito_course_ratings() {

        if (in_array('learnpress-course-review/learnpress-course-review.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            $course_id = get_the_ID();
            $course_rate = learn_press_get_course_rate($course_id);
            $ratings = learn_press_get_course_rate_total($course_id);
            ?>
            <div class="course-review">
                <label><?php esc_html_e('Review', 'educatito'); ?></label>

                <div class="value">
                    <?php educatito_print_rating($course_rate); ?>
                    <span><?php /* translators: %s: reviews */ $ratings ? printf(_n('(%1$s review)', '(%1$s reviews)', $ratings, 'educatito'), number_format_i18n($ratings)) : esc_html_e('(0 review)', 'educatito'); ?></span>
                </div>
            </div>
            <?php
        } else {
            return;
        }
    }

}
/**
 * Display course review
 */
if (!function_exists('educatito_course_review')) {

    function educatito_course_review() {
        $course_id = get_the_ID();
        $course_review = learn_press_get_course_review($course_id, isset($_REQUEST['paged']) ? sanitize_text_field(wp_unslash($_REQUEST['paged'])) : 1, 5, true);
        $course_rate = learn_press_get_course_rate($course_id);
        $total = learn_press_get_course_rate_total($course_id);
        $reviews = $course_review['reviews'];
        ?>
        <h3><?php esc_html_e('Review and Rating', 'educatito'); ?></h3>
        <div class="course-rating uk-clearfix">
            <div class="average-rating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                <div class="rating-box">
                    <div class="average-value" itemprop="ratingValue"><?php if( $course_rate ) { echo esc_html(round($course_rate, 1)); }else{ 0; } ?></div>
                    <div class="review-star">
                        <?php educatito_print_rating($course_rate); ?>
                    </div>
                    <p class="rating-title"><?php esc_html_e('Average Rating', 'educatito'); ?></p>
                    <div class="review-amount" itemprop="ratingCount">
                        <?php /* translators: %s: ratings */ $total ? printf(_n('%1$s rating', '%1$s ratings', $total, 'educatito'), number_format_i18n($total)) : esc_html_e('0 rating', 'educatito'); ?>
                    </div>
                </div>
            </div>
            <div class="detailed-rating-box">
                <div class="rating-box">
                    <?php educatito_detailed_rating($course_id, $total); ?>
                </div>
            </div>
        </div>

        <div class="course-review">
            <div id="course-reviews" class="content-review">
                <ul class="course-reviews-list">
                    <?php foreach ($reviews as $review) : ?>
                        <li>
                            <div class="review-container" itemprop="review" itemscope itemtype="http://schema.org/Review">
                                <div class="review-author">
                                    <?php echo get_avatar($review->ID, 70); ?>
                                    <h4 class="author-name" itemprop="author"><?php echo esc_html($review->display_name); ?></h4>
                                </div>
                                <div class="review-text">
                                    <div class="review-star">
                                        <?php educatito_print_rating($review->rate); ?>
                                    </div>
                                    <p class="review-title"><?php echo esc_html($review->title); ?></p>
                                    <div class="description" itemprop="reviewBody">
                                        <p><?php echo esc_html($review->content); ?></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php if (empty($course_review['finish']) && $total) : ?>
            <div class="review-load-more">
                <span id="course-review-load-more" data-paged="<?php echo esc_attr($course_review['paged']); ?>"><i class="fa fa-angle-double-down"></i></span>
            </div>
        <?php endif; ?>
        <?php educatito_review_button($course_id); ?>
        <?php
    }

}
/**
 * Breadcrumb for LearnPress
 */
if (!function_exists('educatito_learnpress_breadcrumb')) {

    function educatito_learnpress_breadcrumb() {

        // Do not display on the homepage
        if (is_front_page() || is_404()) {
            return;
        }

        // Get the query & post information
        global $post;

        // Build the breadcrums
        echo '<ul itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs" class="breadcrumbs">';

        // Home page
        echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url(get_home_url()) . '" title="' . esc_attr__('Home', 'educatito') . '"><span itemprop="name">' . esc_html__('Home', 'educatito') . '</span></a></li>';

        if (is_single()) {

            $categories = get_the_terms($post, 'course_category');

            if (get_post_type() == 'lpr_course') {
                // All courses
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url(get_post_type_archive_link('lpr_course')) . '" title="' . esc_attr__('All courses', 'educatito') . '"><span itemprop="name">' . esc_html__('All courses', 'educatito') . '</span></a></li>';
            } else {
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url(get_permalink(get_post_meta($post->ID, '_lpr_course', true))) . '" title="' . esc_attr(get_the_title(get_post_meta($post->ID, '_lpr_course', true))) . '"><span itemprop="name">' . esc_html(get_the_title(get_post_meta($post->ID, '_lpr_course', true))) . '</span></a></li>';
            }

            // Single post (Only display the first category)
            if (isset($categories[0])) {
                echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url(get_term_link($categories[0])) . '" title="' . esc_attr($categories[0]->name) . '"><span itemprop="name">' . esc_html($categories[0]->name) . '</span></a></li>';
            }
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</span></li>';
        } else if (is_tax('course_category') || is_tax('course_tag')) {
            // All courses
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url(get_post_type_archive_link('lpr_course')) . '" title="' . esc_attr__('All courses', 'educatito') . '"><span itemprop="name">' . esc_html__('All courses', 'educatito') . '</span></a></li>';

            // Category page
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr(single_term_title('', false)) . '">' . esc_html(single_term_title('', false)) . '</span></li>';
        } else if (!empty($_REQUEST['s']) && !empty($_REQUEST['ref']) && ( $_REQUEST['ref'] == 'course' )) {
            // All courses
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url(get_post_type_archive_link('lpr_course')) . '" title="' . esc_attr__('All courses', 'educatito') . '"><span itemprop="name">' . esc_html__('All courses', 'educatito') . '</span></a></li>';

            // Search result
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__('Search results for:', 'educatito') . ' ' . esc_attr(get_search_query()) . '">' . esc_html__('Search results for:', 'educatito') . ' ' . esc_html(get_search_query()) . '</span></li>';
        } else {
            echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name" title="' . esc_attr__('All courses', 'educatito') . '">' . esc_html__('All courses', 'educatito') . '</span></li>';
        }

        echo '</ul>';
    }

}


/**
 * Page title for LearnPress
 */
if (!function_exists('educatito_learnpress_page_title')) {

    function educatito_learnpress_page_title($echo = true) {
        $title = '';
        if (get_post_type() == 'lpr_course') {
            if (is_tax()) {
                $title = single_term_title('', false);
            } else {
                $title = esc_html__('All Courses', 'educatito');
            }
        }
        if (get_post_type() == 'lpr_quiz') {
            if (is_tax()) {
                $title = single_term_title('', false);
            } else {
                $title = esc_html__('Quiz', 'educatito');
            }
        }
        if ($echo) {
            echo esc_attr($title);
        } else {
            return $title;
        }
    }

}

if (!function_exists('educatito_lesson_duration')) {

    function educatito_lesson_duration($lesson_id) {

        $duration = get_post_meta($lesson_id, '_lpr_lesson_duration', true);
        $hour = floor($duration / 60);
        if ($hour == 0) {
            $hour = '';
        } else {
            $hour = $hour . esc_html__('h', 'educatito');
        }
        $minute = $duration % 60;
        $minute = $minute . esc_html__('m', 'educatito');

        return $hour . $minute;
    }

}
if (!function_exists('educatito_quiz_questions')) {

    function educatito_quiz_questions($quiz_id) {
        $questions = learn_press_get_quiz_questions($quiz_id);
        if ($questions) {
            return count($questions);
        }

        return 0;
    }

}
/**
 * Add format icon before curriculum items
 *
 * @param $lesson_or_quiz
 * @param $enrolled
 */
if (!function_exists('educatito_add_format_icon')) {

    function educatito_add_format_icon($lesson_or_quiz, $viewable) {
        $format = get_post_format($lesson_or_quiz);

        if (get_post_type($lesson_or_quiz) == 'lpr_quiz') {
            echo '<span class="course-format-icon"><i class="fa fa-puzzle-piece"></i></span>';
        } elseif ($format == 'video') {
            echo '<span class="course-format-icon"><i class="fa fa-play-circle"></i></span>';
        } else {
            echo '<span class="course-format-icon"><i class="fa fa-file-o"></i></span>';
        }
    }

}

add_action('learn_press_course_lesson_quiz_before_title', 'educatito_add_format_icon', 10, 2);


if (!function_exists('educatito_get_related_courses')) {

    function educatito_get_related_courses($limit) {
        if (!$limit) {
            $limit = 3;
        }
        $course_id = get_the_ID();

        $tag_ids = array();
        $tags = get_the_terms($course_id, 'course_tag');

        if ($tags) {
            foreach ($tags as $individual_tag) {
                $tag_ids[] = $individual_tag->slug;
            }
        }

        $args = array(
            'posts_per_page' => $limit,
            'paged' => 1,
            'ignore_sticky_posts' => 1,
            'post__not_in' => array($course_id),
            'post_type' => 'lp_course'
        );

        if ($tag_ids) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'course_tag',
                    'field' => 'slug',
                    'terms' => $tag_ids
                )
            );
        }
        $related = array();
        if ($posts = new WP_Query($args)) {
            global $post;
            while ($posts->have_posts()) {
                $posts->the_post();
                $related[] = $post;
            }
            wp_reset_postdata();
        }
        return $related;
    }

}
/**
 * Display related courses
 */
if (!function_exists('educatito_related_courses')) {

    function educatito_related_courses() {
        $related_courses = educatito_get_related_courses(null, array('posts_per_page' => 3));
        if ($related_courses) {
            ?>
            <div class="educatito-ralated-course">
                <h3 class="related-title"><?php esc_html_e('Related Course', 'educatito'); ?></h3>

                <ul class="uk-grid uk-grid-width-large-1-3 uk-grid-width-small-1-3 uk-grid-width-1-1">
                    <?php foreach ($related_courses as $course_item) : ?>
                        <?php
                        $course = LP_Course::get_course($course_item->ID);
                        $is_required = $course->is_required_enroll();
                        $lp_info = get_the_author_meta('lp_info');
                        $_lp_students = get_post_meta($course_item->ID, '_lp_students', true);
                        $_lp_students2 = get_post_meta($course_item->ID, '_lp_max_students', true);
                        $course_id = $course_item->ID;
                        $thumb_id = get_post_thumbnail_id($course_id);
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $url = wp_get_attachment_url($thumb_id);
                        $image = educatito_image_resize($url, 370, 250, true);
                        $lp_info = get_the_author_meta('lp_info');
                        ?>
                        <li class="course-grid-3 lpr_course educatito-our_course">
                            <div class="course-item educatito-hover-icon">
                                <div class="course-thumbnail">
                                    <?php if (!empty($image)) {
                                        ?>
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                                        </a>
                                    <?php }
                                    ?>
                                    <div class="hover-border">
                                        <a href="<?php echo get_the_permalink($course_item->ID); ?>"><span class="fa fa-link"></span></a>
                                    </div>
                                </div>
                                <div class="educatito-course-content">
                                    <div class="author-price">
                                        <div class="course-author">
                                            <?php echo get_avatar($course_item->post_author, 40); ?>
                                            <div class="author-contain">
                                                <div class="value">
                                                    <a href="<?php echo esc_url(learn_press_user_profile_link($course_item->post_author)); ?>">
                                                        <?php echo get_the_author_meta('display_name', $course_item->post_author); ?>
                                                    </a>
                                                </div>
                                                <?php if (isset($lp_info['major']) && $lp_info['major']) : ?>
                                                    <p class="job"><?php echo esc_html($lp_info['major']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                        if ($price = $course->get_price_html()) {

                                            $origin_price = $course->get_origin_price_html();
                                            $sale_price = $course->get_sale_price();
                                            $sale_price = isset($sale_price) ? $sale_price : '';
                                            $class = '';
                                            if ($course->is_free() || !$is_required) {
                                                $class .= ' free-course';
                                                $price = esc_html__('Free', 'educatito');
                                            }
                                            ?>

                                            <div class="course-price" itemprop="offers" itemscope
                                                 itemtype="http://schema.org/Offer">
                                                <div class="value<?php echo esc_attr($class); ?>" itemprop="price">
                                                    <?php
                                                    if ($sale_price) {
                                                        echo '<span class="course-origin-price">' . $origin_price . '</span>';
                                                    }
                                                    ?>
                                                    <?php echo esc_attr($price); ?>
                                                </div>
                                                <meta itemprop="priceCurrency"
                                                      content="<?php echo learn_press_get_currency(); ?>"/>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="title">
                                        <h2 class="course-title">
                                            <a rel="bookmark"
                                               href="<?php echo get_the_permalink($course_item->ID); ?>"><?php echo esc_html($course_item->post_title); ?></a>
                                        </h2>
                                    </div>
                                    <div class="course-description">
                                        <?php
                                        echo the_excerpt($course_item->ID);
                                        ?>
                                    </div>
                                </div> 
                                <ul class="course-meta">
                                    <li>
                                        <?php $user_count = $course->get_users_enrolled('append') ? $course->get_users_enrolled('append') : 0; ?>
                                        <?php echo esc_attr($user_count) . '/' . esc_attr($_lp_students2); ?><span><?php echo esc_html__(' Student', 'educatito'); ?></span>
                                    </li>
                                    <li><?php echo get_the_date('j M, Y'); ?></li>
                                </ul>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
        }
    }

}

/**
 * Add some meta data for a course
 *
 * @param $meta_box
 */
if (!function_exists('educatito_add_course_meta')) {

    function educatito_add_course_meta($meta_box) {
        $fields = $meta_box['fields'];
        $fields[] = array(
            'name' => esc_html__('Duration', 'educatito'),
            'id' => 'educatito_course_duration',
            'type' => 'text',
            'desc' => esc_html__('Course duration', 'educatito'),
            'std' => esc_html__('50 hours', 'educatito')
        );
        $fields[] = array(
            'name' => esc_html__('Age', 'educatito'),
            'id' => 'educatito_course_age',
            'type' => 'text',
            'desc' => esc_html__('Course Age', 'educatito'),
            'std' => esc_html__('15', 'educatito')
        );
        $fields[] = array(
            'name' => esc_html__('Skill Level', 'educatito'),
            'id' => 'educatito_course_skill_level',
            'type' => 'text',
            'desc' => esc_html__('A possible level with this course', 'educatito'),
            'std' => esc_html__('All levels', 'educatito')
        );
        $fields[] = array(
            'name' => esc_html__('Language', 'educatito'),
            'id' => 'educatito_course_language',
            'type' => 'text',
            'desc' => esc_html__('Language\'s used for studying', 'educatito'),
            'std' => esc_html__('English', 'educatito')
        );
        $meta_box['fields'] = $fields;

        return $meta_box;
    }

}

add_filter('learn_press_course_settings_meta_box_args', 'educatito_add_course_meta');

/**
 * Display course info
 */
if (!function_exists('educatito_course_info')) {

    function educatito_course_info() {
        $course_id = get_the_ID();
        $course = LP()->global['course'];
        $count = $course->get_users_enrolled() ? $course->get_users_enrolled() : 0;
        ?>
        <div class="educatito-course-info">
            <div class="title uk-clearfix">
                <p><?php echo esc_html__('Course fee', 'educatito') ?></p>
                <span><?php learn_press_get_template( 'single-course/price.php' ); ?></span>
            </div>
            <ul>

                <li>
                    <i class="fa fa-folder-open"></i>
                    <span class="label"><?php esc_html_e('Lectures', 'educatito'); ?></span>
                    <span class="value"><?php if($course->get_curriculum_items('lp_lesson')) { echo count($course->get_curriculum_items('lp_lesson')); }else{  echo 0; } ?></span>
                </li>
                <li>
                    <i class="fa fa-puzzle-piece"></i>
                    <span class="label"><?php esc_html_e('Quizzes', 'educatito'); ?></span>
                    <span class="value"><?php if($course->get_curriculum_items('lp_quiz')) { echo count($course->get_curriculum_items('lp_quiz')); }else { echo 0; } ?></span>
                </li>
                <li>
                    <i class="fa fa-flag"></i>
                    <span class="label"><?php esc_html_e('Duration', 'educatito'); ?></span>
                    <span class="value"><?php echo esc_html(get_post_meta($course_id, '_lp_duration', true)); ?></span>
                </li>
                <li>
                    <i class="fa fa-pencil"></i>
                    <span class="label"><?php esc_html_e('Skill level', 'educatito'); ?></span>
                    <span class="value"><?php echo esc_html(get_post_meta($course_id, 'educatito_course_skill_level', true)); ?></span>
                </li>
                <li>
                    <i class="fa fa-graduation-cap"></i>
                    <span class="label"><?php esc_html_e('Max Students', 'educatito'); ?></span>
                    <span class="value"><?php echo esc_html(get_post_meta($course_id, '_lp_max_students', true)); ?></span>
                </li>
                <li>
                    <i class="fa fa-comments"></i>
                    <span class="label"><?php esc_html_e('Language', 'educatito'); ?></span>
                    <span class="value"><?php echo esc_html(get_post_meta($course_id, 'educatito_course_language', true)); ?></span>
                </li>
            </ul>
        </div>
        <?php
    }

}

/**
 * Update profile tabs
 *
 * @param $user
 */
if (!function_exists('educatito_add_profile_tab')) {

    function educatito_add_profile_tab($user) {
        $content = '';

        $other_tabs = apply_filters(
                'learn_press_profile_tabs', array(
            20 => array(
                'tab_id' => 'user_courses',
                'tab_name' => '<i class="fa fa-book"></i><span class="text">' . esc_html__('Courses', 'educatito') . '</span>',
                'tab_content' => apply_filters('learn_press_user_courses_tab_content', $content, $user)
            ),
            30 => array(
                'tab_id' => 'user_quizzes',
                'tab_name' => '<i class="fa fa-check-square-o"></i><span class="text">' . esc_html__('Quiz Results', 'educatito') . '</span>',
                'tab_content' => apply_filters('learn_press_user_quizzes_tab_content', $content, $user)
            ),
                ), $user
        );

        if (function_exists('learn_press_course_wishlist_button')) {
            $other_tabs[40] = array(
                'tab_id' => 'user_wishlist',
                'tab_name' => '<i class="fa fa-heart-o"></i><span class="text">' . esc_html__('Wishlist', 'educatito') . '</span>',
                'tab_content' => apply_filters('learn_press_user_wishlist_tab_content', $content, $user)
            );
        }

        ksort($other_tabs);

        if (!$user) {
            echo '<p class="message message-error">' . esc_html__('This user is not available!', 'educatito') . '</p>';
        } else {
            $tabs = $tabs_content = '';
            $class = 'active';
            foreach ($other_tabs as $tab) {
                $tabs .= '<li class="' . $class . '"><a href="#' . $tab['tab_id'] . '" data-toggle="tab">' . $tab['tab_name'] . '</a></li>';
                $tabs_content .= '<div class="tab-pane ' . $class . '" id="' . $tab['tab_id'] . '">' . $tab['tab_content'] . '</div>';
                if ($class == 'active') {
                    $class = '';
                }
            }
            printf(
                    '<div class="profile-container">
			<div class="user-tab">%s</div>
			<div class="profile-tabs">
				<ul class="nav nav-tabs" role="tablist">%s</ul>
				<div class="tab-content">%s</div>
			</div>
		</div>', wp_kses_post(apply_filters('learn_press_user_info_tab_content', $content, $user)), esc_attr($tabs), esc_attr($tabs_content)
            );
        }
    }

}
add_action('learn_press_add_profile_tab', 'educatito_add_profile_tab', 100);

/**
 * Add question hint
 */
if (!function_exists('educatito_add_question_hint')) {

    function educatito_add_question_hint($id) {
        global $post;
        $post = get_post($id);
        $hint = $post->post_content;
        if (!empty($hint)) :
            setup_postdata($post);
            ?>
            <div class="question-hint">
                <p class="quiz-hint">
                    <span class="quiz-hint-toggle">
                        <i class="fa fa-question-circle"></i>
                        <?php esc_html_e('Hint', 'educatito'); ?>
                    </span>
                </p>

                <div class="quiz-hint-content">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
        endif;
        wp_reset_postdata();
    }

}
add_action('learn_press_after_question_title', 'educatito_add_question_hint');

/**
 * Add question index
 */
if (!function_exists('educatito_add_question_index')) {

    function educatito_add_question_index($id) {
        $index = 1;
        if (is_singular('lpr_quiz')) {
            $quiz = get_the_ID();
        } else {
            if (isset($_REQUEST['quiz_id']) && sanitize_text_field(wp_unslash($_REQUEST['quiz_id']))) {
                $quiz = sanitize_text_field(wp_unslash($_REQUEST['quiz_id']));
            } else {
                return;
            }
        }
        $quiz = get_post_meta($quiz, '_lpr_quiz_questions', true);
        $quiz = array_keys($quiz);
        $index = array_search($id, $quiz) + 1;
        echo '<p class="index-question">' . esc_html__('Question', 'educatito') . ' ' . '<span class="number">' . wp_kses_post($index) . '&#47;' . count($quiz) . '</span></p>';
    }

}
add_action('learn_press_before_question_title', 'educatito_add_question_index');

if (!function_exists('educatito_course_content_lesson_action')) {

    function educatito_course_content_lesson_action() {
        if (learn_press_user_has_completed_lesson()) {
            echo '<p class="message-success">' . esc_html__('You have completed this lesson.', 'educatito') . '</p>';
        } else {
            $course_id = learn_press_get_course_by_lesson(get_the_ID());
            if (!learn_press_user_has_finished_course($course_id) && learn_press_user_has_enrolled_course($course_id)) {
                printf('<button class="complete-lesson-button" data-id="%d">%s</button>', esc_attr(get_the_ID()), esc_html__('Complete Lesson', 'educatito'));
            }
        }
    }

}
add_action('learn_press_course_content_lesson', 'educatito_course_content_lesson_action', 10);
add_action('learn_press_course_content_lesson', 'learn_press_course_content_next_prev_lesson', 15);

/**
 * Check answer
 * @param $id
 */
if (!function_exists('educatito_check_answer')) {

    function educatito_check_answer($id, $answers) {
        $question = LPR_Question_Type::instance($id);
        if ($question && isset($answers[$id])) {
            $check = $question->check(array('answer' => $answers[$id]));
            if ($check['correct']) {
                return 'correct';
            } else {
                return 'incorrect';
            }
        } else {
            return 'skipped';
        }
    }

}

/**
 * Wishlist button for LearnPress
 */
if (!function_exists('educatito_course_wishlist_button')) {

    function educatito_course_wishlist_button($course_id = null) {
        if (function_exists('learn_press_course_wishlist_button')) {
            if (get_current_user_id()) {
                echo '<div class="course-wishlist-box">';
                learn_press_course_wishlist_button($course_id);
                echo '</div>';
            }
        }
    }

}
/**
 * Display co instructors
 */
if (!function_exists('educatito_co_instructors')) {

    function educatito_co_instructors($course_id, $author_id) {
        if (!$course_id) {
            return;
        }
        if (in_array('learnpress-co-instructor/learnpress-co-instructor.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            $instructors = get_post_meta($course_id, '_lpr_co_teacher');
            $instructors = array_diff($instructors, array($author_id));
            if ($instructors) {
                foreach ($instructors as $instructor) {
                    $lp_info = get_the_author_meta('lp_info', $instructor);
                    $link = apply_filters('learn_press_instructor_profile_link', '#', $instructor, '');
                    ?>
                    <div class="educatito-about-author educatito-co-instructor" itemprop="contributor" itemscope itemtype="http://schema.org/Person">
                        <div class="author-wrapper">
                            <div class="author-avatar">
                                <?php echo get_avatar($instructor, 110); ?>
                            </div>
                            <div class="author-bio">
                                <div class="author-top">
                                    <a itemprop="url" class="name" href="<?php echo esc_url($link); ?>">
                                        <span itemprop="name"><?php echo wp_kses_post(get_the_author_meta('display_name', $instructor)); ?></span>
                                    </a>
                                    <?php if (isset($lp_info['major']) && $lp_info['major']) : ?>
                                        <p class="job" itemprop="jobTitle"><?php echo esc_html($lp_info['major']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <ul class="educatito-author-social">
                                    <?php if (isset($lp_info['facebook']) && $lp_info['facebook']) : ?>
                                        <li>
                                            <a href="<?php echo esc_url($lp_info['facebook']); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (isset($lp_info['twitter']) && $lp_info['twitter']) : ?>
                                        <li>
                                            <a href="<?php echo esc_url($lp_info['twitter']); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (isset($lp_info['google']) && $lp_info['google']) : ?>
                                        <li>
                                            <a href="<?php echo esc_url($lp_info['google']); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (isset($lp_info['linkedin']) && $lp_info['linkedin']) : ?>
                                        <li>
                                            <a href="<?php echo esc_url($lp_info['linkedin']); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if (isset($lp_info['youtube']) && $lp_info['youtube']) : ?>
                                        <li>
                                            <a href="<?php echo esc_url($lp_info['youtube']); ?>" class="youtube"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>

                            </div>
                            <div class="author-description" itemprop="description">
                                <?php echo wp_kses_post(get_the_author_meta('description', $instructor)); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }

}
/**
 * Display feature certificate
 *
 */
if (!function_exists('educatito_course_certificate')) {

    function educatito_course_certificate($course_id) {

        if (in_array('learnpress-certificates/learnpress-certificates.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            ?>
            <li>
                <i class="fa fa-rebel"></i>
                <span class="label"><?php esc_html_e('Certificate', 'educatito'); ?></span>
                <span class="value"><?php echo ( get_post_meta($course_id, '_lpr_course_certificate', true) ) ? esc_html__('Yes', 'educatito') : esc_html__('No', 'educatito'); ?></span>
            </li>
            <?php
        }
    }

}
/**
 * Get number of courses by search key
 *
 * @param $search_key
 *
 * @return int
 */
if (!function_exists('educatito_get_courses_by_search_key')) {

    function educatito_get_courses_by_search_key($search_key) {
        $query = new WP_Query(array(
            'post_type' => 'lpr_course',
            'ignore_sticky_posts' => true,
            'posts_per_page' => - 1,
            's' => $search_key
        ));

        if (!empty($query->post_count)) {
            return $query->post_count;
        }

        return 0;
    }

}
if (!function_exists('educatito_require_login_to_take_course')) {

    function educatito_require_login_to_take_course($can_take, $user_id, $course_id, $payment_method) {
        if (!is_user_logged_in()) {
            $login_url = educatito_get_login_page_url();
            learn_press_send_json(
                    array(
                        'result' => 'success',
                        'redirect' => $login_url . '?redirect_to=' . htmlentities(urlencode(get_permalink($course_id)))
                    )
            );
        }
        return $can_take;
    }

}
add_filter('learn_press_before_take_course', 'educatito_require_login_to_take_course', 4, 4);

if (!function_exists('educatito_about_author')) {

    function educatito_about_author() {
        $lp_info = get_the_author_meta('lp_info');
        $link = '#';
        if (get_post_type() == 'lpr_course') {
            $link = apply_filters('learn_press_instructor_profile_link', '#', $user_id = null, get_the_ID());
        } elseif (get_post_type() == 'lp_course') {
            $link = learn_press_user_profile_link(get_the_author_meta('ID'));
        } elseif (is_single()) {
            $link = get_author_posts_url(get_the_author_meta('ID'));
        }
        ?>
        <div class="educatito-about-author">
            <div class="author-wrapper">
                <div class="author-avatar uk-clearfix">
                    <?php echo get_avatar(get_the_author_meta('ID'), 110); ?>
                    <div class="author-right">
                        <a class="name" href="<?php echo esc_url($link); ?>">
                            <?php echo get_the_author(); ?>
                        </a>
                        <?php if (isset($lp_info['major']) && $lp_info['major']) : ?>
                            <p class="job"><?php echo esc_html($lp_info['major']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="author-bio">
                    <ul class="educatito-author-social">
                        <li><?php echo esc_html('Contact via:', 'educatito') ?></li>
                        <?php if (isset($lp_info['facebook']) && $lp_info['facebook']) : ?>
                            <li>
                                <a href="<?php echo esc_url($lp_info['facebook']); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
                            </li>
                        <?php endif; ?>

                        <?php if (isset($lp_info['twitter']) && $lp_info['twitter']) : ?>
                            <li>
                                <a href="<?php echo esc_url($lp_info['twitter']); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
                            </li>
                        <?php endif; ?>

                        <?php if (isset($lp_info['google']) && $lp_info['google']) : ?>
                            <li>
                                <a href="<?php echo esc_url($lp_info['google']); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
                            </li>
                        <?php endif; ?>

                        <?php if (isset($lp_info['linkedin']) && $lp_info['linkedin']) : ?>
                            <li>
                                <a href="<?php echo esc_url($lp_info['linkedin']); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
                            </li>
                        <?php endif; ?>

                        <?php if (isset($lp_info['youtube']) && $lp_info['youtube']) : ?>
                            <li>
                                <a href="<?php echo esc_url($lp_info['youtube']); ?>" class="youtube"><i class="fa fa-youtube"></i></a>
                            </li>
                        <?php endif; ?>
                    </ul>

                </div>
                <div class="author-description">
                    <?php echo wp_kses_post(get_the_author_meta('description')); ?>
                </div>
            </div>
        </div>
        <?php
        if (in_array('learnpress/learnpress.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            educatito_co_instructors(get_the_ID(), get_the_author_meta('ID'));
        }
    }

}

add_action('educatito_about_author', 'educatito_about_author');
if (!function_exists('educatito_is_new_learnpress')) {

    function educatito_is_new_learnpress($version) {
        if (defined('LEARNPRESS_VERSION')) {
            return version_compare(LEARNPRESS_VERSION, $version, '>=');
        } else {
            return version_compare(get_option('learnpress_version'), $version, '>=');
        }
    }

}
if (!function_exists('educatito_custom_remove_query_taxonomy')) {

    function educatito_custom_remove_query_taxonomy() {
        global $lp_query;

        if (!$lp_query) {
            return;
        }

        remove_action('pre_get_posts', array($lp_query, 'query_taxonomy'));
    }

}
add_action('init', 'educatito_custom_remove_query_taxonomy');
