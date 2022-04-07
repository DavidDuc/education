<?php
/**
 * Theme Functions Child
 *
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 */
/* ---------------------------------------------------------------------------
 * Styles  
 * --------------------------------------------------------------------------- */
if (!function_exists('educatito_child_enqueue_styles')) {

    function educatito_child_enqueue_styles() {

        wp_enqueue_style('educatito-style-2', get_template_directory_uri() . '/style.css');

        wp_enqueue_style('educatito-child-style', get_stylesheet_directory_uri() . '/style.css', array('educatito-style-2'));
    }
}
add_action('wp_enqueue_scripts', 'educatito_child_enqueue_styles');
