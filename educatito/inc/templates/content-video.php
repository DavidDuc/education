<?php
/* 
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 */
?>
<?php
global $post, $educatito_options;
$post_id = get_the_ID();
$term_list = wp_get_post_terms($post_id, 'category');
$date = get_the_date();
$author_id = $post->post_author;
$author = get_the_author();
$link_author = get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'));
?>
<div class="box">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
        if (has_post_thumbnail()) {
            ?>
            <div class="box-img">
                <?php the_post_thumbnail('full'); ?>
            </div>
            <?php
        }
        ?>
        <div class="box-content">
            <div class="box-content-title">
                <?php
                if (!empty($educatito_options)) {
                    if (isset($educatito_options['jrb_post_show_post_title']) && $educatito_options['jrb_post_show_post_title'] == 1) {
                        if (is_single()) :
                            the_title('<h3 class="title">', '</h3>');
                        else :
                            the_title(sprintf('<h3 class="title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
                        endif;
                    }
                } else {
                    if (is_single()) :
                        the_title('<h3 class="title">', '</h3>');
                    else :
                        the_title(sprintf('<h3 class="title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');
                    endif;
                }
                ?>
            </div>
            <?php
            if (!empty($educatito_options)) {
                if (isset($educatito_options['jrb_post_show_post_info']) && $educatito_options['jrb_post_show_post_info'] == 1) {
                    ?>
                    <div class="box-content-meta">
                        <ul>
                            <li class="date">
                                <a href="javascript:;"><?php echo esc_attr($date); ?></a>
                            </li>
                            <li class="author">
                                <span><?php echo esc_html__('By', 'educatito'); ?></span>
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>"><?php echo esc_attr(educatito_get_author_name()); ?></a>
                            </li>
                            <li class="cat">
                                <?php
                                $count = count($term_list);
                                $i = 1;
                                foreach ($term_list as $term) {
                                    echo '<a class="link-cat" href="' . esc_url(get_category_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                                    if ($i < $count)
                                        echo ', ';
                                    $i++;
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="box-content-meta">
                    <ul>
                        <li class="date">
                            <a href="javascript:;"><?php echo esc_attr($date); ?></a>
                        </li>
                        <li class="author">
                            <span><?php echo esc_html__('By', 'educatito'); ?></span>
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>"><?php echo esc_attr(educatito_get_author_name()); ?></a>
                        </li>
                        <li class="cat">
                            <?php
                            $count = count($term_list);
                            $i = 1;
                            foreach ($term_list as $term) {
                                echo '<a class="link-cat" href="' . esc_url(get_category_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                                if ($i < $count)
                                    echo ', ';
                                $i++;
                            }
                            ?>
                        </li>
                    </ul>
                </div>
                <?php
            }
            ?>
            <div class="educatito-blog-video">
                <?php
                if (!is_home()) {
                    $video_source = get_post_meta(get_the_ID(), 'educatito_post_video_source', true);
                    if (empty($video_source))
                        $video_source = 'post';
                    $video_height = get_post_meta(get_the_ID(), 'educatito_post_video_height', true);
                    switch ($video_source) {
                        case 'post':
                            the_content();
                            break;
                        case 'youtube':
                            $video_youtube = get_post_meta(get_the_ID(), 'educatito_post_video_youtube', true);
                            if ($video_youtube) {
                                echo do_shortcode('[vc_video  height="' . $video_height . '" link="' . $video_youtube . '" ]');
                            }
                            break;
                        case 'vimeo':
                            $video_vimeo = get_post_meta(get_the_ID(), 'educatito_post_video_vimeo', true);
                            if ($video_vimeo) {
                                echo do_shortcode('[vc_video  height="' . $video_height . '" link="' . $video_vimeo . '" ]');
                            }
                            break;
                        case 'media':
                            $video_type = get_post_meta(get_the_ID(), 'educatito_post_video_type', true);
                            $preview_image = get_post_meta(get_the_ID(), 'educatito_post_preview_image', true);
                            $video_file = get_post_meta(get_the_ID(), 'educatito_post_video_url', true);
                            if ($video_file) {
                                echo do_shortcode('[video height="' . $video_height . '" ' . $video_type . '="' . $video_file . '" poster="' . $preview_image . '"][/video]');
                            }
                            break;
                    }
                }
                ?>
            </div>
            <div class="box-content-p uk-clearfix">
                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links"><span class="page-links-title">' . esc_attr__('Pages:', 'educatito') . '</span>',
                    'after' => '</div>',
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                    'pagelink' => '<span class="screen-reader-text">' . esc_attr__('Page', 'educatito') . ' </span>%',
                    'separator' => '<span class="screen-reader-text">, </span>',
                ));
                ?>
            </div>
            <?php if (is_single()): ?>
                <div class="tags-share uk-clearfix">
                    <?php
                    if (!empty($educatito_options)) {
                        if (isset($educatito_options['jrb_post_show_post_tags']) && $educatito_options['jrb_post_show_post_tags'] == 1) {
                            ?>
                            <div class="tags uk-float-left">
                                <?php
                                $posttags = get_the_tags();
                                $count = count($posttags);
                                $i = 1;
                                if (!empty($posttags))
                                    echo '<h3>' . esc_html__('Tags:', 'educatito') . '</h3> ';
                                ?>
                                <ul>
                                    <?php
                                    if ($posttags) {
                                        foreach ($posttags as $tag) {
                                            echo "<li><a href=" . esc_url(get_tag_link($tag->term_id)) . ">" . esc_attr($tag->name) . "</a>";
                                            if ($i < $count)
                                                echo ', ';
                                            echo "</li>";
                                            $i++;
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                    }else {
                        ?>
                        <div class="tags uk-float-left">
                            <?php
                            $posttags = get_the_tags();
                            $count = count($posttags);
                            $i = 1;
                            if (!empty($posttags))
                                echo '<h3>' . esc_html__('Tags:', 'educatito') . '</h3> ';
                            ?>
                            <ul>
                                <?php
                                if ($posttags) {
                                    foreach ($posttags as $tag) {
                                        echo "<li><a href=" . esc_url(get_tag_link($tag->term_id)) . ">" . esc_attr($tag->name) . "</a>";
                                        if ($i < $count)
                                            echo ', ';
                                        echo "</li>";
                                        $i++;
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    if (!empty($educatito_options)) {
                        if (isset($educatito_options['jrb_post_show_social_share']) && $educatito_options['jrb_post_show_social_share'] == 1) {
                            ?>
                            <div class="share uk-float-right">
                                <?php do_action('educatito_social_share'); ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div><!-- .educatito-content -->
    </div><!-- #post-## -->
</div>


