<?php
/* * *****************************************************************************
 * Template Header V1.
 *
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 * **************************************************************************** */

global $educatito_options;
?>
<header class="header-v1" <?php if (isset($educatito_options['jrb_header_sticky']) && $educatito_options['jrb_header_sticky'] == 1) {
    ?>
            data-uk-sticky="{top: -500, animation: 'uk-animation-slide-top'}"
        <?php }
        ?>>
    <div class="header uk-position-relative uk-clearfix">
        <div class="logo educatito-flex-box educatito-flex-box-ai-center">
            <?php educatito_show_logo(); ?>
        </div>
        <div class="menu-login-flex">
            <div class="educatito-cart">
                <?php
                if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))):
                    if (function_exists('is_woocommerce')) {
                        do_action('educatito_woo_menu');
                    }
                endif;
                ?>
            </div>
            <div class="login-register">
                <?php if (isset($educatito_options['jrb_login_woo']) && $educatito_options['jrb_login_woo'] == 1) { ?>
                    <?php educatito_show_login() ?>
                <?php } ?>
            </div>
            <div class="main-menu educatito-flex-box educatito-flex-box-jc-end">
                <?php
                if (has_nav_menu('educatito-main-menu')) {
                    ?>
                    <ul id="nav" class="menu-primary">
                        <?php educatito_menu('educatito-main-menu'); ?>
                    </ul>
                    <?php
                } else {
                    ?>
                    <div class="default-menu">
                        <a class="create-menu" href="<?php echo esc_url(home_url('/')) . 'wp-admin/nav-menus.php?action=locations'; ?>"><span><?php esc_html_e('Create a menu', 'educatito'); ?></span></a>
                    </div> 
                    <?php
                }
                ?>
                <div class="menu-bars-mobi open">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-mobi">
        <nav class="nav-holder">
            <?php
            if (has_nav_menu('educatito-main-menu')) {
                ?>
                <ul>
                    <?php educatito_menu('educatito-main-menu'); ?>
                </ul>
                <?php
            } else {
                ?>
                <div class="default-menu-mobile">
                    <a class="create-menu" href="<?php echo esc_url(home_url('/')) . 'wp-admin/nav-menus.php?action=locations'; ?>"><span><?php esc_html_e('Create a menu', 'educatito'); ?></span></a>
                </div> 
                <?php
            }
            ?>
            <div class="login-register-moblile">
                <?php if (isset($educatito_options['jrb_login_woo']) && $educatito_options['jrb_login_woo'] == 1) { ?>
                    <?php educatito_show_login() ?>
                <?php } ?>
            </div>
        </nav>
    </div>
</header>