<!-- This file is used to markup the administration form of the widget. -->
<?php
if ( $instance ) {
	$value = esc_attr( $instance['field'] );
} else {
	$value = __( 'Default Value', 'wp-pb' );
}
?>
<p>
		<label for="<?php echo $this->get_field_id( 'field' ); ?>"><?php _e( 'Field', 'wp-pb' ) ?></label><br/>
		<input class="widefat" id="<?php echo $this->get_field_id( 'field' ); ?>"
			   name="<?php echo $this->get_field_name( 'field' ); ?>" type="text"
			   value="<?php echo $value; ?>"/>
</p>
