<?php
global $educatito_options;
$display_year = get_theme_mod('educatito_event_display_year', false);
$class = 'entry clearfix';
$time_format = get_option('time_format');
$time_start = tp_event_start($time_format);
$time_end = tp_event_end($time_format);
$location = tp_event_location();
$date_show = tp_event_get_time('d');
$month_show = tp_event_get_time('F');
$post_id = get_the_ID();
$thumb_id = get_post_thumbnail_id($post_id);
$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
$url = wp_get_attachment_url($thumb_id);
$image = educatito_image_resize($url, 370, 250, true);
$image2 = educatito_image_resize($url, 700, 350, true);
$image3 = educatito_image_resize($url, 425, 285, true);
if ($display_year) {
    $month_show .= ', ' . tp_event_get_time('Y');
}
?>
<article <?php post_class($class); ?>>
    <div class="entry-border uk-clearfix">
        <?php
        if (!empty($educatito_options)) {
            if (isset($educatito_options['jrb_archive_event_show_image']) && $educatito_options['jrb_archive_event_show_image'] == 1) {
                ?>
                <div class="feature-post">
                    <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>">
                        <picture>
                            <source srcset="<?php echo esc_url($image3); ?>" media="(max-width: 480px)">
                            <source srcset="<?php echo esc_url($image2); ?>" media="(max-width: 920px)">
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                        </picture>
                    </a>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="feature-post">
                <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>">
                    <picture>
                        <source srcset="<?php echo esc_url($image3); ?>" media="(max-width: 480px)">
                        <source srcset="<?php echo esc_url($image2); ?>" media="(max-width: 920px)">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title(get_the_ID())); ?>">
                    </picture>
                </a>
            </div>
            <?php
        }
        ?>
        <div class="content-post">
            <?php
            if (!empty($educatito_options)) {
                if (isset($educatito_options['jrb_archive_event_show_date']) && $educatito_options['jrb_archive_event_show_date'] == 1) {
                    ?>
                    <ul class="meta-day">
                        <li class="day">
                            <?php echo esc_html($date_show); ?>
                            <span><?php echo esc_html($month_show); ?></span>
                        </li>
                    </ul>
                    <?php
                }
            } else {
                ?>
                <ul class="meta-day">
                    <li class="day">
                        <?php echo esc_html($date_show); ?>
                        <span><?php echo esc_html($month_show); ?></span>
                    </li>
                </ul>
                <?php
            }
            ?>
            <?php
            if (!empty($educatito_options)) {
                if (isset($educatito_options['jrb_archive_event_show_content']) && $educatito_options['jrb_archive_event_show_content'] == 1) {
                    ?>
                    <div class="flat-content">
                        <div class="event-wrapper">
                            <h5 class="title-post">
                                <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>"> <?php echo get_the_title(); ?></a>
                            </h5>
                            <ul class="meta-post uk-clearfix">
                                <li class="time">
                                    <?php echo esc_html($time_start) . ' - ' . esc_html($time_end); ?>
                                </li>
                                <li class="address">
                                    <?php echo ent2ncr($location); ?>
                                </li>
                            </ul><!-- /.meta-post -->
                            <div class="description entry-post">
                                <?php echo the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="flat-content">
                    <div class="event-wrapper">
                        <h5 class="title-post">
                            <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>"> <?php echo get_the_title(); ?></a>
                        </h5>
                        <ul class="meta-post uk-clearfix">
                            <li class="time">
                                <?php echo esc_html($time_start) . ' - ' . esc_html($time_end); ?>
                            </li>
                            <li class="address">
                                <?php echo ent2ncr($location); ?>
                            </li>
                        </ul><!-- /.meta-post -->
                        <div class="description entry-post">
                            <?php echo the_excerpt(); ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div> <!-- /.feature-post -->
    </div><!-- /.entry-border -->
</article>
