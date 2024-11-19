jQuery(document).ready(function ($) {
	console.log('Custom quantity script loaded'); // Debug to ensure script runs

	// Listen for manual input change
	$(document).on('change', '.ajax-cart-quantity', function () {
		const $input = $(this);
		const cartItemKey = $input.data('cart-item-key');
		const newQuantity = $input.val();

		updateCartQuantity(cartItemKey, newQuantity, $input);
	});

	// Listen for custom minus button click
	$(document).on('click', '.custom-minus', function () {
		const $button = $(this);
		const $input = $button.siblings('.ajax-cart-quantity');
		const cartItemKey = $button.data('cart-item-key');
		let newQuantity = parseInt($input.val(), 10) - 1;

		if (newQuantity < 1) newQuantity = 1; // Prevent below minimum
		$input.val(newQuantity);
		updateCartQuantity(cartItemKey, newQuantity, $input);
	});

	// Listen for custom plus button click
	$(document).on('click', '.custom-plus', function () {
		const $button = $(this);
		const $input = $button.siblings('.ajax-cart-quantity');
		const cartItemKey = $button.data('cart-item-key');
		let newQuantity = parseInt($input.val(), 10) + 1;

		$input.val(newQuantity);
		updateCartQuantity(cartItemKey, newQuantity, $input);
	});

	function updateCartQuantity(cartItemKey, quantity, $input) {
		$.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'update_cart_quantity',
				cart_item_key: cartItemKey,
				quantity: quantity,
			},
			beforeSend: function () {
				$input.prop('disabled', true); // Prevent spamming
			},
			success: function (response) {
				if (response.success) {
					// Rerender cart summary details
					$.ajax({
						url: ajax_add_to_cart_params.ajax_url,
						type: 'POST',
						data: {
							action: 'get_cart_summary',
						},
						success: function (htmlResponse) {
							if (htmlResponse.success) {
								$('.cart-summary-details').html(
									htmlResponse.data
								);
							} else {
								console.error(
									'Failed to render cart summary:',
									htmlResponse.data.message
								);
								alert('Could not update the cart summary.');
							}
						},
						error: function () {
							console.error(
								'Failed to reload cart summary details.'
							);
							alert(
								'An error occurred while refreshing the cart summary.'
							);
						},
					});
				} else {
					alert(response.data.message || 'Failed to update cart.');
				}
			},
			complete: function () {
				$input.prop('disabled', false);
			},
			error: function () {
				alert('Something went wrong. Please try again.');
			},
		});
	}
});
