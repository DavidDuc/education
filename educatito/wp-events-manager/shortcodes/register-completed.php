<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

wpems_print_notices();
/* translators: %s: successfully registered  */
printf(
        wp_kses_post( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to <i>%s</i> the email address you entered.', 'educatito' ), wp_kses_post(get_bloginfo( 'name' )), esc_attr(sanitize_text_field(wp_unslash($_REQUEST['registered'])))
);
