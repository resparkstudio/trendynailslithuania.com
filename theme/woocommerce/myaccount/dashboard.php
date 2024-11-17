<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
	exit;
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
		'class' => array(),
	),
);

?>
<p>
	<?php
	printf(
		wp_kses(__('Sveiki, %1$s (ne %1$s? <a class = "link-hover" href="%2$s">Atsijungti</a>)', 'woocommerce'), $allowed_html),
		'<strong>' . esc_html($current_user->display_name) . '</strong>',
		esc_url(wc_logout_url())
	);
	?>
</p>
<br>
<p>
	<?php
	$dashboard_desc = __('Iš savo paskyros pagrindinio meniu galite peržiūrėti savo <a class = "link-hover" href="%1$s">naujausius užsakymus</a>, tvarkyti savo <a class = "link-hover" href="%2$s">atsiskaitymo adresą</a> ir <a class = "link-hover" href="%3$s">redaguoti savo slaptažodį ir paskyros duomenis</a>.', 'woocommerce');
	if (wc_shipping_enabled()) {

		$dashboard_desc = __('Iš savo paskyros pagrindino meniu galite peržiūrėti savo <a class = "link-hover" href="%1$s">naujausius užsakymus</a>, tvarkyti savo <a class = "link-hover" href="%2$s">pristatymo ir atsiskaitymo adresus</a> ir <a class = "link-hover" href="%3$s">redaguoti savo slaptažodį ir paskyros duomenis</a>.', 'woocommerce');
	}
	printf(
		wp_kses($dashboard_desc, $allowed_html),
		esc_url(wc_get_endpoint_url('orders')),
		esc_url(wc_get_endpoint_url('edit-address')),
		esc_url(wc_get_endpoint_url('edit-account'))
	);
	?>
</p>


<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');


?>