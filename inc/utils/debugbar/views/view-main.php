<h2>Plugin Debugging Information</h2>
<h3>Registered Constants</h3>
<ul>
<?php foreach( $constants as $constant ) { ?>
<li><strong><?php echo $constant ?></strong>: <em><?php echo constant( $constant ); ?></em></li>
<?php } ?>
</ul>
