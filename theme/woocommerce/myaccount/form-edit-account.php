<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>

	<?php do_action('woocommerce_edit_account_form_start'); ?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<label class="account-form-label"
			for="account_first_name"><?php esc_html_e('Vardas', 'woocommerce'); ?>&nbsp;<span
				class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name"
			id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" />
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
		<label class="account-form-label"
			for="account_last_name"><?php esc_html_e('Pavardė', 'woocommerce'); ?>&nbsp;<span
				class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name"
			id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" />
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label class="account-form-label"
			for="account_display_name"><?php esc_html_e('Rodomas vardas', 'woocommerce'); ?>&nbsp;<span
				class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name"
			id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>" />
		<span
			class="body-extra-small-regular text-mid-gray"><?php esc_html_e('Tai bus vardas, kuris bus rodomas paskyros skiltyje ir apžvalgose', 'woocommerce'); ?></span>
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label class="account-form-label"
			for="account_email"><?php esc_html_e('El. pašto adresas', 'woocommerce'); ?>&nbsp;<span
				class="required">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email"
			id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" />
	</p>

	<?php do_action('woocommerce_edit_account_form_fields'); ?>

	<fieldset>
		<legend class="mt-2 mb-1 heading-sm"><?php esc_html_e('Keisti slaptažodį', 'woocommerce'); ?></legend>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label class="account-form-label"
				for="password_current"><?php esc_html_e('Dabartinis slaptažodis (palikite tuščią, jei nenorite keisti)', 'woocommerce'); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
				name="password_current" id="password_current" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label class="account-form-label"
				for="password_1"><?php esc_html_e('Naujas slaptažodį (palikite tuščią, jei nenorite keisti)', 'woocommerce'); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1"
				id="password_1" autocomplete="off" />
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label class="account-form-label"
				for="password_2"><?php esc_html_e('Patvirtinkite naują slaptažodį', 'woocommerce'); ?></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2"
				id="password_2" autocomplete="off" />
		</p>
	</fieldset>
	<div class="clear"></div>

	<?php do_action('woocommerce_edit_account_form'); ?>

	<p>
		<?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
		<button type="submit"
			class="white-button-black-text py-3 mt-6 px-12 woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
			name="save_account_details"
			value="<?php esc_attr_e('Išsaugoti pakeitimus', 'woocommerce'); ?>"><?php esc_html_e('Išsaugoti pakeitimus', 'woocommerce'); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>

	<!-- Delete Account Button -->
	<p>
		<button type="button" id="delete-account-button" class="red-button py-2 mt-6 px-6" name="delete_account">
			<?php esc_html_e('Ištrinti paskyrą', 'woocommerce'); ?>
		</button>
	</p>

	<?php do_action('woocommerce_edit_account_form_end'); ?>
</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>

<script>
	document.getElementById('delete-account-button').addEventListener('click', function () {
		if (confirm("Ar tikrai norite ištrinti savo paskyrą? Šis veiksmas negali būti atšauktas.")) {
			// Redirect to the login page after account deletion
			window.location.href = "<?php echo esc_url(add_query_arg('delete_account', 'true', wc_get_account_endpoint_url('dashboard'))); ?>";
		}
	});
</script>