<?php
/**
 * @author  JRBthemes
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Global::profile();

learn_press_display_message( sprintf( __( 'Please <a href="%s">login</a> to see your profile content', 'educatito' ), $profile->get_login_url() ) );