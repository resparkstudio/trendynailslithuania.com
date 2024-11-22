<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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

do_action('woocommerce_before_lost_password_form');
?>

<div class="mb-48 mt-5 md:mb-28 md:mt-2.5">
	<div class="max-w-[87.5rem] mx-auto w-full">
		<div class="flex flex-col mx-12 md:mx-4">

			<header id="heading-section">
				<h1 class="w-full heading-md text-deep-dark-gray mb-4">
					<?php echo wp_kses_post("Slaptažodžio atkūrimas") ?>
				</h1>
			</header>

			<form method="post" class="woocommerce-ResetPassword lost_reset_password">

				<p class="text-deep-dark-gray body-normal-regular">
					<?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Pamiršote slaptažodį? Įveskite savo naudotojo vardą arba el. pašto adresą. Jums bus atsiųsta nuoroda, skirta sukurti naują slaptažodį.', 'woocommerce')); ?>
				</p><?php // @codingStandardsIgnoreLine ?>

				<p
					class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first max-w-72 md:max-w-full mt-3">
					<label class=" account-form-label" for="user_login">
						<?php esc_html_e('El. paštas', 'woocommerce'); ?>&nbsp;<span class="required"
							aria-hidden="true">*</span><span
							class="screen-reader-text"><?php esc_html_e('Privaloma', 'woocommerce'); ?></span></label>
					<input class="woocommerce-Input woocommerce-Input--text input-text form-input" type="text"
						name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
				</p>

				<div class="clear"></div>

				<?php do_action('woocommerce_lostpassword_form'); ?>

				<p class="woocommerce-form-row form-row">
					<input type="hidden" name="wc_reset_password" value="true" />
					<button type="submit"
						class="white-button-black-text py-3 px-8 mt-6 woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
						value="<?php esc_attr_e('Atstatyti slaptažodį', 'woocommerce'); ?>"><?php esc_html_e('Atstatyti slaptažodį', 'woocommerce'); ?></button>
				</p>

				<?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

			</form>
			<?php
			do_action('woocommerce_after_lost_password_form');
			?>
		</div>
	</div>
</div>