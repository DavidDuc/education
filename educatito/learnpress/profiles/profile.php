<?php
/**
 * @author   JRBthemes
 * @package  Learnpress/Templates
 * @version  3.0.0
 */
/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit();

$profile = LP_Global::profile();
if ($profile->is_public()) {
    ?>
        <div id="learn-press-user-profile"<?php $profile->main_class(); ?>>

            <?php
              
            /**
             * @since 3.0.0
             */
            do_action('learn-press/before-user-profile', $profile);

            /**
             * @since 3.0.0
             */
            do_action('learn-press/user-profile', $profile);

            /**
             * @since 3.0.0
             */
            do_action('learn-press/after-user-profile', $profile);
            ?>

        </div>
    <?php
} else {
    esc_html_e('This user does not public their profile.', 'educatito');
}