<?php
/**
 * @author   JRBthemes
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

$args = array( 'item' => $item, 'section' => $section );

/**
 * @since 3.0.0
 */
do_action( 'learn-press/before-section-loop-item', $item );

learn_press_get_template( "single-course/section/" . $item->get_template(), $args );

/**
 * @since 3.0.0
 *
 */
do_action( 'learn-press/after-section-loop-item', $item, $section );
?>