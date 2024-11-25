jQuery(document).ready(function ($) {
	$(document).on(
		'change',
		'.shipping-method input[type="radio"]',
		function () {
			var $form = $('form.woocommerce-checkout');
			$form.block({
				message: null,
				overlayCSS: { background: '#fff', opacity: 0.6 },
			});

			$.ajax({
				type: 'POST',
				url: wc_checkout_params.ajax_url,
				data: {
					action: 'update_shipping_method',
					security: wc_checkout_params.update_order_review_nonce,
					shipping_method: $(
						'input[name^="shipping_method"]:checked'
					).val(),
				},
				success: function (response) {
					if (response.success) {
						// Replace cart summary details
						if (response.data.cart_summary) {
							$('.cart-summary-details').replaceWith(
								response.data.cart_summary
							);
						}

						// Replace mini-cart contents
						if (response.data.mini_cart) {
							$('.woocommerce-mini-cart').replaceWith(
								response.data.mini_cart
							);
						}
					} else {
						console.error(
							'Error updating shipping method',
							response
						);
					}
					$form.unblock();
				},
				error: function (xhr, status, error) {
					console.error('AJAX error:', error);
					$form.unblock();
				},
			});
		}
	);
});
