<?php

/*
 * functions
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 */
define('EDUCATITO_THEME_DIR', get_template_directory());
define('EDUCATITO_THEME_URI', get_template_directory_uri());
define('EDUCATITO_THEME_URL', get_stylesheet_directory());
define('EDUCATITO_STYLESHEET_URI', get_stylesheet_uri());

define('EDUCATITO_LIBS_DIR', EDUCATITO_THEME_DIR . '/inc');
define('EDUCATITO_LIBS_URI', EDUCATITO_THEME_URI . '/inc');
define('EDUCATITO_LANG_DIR', EDUCATITO_THEME_DIR . '/languages');
define('EDUCATITO_THEME_VERSION', '1.0');

global $educatito_options;

load_theme_textdomain('educatito', EDUCATITO_LANG_DIR);

// Slider Revolution
if (isset($educatito_options['jrb_enable_rev']) && $educatito_options['jrb_enable_rev'] == 1) {
    if (function_exists('set_revslider_as_theme')) {
        set_revslider_as_theme();
    }
}
// Visual Composer
if (isset($educatito_options['jrb_enable_visual_composer']) && $educatito_options['jrb_enable_visual_composer'] == 1) {
    add_action('vc_before_init', 'educatito_vcSetAsTheme');

    function educatito_vcSetAsTheme() {
        vc_set_as_theme();
    }

}

if (class_exists('WooCommerce')) {
    require_once( EDUCATITO_THEME_DIR . '/woocommerce/wc-template-function.php' );
    require_once( EDUCATITO_THEME_DIR . '/woocommerce/wc-template-hooks.php' );
}

/*
 * Setup Theme Support
 */
if (!isset($content_width)) {
    $content_width = 600;
}

