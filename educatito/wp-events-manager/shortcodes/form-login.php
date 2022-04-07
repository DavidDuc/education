<?php
if (!defined('ABSPATH')) {
    exit;
}

wpems_print_notices();
?>
<div class="wp_login_error">
    <?php if (isset($_GET['login']) && $_GET['login'] == 'failed') { ?>
        <p><?php echo esc_html__('Username and/or password is not correct', 'educatito'); ?></p>
    <?php } ?>
</div>
<form name="event_auth_login_form" action="" method="post" class="event-auth-form">
    <h2><?php echo esc_html__('SIGN IN', 'educatito'); ?></h2>
    <p class="form-row form-required user-name">
        <label for="user_login"><?php echo esc_html__('Username', 'educatito') ?><span class="required">*</span></label>
        <input type="text" name="user_login" placeholder="<?php echo esc_attr__('E-mail or Username', 'educatito') ?>" id="user_login" class="input" value="<?php echo esc_attr(!empty($_POST['user_login']) ? sanitize_text_field(wp_unslash($_POST['user_login'])) : '' ) ?>" size="20" /></label>
    </p>

    <p class="form-row form-required password">
        <label for="user_pass"><?php echo esc_html__('Password', 'educatito') ?><span class="required">*</span></label>
        <input type="password" name="user_pass" placeholder="<?php echo esc_attr__('Password', 'educatito') ?>" id="user_pass" class="input" value="" size="25" />
    </p>

    <?php do_action('event_auth_register_form'); ?>

    <div class="form-row form-required rememberme">
        <label for="rememberme" class="inline">
            <input class="input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e('Remember me', 'educatito'); ?>
        </label>
        <div>
            <?php if (get_option('users_can_register')) : ?>
                <a href="<?php echo esc_url(wpems_register_url()); ?>"><?php esc_html_e('Register', 'educatito') ?></a> |
            <?php endif; ?>
            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Forgot Password', 'educatito') ?></a>
        </div>
    </div>

    <p class="submit form-row">
        <?php wp_nonce_field('auth-login-nonce', 'auth-nonce'); ?>
        <input type="hidden" name="action" value="event_login_action" />
        <input type="hidden" name="redirect_to" value="<?php echo esc_attr(( is_ssl() ? 'https://' : 'http://' )) . filter_input(INPUT_SERVER, 'HTTP_HOST') . filter_input(INPUT_SERVER, 'REQUEST_URI'); ?>" />
        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php echo esc_attr__('SIGN IN', 'educatito') ?>" />
    </p>

</form>