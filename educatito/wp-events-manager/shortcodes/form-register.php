<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

wpems_print_notices();
?>

<form name="event_auth_register_form" action="" method="post" class="event-auth-form">
    <h2><?php echo esc_html__('Register Now', 'educatito'); ?></h2>
    <p class="form-row form-required username">
        <label for="user_login"><?php esc_html_e( 'Username', 'educatito' ) ?><span class="required">*</span></label>
        <input type="text" name="user_login" placeholder="<?php echo esc_attr__('Username', 'educatito') ?>" id="user_login" class="input" value="<?php echo esc_attr( ! empty( $_POST['user_login'] ) ? sanitize_text_field(wp_unslash( $_POST['user_login'] )) : '' ); ?>" size="20" />
    </p>

    <p class="form-row form-required user-name">
        <label for="user_email"><?php esc_html_e( 'Email', 'educatito' ) ?><span class="required">*</span></label>
        <input type="email" name="user_email" placeholder="<?php echo esc_attr__('Email', 'educatito') ?>" id="user_email" class="input" value="<?php echo esc_attr( ! empty( $_POST['user_email'] ) ? sanitize_text_field(wp_unslash( $_POST['user_email'] )) : '' ); ?>" size="25" />
    </p>

    <p class="form-row form-required password">
        <label for="user_pass"><?php esc_html_e( 'Password', 'educatito' ) ?><span class="required">*</span></label>
        <input type="password" placeholder="<?php echo esc_attr__('Password', 'educatito') ?>" name="user_pass" id="user_pass" class="input" value="" size="25" />
    </p>

    <p class="form-row form-required password">
        <label for="confirm_password"><?php esc_html_e( 'Confirm Password', 'educatito' ) ?><span class="required">*</span></label>
        <input type="password" name="confirm_password" placeholder="<?php echo esc_attr__('Confirm Password', 'educatito') ?>" id="confirm_password" class="input" value="" size="25" /></label>
    </p>

    <?php do_action( 'event_auth_register_form' ); ?>

    <?php $send_notify = wpems_get_option( 'register_notify', true ); ?>
    <?php if ( $send_notify ) : ?>
        <p id="reg_passmail" class="form-row">
            <?php esc_html_e( 'Registration confirmation will be emailed to you.', 'educatito' ); ?>
        </p>
    <?php endif; ?>

    <p class="submit form-row">
                          <input type="hidden" name="redirect_to" value="<?php echo esc_attr(( is_ssl() ? 'https://' : 'http://')) . filter_input(INPUT_SERVER, 'HTTP_HOST') . filter_input(INPUT_SERVER, 'REQUEST_URI'); ?>" />
		<?php wp_nonce_field( 'auth-reigter-nonce', 'auth-nonce' ); ?>
        <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Register', 'educatito' ); ?>" />
    </p>

</form>

<p id="nav">
    <a href="<?php echo esc_url( wpems_login_url() ); ?>"><?php esc_html_e( 'Log in', 'educatito' ); ?></a> |
    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" title="<?php esc_attr_e( 'Password Lost and Found', 'educatito' ) ?>"><?php esc_html_e( 'Forgot password?', 'educatito' ); ?></a>
</p>