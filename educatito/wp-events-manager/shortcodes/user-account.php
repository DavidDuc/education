<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

$query = new WP_Query( $args );

wpems_print_notices();

if ( !is_user_logged_in() ) {
    /* translators: %s: You are not */
	printf( wp_kses_post( 'You are not <a href="%s">login</a>', 'educatito' ), esc_url(wpems_login_url()) );
	return;
}

if ( $query->have_posts() ) :
	?>

    <table>
        <thead>
        <th><?php esc_html_e( 'Booking ID', 'educatito' ); ?></th>
        <th><?php esc_html_e( 'Events', 'educatito' ); ?></th>
        <th><?php esc_html_e( 'Type', 'educatito' ); ?></th>
        <th><?php esc_html_e( 'Cost', 'educatito' ); ?></th>
        <th><?php esc_html_e( 'Quantity', 'educatito' ); ?></th>
        <th><?php esc_html_e( 'Method', 'educatito' ); ?></th>
        <th><?php esc_html_e( 'Status', 'educatito' ); ?></th>
        </thead>
        <tbody>
		<?php foreach ( $query->posts as $post ): ?>

			<?php $booking = WPEMS_Booking::instance( $post->ID ) ?>
            <tr>
                <td><?php printf( '%s', wp_kses_post(wpems_format_ID( $post->ID ) )) ?></td>
                <td><?php printf( '<a href="%s">%s</a>', esc_url(get_the_permalink( $booking->event_id )), get_the_title( $booking->event_id ) ) ?></td>
                <td><?php printf( '%s', floatval( $booking->price ) == 0 ? wp_kses_post( 'Free', 'educatito' ) : wp_kses_post( 'Cost', 'educatito' ) ) ?></td>
                <td><?php printf( '%s', wp_kses_post(wpems_format_price( floatval( $booking->price ), $booking->currency )) ) ?></td>
                <td><?php printf( '%s', wp_kses_post($booking->qty) ) ?></td>
                <td><?php printf( '%s', wp_kses_post($booking->payment_id) ? wpems_get_payment_title( $booking->payment_id ) : __( 'No payment', 'educatito' ) ) ?></td>
                <th><?php printf( '%s', wp_kses_post(wpems_booking_status( $booking->ID ) )); ?></th>
            </tr>

		<?php endforeach; ?>
        </tbody>
    </table>

	<?php
	$args = array(
		'base'               => '%_%',
		'format'             => '?paged=%#%',
		'total'              => 1,
		'current'            => 0,
		'show_all'           => false,
		'end_size'           => 1,
		'mid_size'           => 2,
		'prev_next'          => true,
		'prev_text'          => __( '?? Previous', 'educatito' ),
		'next_text'          => __( 'Next ??', 'educatito' ),
		'type'               => 'plain',
		'add_args'           => false,
		'add_fragment'       => '',
		'before_page_number' => '',
		'after_page_number'  => ''
	);

	echo wp_kses_post(paginate_links( array(
		'base'      => str_replace( 9999999, '%#%', esc_url( get_pagenum_link( 9999999 ) ) ),
		'format'    => '?paged=%#%',
		'prev_text' => __( '?? Previous', 'educatito' ),
		'next_text' => __( 'Next ??', 'educatito' ),
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $query->max_num_pages
	) ));
	?>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
