<?php
/**
 * @Author: educatito
 * @Date:   2016-02-22 17:03:48
 */
if (!defined('ABSPATH')) {
    exit;
}

wpems_print_notices();
?>

<?php if (empty($_REQUEST['checkemail'])) : ?>

    <form name="forgot-password" class="forgot-password event-auth-form" action="" method="post">
        <h2><?php echo esc_html__('Forgot Password', 'educatito'); ?></h2>
        <p class="form-row event_auth_forgot_password_message message">
            <?php esc_html_e('Please enter your username or email address. You will receive a link to create a new password via email.', 'educatito') ?>
        </p>
        <p class="form-row required user-name">
            <label for="user_login" ><?php esc_html_e('Username or Email:', 'educatito') ?></label>
            <input type="text" name="user_login" id="user_login" placeholder="<?php echo esc_attr__('E-mail or Username', 'educatito') ?>" class="input" value="<?php echo esc_attr(!empty($_POST['user_login']) ? sanitize_text_field(wp_unslash($_POST['user_login'])) : '' ); ?>" size="20" />
        </p>
        <?php
        do_action('tp_event_forgot_password_form');
        ?>
        <input type="hidden" name="redirect_to" value="<?php echo esc_attr(( is_ssl() ? 'https://' : 'http://')) . filter_input(INPUT_SERVER, 'HTTP_HOST') . filter_input(INPUT_SERVER, 'REQUEST_URI'); ?>" />
        <p class="form-row submit">
            <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Get New Password', 'educatito'); ?>" />
        </p>

    </form>

    <div class="event_auth_lost_pass_footer">
        <a href="<?php echo esc_url(wpems_login_url()) ?>">
            <?php esc_html_e('Login', 'educatito'); ?>
        </a> | 
        <?php if (!is_user_logged_in()) : ?>

            <a href="<?php echo esc_url(wpems_register_url()) ?>">
                <?php esc_html_e('Create new user', 'educatito'); ?>
            </a>

        <?php endif; ?>
    </div>

    <?php do_action('tp_event_forgot_password_form_footer'); ?>

<?php endif; ?>