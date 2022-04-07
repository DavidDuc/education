<?php
global $educatito_options, $post;
if ($post) {
    $meta_data = educatito_option_meta_id($post->ID);
}
$sidebar_page = (isset($educatito_options['jrb_sidebar_page'])) ? $educatito_options['jrb_sidebar_page'] : 'no_sidebar';
$sidebar_archive = (isset($educatito_options['jrb_sidebar_archive'])) ? $educatito_options['jrb_sidebar_archive'] : 'no_sidebar';
$sidebar_single_portfolio = (isset($educatito_options['jrb_portfolio_detail_layout'])) ? $educatito_options['jrb_portfolio_detail_layout'] : 'full';
$sidebar_single_team = (isset($educatito_options['jrb_team_layout'])) ? $educatito_options['jrb_team_layout'] : 'full';

$body_classes = get_body_class();

if ((is_search() || is_archive()) && !in_array("tax-product_tag", $body_classes) && !in_array('tax-product_cat', $body_classes) && !in_array("post-type-archive-lp_course", $body_classes)):
    if ($sidebar_archive != 'no_sidebar'):
        $class_sidebar = ($sidebar_archive == 'sidebar_left') ? 'sidebar-left' : 'sidebar-right';
        ?>
        <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 <?php echo esc_attr($class_sidebar); ?>">
            <div class="inner_sidebar">
                <?php
                if (!is_post_type_archive('product')) {
                    educatito_dynamic_sidebar('educatito_sidebar_archive');
                }
                ?>
            </div>
        </div>
        <?php
    endif;
endif;

if (is_single() && $post->post_type != 'product' && $post->post_type != 'portfolio'):
    if (!empty($educatito_options)) {
        $sidebar_single_post = $educatito_options['jrb_sidebar_single_post'];
    } else {
        $sidebar_single_post = 'sidebar_right';
    }
    if ($sidebar_single_post != 'no_sidebar' && is_active_sidebar('educatito_sidebar_blog')):
        $class_sidebar = ($sidebar_single_post == 'sidebar_left') ? 'sidebar-left' : 'sidebar-right';
        ?>
        <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 <?php echo esc_attr($class_sidebar); ?>">
            <div class="inner_sidebar">
                <?php educatito_dynamic_sidebar('educatito_sidebar_blog'); ?>
            </div>
        </div>
        <?php
    endif;

endif;

if (is_single() && $post->post_type == 'portfolio'):
    if ($sidebar_single_portfolio != 'full'):
        $class_sidebar = ($sidebar_single_portfolio == 'left') ? 'sidebar-left' : 'sidebar-right';
        ?>
        <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 <?php echo esc_attr($class_sidebar); ?>">
            <div class="inner_sidebar">
                <?php educatito_dynamic_sidebar('educatito_sidebar_single_portfolio'); ?>
            </div>
        </div>
        <?php
    endif;

endif;

if (!is_search() && $post->post_type == 'team'):
    if ($sidebar_single_team != 'full'):
        $class_sidebar = ($sidebar_single_team == 'left') ? 'sidebar-left' : 'sidebar-right';
        ?>
        <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-4 uk-width-small-1-1 uk-width-1-1  <?php echo esc_attr($class_sidebar); ?>">
            <div class="inner_sidebar">
                <?php educatito_dynamic_sidebar('educatito_sidebar_team'); ?>
            </div>
        </div>
        <?php
    endif;

endif;

if (is_page()):
    if ($sidebar_page != 'no_sidebar') {

        if (!empty($meta_data)) {
            if (isset($meta_data->_jrb_show_sidebar) && $meta_data->_jrb_show_sidebar == 1) {
                if (isset($meta_data->_jrb_cus_sidebar_page) && $meta_data->_jrb_cus_sidebar_page != '') {
                    if ($meta_data->_jrb_educatito_show_sidebar) {
                        $class_sidebar = 'sidebar-left';
                    } else {
                        $class_sidebar = 'sidebar-right';
                    }
                    ?> 
                    <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 <?php echo esc_attr($class_sidebar); ?>">
                        <div class="inner_sidebar">
                            <?php
                            educatito_dynamic_sidebar($meta_data->_jrb_cus_sidebar_page);
                            ?>
                        </div>
                    </div>
                    <?php
                }
            } else {

                $class_sidebar = ($sidebar_page == 'sidebar_left') ? 'sidebar-left' : 'sidebar-right';
                ?>
                <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 <?php echo esc_attr($class_sidebar); ?>">
                    <div class="inner_sidebar">
                        <?php
                        educatito_dynamic_sidebar('educatito_sidebar_page');
                        ?>
                    </div>
                </div>
                <?php
            }
        } else {

            $class_sidebar = ($sidebar_page == 'sidebar_left') ? 'sidebar-left' : 'sidebar-right';
            ?>
            <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 <?php echo esc_attr($class_sidebar); ?>">
                <div class="inner_sidebar">
                    <?php
                    educatito_dynamic_sidebar('educatito_sidebar_page');
                    ?>
                </div>
            </div>
            <?php
        }
    } else {
        if (!empty($meta_data)):
            if (isset($meta_data->_jrb_show_sidebar) && $meta_data->_jrb_show_sidebar == 1) {
                if (isset($meta_data->_jrb_cus_sidebar_page) && $meta_data->_jrb_cus_sidebar_page != '') {
                    if ($meta_data->_jrb_educatito_show_sidebar) {
                        $class_sidebar = 'sidebar-left';
                    } else {
                        $class_sidebar = 'sidebar-right';
                    }
                    ?> 
                    <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 <?php echo esc_attr($class_sidebar); ?>">
                        <div class="inner_sidebar">
                            <?php
                            educatito_dynamic_sidebar($meta_data->_jrb_cus_sidebar_page);
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
        endif;
    }
endif;

if (in_array("blog", $body_classes)) {
    if (!empty($educatito_options)) {
        $sidebar_blog = $educatito_options['jrb_sidebar_blog'];
    } else {
        $sidebar_blog = 'sidebar_right';
    }
    if (isset($_GET['sidebar']) && $_GET['sidebar'] == 'left') {
        $sidebar_blog = 'sidebar_left';
    }else if(isset($_GET['sidebar']) && $_GET['sidebar'] == 'right'){
        $sidebar_blog = 'sidebar_right';
    }
    if ($sidebar_blog != 'no_sidebar' && is_active_sidebar('educatito_sidebar_blog')):
        $class_sidebar = ($sidebar_blog == 'sidebar_left') ? 'sidebar-left' : 'sidebar-right';
        ?>
        <div class="educatito_sidebar uk-width-large-1-4 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 <?php echo esc_attr($class_sidebar); ?>">
            <div class="inner_sidebar"> 
                <?php educatito_dynamic_sidebar('educatito_sidebar_blog'); ?>
            </div>
        </div>
        <?php
    endif;
}
