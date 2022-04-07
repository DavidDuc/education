<?php
/**
 * Single Product tabs
 * @author  JRB Themes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */
if (!defined('ABSPATH')) {
    exit;
}

$tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($tabs)) :
    ?>

    <div class="information">
        <ul  class="uk-subnav uk-subnav-pill" data-uk-switcher="{connect:'#switcher-content-a-fade', animation: 'fade'}">
            <?php
            foreach ($tabs as $key => $tab) :
                ?>
                <li>
                    <a href="javascript:;"><?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', esc_html($tab['title']), $key)); ?></a>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
        <ul id="switcher-content-a-fade" class="uk-switcher">
            <?php
            foreach ($tabs as $key => $tab) :
                ?>
                <li>
                    <div class="tab-content" id="tab_<?php echo esc_attr($key); ?>">
                        <?php call_user_func($tab['callback'], $key, $tab); ?>
                    </div>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
    </div>

<?php endif; ?>
