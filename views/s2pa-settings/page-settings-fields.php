<?php
/*
 * Demo requests settings Section
 */
?>

<?php

	if( 's2pa_field-demo-settings' == $field['label_for'] )
	{

		$section_fields = array(
			'api_url' => 'Post URL',
			'merchant_id' => 'Merchant ID',
			'site_id' => 'Site ID',
			'signature' => 'Signature',
			'return_url' => 'Return URL',
		);

		?><fieldset><?php

		foreach( $section_fields as $input_field => $text )
		{
			$field_name = esc_attr( 's2pa_settings[basic]['.$input_field.']' );
			if( !isset( $settings['basic'][$input_field] ) )
				$field_value = '';
			else
				$field_value = $settings['basic'][$input_field];

			if( $input_field == 'return_url' and empty( $field_value ) )
				$field_value = S2PA_PLUGIN_URL.'notification.php';

			?>
			<label for="<?php echo $field_name ?>">
			<div style="width: 100px;"><?php _e( $text )?></div>
			</label>
			<input type="text" id="<?php echo $field_name ?>" name="<?php echo $field_name ?>" class="regular-text ltr" value="<?php esc_attr_e( $field_value ); ?>" />
			<br/>
			<?php
		}

		?></fieldset><?php
	}
?>


<?php
/*
 * Advanced Section
 */
?>

<?php if ( 's2pa_field-example2' == $field['label_for'] ) : ?>

	<textarea id="<?php esc_attr_e( 's2pa_settings[advanced][field-example2]' ); ?>" name="<?php esc_attr_e( 's2pa_settings[advanced][field-example2]' ); ?>" class="large-text"><?php echo esc_textarea( $settings['advanced']['field-example2'] ); ?></textarea>
	<p class="description">This is an example of a longer explanation.</p>

<?php elseif ( 's2pa_field-example3' == $field['label_for'] ) : ?>

	<p>Another example</p>

<?php endif; ?>
