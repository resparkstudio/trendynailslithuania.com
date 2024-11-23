<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_reset_password_form');
?>

<div class="mb-48 mt-5 md:mb-28 md:mt-2.5">
	<div class="max-w-[87.5rem] mx-auto w-full">
		<div class="flex flex-col mx-12 md:mx-4">

			<header id="heading-section">
				<h1 class="w-full heading-md text-deep-dark-gray mb-4">
					<?php echo wp_kses_post("Naujo slaptažodžio sukūrimas"); ?>
				</h1>
			</header>

			<form method="post" class="woocommerce-ResetPassword lost_reset_password">

				<p class="text-deep-dark-gray body-normal-regular">
					<?php echo apply_filters('woocommerce_reset_password_message', esc_html__('Įveskite naują slaptažodį žemiau.', 'woocommerce')); ?>
				</p>

				<p
					class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first max-w-72 md:max-w-full mt-3">
					<label class="account-form-label" for="password_1">
						<?php esc_html_e('Naujas slaptažodis', 'woocommerce'); ?>&nbsp;<span class="required"
							aria-hidden="true">*</span><span
							class="screen-reader-text"><?php esc_html_e('Privaloma', 'woocommerce'); ?></span>
					</label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-input"
						name="password_1" id="password_1" autocomplete="new-password" required aria-required="true" />
				</p>

				<p
					class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last max-w-72 md:max-w-full mt-3">
					<label class="account-form-label" for="password_2">
						<?php esc_html_e('Pakartokite naują slaptažodį', 'woocommerce'); ?>&nbsp;<span class="required"
							aria-hidden="true">*</span><span
							class="screen-reader-text"><?php esc_html_e('Privaloma', 'woocommerce'); ?></span>
					</label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-input"
						name="password_2" id="password_2" autocomplete="new-password" required aria-required="true" />
				</p>

				<input type="hidden" name="reset_key" value="<?php echo esc_attr($args['key']); ?>" />
				<input type="hidden" name="reset_login" value="<?php echo esc_attr($args['login']); ?>" />

				<div class="clear"></div>

				<?php do_action('woocommerce_resetpassword_form'); ?>

				<p class="woocommerce-form-row form-row">
					<input type="hidden" name="wc_reset_password" value="true" />
					<button type="submit"
						class="white-button-black-text py-3 px-8 mt-6 woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
						value="<?php esc_attr_e('Išsaugoti', 'woocommerce'); ?>"><?php esc_html_e('Išsaugoti', 'woocommerce'); ?></button>
				</p>

				<?php wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'); ?>

			</form>
		</div>
	</div>
</div>

<?php do_action('woocommerce_after_reset_password_form'); ?>