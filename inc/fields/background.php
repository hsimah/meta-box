<?php
/**
 * The background field.
 *
 * @package Meta Box.
 */

/**
 * The Background field.
 */
class RWMB_Background_Field extends RWMB_Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_style( 'rwmb-background', RWMB_CSS_URL . 'background.css', '', RWMB_VER );

		RWMB_Color_Field::admin_enqueue_scripts();
		RWMB_File_Input_Field::admin_enqueue_scripts();
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field settings.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$meta = wp_parse_args( $meta, array(
			'color'      => '',
			'image'      => '',
			'repeat'     => '',
			'attachment' => '',
			'position'   => '',
			'size'       => '',
		) );

		$output = '<div class="rwmb-background-row">';

		// Color.
		$color  = RWMB_Color_Field::normalize( array(
			'type'       => 'color',
			'id'         => "{$field['id']}_color",
			'field_name' => "{$field['field_name']}[color]",
		) );
		$output .= RWMB_Color_Field::html( $meta['color'], $color );

		// Image.
		$image  = RWMB_File_Input_Field::normalize( array(
			'type'        => 'file_input',
			'id'          => "{$field['id']}_image",
			'field_name'  => "{$field['field_name']}[image]",
			'placeholder' => __( 'Background Image', 'meta-box' ),
		) );
		$output .= '<div class="rwmb-background-image">';
		$output .= RWMB_File_Input_Field::html( $meta['image'], $image );
		$output .= '</div>';

		$output .= '</div><!-- .rwmb-background-row -->';
		$output .= '<div class="rwmb-background-row">';

		// Repeat.
		$repeat = RWMB_Select_Field::normalize( array(
			'type'        => 'select',
			'id'          => "{$field['id']}_repeat",
			'field_name'  => "{$field['field_name']}[repeat]",
			'placeholder' => esc_html__( '-- Background Repeat --', 'meta-box' ),
			'options'     => array(
				'no-repeat' => esc_html__( 'No Repeat', 'meta-box' ),
				'repeat'    => esc_html__( 'Repeat All', 'meta-box' ),
				'repeat-x'  => esc_html__( 'Repeat Horizontally', 'meta-box' ),
				'repeat-y'  => esc_html__( 'Repeat Vertically', 'meta-box' ),
				'inherit'   => esc_html__( 'Inherit', 'meta-box' ),
			),
		) );
		$output .= RWMB_Select_Field::html( $meta['repeat'], $repeat );

		// Position.
		$position = RWMB_Select_Field::normalize( array(
			'type'        => 'select',
			'id'          => "{$field['id']}_position",
			'field_name'  => "{$field['field_name']}[position]",
			'placeholder' => esc_html__( '-- Background Position --', 'meta-box' ),
			'options'     => array(
				'top_left'      => esc_html__( 'Top Left', 'meta-box' ),
				'top_center'    => esc_html__( 'Top Center', 'meta-box' ),
				'top_right'     => esc_html__( 'Top Right', 'meta-box' ),
				'center_left'   => esc_html__( 'Center Left', 'meta-box' ),
				'center_center' => esc_html__( 'Center Center', 'meta-box' ),
				'center_right'  => esc_html__( 'Center Right', 'meta-box' ),
				'bottom_left'   => esc_html__( 'Bottom Left', 'meta-box' ),
				'bottom_center' => esc_html__( 'Bottom Center', 'meta-box' ),
				'bottom_right'  => esc_html__( 'Bottom Right', 'meta-box' ),
			),
		) );
		$output   .= RWMB_Select_Field::html( $meta['position'], $position );

		// Attachment.
		$attachment = RWMB_Select_Field::normalize( array(
			'type'        => 'select',
			'id'          => "{$field['id']}_attachment",
			'field_name'  => "{$field['field_name']}[attachment]",
			'placeholder' => esc_html__( '-- Background Attachment --', 'meta-box' ),
			'options'     => array(
				'fixed'   => esc_html__( 'Fixed', 'meta-box' ),
				'scroll'  => esc_html__( 'Scroll', 'meta-box' ),
				'inherit' => esc_html__( 'Inherit', 'meta-box' ),
			),
		) );
		$output     .= RWMB_Select_Field::html( $meta['attachment'], $attachment );

		// Size.
		$size   = RWMB_Select_Field::normalize( array(
			'type'        => 'select',
			'id'          => "{$field['id']}_size",
			'field_name'  => "{$field['field_name']}[size]",
			'placeholder' => esc_html__( '-- Background Size --', 'meta-box' ),
			'options'     => array(
				'inherit' => esc_html__( 'Inherit', 'meta-box' ),
				'cover'   => esc_html__( 'Cover', 'meta-box' ),
				'contain' => esc_html__( 'Contain', 'meta-box' ),
			),
		) );
		$output .= RWMB_Select_Field::html( $meta['size'], $size );
		$output .= '</div><!-- .rwmb-background-row -->';

		return $output;
	}
}
