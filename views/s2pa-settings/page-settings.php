<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2><?php esc_html_e( S2PA_NAME ); ?> Settings</h2>

	<form method="post" action="options.php">
		<?php settings_fields( 's2pa_settings' ); ?>
		<?php do_settings_sections( 's2pa_settings' ); ?>

		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button-primary" value="<?php esc_attr_e( __( 'Save Changes' ) ); ?>" />
		</p>
	</form>
</div> <!-- .wrap -->
