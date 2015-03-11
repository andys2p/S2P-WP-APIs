<h3>WPPS User Fields</h3>

<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<label for="s2pa_user-example-field1">Example Field 1</label>
		</th>

		<td>
			<input id="s2pa_user-example-field1" name="s2pa_user-example-field1" type="text" class="regular-text" value="<?php esc_attr_e( get_user_meta( $user->ID, 's2pa_user-example-field1', true ) ); ?>" />
			<span class="description">Example description.</span>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">
			<label for="s2pa_user-example-field2">Example Field 2</label>
		</th>

		<td>
			<input id="s2pa_user-example-field2" name="s2pa_user-example-field2" type="text" class="regular-text" value="<?php esc_attr_e( get_user_meta( $user->ID, 's2pa_user-example-field2', true ) ); ?>" />
			<span class="description">Example description.</span>
		</td>
	</tr>
</table>
