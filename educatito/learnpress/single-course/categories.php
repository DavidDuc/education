<?php
/**
 * @author   JRBthemes
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

do_action( 'learn_press_before_course_categories' );

$term_list = get_the_term_list( get_the_ID(), 'course_category', '', ', ', '' );
if ( $term_list ) :
	?>
	<div class="course-categories">
		<label><?php esc_html_e( 'Categories', 'educatito' ); ?></label>

		<div class="value">
			<?php

			printf(
				'<span class="cat-links">%s</span>',
				wp_kses_post($term_list)
			);
			?>
		</div>
	</div>
	<?php
endif;
do_action( 'learn_press_after_course_categories' );