if (!function_exists('educatito_fonts_url')) {

    function educatito_fonts_url() {
        $fonts_url = '';
        $lora = _x('on', 'Lora font: on or off', 'educatito');
        $open_sans = _x('on', 'Open Sans font: on or off', 'educatito');
        if ('off' !== $lora || 'off' !== $open_sans) {
            $font_families = array();
            if ('off' !== $lora) {
                $font_families[] = 'Lora:400,700,400italic';
            }
            if ('off' !== $open_sans) {
                $font_families[] = 'Open Sans:700italic,400,800,600';
            }
            $query_args = array(
                'family' => urlencode(implode('|', $font_families)),
                'subset' => urlencode('latin,latin-ext'),
            );
            $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
        }
        return esc_url_raw($fonts_url);
    }

}
if (!function_exists('educatito_theme_support')):

    function educatito_theme_support() {
        add_theme_support('automatic-feed-links');
        add_theme_support('post-formats', array('aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'status'));
        add_theme_support("title-tag");
        add_theme_support('post-thumbnails');
        add_theme_support('woocommerce');
        add_theme_support('custom-header');
        add_theme_support('custom-background', apply_filters('educatito_custom_background_args', array(
            'default-color' => 'f5f5f5',
        )));
        add_editor_style(array('editor-style.css', educatito_fonts_url()));
    }

endif;
add_action('after_setup_theme', 'educatito_theme_support');

//Register Fonts
if (!function_exists('educatito_google_fonts_url')) {

    function educatito_google_fonts_url() {
        $font_url = '';
        if ('off' !== _x('on', 'Google font: on or off', 'educatito')) {
            $font_url = add_query_arg('family', urlencode('Roboto:100,100i,300,300i,400,400i,500,500i,700,700i|Montserrat:300,400,500,600,700'), "//fonts.googleapis.com/css");
        }
        return $font_url;
    }

}
//Enqueue scripts and styles.
if (!function_exists('educatito_google_fonts_scripts')) {

    function educatito_google_fonts_scripts() {
        wp_enqueue_style('educatito-google-fonts', educatito_google_fonts_url(), array(), null);
    }

}

if (!empty($educatito_options)) {
    if (isset($educatito_options['jrb_font_default_theme']) && $educatito_options['jrb_font_default_theme'] == 1):
        add_action('wp_enqueue_scripts', 'educatito_google_fonts_scripts');
    endif;
}else {
    add_action('wp_enqueue_scripts', 'educatito_google_fonts_scripts');
}
/*
 * Enqueue Style  
 */
if (!function_exists('educatito_frontend_styles')) {

    function educatito_frontend_styles() {
        $body_classes = get_body_class();
        // Add Style theme
        wp_enqueue_style('animate', EDUCATITO_THEME_URI . '/assets/css/animate.min.css', false);
        wp_enqueue_style('font-awesome', EDUCATITO_THEME_URI . '/assets/css/font-awesome.min.css', false);
        //slick
        wp_enqueue_style('slick', EDUCATITO_THEME_URI . '/assets/lib/slick-master/slick/slick.css', false);
        // owlcarousel
        wp_enqueue_style('owl-carousel', EDUCATITO_THEME_URI . '/assets/lib/owl-carousel/css/owl.carousel.min.css', false);
        // Normalize
        wp_enqueue_style('normalize', EDUCATITO_THEME_URI . '/assets/lib/normalize.css', false);

        //lightgallery
        wp_enqueue_style('lightgallery', EDUCATITO_THEME_URI . '/assets/lib/lightGallery/dist/css/lightgallery.min.css', false);

        // Uikit
        wp_enqueue_style('uikit', EDUCATITO_THEME_URI . '/assets/lib/uikit/css/uikit.min.css', false);
        wp_enqueue_style('sticky', EDUCATITO_THEME_URI . '/assets/lib/uikit/css/components/sticky.min.css', false);
        wp_enqueue_style('slidenav', EDUCATITO_THEME_URI . '/assets/lib/uikit/css/components/slidenav.min.css', false);
        wp_enqueue_style('slideshow', EDUCATITO_THEME_URI . '/assets/lib/uikit/css/components/slideshow.min.css', false);
        wp_enqueue_style('dotnav', EDUCATITO_THEME_URI . '/assets/lib/uikit/css/components/dotnav.min.css', false);
        wp_enqueue_style('slider', EDUCATITO_THEME_URI . '/assets/lib/uikit/css/components/slider.min.css', false);

        // Fotorama
        wp_enqueue_style('fotorama', EDUCATITO_THEME_URI . '/assets/lib/fotorama-4.6.4/fotorama.css', false);
        //Magnificpopup
        wp_enqueue_style('magnificpopup', EDUCATITO_THEME_URI . '/assets/lib/Magnificpopup/magnificpopup.css', false);
        // Educatito default css
        wp_enqueue_style('educatito-default', EDUCATITO_THEME_URI . '/assets/css/educatito-default.css', false);

        wp_enqueue_style('themify-icons', EDUCATITO_THEME_URI . '/assets/css/themify-icons.css', false);
        wp_enqueue_style('ionicons', EDUCATITO_THEME_URI . '/assets/css/ionicons.min.css', false);
        // style CSS
        wp_enqueue_style('educatito-style', EDUCATITO_THEME_URI . '/assets/css/style.css', false);
    }

}
add_action('wp_enqueue_scripts', 'educatito_frontend_styles');

/* ---------------------------------------------------------------------------
 * Enqueue Scripts
 * --------------------------------------------------------------------------- */
if (!function_exists('educatito_frontend_scripts')) {

    function educatito_frontend_scripts() {
        global $educatito_options;
        if (!is_admin()) {
            // singular | comment reply
            if (is_singular() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        }
        $body_classes = get_body_class();

        //scroll
        if (isset($educatito_options['use_smooth_scroll']) && $educatito_options['use_smooth_scroll'] == 1) {
            wp_enqueue_script('smoothscroll', EDUCATITO_THEME_URI . '/assets/js/smoothscroll.min.js', array('jquery'), false, true);
        }
        //ultimate
        wp_enqueue_script('ultimate', EDUCATITO_THEME_URI . '/assets/js/ultimate.min.js', array('jquery'), false, true);

        //hoverdir
        wp_enqueue_script('modernizr-custom', EDUCATITO_THEME_URI . '/assets/lib/hoverdir/modernizr.custom.97074.js', array('jquery'), false, false);
        wp_enqueue_script('jquery-hoverdir', EDUCATITO_THEME_URI . '/assets/lib/hoverdir/jquery.hoverdir.js', array('jquery'), false, true);
        //jquery.owl-filter
        wp_enqueue_script('jquery-owl-filter', EDUCATITO_THEME_URI . '/assets/js/jquery.owl-filter.min.js', array('jquery'), false, true);
        //owl.carousel
        wp_enqueue_script('owl-carousel', EDUCATITO_THEME_URI . '/assets/lib/owl-carousel/owl.carousel.min.js', array('jquery'), false, true);

        //waypoints
        wp_enqueue_script('waypoints', EDUCATITO_THEME_URI . '/assets/lib/jquery-waypoints/2.0.3/waypoints.min.js', array('jquery'), false, true);

        //particles
        wp_enqueue_script('particles', EDUCATITO_THEME_URI . '/assets/lib/particles/particles.min.js', array('jquery'), false, true);

        //lightgallery single portfolio
        wp_enqueue_script('lightgallery-all', EDUCATITO_THEME_URI . '/assets/lib/lightGallery/dist/js/lightgallery-all.min.js', array('jquery'), false, true);
        wp_enqueue_script('jquery-mousewheel', EDUCATITO_THEME_URI . '/assets/lib/lightGallery/dist/js/jquery.mousewheel.min.js', array('jquery'), false, true);

        //js mansory 
        wp_enqueue_script('isotope', EDUCATITO_THEME_URI . '/assets/js/isotope.pkgd.min.js', array('jquery'), false, true);
        // rtl
        if (in_array("rtl", $body_classes)):
            wp_enqueue_script('jscomposerfront', EDUCATITO_THEME_URI . '/assets/js/jscomposerfront.min.js', array('jquery'), false, true);
        endif;
        //-- BEGIN UIKIT--
        wp_enqueue_script('uikit', EDUCATITO_THEME_URI . '/assets/lib/uikit/js/uikit.min.js', array('jquery'), false, true);
        wp_enqueue_script('gird', EDUCATITO_THEME_URI . '/assets/lib/uikit/js/components/grid.min.js', array('jquery'), false, true);
        wp_enqueue_script('slider', EDUCATITO_THEME_URI . '/assets/lib/uikit/js/components/slider.min.js', array('jquery'), false, true);
        wp_enqueue_script('slideshow', EDUCATITO_THEME_URI . '/assets/lib/uikit/js/components/slideshow.min.js', array('jquery'), false, true);
        wp_enqueue_script('slideset', EDUCATITO_THEME_URI . '/assets/lib/uikit/js/components/slideset.min.js', array('jquery'), false, true);
        wp_enqueue_script('lightbox', EDUCATITO_THEME_URI . '/assets/lib/uikit/js/components/lightbox.min.js', array('jquery'), false, true);
        wp_enqueue_script('sticky', EDUCATITO_THEME_URI . '/assets/lib/uikit/js/components/sticky.min.js', array('jquery'), false, true);
        //-- END UIKIT--
        //slick
        wp_enqueue_script('slick', EDUCATITO_THEME_URI . '/assets/lib/slick-master/slick/slick.min.js', array('jquery'), false, true);
        //-- Fotorama
        wp_enqueue_script('fotorama', EDUCATITO_THEME_URI . '/assets/lib/fotorama-4.6.4/fotorama.js', array('jquery'), false, true);
        //sweetalert
        wp_enqueue_script('sweetalert', EDUCATITO_THEME_URI . '/assets/js/sweetalert.min.js', array('jquery'), false, true);
        //light box
        wp_register_script('html5lightbox', EDUCATITO_THEME_URI . '/assets/lib/html5lightbox/html5lightbox.js', array('jquery'), false, true);

        //loading
        wp_enqueue_script('modernizr', EDUCATITO_THEME_URI . '/assets/lib/loading/modernizr.min.js', array('jquery'), false, true);
        //Magnificpopup
        wp_enqueue_script('magnificpopup', EDUCATITO_THEME_URI . '/assets/lib/Magnificpopup/magnificpopup.min.js', array('jquery'), false, true);
        //js script theme
        wp_enqueue_script('educatito-script', EDUCATITO_THEME_URI . '/assets/js/script.js', array('jquery'), false, true);
        wp_localize_script('educatito-script', 'educaLoadmoreAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

}
add_action('wp_enqueue_scripts', 'educatito_frontend_scripts');

/*
 * Scripts Color picker
 */
if (!function_exists('educatito_color_picker_assets')) {

    function educatito_color_picker_assets($hook) {
        if ('widgets.php' != $hook) {
            return;
        }
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }

}
add_action('admin_enqueue_scripts', 'educatito_color_picker_assets');

/*
 * Enqueue Script Woocommerce
 */
if (!function_exists('educatito_woo_enqueue_script')) {

    function educatito_woo_enqueue_script() {
        if (function_exists('is_woocommerce')) {
            wp_enqueue_script('educatito-woo-js', EDUCATITO_THEME_URI . '/assets/js/woocommerce.js', array('jquery'), false, true);
        }
    }

}
add_action('wp_enqueue_scripts', 'educatito_woo_enqueue_script');
/*
 * Plugin Activation
 */
require_once( EDUCATITO_LIBS_DIR . '/plugins/init.php');
require_once( EDUCATITO_LIBS_DIR . '/custom-functions.php' );
require_once( EDUCATITO_LIBS_DIR . '/learnpress-functions.php' );
require_once( EDUCATITO_LIBS_DIR . '/custom-body.php' );
require_once( EDUCATITO_LIBS_DIR . '/libs/img-resizer.php');
require_once( EDUCATITO_LIBS_DIR . '/hooks.php');

/* Register Widget */
if (!function_exists('educatito_register_sidebars')) {
    add_action('widgets_init', 'educatito_register_sidebars');

    function educatito_register_sidebars() {
        global $educatito_options;
        if (function_exists('register_sidebar')) {
            /* -------- Sidebar Blog------------ */
            register_sidebar(array(
                'name' => esc_html__('Sidebar Blog', 'educatito'),
                'description' => esc_html__('Display sidebar blog page.', 'educatito'),
                'id' => 'educatito_sidebar_blog',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* -------- Sidebar Search 404------------ */
            register_sidebar(array(
                'name' => esc_html__('Sidebar Search 404', 'educatito'),
                'description' => esc_html__('Sidebar of all Search 404.', 'educatito'),
                'id' => 'educatito_search_404',
                'before_widget' => '<aside id="%1$s" class="%2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* -------- Sidebar Course------------ */
            register_sidebar(array(
                'name' => esc_html__('Sidebar Course', 'educatito'),
                'description' => esc_html__('Sidebar of all Course post.', 'educatito'),
                'id' => 'educatito_sidebar_lp_course',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* -------- Sidebar Shop------------ */
            register_sidebar(array(
                'name' => esc_html__('Sidebar Shop', 'educatito'),
                'description' => esc_html__('Display sidebar shop page.', 'educatito'),
                'id' => 'educatito_sidebar_shop',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* -------- Sidebar Page------------ */
            register_sidebar(array(
                'name' => esc_html__('Sidebar Page', 'educatito'),
                'description' => esc_html__('Sidebar Single of pages.', 'educatito'),
                'id' => 'educatito_sidebar_page',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* -------- Sidebar Archive------------ */
            register_sidebar(array(
                'name' => esc_html__('Sidebar Archive', 'educatito'),
                'description' => esc_html__('Sidebar Archive of archive pages.', 'educatito'),
                'id' => 'educatito_sidebar_archive',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* --------Footer Widget Column------------ */
            if (isset($educatito_options['jrb_footer_widget']) && $educatito_options['jrb_footer_widget']) {
                $layouts = explode('_', $educatito_options['jrb_footer_widgets_layout']);
                foreach ($layouts as $i => $layout) {
                    register_sidebar(array(
                        'name' => esc_html__('Footer Widget Column', 'educatito') . ' | #' . ($i + 1),
                        'id' => 'educatito_footer_' . ($i + 1),
                        'description' => esc_html__('Appears in the Footer Widget section of the site.', 'educatito'),
                        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h4 class="title">',
                        'after_title' => '</h4>',
                    ));
                }
            }
            /* --------Footer Widget Column 2------------ */
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Column 2', 'educatito') . ' | #1',
                'id' => 'educatito_footer_v2_1',
                'description' => esc_html__('Appears in the Footer Widget section of the site.', 'educatito'),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="title">',
                'after_title' => '</h4>',
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Column 2', 'educatito') . ' | #2',
                'id' => 'educatito_footer_v2_2',
                'description' => esc_html__('Appears in the Footer Widget section of the site.', 'educatito'),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="title">',
                'after_title' => '</h4>',
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Column 2', 'educatito') . ' | #3',
                'id' => 'educatito_footer_v2_3',
                'description' => esc_html__('Appears in the Footer Widget section of the site.', 'educatito'),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="title">',
                'after_title' => '</h4>',
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Column 2', 'educatito') . ' | #4',
                'id' => 'educatito_footer_v2_4',
                'description' => esc_html__('Appears in the Footer Widget section of the site.', 'educatito'),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="title">',
                'after_title' => '</h4>',
            ));
            /* --------Footer Widget Column 3------------ */
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Column 3', 'educatito') . ' | #Left',
                'id' => 'educatito_footer_v3_1',
                'description' => esc_html__('Appears in the Footer Widget section of the site.', 'educatito'),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="title">',
                'after_title' => '</h4>',
            ));
            register_sidebar(array(
                'name' => esc_html__('Footer Widget Column 3', 'educatito') . ' | #Right',
                'id' => 'educatito_footer_v3_2',
                'description' => esc_html__('Appears in the Footer Widget section of the site.', 'educatito'),
                'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h4 class="title">',
                'after_title' => '</h4>',
            ));
            /* --------Footer Bottom------------ */
            register_sidebar(array(
                'name' => esc_html__('Footer Bottom', 'educatito'),
                'description' => esc_html__('Footer Bottom of all page.', 'educatito'),
                'id' => 'educatito_footer_bottom',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* --------Footer Bottom v3------------ */
            register_sidebar(array(
                'name' => esc_html__('Footer Bottom V3', 'educatito'),
                'description' => esc_html__('Footer Bottom v3 of all page.', 'educatito'),
                'id' => 'educatito_footer_bottom_v3',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* --------Team Top Widget------------ */
            register_sidebar(array(
                'name' => esc_html__('Banner Course Single', 'educatito'),
                'description' => esc_html__('Banner Course Single', 'educatito'),
                'id' => 'educatito_banner_course_single',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* --------Testimonials Widget Footer------------ */
            register_sidebar(array(
                'name' => esc_html__('Testimonials Widget Footer', 'educatito'),
                'description' => esc_html__('Testimonials Widget Footer of all page.', 'educatito'),
                'id' => 'educatito_testimonial_footer',
                'before_widget' => '<aside id="%1$s" class="%2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));
            /* --------Testimonials Mega Menu------------ */
            register_sidebar(array(
                'name' => esc_html__('Mega Menu Widget', 'educatito'),
                'description' => esc_html__('Mega Menu Widget of all page.', 'educatito'),
                'id' => 'educatito_mega_menu_1',
                'before_widget' => '<aside id="%1$s" class="%2$s">',
                'after_widget' => '</aside>',
                'before_title' => '<h4>',
                'after_title' => '</h4>',
            ));

        }
    }

}
add_filter( 'learn-press/override-templates', function(){ return true; } );
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );


