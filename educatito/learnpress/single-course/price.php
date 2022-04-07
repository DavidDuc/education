<?php
/**
 * @author  JRB Themes
 * @package LearnPress/Templates
 * @version 3.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $course;
$course = LP()->global['course'];
$is_required = $course->is_required_enroll();

?>
<div class="course-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	<?php if ( $course->is_free() || ! $is_required ) : ?>
		<div class="value free-course" itemprop="price" content="<?php esc_attr_e( 'Free', 'educatito' ); ?>">
			<?php esc_html_e( 'Free', 'educatito' ); ?>
		</div>
	<?php else: $price = learn_press_format_price( $course->get_price(), true ); ?>
		<div class="value " itemprop="price" content="<?php echo esc_attr( $price ); ?>">
			<?php echo esc_html( $price ); ?>
		</div>
	<?php endif; ?>
	<meta itemprop="priceCurrency" content="<?php echo wp_kses_post(learn_press_get_currency_symbol()); ?>" />

</div>

