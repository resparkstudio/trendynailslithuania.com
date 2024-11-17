<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined('ABSPATH') || exit;

$customer_id = get_current_user_id();

// Determine which addresses to fetch
if (!wc_ship_to_billing_address_only() && wc_shipping_enabled()) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __('Atsiskaitymo adresas', 'woocommerce'),
			'shipping' => __('Pristatymo adresas', 'woocommerce'),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __('Atsiskaitymo adresas', 'woocommerce'),
		),
		$customer_id
	);
}

$oldcol = 1;
$col = 1;

// Begin output
?>

<?php if (!empty($get_addresses)): ?>
	<div class="u-columns woocommerce-Addresses col2-set addresses">
		<?php foreach ($get_addresses as $name => $address_title): ?>
			<?php
			$address = wc_get_account_formatted_address($name);
			$col = $col * -1;
			$oldcol = $oldcol * -1;

			// Change the text for "Pridėti" link only
			$add_text = ($name === 'billing') ? 'atsiskaitymo adresą' : 'pristatymo adresą';
			?>

			<div class="u-column<?php echo $col < 0 ? 1 : 2; ?> col-<?php echo $oldcol < 0 ? 1 : 2; ?> woocommerce-Address">
				<header class="woocommerce-Address-title title">
					<h2 class="heading-sm mt-2 mb-3"><?php echo esc_html($address_title); ?></h2>
					<a href="<?php echo esc_url(wc_get_endpoint_url('edit-address', $name)); ?>" class="edit link-hover">
						<?php
						printf(
							$address ? esc_html__('Redaguoti %s', 'woocommerce') : esc_html__('Pridėti %s', 'woocommerce'),
							esc_html($add_text)
						);
						?>
					</a>
				</header>
				<address class="text-mid-gray body-small-regular mt-1">
					<?php
					echo $address ? wp_kses_post($address) : esc_html__('Dar nesukūrėte šio tipo adreso.', 'woocommerce');

					/**
					 * Used to output content after core address fields.
					 *
					 * @param string $name Address type.
					 * @since 8.7.0
					 */
					do_action('woocommerce_my_account_after_my_address', $name);
					?>
				</address>
			</div>

		<?php endforeach; ?>
	</div>
<?php else: ?>
	<p class="text-mid-gray body-small-regular mt-3">
		<?php esc_html_e('Nėra adresų, kuriuos būtų galima rodyti.', 'woocommerce'); ?>
	</p>
<?php endif; ?>