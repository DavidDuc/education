<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119328093-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-119328093-1');
        </script>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> > 
    <?php wp_body_open(); ?>
        <?php

        do_action('load_page_wrapper');
        do_action('educatito_after_body_tag_hook');
        ?>
        <div id="educatito-wrapper">
            <?php do_action('educatito_header_template'); ?>