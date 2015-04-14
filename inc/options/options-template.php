		<h2 class="nav-tab-wrapper">
			<?php echo \devinsays\optionsframework\Options_Framework_Interface::optionsframework_tabs( $this->option_name, $this->options ); ?>
		</h2>

		<?php settings_errors( 'options-framework' ); ?>

		<div id="optionsframework-metabox" class="metabox-holder">
			<div id="optionsframework" class="postbox">
				<form action="options.php" method="post">
				<?php settings_fields( $this->option_name ); ?>
				<?php \devinsays\optionsframework\Options_Framework_Interface::optionsframework_fields( $this->option_name, $this->options );  ?>
				<div id="optionsframework-submit">
					<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options', 'wpbp' ); ?>" />
					<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults', 'wpbp' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!', 'wpbp' ) ); ?>' );" />
					<div class="clear"></div>
				</div>
				</form>
			</div> <!-- / #container -->
		</div>
