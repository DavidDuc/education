<?php
/**
 * Template for displaying sidebar in user profile.
 *
 * @author ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined('ABSPATH') || exit;

$profile = LP_Profile::instance();

$user = $profile->get_user();
$lp_info = get_the_author_meta('lp_info');
?>
<div id="learn-press-user-profile" class="lp-user-profile current-user has-sidebar">
    <div id="learn-press-profile-header" class="lp-profile-header">
        <div class="lp-profile-cover uk-clearfix">
            <div class="lp-profile-avatar">
                <?php echo wp_kses_post($user->get_profile_picture()); ?>
            </div>
            <div class="user-information">
                <h3 class="author-name"><?php echo wp_kses_post($user->get_display_name()); ?></h3>
                <?php
                // $lp_info = wp_kses_post(get_the_author_meta('lp_info', $user->get_id()));
                // ?>
                <ul class="educatito-author-social">
                    <?php if (isset($lp_info['facebook']) && $lp_info['facebook']) : ?>
                        <li>
                            <a href="<?php echo esc_url($lp_info['facebook']); ?>" class="facebook"><i
                                        class="fa fa-facebook"></i></a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($lp_info['twitter']) && $lp_info['twitter']) : ?>
                        <li>
                            <a href="<?php echo esc_url($lp_info['twitter']); ?>" class="twitter"><i
                                        class="fa fa-twitter"></i></a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($lp_info['google']) && $lp_info['google']) : ?>
                        <li>
                            <a href="<?php echo esc_url($lp_info['google']); ?>" class="google-plus"><i
                                        class="fa fa-google-plus"></i></a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($lp_info['linkedin']) && $lp_info['linkedin']) : ?>
                        <li>
                            <a href="<?php echo esc_url($lp_info['linkedin']); ?>" class="linkedin"><i
                                        class="fa fa-linkedin"></i></a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($lp_info['youtube']) && $lp_info['youtube']) : ?>
                        <li>
                            <a href="<?php echo esc_url($lp_info['youtube']); ?>" class="youtube"><i
                                        class="fa fa-youtube"></i></a>
                        </li>
                    <?php endif; ?>
                </ul>
                <p><?php echo wp_kses_post(get_user_meta($user->get_id(), 'description', true)); ?></p>
            </div>
        </div>
    </div>
</div>
<aside id="profile-sidebar">

    <?php do_action('learn-press/user-profile-tabs'); ?>

</aside>
