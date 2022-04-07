<?php
do_action('educatito_theme_footer');
if (in_array('educatito-addons/init.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    educatito_form_login();
}
?>
</div> 
<?php wp_footer(); ?> 
</body>
</html> 
