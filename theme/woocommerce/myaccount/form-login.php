<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$action = isset($_GET['action']) ? sanitize_text_field($_GET['action']) : 'login';

do_action('woocommerce_before_customer_login_form'); ?>

<div class="mx-auto w-full text-deep-dark-gray" id="customer_login">
	<div class="grid grid-cols-12 gap-4 ml-12 md:mx-4">
		<div class="flex w-full justify-end col-span-5 md:col-span-12">
			<?php if ($action === 'login'): ?>

				<div class="w-full max-w-[43.75rem] md:max-w-full pb-36 md:pb-32">
					<h1 class="heading-md text-deep-dark-gray"><?php esc_html_e('Prisijunkite', 'woocommerce'); ?></h1>
					<div class="ml-12 md:ml-0 mt-12 md:mt-7">
						<p class="woocommerce-RegisterLink text-deep-dark-gray body-normal-regular block mb-7">
							<?php esc_html_e("Neturite paskyros?", 'woocommerce'); ?> <a class="link-hover"
								href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')) . '?action=register'); ?>"><?php esc_html_e('Registruokitės', 'woocommerce'); ?></a>
						</p>
						<form class="woocommerce-form woocommerce-form-login login mb-0 w-full" method="post">
							<?php do_action('woocommerce_login_form_start'); ?>
							<!-- Email Field -->
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide block mb-3">
								<input type="text" class="form-input woocommerce-Input woocommerce-Input--text input-text"
									name="username" id="username" autocomplete="username" placeholder="El. paštas" required
									aria-required="true" />
							</p>
							<!-- Password Field -->
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide block mb-3">
								<input class="form-input woocommerce-Input woocommerce-Input--text input-text"
									type="password" name="password" id="password" placeholder="Slaptažodis"
									autocomplete="current-password" required aria-required="true" />
							</p>
							<!-- Lost Password -->
							<p
								class="woocommerce-LostPassword lost_password body-extra-small-light text-deep-dark-gray flex justify-end mb-2">
								<a class="underline"
									href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Pamiršote slaptažodį?', 'woocommerce'); ?></a>
							</p>
							<?php do_action('woocommerce_login_form'); ?>

							<!-- Remember me Checkbox -->
							<p class="pl-4">
								<label
									class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme mb-4 flex gap-2 body-small-light text-deep-dark-gray">
									<input class="input-checkbox woocommerce-form__input woocommerce-form__input-checkbox"
										name="rememberme" type="checkbox" id="rememberme" value="forever" />
									<span
										class="body-small-light"><?php esc_html_e('Prisiminti mane', 'woocommerce'); ?></span>
								</label>
								<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
							</p>

							<button type="submit"
								class="woocommerce-button uppercase black-button w-full py-3 woocommerce-form-login__submit"
								name="login"
								value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Prisijungti', 'woocommerce'); ?></button>

							<p class="block text-center w-full py-5 body-small-light"><?php echo wp_kses_post("arba") ?></p>

							<?php echo do_shortcode('[nextend_social_login provider="facebook"]') ?>
							<?php echo do_shortcode('[nextend_social_login provider="google"]') ?>

							<?php do_action('woocommerce_login_form_end'); ?>
						</form>
					</div>


				</div>

			<?php elseif ($action === 'register' && get_option('woocommerce_enable_myaccount_registration') === 'yes'): ?>

				<div class="w-full max-w-[43.75rem] md:max-w-full pb-36 md:pb-32">
					<h1 class="heading-md text-deep-dark-gray"><?php esc_html_e('Registruokitės', 'woocommerce'); ?></h1>
					<div class="ml-12 md:ml-0 mt-12 md:mt-7">
						<p class="woocommerce-LoginLink body-normal-regular block mb-7">
							<?php esc_html_e("Turie paskyrą?", 'woocommerce'); ?> <a class="link-hover"
								href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id')) . '?action=login'); ?>"><?php esc_html_e('Prisijunkite', 'woocommerce'); ?></a>
						</p>
						<form method="post" class="woocommerce-form woocommerce-form-register register w-full" <?php do_action('woocommerce_register_form_tag'); ?>>
							<?php do_action('woocommerce_register_form_start'); ?>

							<!-- Email Field -->
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide block mb-3">
								<input type="email" class="form-input woocommerce-Input woocommerce-Input--text input-text"
									name="email" id="reg_email" autocomplete="email" placeholder="El. paštas" required
									aria-required="true" />
							</p>

							<!-- Username Field -->
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide block mb-3">
								<input type="text" class="form-input woocommerce-Input woocommerce-Input--text input-text"
									name="username" id="reg_username" autocomplete="username" required aria-required="true"
									placeholder="Vardas" />
							</p>

							<!-- Password Field -->
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide block mb-3">
								<input type="password"
									class="form-input woocommerce-Input woocommerce-Input--text input-text" name="password"
									id="reg_password" autocomplete="new-password" required aria-required="true"
									placeholder="Slaptažodis" />
							</p>

							<!-- Privacy Policy Checkbox -->
							<p
								class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide block mb-4 pl-4">
								<label
									class="woocommerce-form__label woocommerce-form__label-for-checkbox flex gap-2 items-center">
									<input class="input-checkbox woocommerce-form__input woocommerce-form__input-checkbox"
										type="checkbox" name="privacy_policy" id="privacy_policy" required>
									<span
										class="block body-extra-small-light text-deep-dark-gray"><?php esc_html_e('Sutinku su', 'woocommerce'); ?>
										<a class="underline" href="<?php echo esc_url(get_permalink(12)); ?>"
											target="_blank"><?php esc_html_e('naudojimo sąlygomis', 'woocommerce'); ?></a>
										<?php esc_html_e('ir', 'woocommerce'); ?>
										<a class="underline" href="<?php echo esc_url(get_permalink(3)); ?>"
											target="_blank"><?php esc_html_e('privatumo politika', 'woocommerce'); ?></a>
									</span>
								</label>
							</p>

							<?php do_action('woocommerce_register_form'); ?>

							<p class="woocommerce-form-row form-row">
								<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
								<button type="submit"
									class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit  uppercase black-button w-full py-3 "
									name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
									<?php esc_html_e('Registruotis', 'woocommerce'); ?>
								</button>
							</p>

							<p class="block text-center w-full py-5 body-small-light"><?php echo wp_kses_post("arba") ?></p>

							<?php echo do_shortcode('[nextend_social_login provider="facebook"]') ?>
							<?php echo do_shortcode('[nextend_social_login provider="google"]') ?>

							<?php do_action('woocommerce_register_form_end'); ?>
						</form>
					</div>


				</div>

			<?php endif; ?>
		</div>

		<div class="w-full h-full md:hidden col-span-7 col-start-7">
			<img class="w-full h-full object-cover object-center aspect-[712/646] rounded-l-[15px]"
				src="<?php echo wp_get_attachment_image_src(362, 'full')[0]; ?>"
				alt="Row of Trendy Nails Builder Gel bottles in black matte finish with shades labeled, displayed on a pink background.">
		</div>


	</div>


</div>

<?php do_action('woocommerce_after_customer_login_form'); ?>