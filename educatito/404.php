<?php
/*
  Template Name: 404 Template
 */
?>
<?php
global $educatito_options;
get_header();
?>
<section class="error-page full-screen">
    <div class="error-message">
        <?php if (!empty($educatito_options)) { ?>
            <?php
            if (isset($educatito_options['jrb_show_title_404']) && $educatito_options['jrb_show_title_404'] != 0) {
                if (isset($educatito_options['jrb_title_404']) && $educatito_options['jrb_title_404'] != '') {
                    ?>
                    <h2 class="title-404"><?php echo esc_attr($educatito_options['jrb_title_404']); ?></h2>  
                    <?php
                }
            }
            ?>
            <?php
            if (isset($educatito_options['jrb_show_content_404']) && $educatito_options['jrb_show_content_404'] != 0) {
                if (isset($educatito_options['jrb_content_404']) && $educatito_options['jrb_content_404'] != '') {
                    ?>
                    <p><?php echo esc_attr($educatito_options['jrb_content_404']); ?><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Home', 'educatito'); ?></a></p>
                    <?php
                }
            }
            ?>

        <?php } else { ?>
            <h2 class="title-404"><?php echo esc_html__('404 Error !', 'educatito'); ?></h2>
            <p><?php echo esc_html__('Sorry, we can not find the page you are looking for. Please go to', 'educatito'); ?><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Home', 'educatito'); ?></a></p>
        <?php } ?>
        <?php
        if (is_active_sidebar('educatito_search_404')) :
            educatito_dynamic_sidebar('educatito_search_404');
        endif;
        ?>
    </div>
</section>
<?php get_footer(); ?>