<h3><?php _e( 'Registered Constants', 'wpbp' ); ?></h3>
<ul>
<?php foreach( $constants as $constant ) { ?>
<li><strong><?php echo $constant ?></strong>: <em><?php echo constant( $constant ); ?></em></li>
<?php } ?>
</ul>
