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
$image = educatito_image_resize($url, 870, 515, true);
$term_list = wp_get_post_terms($post_id, 'category');
$date = get_the_date();
?>

<div class="box">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php
        if (!empty($image)) {
            ?>
            <div class="box-img">
                <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                </a>
            </div>
            <?php
        }else {
            if (!empty($url)) {
                ?>
                <div class="box-img">
                    <a href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark">
                        <img src="<?php echo esc_url($url); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                    </a>
                </div>
                <?php
            }
        }
        ?>

        <div class="box-content">
            <div class="box-content-title">
                <a class="educatito-hover-child-color-orange" href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark"><h3 class="title"><?php echo esc_attr(the_title()); ?></h3></a>
            </div>
            <div class="box-content-meta">
                <ul>
                    <li class="date">
                        <a href="javascript:;"><?php echo esc_attr($date); ?></a>
                    </li>
                    <li class="author">
                        <span><?php echo esc_html__('By', 'educatito'); ?></span>
                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>"><?php echo esc_attr(educatito_get_author_name()); ?></a>
                    </li>

                    <?php
                    $count = count($term_list);
                    if ($count > 0) {
                        ?>
                        <li class="cat">
                            <?php
                            $i = 1;
                            foreach ($term_list as $term) {
                                echo '<a class="link-cat" href="' . esc_url(get_category_link($term->term_id)) . '">' . esc_attr($term->name) . '</a>';
                                if ($i < $count)
                                    echo ', ';
                                $i++;
                            }
                            ?>
                        </li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
            <div class="box-content-p">
                <?php
                the_excerpt();
                ?>
            </div>
            <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more educatito-hover-color-primary"><?php echo esc_html__('Read more', 'educatito'); ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
    </div><!-- #post-## -->
</div>
