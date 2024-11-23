<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined('ABSPATH') || exit;

$notes = $order->get_customer_order_notes();
?>
<p class="text-deep-dark-gray body-normal-regular">
	<?php
	printf(
		/* translators: 1: order number 2: order date 3: order status */
		esc_html__('Užsakymas #%1$s buvo pateiktas %2$s ir šiuo metu yra %3$s.', 'woocommerce'),
		'<span class="order-number body-normal-semibold">' . $order->get_order_number() . '</span>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		'<span class="order-date body-normal-semibold">' . wc_format_datetime($order->get_date_created()) . '</span>', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		'<span class="order-status body-normal-semibold">' . wc_get_order_status_name($order->get_status()) . '</span>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
	?>
</p>

<div class="overflow-x-auto text-deep-dark-gray">
	<table class="min-w-full mt-4 table-auto border-collapse border border-deep-dark-gray">
		<thead class="bg-gray-100">
			<tr>
				<th class="px-4 py-2 text-left  font-semibold">Produktas</th>
				<th class="px-4 py-2 text-right  font-semibold">Viso</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($order->get_items() as $item_id => $item): ?>
				<tr class="border-b border-deep-dark-gray">
					<td class="px-4 py-2 ">
						<a href="<?php echo esc_url(get_permalink($item->get_product_id())); ?>" class="">
							<?php echo esc_html($item->get_name()); ?>
						</a>
						<strong class="ml-2">× <?php echo esc_html($item->get_quantity()); ?></strong>
					</td>
					<td class="px-4 py-2 text-right ">
						<?php echo wp_kses_post($order->get_formatted_line_subtotal($item)); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot class="bg-gray-50">
			<tr>
				<th class="px-4 py-2 text-left ">Suma:</th>
				<td class="px-4 py-2 text-right ">
					<?php echo wp_kses_post($order->get_formatted_order_total()); ?>
				</td>
			</tr>
			<tr>
				<th class="px-4 py-2 text-left ">Pristatymas:</th>
				<td class="px-4 py-2 text-right ">
					<?php echo esc_html($order->get_shipping_method()); ?>
				</td>
			</tr>
			<tr>
				<th class="px-4 py-2 text-left ">Mokėjimo būdas:</th>
				<td class="px-4 py-2 text-right ">
					<?php echo esc_html($order->get_payment_method_title()); ?>
				</td>
			</tr>
			<tr>
				<th class="px-4 py-2 text-left ">Viso:</th>
				<td class="px-4 py-2 text-right  font-bold">
					<?php echo wp_kses_post($order->get_formatted_order_total()); ?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>

<?php if ($notes): ?>
	<h2 class="mt-6 text-lg font-semibold text-gray-800"><?php esc_html_e('Užsakymo atnaujinimai', 'woocommerce'); ?></h2>
	<ol class="mt-4 space-y-4">
		<?php foreach ($notes as $note): ?>
			<li class="bg-gray-100 p-4 rounded shadow-sm">
				<p class="text-sm ">
					<?php echo date_i18n(esc_html__('l jS \o\f F Y, h:ia', 'woocommerce'), strtotime($note->comment_date)); ?>
				</p>
				<div class="mt-2 ">
					<?php echo wpautop(wptexturize($note->comment_content)); ?>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>