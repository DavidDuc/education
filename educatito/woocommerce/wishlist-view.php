<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.12
 */
?>

<?php do_action('yith_wcwl_before_wishlist_form', $wishlist_meta); ?>
<div class="decs-to-shop">Product with varients has added to your wishlist. <a href="<?php echo esc_url(home_url('/')); ?>shop/">Click here</a> to continue shopping</div>
<form id="yith-wcwl-form" class="ro-cart-form" action="<?php echo esc_url(YITH_WCWL()->get_wishlist_url('view' . ( $wishlist_meta['is_default'] != 1 ? '/' . $wishlist_meta['wishlist_token'] : '' ))) ?>" method="post" class="woocommerce">
    <?php wp_nonce_field('yith-wcwl-form', 'yith_wcwl_form_nonce') ?>
    <?php
    do_action('yith_wcwl_before_wishlist_title');

    if (!empty($page_title)) :
        ?>
        <?php if ($wishlist_meta['is_default'] != 1 && $is_user_owner): ?>
            <div class="hidden-title-form">
                <input type="text" value="<?php echo esc_attr($page_title); ?>" name="wishlist_name"/>
                <button>
                    <?php echo wp_kses_post(apply_filters('yith_wcwl_save_wishlist_title_icon', '<i class="fa fa-check"></i>')) ?>
                    <?php echo esc_html__('Save', 'educatito') ?>
                </button>
                <a class="hide-title-form btn button">
                    <?php echo wp_kses_post(apply_filters('yith_wcwl_cancel_wishlist_title_icon', '<i class="fa fa-remove"></i>')) ?>
                    <?php echo esc_html__('Cancel', 'educatito') ?>
                </a>
            </div>
        <?php endif; ?>
        <?php
    endif;

    do_action('yith_wcwl_before_wishlist');
    ?>

    <!-- WISHLIST TABLE -->
    <table class="shop_table cart wishlist_table" data-pagination="<?php echo esc_attr($pagination) ?>" data-per-page="<?php echo esc_attr($per_page) ?>" data-page="<?php echo esc_attr($current_page) ?>" data-id="<?php echo ( is_user_logged_in() ) ? esc_attr($wishlist_meta['ID']) : '' ?>" data-token="<?php echo (!empty($wishlist_meta['wishlist_token']) && is_user_logged_in() ) ? esc_attr($wishlist_meta['wishlist_token']) : '' ?>">

        <?php $column_count = 2; ?>

        <thead>
            <tr>
                <?php if ($show_cb) : ?>

                    <th class="product-checkbox">
                        <input type="checkbox" value="" name="" id="bulk_add_to_cart"/>
                    </th>

                    <?php
                    $column_count ++;
                endif;
                ?>

                <?php if ($is_user_owner): ?>
                    <th class="product-remove"></th>
                    <?php
                    $column_count ++;
                endif;
                ?>

                <th class="product-thumbnail"></th>

                <th class="product-name">
                    <span class="nobr"><?php echo wp_kses_post(apply_filters('yith_wcwl_wishlist_view_name_heading', esc_html__('Product Name', 'educatito'))) ?></span>
                </th>

                <?php if ($show_price) : ?>

                    <th class="product-price">
                        <span class="nobr">
                            <?php echo wp_kses_post(apply_filters('yith_wcwl_wishlist_view_price_heading', esc_html__('Unit Price', 'educatito'))) ?>
                        </span>
                    </th>

                    <?php
                    $column_count ++;
                endif;
                ?>

                <?php if ($show_stock_status) : ?>

                    <th class="product-stock-stauts">
                        <span class="nobr">
                            <?php echo wp_kses_post(apply_filters('yith_wcwl_wishlist_view_stock_heading', esc_html__('Stock Status', 'educatito'))) ?>
                        </span>
                    </th>

                    <?php
                    $column_count ++;
                endif;
                ?>

                <?php if ($show_last_column) : ?>

                    <th class="product-add-to-cart"></th>

                    <?php
                    $column_count ++;
                endif;
                ?>
            </tr>
        </thead>

        <tbody>
            <?php
            if (count($wishlist_items) > 0) :
                foreach ($wishlist_items as $item) :
                    global $product;
                    if (function_exists('wc_get_product')) {
                        $product = wc_get_product($item['prod_id']);
                    } else {
                        $product = get_product($item['prod_id']);
                    }

                    if ($product !== false && $product->exists()) :
                        $availability = $product->get_availability();
                        $stock_status = $availability['class'];
                        ?>
                        <tr id="yith-wcwl-row-<?php echo esc_attr($item['prod_id']) ?>" data-row-id="<?php echo esc_attr($item['prod_id']) ?>">
                            <?php if ($show_cb) : ?>
                                <td class="product-checkbox">
                                    <input type="checkbox" value="<?php echo esc_attr($item['prod_id']) ?>" name="add_to_cart[]" <?php  if( $product->product_type != 'simple' ) { echo 'disabled="disabled"'; }else { echo ''; } ?>/>
                                </td>
                            <?php endif ?>

                            <?php if ($is_user_owner): ?>
                                <td class="product-remove">
                                    <div>
                                        <a href="<?php echo esc_url(add_query_arg('remove_from_wishlist', $item['prod_id'])) ?>" class="remove remove_from_wishlist" title="<?php echo esc_attr__('Remove this product', 'educatito') ?>">&times;</a>
                                    </div>
                                </td>
                            <?php endif; ?>

                            <td class="product-thumbnail">
                                <a href="<?php echo esc_url(get_permalink(apply_filters('woocommerce_in_cart_product', $item['prod_id']))) ?>">
                                    <?php echo wp_kses_post($product->get_image('full')) ?>
                                </a>
                            </td>

                            <td class="product-name">
                                <a href="<?php echo esc_url(get_permalink(apply_filters('woocommerce_in_cart_product', $item['prod_id']))) ?>"><?php echo wp_kses_post(apply_filters('woocommerce_in_cartproduct_obj_title', $product->get_title(), $product)) ?></a>
                                <?php do_action('yith_wccl_table_after_product_name', $item); ?>
                            </td>

                            <?php if ($show_price) : ?>
                                <td class="product-price">
                                    <?php
                                    if (is_a($product, 'WC_Product_Bundle')) {
                                        if ($product->min_price != $product->max_price) {
                                            echo sprintf('%s - %s', esc_attr(wc_price($product->min_price)), esc_attr(wc_price($product->max_price)));
                                        } else {
                                            echo esc_attr(c_price($product->min_price));
                                        }
                                    } elseif ($product->get_price() != '0') {
                                        echo wp_kses_post($product->get_price_html());
                                    } else {
                                        echo wp_kses_post(apply_filters('yith_free_text', esc_html__('Free!', 'educatito')));
                                    }
                                    ?>
                                </td>
                            <?php endif ?>

                            <?php if ($show_stock_status) : ?>
                                <td class="product-stock-status">
                                    <?php
                                    if ($stock_status == 'out-of-stock') {
                                        $stock_status = "Out";
                                        echo '<span class="wishlist-out-of-stock">' . esc_html__('Out of Stock', 'educatito') . '</span>';
                                    } else {
                                        $stock_status = "In";
                                        echo '<span class="wishlist-in-stock">' . esc_html__('In Stock', 'educatito') . '</span>';
                                    }
                                    ?>
                                </td>
                            <?php endif ?>

                            <?php if ($show_last_column): ?>
                                <td class="product-add-to-cart">
                                    <!-- Date added -->
                                    <?php
                                    if ($show_dateadded && isset($item['dateadded'])):
                                        /* translators: %s: Added on */
                                        echo '<span class="dateadded">' . sprintf(__('Added on : %s', 'educatito'), esc_attr(date_i18n(get_option('date_format'), strtotime($item['dateadded'])))) . '</span>';
                                    endif;
                                    ?>

                                    <!-- Add to cart button -->
                                    <?php if ($show_add_to_cart && isset($stock_status) && $stock_status != 'Out'): ?>
                                        <?php
                                        if (function_exists('wc_get_template')) {
                                            wc_get_template('loop/add-to-cart.php');
                                        } else {
                                            woocommerce_get_template('loop/add-to-cart.php');
                                        }
                                        ?>
                                    <?php endif ?>

                                    <!-- Change wishlist -->
                                    <?php if ($available_multi_wishlist && is_user_logged_in() && count($users_wishlists) > 1 && $move_to_another_wishlist): ?>
                                        <select class="change-wishlist selectBox">
                                            <option value=""><?php echo esc_html__('Move', 'educatito') ?></option>
                                            <?php
                                            foreach ($users_wishlists as $wl):
                                                if ($wl['wishlist_token'] == $wishlist_meta['wishlist_token']) {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo esc_attr($wl['wishlist_token']) ?>">
                                                    <?php
                                                    $wl_title = !empty($wl['wishlist_name']) ? esc_html($wl['wishlist_name']) : esc_html($default_wishlsit_title);
                                                    if ($wl['wishlist_privacy'] == 1) {
                                                        $wl_privacy = esc_html__('Shared', 'educatito');
                                                    } elseif ($wl['wishlist_privacy'] == 2) {
                                                        $wl_privacy = esc_html__('Private', 'educatito');
                                                    } else {
                                                        $wl_privacy = esc_html__('Public', 'educatito');
                                                    }

                                                    echo sprintf('%s - %s', esc_attr($wl_title), esc_attr($wl_privacy));
                                                    ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    <?php endif; ?>

                                    <!-- Remove from wishlist -->
                                    <?php if ($is_user_owner && $repeat_remove_button): ?>
                                    <a href="<?php echo esc_url(add_query_arg('remove_from_wishlist', $item['prod_id'])) ?>" class="remove_from_wishlist button" title="<?php echo esc_attr__('Remove this product', 'educatito') ?>"><?php echo esc_html__('Remove', 'educatito') ?></a>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php
                    endif;
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="<?php echo esc_attr($column_count) ?>" class="wishlist-empty"><?php echo esc_html__('No products were added to the wishlist', 'educatito') ?></td>
                </tr>
            <?php
            endif;

            if (!empty($page_links)) :
                ?>
                <tr class="pagination-row">
                    <td colspan="<?php echo esc_attr($column_count) ?>"><?php echo esc_attr($page_links) ?></td>
                </tr>
            <?php endif ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="<?php echo esc_attr($column_count) ?>">
                    <?php if ($show_cb) : ?>
                        <div class="custom-add-to-cart-button-cotaniner">
                            <a href="<?php echo esc_url(add_query_arg(array('wishlist_products_to_add_to_cart' => '', 'wishlist_token' => $wishlist_meta['wishlist_token']))) ?>" class="button alt" id="custom_add_to_cart"><?php echo wp_kses_post(apply_filters('yith_wcwl_custom_add_to_cart_text', esc_html__('Add the selected products to the cart', 'educatito'))) ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if (is_user_logged_in() && $is_user_owner && $show_ask_estimate_button && $count > 0): ?>
                        <div class="ask-an-estimate-button-container">
                            <a href="<?php echo esc_attr( $additional_info ) ? '#ask_an_estimate_popup' : esc_url($ask_estimate_url) ?>" class="btn button ask-an-estimate-button" <?php echo esc_attr( $additional_info ) ? 'data-rel="prettyPhoto[ask_an_estimate]"' : '' ?> >
                                <?php echo wp_kses_post(apply_filters('yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>')) ?>
                                <?php echo wp_kses_post(apply_filters('yith_wcwl_ask_an_estimate_text', esc_html__('Ask for an estimate', 'educatito'))) ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php
                    do_action('yith_wcwl_before_wishlist_share');

                    if (is_user_logged_in() && $is_user_owner && $wishlist_meta['wishlist_privacy'] != 2 && $share_enabled) {
                        yith_wcwl_get_template('share.php', $share_atts);
                    }

                    do_action('yith_wcwl_after_wishlist_share');
                    ?>
                </td>
            </tr>
        </tfoot>

    </table>

    <?php wp_nonce_field('yith_wcwl_edit_wishlist_action', 'yith_wcwl_edit_wishlist'); ?>

    <?php if ($wishlist_meta['is_default'] != 1): ?>
        <input type="hidden" value="<?php echo esc_attr($wishlist_meta['wishlist_token']) ?>" name="wishlist_id" id="wishlist_id">
    <?php endif; ?>

    <?php do_action('yith_wcwl_after_wishlist'); ?>

</form>

<?php do_action('yith_wcwl_after_wishlist_form', $wishlist_meta); ?>

<?php if ($additional_info): ?>
    <div id="ask_an_estimate_popup">
        <form action="<?php echo esc_url($ask_estimate_url) ?>" method="post" class="wishlist-ask-an-estimate-popup">
            <?php if (!empty($additional_info_label)): ?>
                <label for="additional_notes"><?php echo esc_html($additional_info_label) ?></label>
            <?php endif; ?>
            <textarea id="additional_notes" name="additional_notes"></textarea>

            <button class="btn button ask-an-estimate-button ask-an-estimate-button-popup" >
                <?php echo wp_kses_post(apply_filters('yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>')) ?>
                <?php echo esc_html__('Ask for an estimate', 'educatito') ?>
            </button>
        </form>
    </div>
<?php endif; ?>