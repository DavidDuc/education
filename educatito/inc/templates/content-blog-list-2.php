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
$image = educatito_image_resize($url, 689, 428, true);
$term_list = wp_get_post_terms($post_id, 'category');
$date = get_the_date();
$dateD = get_the_date('d');
$dateM = get_the_date('M');
$dateY = get_the_date('Y');
?>

<div class="box uk-clearfix">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="box-left uk-float-left text-right">
            <div class="date">
                <div class="day"><?php echo esc_attr($dateD); ?></div>
                <div class="month"><?php echo esc_attr($dateM); ?> <?php echo esc_attr($dateY); ?></div>
            </div>
            <div class="author">
                <span class="ti-user"></span>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>"><?php echo esc_attr(educatito_get_author_name()); ?></a>
            </div>
            <div class="cat">
                <span class="ti-folder"></span>
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
            </div>
            <div class="comment">
                <?php
                educatito_comment_number();
                ?>
            </div>
        </div>
        <div class="box-right">
            <div class="box-content-title">
                <a class="educatito-hover-child-color-orange" href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark"><h3 class="title"><?php echo esc_attr(the_title()); ?></h3></a>
            </div>
            <?php
            if (!empty($image)) {
                ?>
                <div class="box-img">
                    <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                    </a>
                </div>
                <?php
            }
            ?>
            <div class="box-content-p">
                <?php
                the_excerpt();
                ?>
            </div>
            <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more"><?php echo esc_html__('Read more', 'educatito'); ?></a>
        </div>
    </div><!-- #post-## -->
</div>
