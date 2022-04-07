<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
get_template_part("inc/plugins/tgm");

/* ---------------------------------------------------------------------------
 * 	Educatito Plugin Activation
 * --------------------------------------------------------------------------- */
add_action('tgmpa_register', 'educatito_register_required_plugins');
if (!function_exists('educatito_register_required_plugins')) {

    function educatito_register_required_plugins() {
        $plugins = array(
            array(
                'name' => esc_html__('Educatito Addons', 'educatito'),
                'slug' => 'educatito-addons',
                'source' => EDUCATITO_THEME_URI . '/inc/plugins/files/educatito-addons.zip',
                'required' => true,
                'version' => '',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
                'is_callable' => '',
            ),
              array(
                'name' => esc_html__('Educatito Options', 'educatito'),
                'slug' => 'educatito-options',
                'source' => EDUCATITO_THEME_URI . '/inc/plugins/files/educatito-options.zip',
                'required' => true,
                'version' => '',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
                'is_callable' => '',
            ),
            array(
                'name' => esc_html__('Visual Composer', 'educatito'),
                'slug' => 'js_composer',
                'source' => EDUCATITO_THEME_URI . '/inc/plugins/files/js_composer.zip',
                'required' => true,
                'version' => '',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
                'is_callable' => '',
            ),
            array(
                'name' => esc_html__('Ultimate VC Addons', 'educatito'),
                'slug' => 'Ultimate_VC_Addons',
                'source' => EDUCATITO_THEME_URI . '/inc/plugins/files/Ultimate_VC_Addons.zip',
                'required' => true,
                'version' => '',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
                'is_callable' => '',
            ),
            array(
                'name' => esc_html__('Slider Revolution', 'educatito'),
                'slug' => 'revslider',
                'source' => EDUCATITO_THEME_URI . '/inc/plugins/files/revslider.zip',
                'required' => true,
                'version' => '',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
                'is_callable' => '',
            ),
            array(
                'name' => esc_html__('Ninja Form', 'educatito'),
                'slug' => 'ninja-forms',
                'required' => true,
            ),
            array(
                'name' => esc_html__('WooCommerce', 'educatito'),
                'slug' => 'woocommerce',
                'required' => true,
            ),
            array(
                'name' => esc_html__('WooCommerce Quick View', 'educatito'),
                'slug' => 'yith-woocommerce-quick-view',
                'required' => true,
            ),
            array(
                'name' => esc_html__('Comments Like Dislike', 'educatito'),
                'slug' => 'comments-like-dislike',
                'required' => true,
            ),
            array(
                'name' => esc_html__('Learnpress', 'educatito'),
                'slug' => 'learnpress',
                'required' => true,
            ),
            array(
                'name' => esc_html__('Learnpress Course Review', 'educatito'),
                'slug' => 'learnpress-course-review',
                'required' => true,
            ),
            array(
                'name' => esc_html__('Newsletter', 'educatito'),
                'slug' => 'newsletter',
                'required' => true,
            ),
            array(
                'name' => esc_html__('Events Manager', 'educatito'),
                'slug' => 'wp-events-manager',
                'required' => true,
            ),
        );

        $config = array(
            'id' => 'educatito-tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '', // Default absolute path to bundled plugins.
            'menu' => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug' => 'themes.php', // Parent menu slug.
            'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices' => true, // Show admin notices or not.
            'dismissable' => true, // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false, // Automatically activate plugins after installation or not.
            'message' => '<div class="mfn-tgm-message">' . sprintf(__('If you are not sure about server\'s settings and limits, please activate <u>necessary plugins ONLY</u>', 'educatito')) . '</div>', // Message to output right before the plugins table
            'strings' => array(
                'page_title' => esc_html__('Install Required Plugins', 'educatito'),
                'menu_title' => esc_html__('Install Plugins', 'educatito'),
                /* translators: %s: Installing Plugin */
                'installing' => esc_html__('Installing Plugin: %s', 'educatito'), // %s = plugin name.
                'oops' => esc_html__('Something went wrong with the plugin API.', 'educatito'),
                /* translators: %s: theme requires the following plugin */
                'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'educatito'), // %1$s = plugin name(s).
                /* translators: %s: theme recommends the following plugin */
                'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'educatito'), // %1$s = plugin name(s).
                /* translators: %s: permissions to install */
                'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'educatito'), // %1$s = plugin name(s).
                /* translators: %s: required plugin is currently inactive */
                'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'educatito'), // %1$s = plugin name(s).
                /* translators: %s: recommended plugin is currently inactive */
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'educatito'), // %1$s = plugin name(s).
                /* translators: %s: the correct permissions to activate */
                'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'educatito'), // %1$s = plugin name(s).
                /* translators: %s: The following plugin needs to be updated */
                'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'educatito'), // %1$s = plugin name(s).
                /* translators: %s: you do not have the correct */
                'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'educatito'), // %1$s = plugin name(s).
                'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'educatito'),
                'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins', 'educatito'),
                'return' => esc_html__('Return to Required Plugins Installer', 'educatito'),
                'plugin_activated' => esc_html__('Plugin activated successfully.', 'educatito'),
                /* translators: %s: All plugins installed and activated successfully */
                'complete' => esc_html__('All plugins installed and activated successfully. %s', 'educatito'), // %s = dashboard link.
                'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            ),
        );

        tgmpa($plugins, $config);
    }

}
