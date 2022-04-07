<?php
/*
 * Custom Body.
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 */
/* 
 * Header
  */
if (!function_exists('educatito_style_head')):
    add_action('wp_head', 'educatito_style_head');

    function educatito_style_head() {
        $body_classes = get_body_class();
        global $educatito_options, $post;
        if (isset($post)) {
            $meta_data = educatito_option_meta_id($post->ID);
        }
        $style = '';

        /* header */
        if (isset($educatito_options['jrb_header_color']) && $educatito_options['jrb_header_color'] != '') {
            $color_header = $educatito_options['jrb_header_color'];
            $style .= '.header-v1 .header .login-register a,'
                    . '.header-v2 .header .login-register a{'
                    . 'color:' . $color_header . ';'
                    . '}';
        }
        /* Cart */
          if (isset($educatito_options['jrb_cart_woo']) && $educatito_options['jrb_cart_woo'] == 0) {
            $style .=' .header-v1 .header .menu-login-flex .educatito-cart{
                        display:none;
                 }';
        }

        if (isset($educatito_options['jrb_background_header']) && $educatito_options['jrb_background_header'] != '') {
            $background_header = $educatito_options['jrb_background_header'];
        }
        $opacity_header = 1;
        if (isset($educatito_options['jrb_header_transparent'])) {
            $opacity_header = (float) $educatito_options['jrb_header_transparent'] / 100;
        }
        if (isset($background_header) && $background_header != 'transparent') {
            $background_header = educatito_hex2rgba($background_header, $opacity_header);
            $style .= 'header:not(.uk-active) .header{'
                    . 'background:' . $background_header . ';'
                    . '}';
        }

        $costum_header = '';
        if (!empty($meta_data)):
            if (isset($meta_data->_jrb_header) && $meta_data->_jrb_header) {

                if (isset($meta_data->_jrb_custom_color) && $meta_data->_jrb_custom_color) {
                    $costum_header .='.page-id-' . $post->ID . ' header:not(.uk-active) .header,.page-id-' . $post->ID . ' header:not(.uk-active) .header .logo-menu{'
                            . 'background:' . urldecode($meta_data->_jrb_background_color) . ';'
                            . '}'
                            . '.header-v1 .header .main-menu .menu-primary > li > a,
                                .header-v2 .header .main-menu .menu-primary > li > a,
                                .login-register a,
                                .header-v3 .header .main-menu .menu-primary > li > a{
                                color:' . urldecode($meta_data->_jrb_menu_color) . ';
                            }';
                }
                if (isset($meta_data->_jrb_educatito_tranparent_header) && $meta_data->_jrb_educatito_tranparent_header) {
                    $costum_header .='.page-id-' . $post->ID . ' header .header{'
                            . 'position: absolute; width: 100%; z-index: 99999;'
                            . '}';
                }
                
                //sticky custom
                if (isset($meta_data->_jrb_custom_header_sticky) && $meta_data->_jrb_custom_header_sticky) {
                    $costum_header .='.page-id-' . $post->ID . ' header.uk-active .header,.page-id-' . $post->ID . ' header.uk-active .header .logo-menu{'
                            . 'background:' . urldecode($meta_data->_jrb_background_color_sticky) . ';'
                            . '}'
                            . '.header-v1.uk-active .header .main-menu .menu-primary > li > a,
                                .header-v2.uk-active .header .main-menu .menu-primary > li > a,
                                .login-register a,
                                .header-v3.uk-active .header .main-menu .menu-primary > li > a{
                                color:' . urldecode($meta_data->_jrb_menu_color_sticky) . ';
                            }';
                    
                }
            }
        endif;
        /* menu */
        if (isset($educatito_options['jrb_background_menu']) && $educatito_options['jrb_background_menu'] != '') {
            $background_menu = $educatito_options['jrb_background_menu'];
        }
        $opacity_menu = 1;
        if (isset($educatito_options['jrb_menu_transparent'])) {
            $opacity_menu = (float) $educatito_options['jrb_menu_transparent'] / 100;
        }
        if (isset($background_menu) && $background_menu != 'transparent') {
            $background_menu = educatito_hex2rgba($background_menu, $opacity_menu);
            $style .= '.header-v1 .header,'
                    . '.header-v2 .header{'
                    . 'background:' . $background_menu . ';'
                    . '}';
        }

        if (isset($educatito_options['jrb_menu_uppercase']) && $educatito_options['jrb_menu_uppercase'] == 1) {
            $style .='#header .header .educatito-navbar ul li a, #header .menu-primary-show ul  li  a{
                        text-transform: uppercase;
                 }';
        }
        
        //menu logo center
        if (isset($educatito_options['jrb_logo'])) {
            $url_logo = $educatito_options['jrb_logo']['url'];
        } else {
            $url_logo = EDUCATITO_THEME_URI . "/images/logo.png";
        }
        if (isset($post)) {
            $meta_data = educatito_option_meta_id($post->ID);
        }
        if (!empty($meta_data)):
            if (isset($meta_data->_jrb_header) && $meta_data->_jrb_header != '') {
                if (isset($meta_data->_jrb_custom_logo) && $meta_data->_jrb_custom_logo != '') {
                    $url_logo = wp_get_attachment_url($meta_data->_jrb_header_logo_page);
                }
            }
        endif;
        
        //logo sticky
        if (isset($educatito_options['jrb_logo_sticky'])) {
            $url_logo_sticky = $educatito_options['jrb_logo_sticky']['url'];
        } else {
            $url_logo_sticky = EDUCATITO_THEME_URI . "/images/logo.png";
        }
        
        if(isset($educatito_options['jrb_logo_center_width']) && $educatito_options['jrb_logo_center_width'] != ''){
            $style .= ".logo-center{min-width: " . $educatito_options['jrb_logo_center_width'] . ";}";
        }
        
        $style .= ".logo-center{background-image: url('" . $url_logo . "');}";
        $style .= "header.uk-active .logo-center{background-image: url('" . $url_logo_sticky . "');}";
        

        /* Background theme */

        $bg_image = (isset($educatito_options['jrb_bg_image']['url'])) ? $educatito_options['jrb_bg_image']['url'] : '';
        $bg_full = (isset($educatito_options['jrb_bg_full']) && $educatito_options['jrb_bg_full'] == 1) ? 'background-size:100%;' : '';
        $bg_pos = empty($educatito_options['jrb_bg_pos']) ? 'top left' : $educatito_options['jrb_bg_pos'];
        $bg_repeat = (isset($educatito_options['jrb_bg_repeat'])) ? $educatito_options['jrb_bg_repeat'] : 'repeat';

        if (!empty($bg_image)) {
            $showbg = 1;
            $bg_image = 'url("' . $bg_image . '")';
        } else {
            $showbg = 0;
            $bg_image = 'none';
        }
        if (isset($educatito_options['jrb_bg_pattern_option']) && $educatito_options['jrb_bg_pattern_option'] == 1):
            $bg_image = $educatito_options['jrb_bg_pattern'];
        endif;

        $style .= 'body{'
                . 'background:' . $bg_image . ';'
                . $bg_full
                . 'background-position:' . $bg_pos . ';'
                . 'background-repeat:' . $bg_repeat . ';'
                . '}';


        /* Sticky */
         $style_sticky = $custom_css = $background_sticky = '';
        if (isset($educatito_options['jrb_custom_header_sticky']) && $educatito_options['jrb_custom_header_sticky'] == 1) {
            if (isset($educatito_options['jrb_background_header_sticky'])) {
                $background_sticky = $educatito_options['jrb_background_header_sticky'];
            }
            $opacity_sticky = 1;
            if (isset($educatito_options['jrb_header_sticky_opacity'])) {
                $opacity_sticky = (float) $educatito_options['jrb_header_sticky_opacity'] / 100;
            }
            $color_menu = $educatito_options['jrb_color_header_sticky'];
            if ($background_sticky != 'transparent') {
                $background_sticky = educatito_hex2rgba($background_sticky, $opacity_sticky);
            }
            $style_sticky .= '.educatito-sticky .header-v1.uk-active .header,'
                    . '.educatito-sticky .header-v2.uk-active .header{'
                    . 'background:' . $background_sticky . ';'
                    . '}';
            if ($color_menu != '') {
                $style_sticky .='.educatito-sticky .header-v1.uk-active .header .main-menu .menu-primary > li > a,
                    .educatito-sticky .header-v2.uk-active .header .main-menu .menu-primary > li > a{
                        color:' . $color_menu . '; 
                 }';
                $style_sticky .='.educatito-sticky .header-v1.uk-active .header .main-menu .menu-primary > li:hover > a,
                    .header-v2.uk-active .header .main-menu .menu-primary > li:hover > a{
                        color:' . $educatito_options['jrb_color_hover_header_sticky'] . ';
                 }';
                $style_sticky .= '.educatito-sticky .header-v1.uk-active .header .main-menu .menu-primary > li.current_page_item > a,
                    .educatito-sticky .header-v2.uk-active .header .main-menu .menu-primary > li.current_page_item > a{
                        color:' . $educatito_options['jrb_color_active_header_sticky'] . ';'
                        . '}';
            }
        }
        
        $title_bar = '';
        //color title bar theme option
        //---page
        if (isset($educatito_options['jrb_page_title_color']) && $educatito_options['jrb_page_title_color'] != '') {
            $title_bar .='.page-title-bar .educatito-title{'
                        . 'color: ' . $educatito_options['jrb_page_title_color'] . ';'
                        . '}';
        }
        if (isset($educatito_options['jrb_page_breadcrumb_color']) && $educatito_options['jrb_page_breadcrumb_color'] != '') {
            $title_bar .='.page-title-bar .educatito-breadcrumb, .page-title-bar .educatito-breadcrumb a{'
                        . 'color: ' . $educatito_options['jrb_page_breadcrumb_color'] . ';'
                        . '}';
        }
        //---blog
        if (isset($educatito_options['jrb_blog_title_color']) && $educatito_options['jrb_blog_title_color'] != '') {
            $title_bar .='.blog-title-bar .educatito-title{'
                        . 'color: ' . $educatito_options['jrb_blog_title_color'] . ';'
                        . '}';
        }
        if (isset($educatito_options['jrb_blog_breadcrumb_color']) && $educatito_options['jrb_blog_breadcrumb_color'] != '') {
            $title_bar .='.blog-title-bar .educatito-breadcrumb, .blog-title-bar .educatito-breadcrumb a{'
                        . 'color: ' . $educatito_options['jrb_blog_breadcrumb_color'] . ';'
                        . '}';
        }
        //---shop
        if (isset($educatito_options['jrb_shop_title_color']) && $educatito_options['jrb_shop_title_color'] != '') {
            $title_bar .='.product-title-bar .educatito-title{'
                        . 'color: ' . $educatito_options['jrb_shop_title_color'] . ';'
                        . '}';
        }
        if (isset($educatito_options['jrb_shop_breadcrumb_color']) && $educatito_options['jrb_shop_breadcrumb_color'] != '') {
            $title_bar .='.product-title-bar .educatito-breadcrumb .woocommerce-breadcrumb, .product-title-bar .educatito-breadcrumb a{'
                        . 'color: ' . $educatito_options['jrb_shop_breadcrumb_color'] . ';'
                        . '}';
        }
        
        // background title bar option page
        if (isset($meta_data->_jrb_header) && $meta_data->_jrb_header && isset($meta_data->_jrb_custom_bg_page_title) && $meta_data->_jrb_custom_bg_page_title) {
            if (isset($meta_data->_jrb_bg_page_title) && $meta_data->_jrb_bg_page_title != '') {
                $url = wp_get_attachment_url($meta_data->_jrb_bg_page_title);
                $title_bar .='.page-id-' . $post->ID . ' .page-title-bar{'
                        . 'background-image: url(' . $url . ');'
                        . '}';
            }
        }
        if(!is_user_logged_in()){
            $style .= ".hidden-user{display:none!important;}";
        }
        $style .= $title_bar;
        $style_sticky .= $costum_header;

        echo '<style type="text/css">' . wp_kses_post($style) . '</style>';
        echo '<style> @media (min-width: 992px){' . $style_sticky . '}</style>';
    }
endif;

/*------------------------------ Menu----------------------------------------- */

/*
 * Register Main Menu
*/
register_nav_menu('educatito-main-menu', esc_html__('Main Menu', 'educatito'));

/*
 * Educatito Menu
*/
if (!function_exists('educatito_menu')) {

    function educatito_menu($slug) {
        $menu = array(
            'theme_location' => $slug,
            'container' => false,
            'items_wrap' => '%3$s'
        );
        wp_nav_menu($menu);
    }

}


/*
 * Educatito Menu 2
*/
if (!function_exists('educatito_menu2')) {

    function educatito_menu2($slug) {
        $menu_cart = '';
        if (educatito_opts_get('jrb_cart_woo') && in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))):
            if (function_exists('is_woocommerce')) {
                global $woocommerce;
                $qty = esc_attr(WC()->cart->get_cart_contents_count());
                $cart_url = esc_url(wc_get_cart_url());
                $menu_cart = '<li class="menu-item menu-item-cart hide-xs"><a href="' . esc_url($cart_url) . '" class="cart"><span class="ion-bag"></span><span class="number ajax-count-cart">' . $qty . '</span></a>' . educatito_show_cart_checkout_process2() . '</li>';
            }
        endif;
        $menu = array(
            'theme_location' => $slug,
            'menu_id' => 'nav',
            'container_class' => 'menu-list text-center',
            'menu_class' => 'menu-primary',
            'container' => false,
            'echo' => true,
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $menu_cart . '</ul>',
            'depth' => 0,
        );
        wp_nav_menu($menu);
    }

}
/*
 * Educatito Show Form Login
*/
if (!function_exists('educatito_show_form_login')):

    function educatito_show_form_login() {
        ?>
        <form id="login-form" name="event_auth_login_form" action="" method="post" class="white-popup-block mfp-hide login event-auth-form">
            <div class="header-login uk-flex">
                <button title="<?php echo esc_attr__('Close (Esc)', 'educatito') ?>" type="button" class="mfp-close">×</button>
            </div>
            <div class="content">
                <h2><?php echo esc_html__('SIGN IN', 'educatito'); ?></h2>
                <p class="form-row form-required user-name">
                    <input type="text" name="user_login" placeholder="<?php echo esc_attr__('E-mail or Username', 'educatito') ?>" id="popup_user_login" class="input" value="<?php echo esc_attr(!empty($_POST['user_login']) ? sanitize_text_field(wp_unslash($_POST['user_login'])) : '' ) ?>" size="20" />
                </p>
                <p class="form-row form-required password">
                    <input type="password" name="user_pass" placeholder="<?php echo esc_attr__('Password', 'educatito') ?>" id="popup_user_pass" class="input" value="" size="25" />
                </p>

                <?php do_action('event_auth_register_form'); ?>

                <p class="form-row form-required rememberme">
                    <label for="popup_rememberme" class="inline">
                        <input class="input-checkbox" name="rememberme" type="checkbox" id="popup_rememberme" value="forever" /> <?php esc_html_e('Remember me', 'educatito'); ?>
                    </label>
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Forgot Password', 'educatito') ?></a>
                </p>

                <p class="submit form-row">
                    <?php wp_nonce_field('auth-login-nonce', 'auth-nonce'); ?>
                    <input type="hidden" name="action" value="event_login_action" />
                    <input type="hidden" name="redirect_to" value="<?php echo esc_attr(( is_ssl() ? 'https://' : 'http://')) . filter_input(INPUT_SERVER, 'HTTP_HOST') . filter_input(INPUT_SERVER, 'REQUEST_URI'); ?>" />
                    <input type="submit" name="wp-submit" id="popup-wp-submit" class="button button-primary button-large" value="<?php echo esc_attr__('SIGN IN', 'educatito'); ?>" />
                </p>
                <p class="user-register">
                    <?php if (get_option('users_can_register')) : ?>
                        <span><?php echo esc_html__('Do not have an account?', 'educatito') ?></span>
                        <a href="<?php echo esc_url(wpems_register_url()); ?>"><?php echo esc_html__('Register Now', 'educatito') ?></a>
                    <?php endif; ?>
                </p>
            </div>
        </form>
        <?php
    }

