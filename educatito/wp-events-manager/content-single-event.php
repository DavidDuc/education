<?php
global $educatito_options;
do_action('tp_event_before_single_event');
?>
<div id="tp_event-<?php the_ID(); ?>" class="uk-width-large-2-3 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1" <?php post_class('tp_single_event'); ?>>
    <?php
    if (!empty($educatito_options)) {
        if (isset($educatito_options['jrb_event_detail_show_title_detail']) && $educatito_options['jrb_event_detail_show_title_detail'] == 1) {
            do_action('tp_event_single_event_title');
        }
    } else {
        do_action('tp_event_single_event_title');
    }
    ?>
    <div class="tp-event-top">
        <?php
        if (!empty($educatito_options)) {
            if (isset($educatito_options['jrb_event_detail_show_image']) && $educatito_options['jrb_event_detail_show_image'] == 1) {
                do_action('tp_event_single_event_thumbnail');
            }
        } else {
            do_action('tp_event_single_event_thumbnail');
        }
        if (!empty($educatito_options)) {
            if (isset($educatito_options['jrb_event_detail_show_countdown']) && $educatito_options['jrb_event_detail_show_countdown'] == 1) {
                do_action('tp_event_loop_event_countdown');
            }
        } else {
            do_action('tp_event_loop_event_countdown');
        }
        ?>
    </div>
    <div class="tp-event-content">
        <?php
        if (!empty($educatito_options)) {
            if (isset($educatito_options['jrb_event_detail_show_content']) && $educatito_options['jrb_event_detail_show_content'] == 1) {
                do_action('tp_event_single_event_content');
            }
        } else {
            do_action('tp_event_single_event_content');
        }
        ?>
    </div>
    <div class="tp-event-single-share">
        <?php
        if (!empty($educatito_options)) {
            if (isset($educatito_options['jrb_event_detail_show_social']) && $educatito_options['jrb_event_detail_show_social'] == 1) {
                do_action('educatito_social_share');
            }
        } else {
            do_action('educatito_social_share');
        }
        ?>
    </div>
</div>
<div class="uk-width-large-1-3 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 event-sidebar">
    <?php
    $event = new WPEMS_Event(get_the_ID());
    $time_format = get_option('time_format');
    $time_from = get_post_meta(get_the_ID(), 'tp_event_date_start', true) ? strtotime(get_post_meta(get_the_ID(), 'tp_event_date_start', true)) : time();
    $time_finish = get_post_meta(get_the_ID(), 'tp_event_date_end', true) ? strtotime(get_post_meta(get_the_ID(), 'tp_event_date_end', true)) : time();
    $time_start = tp_event_start($time_format);
    $time_end = tp_event_end($time_format);

    $location = get_post_meta(get_the_ID(), 'tp_event_location', true) ? get_post_meta(get_the_ID(), 'tp_event_location', true) : 'Birmingham, UK';
    ?>
    <div class="tp-event-info">
        <div class="tp-info-cost uk-clearfix" >
            <div class="label"><?php esc_html_e('Cost', 'educatito'); ?></div>
            <div class="value"><?php  if($event->get_price() != NULL) { echo wp_kses_post(wpems_format_price($event->get_price())) . esc_html__('/Slot', 'educatito'); }else{ echo '<span class="free">' . esc_html__('Free', 'educatito') . '</span>'; } ?></div>
        </div>
        <ul class="tp-info-box">
            <li class="uk-clearfix">
                <p class="heading">
                    <i class="fa fa-clock-o"></i><?php esc_html_e('Start Time', 'educatito'); ?>
                </p>
                <span><?php echo esc_html($time_start); ?></span>
            </li>
            <li class="uk-clearfix">
                <p class="heading">
                    <i class="fa fa-flag"></i><?php esc_html_e('Finish Time', 'educatito'); ?>
                </p>
                <span><?php echo esc_html($time_end); ?></span>
            </li>
            <li class="uk-clearfix">
                <p class="heading">
                    <i class="fa fa-calendar"></i><?php esc_html_e('Day', 'educatito'); ?>
                </p>
                <span><?php echo wp_kses_post(date_i18n('F j, Y', $time_from)); ?> - <?php echo wp_kses_post(date_i18n('F j, Y', $time_finish)); ?></span>
            </li>
            <li class="uk-clearfix">
                <p class="heading">
                    <i class="fa fa-graduation-cap"></i><?php esc_html_e('Total Slots', 'educatito'); ?>
                </p>
                <span><?php echo absint($event->qty); ?></span>
            </li>
            <li class="uk-clearfix">
                <p class="heading">
                    <i class="fa fa-map-marker"></i><?php esc_html_e('Address', 'educatito'); ?>
                </p>
                <span><?php echo esc_html($location); ?></span>
            </li>
        </ul>
        <?php
        do_action('tp_event_after_single_event');
        ?>
    </div>
    <?php
    if (!empty($educatito_options)) {
        if (isset($educatito_options['jrb_event_detail_show_maps']) && $educatito_options['jrb_event_detail_show_maps'] == 1) {
            do_action('tp_event_loop_event_location');
        }
    } else {
        do_action('tp_event_loop_event_location');
    }
    ?>
</div>