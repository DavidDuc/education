<?php
/**
 * Login Form
 * @author  JRB Themes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') : ?>

    <div class="u-columns col2-set" id="customer_login">
        <div class="wp_login_error">
            <?php if (isset($_GET['login']) && $_GET['login'] == 'failed') { ?>
                <p><?php echo esc_html__('Username and/or password is not correct', 'educatito'); ?></p>
            <?php } ?>
        </div>
        <div class="u-column1 col-1">

        <?php endif; ?>

        <h2><?php echo esc_html__('SIGN IN', 'educatito'); ?></h2>
        <p><?php echo esc_html__('Do you already have an existing account? Please log in with your username and password.', 'educatito'); ?></p>
        <form class="woocommerce-form woocommerce-form-login login" method="post">

            <?php do_action('woocommerce_login_form_start'); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="username"><?php echo esc_html__('Username or email address', 'educatito'); ?> <span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php echo (!empty($_POST['username']) ) ? esc_attr(sanitize_text_field(wp_unslash($_POST['username']))) : ''; ?>" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password"><?php echo esc_html__('Password', 'educatito'); ?> <span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
            </p>

            <?php do_action('woocommerce_login_form'); ?>
            <p class="form-row">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php echo esc_html__('Remember me', 'educatito'); ?></span>
                </label>
            </p>
            <p class="form-row uk-flex">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <input type="submit" class="woocommerce-Button button hover-button" name="login" value="<?php esc_attr_e('Login', 'educatito'); ?>" />
                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="woocommerce-LostPassword lost_password"><?php echo esc_html__('Lost your password?', 'educatito'); ?></a>
            </p>
            <?php do_action('woocommerce_login_form_end'); ?>

        </form>

        <?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') : ?>

        </div>

        <div class="u-column2 col-2">
            <h2><?php echo esc_html__('NO ACCOUNT YET? SIGN UP HERE.', 'educatito'); ?></h2>
            <p><?php echo esc_html__('Do you not have an account yet? Please fill in your details below:', 'educatito'); ?></p>
            <form method="post" class="register">

                <?php do_action('woocommerce_register_form_start'); ?>

                <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_username"><?php echo esc_html__('Username', 'educatito'); ?> <span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php echo (!empty($_POST['username']) ) ? esc_attr(sanitize_text_field(wp_unslash($_POST['username']))) : ''; ?>" />
                    </p>

                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_email"><?php echo esc_html__('Email address', 'educatito'); ?> <span class="required">*</span></label>
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" value="<?php echo (!empty($_POST['email']) ) ? esc_attr(sanitize_text_field(wp_unslash($_POST['email']))) : ''; ?>" />
                </p>

                <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password"><?php echo esc_html__('Password', 'educatito'); ?> <span class="required">*</span></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
                    </p>

                <?php endif; ?>

                <?php do_action('woocommerce_register_form'); ?>

                <p class="woocommerce-FormRow form-row">
                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                    <input type="submit" class="woocommerce-Button button hover-button" name="register" value="<?php esc_attr_e('Register', 'educatito'); ?>" />
                </p>
                <?php do_action('woocommerce_register_form_end'); ?>

            </form>

        </div>

    </div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>
