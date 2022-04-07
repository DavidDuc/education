<?php
/* 
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 */

global $educatito_options;
$post_id = get_the_ID();
$thumb_id = get_post_thumbnail_id($post_id);
$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$url = wp_get_attachment_url($thumb_id);
$image = educatito_image_resize($url, 420, 300, true);
$image_large = educatito_image_resize($url, 600, 400, true);
$term_list = wp_get_post_terms($post_id, 'category');
$date = get_the_date();
?>

<div class="uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1">
    <div id="post-<?php the_ID(); ?>" <?php post_class("box set-height-group"); ?>>
        <div class="box-img">
            <?php
            if (!empty($image)) {
                ?>
                <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">
                    <picture>
                        <source srcset="<?php echo esc_url($image_large); ?>" media="(max-width: 767px)">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                    </picture>
                </a>               
                <?php
            }
            ?>
        </div>
        <div class="box-content">
            <div class="box-content-title">
                <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark"><h3 class="title"><?php echo esc_attr(the_title()); ?></h3></a>
            </div>
            <div class="box-content-meta">
                <ul>
                    <li class="date">
                        <a href="javascript:;"><?php echo esc_attr($date); ?></a>
                    </li>
                    <li class="author">
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>"><?php echo esc_attr(educatito_get_author_name()); ?></a>
                    </li>
                </ul>
            </div>
            <div class="box-content-p">
                <?php echo wp_trim_words(get_the_excerpt(), 17, '...') ?>
            </div>
        </div>
    </div>
</div>
