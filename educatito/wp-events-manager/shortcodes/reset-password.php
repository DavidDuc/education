<?php
/**
 * @Author: educatito
 * @Date:   2016-03-02 14:46:31
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

wpems_print_notices();
?>
<form name="resetpassform" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=resetpass', 'login_post' ) ); ?>" method="POST" class="event-auth-form">
    <input type="hidden" name="user_login" value="<?php echo esc_attr( $atts['login'] ); ?>" />

    <div class="user-pass1-wrap">
        <p class="form-row required password">
            <label for="pass1"><?php esc_html_e( 'Password', 'educatito' ) ?></label>
            <input type="password" placeholder="<?php echo esc_attr__('Password', 'educatito') ?>" class="event_auth_input" name="pass1" />
        </p>
    </div>

    <div class="user-pass2-wrap">
        <p class="form-row required password">
            <label for="pass2"><?php esc_html_e( 'Confirm Password', 'educatito' ) ?></label>
            <input type="password" placeholder="<?php echo esc_attr__('Confirm Password', 'educatito') ?>" name="pass2" class="event_auth_input" />
        </p>
    </div>

    <p class="description indicator-hint"><?php echo wp_kses_post(wp_get_password_hint()); ?></p>

    <?php
    do_action( 'event_auth_resetpass_form', $atts['login'] );
    ?>
    <input type="hidden" name="key" value="<?php echo esc_attr( $atts['key'] ); ?>" />
    <p class="submit form-row required">
        <input type="submit" name="submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Reset Password', 'educatito' ); ?>" />
    </p>
</form>

<p id="nav">
    <?php if ( !is_user_logged_in() ) : ?>
        <a href="<?php echo esc_url( wp_login_url() ); ?>"><?php esc_html_e( 'Log in', 'educatito' ); ?></a>
    <?php endif; ?>
    <?php
    if ( get_option( 'users_can_register' ) ) :
        $registration_url = sprintf( '<a href="%s">%s</a>', esc_url( wp_registration_url() ), __( 'Register', 'educatito' ) );

        echo ' | ' . esc_url($registration_url);
    endif;
    ?>
</p>