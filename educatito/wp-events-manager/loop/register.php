<?php
if (!defined('ABSPATH')) {
    exit;
}

if (wpems_get_option('allow_register_event') == 'no') {
    return;
}

$event = new WPEMS_Event(get_the_ID());
$user_reg = $event->booked_quantity(get_current_user_id());


?>
<div class="event_register_area">

    <form name="event_register" class="event_register" method="POST">

        <ul class="info-event">
            <li class="uk-clearfix">
                <?php if (( $event->get_price() && absint($event->qty) != 0 && $event->post->post_status !== 'tp-event-expired')) : ?>
                    <div class="label"><i class="fa fa-dropbox"></i><?php esc_html_e('Quantity', 'educatito'); ?></div>
                    <div class="value">
                        <input type="number" name="qty" value="1" min="1" id="event_register_qty" />
                    </div>
                <?php else: ?>
                    <div class="label"><i class="fa fa-dropbox"></i><?php esc_html_e('Quantity', 'educatito'); ?></div>
                    <div class="value">
                        <input disabled type="number" value="1" min="1" id="event_register_qty" />
                        <input type="hidden" name="qty" value="1" min="1" />
                    </div>
                <?php endif; ?>
            </li>
            <?php if (intval($event->get_price()) > 0) : ?>
                <li class="event-payment uk-clearfix">
                    <div class="label"><i class="fa fa-cc-paypal"></i><?php esc_html_e('Pay with', 'educatito'); ?></div>
                    <div class="event_auth_payment_methods">
                        <?php
                        $payments = wpems_gateways_enable();

                        if (!empty($payments)) {
                            $i = 0;
                            foreach ($payments as $id => $payment) :
                                ?>
                                <input id="payment_method_<?php echo esc_attr($id) ?>" type="radio" name="payment_method" value="<?php echo esc_attr($id) ?>"<?php echo esc_attr($i) === 0 ? ' checked' : '' ?>/>
                                <label for="payment_method_<?php echo esc_attr($id) ?>"><img width="115" height="50" src="<?php echo esc_attr($payment->icon) ?>" /></label>
                                <?php
                                $i ++;
                            endforeach;
                        }
                        ?>
                    </div>

                </li>
        <?php endif; ?>
        </ul>
<?php if (is_user_logged_in()) { ?>
            <div class="event_register_foot">
                <input type="hidden" name="event_id" value="<?php echo esc_attr(get_the_ID()) ?>" />
                <input type="hidden" name="action" value="event_auth_register" />
                <?php wp_nonce_field('event_auth_register_nonce', 'event_auth_register_nonce'); ?>
                <?php if ($event->post->post_status === 'tp-event-expired') : ?>
                    <button type="submit" disabled class="event_button_disable"><?php esc_html_e('Expired', 'educatito'); ?></button>
                <?php elseif (absint($event->qty) == 0) : ?>
                    <button type="submit" disabled class="event_button_disable"><?php esc_html_e('Sold Out', 'educatito'); ?></button>
                <?php else: ?>
                    <button type="submit" class="event_register_submit event_auth_button"><?php esc_html_e('Buy Ticket', 'educatito'); ?></button>
            <?php endif ?>
            </div>
        <?php }else { ?>
        <div class="main-nav">
            <a class="cd-signin button-login" href="javascript:void(0)"><?php echo esc_html__('Login', 'educatito'); ?></a>
        </div>
<?php } ?>
    </form>

</div>
