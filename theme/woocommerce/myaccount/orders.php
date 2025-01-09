<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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
if ($has_orders): ?>

	<div class="overflow-x-auto">
		<table class="min-w-full table-auto border-collapse border border-deep-dark-gray">
			<thead class="bg-gray">
				<tr>
					<?php foreach (wc_get_account_orders_columns() as $column_id => $column_name): ?>
						<th scope="col"
							class="border border-deep-dark-gray px-2 sm:px-1 py-2 text-center font-semibold text-sm text-deep-dark-gray">
							<?php echo esc_html($column_name); ?>
						</th>
					<?php endforeach; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($customer_orders->orders as $customer_order):
					$order = wc_get_order($customer_order);
					$item_count = $order->get_item_count() - $order->get_item_count_refunded();
					?>
					<tr class="hover:bg-gray-50">
						<?php foreach (wc_get_account_orders_columns() as $column_id => $column_name):
							$is_order_number = 'order-number' === $column_id;
							?>
							<?php if ($is_order_number): ?>
								<th scope="row"
									class="border border-deep-dark-gray px-1 py-2 text-center text-deep-dark-gray body-normal-semibold sm:text-[0.75rem] sm:leading-[1rem]">
								<?php else: ?>
								<td
									class="border border-deep-dark-gray px-2 sm:px-1 py-2 text-center body-small-regular text-deep-dark-gray">
								<?php endif; ?>
								<?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)): ?>
									<?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>
								<?php elseif ($is_order_number): ?>
									<a href="<?php echo esc_url($order->get_view_order_url()); ?>"
										class="link-hover text-deep-dark-gray sm:text-[0.75rem] sm:leading-[1rem]">
										<?php echo esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?>
									</a>
								<?php elseif ('order-date' === $column_id): ?>
									<time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"
										class=" body-small-regular text-deep-dark-gray sm:text-[0.75rem] sm:leading-[1rem]">
										<?php echo esc_html(wc_format_datetime($order->get_date_created())); ?>
									</time>
								<?php elseif ('order-status' === $column_id): ?>
									<span class="text-deep-dark-gray body-small-regular sm:text-[0.75rem] sm:leading-[1rem]">
										<?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
									</span>
								<?php elseif ('order-total' === $column_id): ?>
									<span class="text-deep-dark-gray body-small-regular sm:text-[0.75rem] sm:leading-[1rem]">
										<?php
										echo wp_kses_post(sprintf(
											_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'),
											$order->get_formatted_order_total(),
											$item_count
										));
										?>
									</span>
								<?php elseif ('order-actions' === $column_id): ?>
									<div class="flex flex-wrap gap-2 justify-center">
										<?php
										$actions = wc_get_account_orders_actions($order);
										if (!empty($actions)) {
											foreach ($actions as $key => $action) {
												echo '<a href="' . esc_url($action['url']) . '" class="inline-block px-2 sm:px-1 py-2 body-small-semibold text-white body-small-regular sm:text-[0.75rem] sm:leading-[1rem] rounded black-button">' . esc_html($action['name']) . '</a>';
											}
										}
										?>
									</div>
								<?php endif; ?>
								<?php if ($is_order_number): ?>
									</th>
								<?php else: ?>
								</td>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<?php if (1 < $customer_orders->max_num_pages): ?>
		<div class="flex items-center justify-center mt-6 gap-4">
			<?php if (1 !== $current_page): ?>
				<a href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>"
					class="inline-flex items-center px-2 sm:px-1 py-2 border-deep-dark-gray">
					<svg xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 6 10" fill="none"
						class="transform rotate-180">
						<path
							d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
							fill="#201F1F" />
					</svg>
				</a>
			<?php endif; ?>
			<?php if (intval($customer_orders->max_num_pages) !== $current_page): ?>
				<a href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>"
					class="inline-flex items-center px-2 sm:px-1 py-2 border-deep-dark-gray">
					<svg xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 6 10" fill="none">
						<path
							d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
							fill="#201F1F" />
					</svg>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else: ?>
	<div class="p-4 bg-yellow-100 text-yellow-800 rounded">
		<?php esc_html_e('Užsakymų nėra.', 'woocommerce'); ?>
	</div>
<?php endif; ?>