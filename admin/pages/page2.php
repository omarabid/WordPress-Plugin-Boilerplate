<?php
$myListTable = new wp_admin_table();
$myListTable->prepare_items();
?>
<div class="wrap">
	<h2><?php _e( 'WP Admin Table', 'wp-pb' ); ?></h2>

	<form id="edd-payments-filter" method="get" action="<?php echo admin_url( 'admin.php?page=page-id-2' ); ?>">
		<input type="hidden" name="page" value=""/>

		<?php $myListTable->views() ?>

		<?php $myListTable->advanced_filters(); ?>

		<?php $myListTable->display() ?>
	</form>
</div>
