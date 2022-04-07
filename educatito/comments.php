<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number > 1) {
                printf(
                        /* translators: 1: number of comments, 2: post title */
                        esc_html_x(
                                '%1$s Comments', 'comments title', 'educatito'
                        ), esc_attr(number_format_i18n($comments_number)), esc_attr(get_the_title())
                );
            } else {
                /* translators: %s: post title */
                printf(esc_html_x('1 Comment', 'comments title', 'educatito'), esc_attr(get_the_title()));
            }
            ?>
        </h3>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through   ?>
            <nav id="comment-nav-above" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'educatito'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'educatito')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'educatito')); ?></div>
            </nav><!-- #comment-nav-above -->
        <?php endif; // check for comment navigation  ?>

        <ol class="comment-list">
            <?php

            function custom_comments($comment, $args, $depth) {
                switch ($comment->comment_type) :
                    case 'pingback' :
                        ?>
                        <li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">
                            <div class="back-link"><?php echo esc_html__('Pingback:', 'educatito'); ?> <?php comment_author_link(); ?></div>
                            <?php
                            break;
                        case 'trackback' :
                            ?>
                        <li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">
                            <div class="back-link"><?php echo esc_html__('Trackback:', 'educatito'); ?> <?php comment_author_link(); ?></div>
                            <?php
                            break;
                        default :
                            ?>
                        <li id="comment-<?php comment_ID(); ?>" class="comment-item">
                            <article <?php comment_class(); ?>>

                                <div class="comment-body uk-clearfix">
                                    <div class="comment-author vcard">
                                        <?php echo get_avatar($comment, 80); ?>
                                    </div><!-- .vcard -->
                                    <div class="comment-details clr">
                                        <div class="comment-meta">
                                            <div class="meta-author">
                                                <span class="times">
                                                    <span class="date">
                                                        <?php comment_date(); ?>
                                                    </span>
                                                </span>
                                                <h6 class="author-name"><?php comment_author(); ?>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <?php comment_text(); ?>
                                            <div class="reply"><?php
                                                $reply_text = esc_html__('Reply', 'educatito');
                                                comment_reply_link(array_merge($args, array(
                                                    'reply_text' => $reply_text,
                                                    'after' => '',
                                                    'before' => '<span class="fa fa-share"></span>',
                                                    'depth' => $depth,
                                                    'max_depth' => $args['max_depth']
                                                )));
                                                ?>
                                            </div><!-- .reply -->
                                        </div>
                                    </div>
                                </div><!-- comment-body -->			 
                            </article><!-- #comment-<?php comment_ID(); ?> -->
                            <?php
                            // End the default styling of comment
                            break;
                    endswitch;
                }

                wp_list_comments(array(
                    'callback' => 'custom_comments',
                    'style' => 'ol'
                ));
                ?>
        </ol><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php echo esc_html__('Comment navigation', 'educatito'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'educatito')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'educatito')); ?></div>
            </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation  ?>

    <?php endif;  ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php echo esc_html__('Comments are closed.', 'educatito'); ?></p>
    <?php endif; ?>

    <?php
    $label_submit = esc_html__('POST COMMENT', 'educatito');
    $title_reply = esc_html__('Leave a Comment', 'educatito');
    $text_author = esc_html__('Name', 'educatito');
    $text_email = esc_html__('Email', 'educatito');
    $text_comment = esc_html__('Your Comment', 'educatito');
    $comments_args = array(
        'label_submit' => $label_submit,
        'title_reply' => $title_reply,
        'comment_notes_after' => '',
        'comment_notes_before' => '',
        'format' => 'xhtml',
        'comment_field' => '',
        'fields' => apply_filters('comment_form_default_fields', array(
            'author' => '<p class="comment-form-author"><input id="author" placeholder="' . esc_attr($text_author) . '" name="author" type="text" value="" size="30" aria-required="true" /></p>',
            'email' => '<p class="comment-form-email"><input id="email" placeholder="' . esc_attr($text_email) . '" name="email" type="text" value="" size="30" aria-required="true"  /></p>',
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_attr($text_comment) . '" cols="45" rows="8" aria-required="true"></textarea></p>',
        )),
    );
    if (is_user_logged_in()) {
        $comments_args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_attr($text_comment) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    }
    comment_form($comments_args);
    ?>

</div><!-- #comments -->