endif;
/*
 * Educatito Show Login Register
*/
if (!function_exists('educatito_show_login')):

    function educatito_show_login() {
        if (is_user_logged_in()) {
            if (in_array('learnpress/learnpress.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                ?>
                <a href="<?php echo esc_url(learn_press_user_profile_link()); ?>"><?php echo esc_html__('Profile', 'educatito'); ?></a>
            <?php } ?>
            <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>"><?php echo esc_html__('Logout', 'educatito'); ?></a>
            <?php
        } else {
            ?>
            <div class="main-nav">
                <a class="cd-signin button-login" href="javascript:void(0)"><?php echo esc_html__('Register Or Login', 'educatito'); ?></a>
            </div>
            <?php
        }
    }

endif;
/*
 * Educatito Show Logo
*/
if (!function_exists('educatito_show_logo')):

    function educatito_show_logo() {
        global $post, $educatito_options;
        //main logo
        if (isset($educatito_options['jrb_logo'])) {
            $url_logo = $educatito_options['jrb_logo']['url'];
        } else {
            $url_logo = EDUCATITO_THEME_URI . "/assets/images/logo.png";
        }
        if (isset($post)) {
            $meta_data = educatito_option_meta_id($post->ID);
        }
        if (!empty($meta_data)):
            if (isset($meta_data->_jrb_header) && $meta_data->_jrb_header != '') {
                if (isset($meta_data->_jrb_custom_logo) && $meta_data->_jrb_custom_logo != '') {
                    $url_logo = wp_get_attachment_url($meta_data->_jrb_header_logo_page);
                }
            }
        endif;

        //mobile menu
        if (isset($educatito_options['jrb_logo_mobile'])) {
            $url_logo_mobile = $educatito_options['jrb_logo_mobile']['url'];
        } else {
            $url_logo_mobile = EDUCATITO_THEME_URI . "/assets/images/logo.png";
        }

        //logo sticky
        if (isset($educatito_options['jrb_logo_sticky'])) {
            $url_logo_sticky = $educatito_options['jrb_logo_sticky']['url'];
        } else {
            $url_logo_sticky = EDUCATITO_THEME_URI . "/assets/images/logo.png";
        }
        ?>
        <a class="educatito-logo" href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo esc_url($url_logo); ?>" alt="<?php esc_attr(bloginfo('name')); ?>"
                 style="max-height: <?php echo esc_attr(educatito_opts_get('jrb_logo_max_height')); ?>; margin:<?php echo esc_attr(educatito_opts_get('jrb_margin_logo')); ?>; padding:<?php echo esc_attr(educatito_opts_get('jrb_padding_logo')); ?>;" class="normal-logo logo-main"/>
            <img class="logo-sticky" src="<?php echo esc_url($url_logo_sticky); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" />
            <img class="logo-mobile" src="<?php echo esc_url($url_logo_mobile); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" />
        </a>
        <?php
    }

endif;


/*
 * Educatito Menu Cart
*/
if (!function_exists('educatito_menu_cart')):
    add_action('educatito_woo_menu', 'educatito_menu_cart');

    function educatito_menu_cart() {
        global $woocommerce;
        // get cart quantity
        $qty = esc_attr(WC()->cart->get_cart_contents_count());
        // get cart url
        $cart_url = esc_url(wc_get_cart_url());
        ?>
        <a href="<?php echo esc_url($cart_url); ?>" class="cart">
            <span class="ion-bag"></span>
            <span class="number ajax-count-cart"><?php echo esc_attr($qty); ?></span>
        </a>
        <?php
        if (function_exists('is_woocommerce')) {
            do_action('educatito_show_cart_checkout');
        }
    }

endif;
/*
 * Educatito Menu Cart 2
*/
if (!function_exists('educatito_menu_cart2')):
    add_action('educatito_woo_menu2', 'educatito_menu_cart2');

    function educatito_menu_cart2() {
        global $woocommerce;
        // get cart quantity
        $qty = esc_attr(WC()->cart->get_cart_contents_count());
        // get cart url
        $cart_url = esc_url(wc_get_cart_url());
        ?>
        <a href="<?php echo esc_url($cart_url); ?>" class="cart">
            <span class="ion-briefcase"></span>
            <?php echo esc_html__('Cart', 'educatito'); ?>
            <?php echo esc_html__('(', 'educatito'); ?><span class="number ajax-count-cart"><?php echo  esc_attr($qty); ?></span><?php echo esc_html__(')', 'educatito'); ?>
        </a>
        <?php
        if (function_exists('is_woocommerce')) {
            do_action('educatito_show_cart_checkout');
        }
    }

endif;
/*
 * Educatito Mini Cart
*/
add_action('educatito_show_cart_checkout', 'educatito_show_cart_checkout_process');
if (!function_exists('educatito_show_cart_checkout_process')):

    function educatito_show_cart_checkout_process() {
        global $educatito_options, $post;
        ?>
        <div class="display-posion-cart">
            <div class="cart-block-content widget_shopping_cart_content">
                <?php get_template_part('woocommerce/cart/mini', 'cart'); ?>
            </div>
        </div>
        <?php
    }

endif;
/*
 * Educatito Mini Cart 2
*/
if (!function_exists('educatito_show_cart_checkout_process2')):

    function educatito_show_cart_checkout_process2() {
        global $educatito_options, $post;
        ob_start();
        ?>
        <div class="display-posion-cart">
            <div class="cart-block-content widget_shopping_cart_content">
                <?php get_template_part('woocommerce/cart/mini', 'cart'); ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
endif;

/*------------------------Footer--------------------*/
if (!function_exists('educatito_style_footer')):
    add_action('wp_head', 'educatito_style_footer');

    function educatito_style_footer() {
        global $educatito_options, $post;
        if ($post) {
            $meta_data = educatito_option_meta_id($post->ID);
        }
        $style = '';
        if (isset($educatito_options['jrb_footer_top_bg_image']['url']) && $educatito_options['jrb_footer_top_bg_image']['url'] != ''):
            $style .= '.footer{ background:url("' . $educatito_options['jrb_footer_top_bg_image']['url'] . '"); ' . ((isset($educatito_options['jrb_footer_top_bg_full']) && $educatito_options['jrb_footer_top_bg_full']) ? 'background-size:100%;' : '') . ' background-repeat:' . $educatito_options['jrb_footer_top_bg_repeat'] . '; color: ' . $educatito_options['jrb_color_footer'] . ';}';
            $style .= '.footer-bottom{ background: ' . $educatito_options['jrb_backgroud_footer_bottom'] . '; }';
            $style .= '.footer .sec-padding{ padding:' . $educatito_options['jrb_footer_top_padding'] . '; margin:' . $educatito_options['jrb_footer_top_margin'] . ';}';
            $style .= '.footer .footer-widget ul li a{ color: ' . $educatito_options['jrb_color_link_footer'] . ';}';
            $style .= '.footer .footer-widget ul li a:hover{ color: ' . $educatito_options['jrb_color_link_hover_footer'] . ';}';
            $style .= '.footer .col-footer .footer-widget .title{ color: ' . $educatito_options['jrb_color_heading_footer'] . ';}';
        elseif (isset($educatito_options['jrb_backgroud_footer'])):
            $style .= '.footer{ background: ' . $educatito_options['jrb_backgroud_footer'] . '; ' . ((isset($educatito_options['jrb_footer_top_bg_full']) && $educatito_options['jrb_footer_top_bg_full']) ? 'background-size:100%;' : '') . ' background-repeat:' . $educatito_options['jrb_footer_top_bg_repeat'] . '; color: ' . $educatito_options['jrb_color_footer'] . ';}';
            $style .= '.footer-bottom{ background: ' . $educatito_options['jrb_backgroud_footer_bottom'] . '; }';
            $style .= '.footer .sec-padding{ padding:' . $educatito_options['jrb_footer_top_padding'] . '; margin:' . $educatito_options['jrb_footer_top_margin'] . ';}';
            $style .= '.footer .footer-widget ul li a{ color: ' . $educatito_options['jrb_color_link_footer'] . ';}';
            $style .= '.footer .footer-widget ul li a:hover{ color: ' . $educatito_options['jrb_color_link_hover_footer'] . ';}';
            $style .= '.footer .col-footer .footer-widget .title{ color: ' . $educatito_options['jrb_color_heading_footer'] . ';}';
        endif;
        $custom_color_footer = '';
        if (!empty($meta_data)):
            if ($meta_data->_jrb_footer) {
                if ($meta_data->_jrb_custom_color_footer) {
                    $custom_color_footer .= '.page-id-' . $post->ID . ' .footer{ background: ' . urldecode($meta_data->_jrb_background_color_footer) . '; color: ' . urldecode($meta_data->_jrb_color_footer) . ';}';
                    $custom_color_footer .= '.page-id-' . $post->ID . ' .footer .footer-widget ul li a{ color: ' . urldecode($meta_data->_jrb_color_link_footer) . ';}';
                    $custom_color_footer .= '.page-id-' . $post->ID . ' .footer .footer-widget ul li a:hover{ color: ' . urldecode($meta_data->_jrb_color_link_hover_footer) . ';}';
                    $custom_color_footer .= '.page-id-' . $post->ID . ' .footer .footer-widget .title{ color: ' . urldecode($meta_data->_jrb_color_heading_footer) . ';}';
                }
            }
        endif;
        echo '<style type="text/css">' . wp_kses_post($style) . wp_kses_post($custom_color_footer) . '</style>';
    }

endif;

/*
 * Load Footer 
*/
if (!function_exists('educatito_theme_footer')):
    add_action('educatito_theme_footer', 'educatito_theme_footer');

    function educatito_theme_footer() {

       global $educatito_options, $post;

        if ($post) {
            $meta_data = educatito_option_meta_id($post->ID);
        }
        $jrb_footer = '';
        if (!empty($meta_data)):
            if ($meta_data->_jrb_footer) {
                if ($meta_data->_jrb_custom_widget_footer) {
                    $jrb_footer = 'v' . $meta_data->_jrb_footer_custom_layout;
                }
            }
        endif;
        if ($jrb_footer == '') {
            if (isset($educatito_options['jrb_footer']) && $educatito_options['jrb_footer']) {
                if (isset($educatito_options['jrb_footer_widget']) && $educatito_options['jrb_footer_widget']) {
                    do_action('educatito_footer_widget');
                }
                if (isset($educatito_options['jrb_footer_bottom']) && $educatito_options['jrb_footer_bottom']) {
                    do_action('educat_footer_bottom');
                }
            }
        } elseif ($jrb_footer == 'v2') {
            if (isset($educatito_options['jrb_footer']) && $educatito_options['jrb_footer']) {
                if (isset($educatito_options['jrb_footer_widget']) && $educatito_options['jrb_footer_widget']) {
                    do_action('educatito_footer_widget_v2');
                }
                if (isset($educatito_options['jrb_footer_bottom']) && $educatito_options['jrb_footer_bottom']) {
                    $year = date("Y");
                    ?>
                    <div class="footer-bottom">
                        <div class="footer-container uk-container-center">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1">
                                    <div class="copyright text-center">
                                        <p>&copy; <?php echo esc_attr($year); ?> <span><?php echo esc_html__('Educatito', 'educatito'); ?></span>, <?php echo esc_html__('All rights reserved.', 'educatito'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        } else {
            if (isset($educatito_options['jrb_footer']) && $educatito_options['jrb_footer']) {
                if (isset($educatito_options['jrb_footer_widget']) && $educatito_options['jrb_footer_widget']) {
                    do_action('educatito_footer_widget_v3');
                }
                if (isset($educatito_options['jrb_footer_bottom']) && $educatito_options['jrb_footer_bottom']) {
                    do_action('educat_footer_bottom_v3');
                }
            }
        }
        if (empty($educatito_options)) {
            $year = date("Y");
            ?>
            <div class="footer-bottom">
                <div class="footer-container uk-container-center">
                    <div class="uk-grid uk-grid-small">
                        <div class="uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1">
                            <div class="copyright text-center">
                                <p>&copy; <?php echo esc_attr($year); ?> <span><?php echo esc_html__('Educatito', 'educatito'); ?></span>, <?php echo esc_html__('All rights reserved.', 'educatito'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        if (isset($educatito_options['jrb_footer_backtotop']) && $educatito_options['jrb_footer_backtotop'] == 1) {
            ?>
<div id="educatito_backtop" class="educatito-scroll-top bg-primary-color"><span class="fa fa-angle-up"></span></div>
            <?php
        }
    }

endif;

/*
 * Load Footer Widget 
*/
if (!function_exists('educatito_footer_widget')) {
    add_action("educatito_footer_widget", "educatito_footer_widget");

    function educatito_footer_widget() {
        global $educatito_options;

        $layouts = explode('_', $educatito_options['jrb_footer_widgets_layout']);
        if (is_active_sidebar('educatito_footer_1') || is_active_sidebar('educatito_footer_2') || is_active_sidebar('educatito_footer_3') || is_active_sidebar('educatito_footer_4')) :
            ?>
            <footer class = "footer">
                <div class="sec-padding">
                    <div class = "footer-container uk-container-center">
                        <div class = "uk-grid">
                            <?php
                            foreach ($layouts as $i => $layout) {
                                ?>
                                <div class = "uk-width-medium-<?php echo esc_attr($layout); ?> uk-width-small-1-1 uk-width-1-1 col-footer">
                                    <?php
                                    educatito_dynamic_sidebar("educatito_footer_" . ($i + 1));
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </footer>
            <?php
        endif;
    }

}
/*
 * Load Footer Widget 2
*/
if (!function_exists('educatito_footer_widget_v2')) {
    add_action("educatito_footer_widget_v2", "educatito_footer_widget_v2");

    function educatito_footer_widget_v2() {
        if (is_active_sidebar('educatito_footer_v2_1') || is_active_sidebar('educatito_footer_v2_2') || is_active_sidebar('educatito_footer_v2_3') || is_active_sidebar('educatito_footer_v2_4')) :
            ?>
            <footer class = "footer footer-widget-v2">
                <div class="sec-padding">
                    <div class = "uk-container uk-container-center">
                        <div class = "uk-grid">
                            <div class = "uk-width-medium-1-4 uk-width-small-1-1 uk-width-1-1 col-footer">
                                <?php
                                educatito_dynamic_sidebar("educatito_footer_v2_1");
                                ?>
                            </div>
                            <div class = "uk-width-medium-1-6 uk-width-small-1-1 uk-width-1-1 col-footer">
                                <?php
                                educatito_dynamic_sidebar("educatito_footer_v2_2");
                                ?>
                            </div>
                            <div class = "uk-width-medium-1-4 uk-width-small-1-1 uk-width-1-1 col-footer">
                                <?php
                                educatito_dynamic_sidebar("educatito_footer_v2_3");
                                ?>
                            </div>
                            <div class = "uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 col-footer">
                                <?php
                                educatito_dynamic_sidebar("educatito_footer_v2_4");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <?php
        endif;
    }

}
/*
 * Load Footer Widget 3
*/
if (!function_exists('educatito_footer_widget_v3')) {
    add_action("educatito_footer_widget_v3", "educatito_footer_widget_v3");

    function educatito_footer_widget_v3() {
        if (is_active_sidebar('educatito_footer_v3_1') || is_active_sidebar('educatito_footer_v3_2')) :
            ?>
            <footer class = "footer footer-widget-v3">
                <div class="sec-padding">
                    <div class = "footer-container uk-container-center">
                        <div class = "uk-grid">
                            <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1 col-footer">
                                <?php
                                educatito_dynamic_sidebar("educatito_footer_v3_1");
                                ?>
                            </div>
                            <div class = "uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1 col-footer">
                                <?php
                                educatito_dynamic_sidebar("educatito_footer_v3_2");
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <?php
        endif;
    }

}
/*
 * Load Footer Bottom
 */
if (!function_exists('educat_footer_bottom')) {
    add_action('educat_footer_bottom', 'educat_footer_bottom');

    function educat_footer_bottom() {
        global $educatito_options;
        ?>
        <div class="footer-bottom footer-bottom-v1">
            <div class="footer-container uk-container-center">
                <div class="uk-clearfix">
                    <div class="copyright active uk-float-left">
                        <p><?php echo esc_attr($educatito_options['jrb_copyright']); ?></p>
                    </div>
                    <div class="menu-bottom uk-float-right">
                        <?php do_action('educatito_social_site'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
/*
 * Load Footer Bottom V3
*/
if (!function_exists('educat_footer_bottom_v3')) {
    add_action('educat_footer_bottom_v3', 'educat_footer_bottom_v3');

    function educat_footer_bottom_v3() {
        global $educatito_options;
        ?>
        <div class="footer-bottom footer-bottom-v3">
            <div class="footer-container uk-container-center">
                <div class="uk-clearfix">
                    <div class="copyright active uk-float-left">
                        <p><?php echo esc_attr($educatito_options['jrb_copyright']); ?></p>
                    </div>
                    <div class="menu-bottom uk-float-right">
                        <?php do_action('educatito_social_site'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
if (!function_exists('educatito_objectToArray')) {

    function educatito_objectToArray($object) {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        return array_map('educatito_objectToArray', (array) $object);
    }

}