<?php
/*******************************************************************************
 * Title Bar Shop.
 *
 * @package Educatito
 * @author JRBthemes
 * @link http://educa.jrbthemes.com
 ******************************************************************************/

global $educatito_options;
$educatito_show_page_title_shop = isset($educatito_options['jrb_show_page_title_shop']) ? $educatito_options['jrb_show_page_title_shop'] : 0;
$educatito_show_page_breadcrumb_shop = isset($educatito_options['jrb_show_page_breadcrumb_shop']) ? $educatito_options['jrb_show_page_breadcrumb_shop'] : 0;
$class = array();
$class[] = 'product-title-bar educatito_title_bar';
?>
<?php if ($educatito_show_page_title_shop || $educatito_show_page_breadcrumb_shop) { ?>
    <div class="educatito-title-wrapper">
        <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
            <div class="uk-container uk-container-center">
                <div class="box uk-clearfix">
                    <?php if ($educatito_show_page_title_shop) { ?>
                        <h1 class="educatito-title"><?php echo esc_attr(educatito_woocommerce_page_title()); ?></h1>
                    <?php } ?>
                    <?php if ($educatito_show_page_breadcrumb_shop) { ?>
                        <div class="educatito-breadcrumb">
                            <?php woocommerce_breadcrumb(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    ?>
    <div class="educatito-title-wrapper">
        <div class="<?php echo esc_attr(implode(' ', $class)); ?>">
            <div class="uk-container uk-container-center">
                <div class="box uk-clearfix">
                        <h1 class="educatito-title"><?php echo esc_attr(educatito_woocommerce_page_title()); ?></h1>
                        <div class="educatito-breadcrumb">
                            <?php woocommerce_breadcrumb(); ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <?php }
?>