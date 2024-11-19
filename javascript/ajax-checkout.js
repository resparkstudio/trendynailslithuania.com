jQuery(document).ready(function ($) {
	// Change quantity
	$(document).on('change', '.ajax-cart-quantity', function () {
		const $input = $(this);
		const cartItemKey = $input.data('cart-item-key');
		const newQuantity = $input.val();

		updateCartQuantity(cartItemKey, newQuantity, $input);
	});

	$(document).on('click', '.custom-minus', function () {
		const $button = $(this);
		const $input = $button.siblings('.ajax-cart-quantity');
		const cartItemKey = $button.data('cart-item-key');
		let newQuantity = parseInt($input.val(), 10) - 1;

		if (newQuantity < 1) newQuantity = 1; // Prevent below minimum
		$input.val(newQuantity);
		updateCartQuantity(cartItemKey, newQuantity, $input);
	});

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
	// Remove
	$(document).on('click', '.remove-item', function (e) {
		e.preventDefault();

		const $button = $(this);
		const cartItemKey = $button.data('remove-item');

		if (!cartItemKey) {
			alert('Unable to identify the item to remove.');
			return;
		}

		$.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'remove_cart_item',
				cart_item_key: cartItemKey,
			},
			beforeSend: function () {
				$button.prop('disabled', true); // Prevent spamming
			},
			success: function (response) {
				if (response.success) {
					// Re-render the cart product list
					$('.cart-items').html(response.data.product_list);

					// Re-render the cart summary details
					$('.cart-summary-details').html(response.data.cart_summary);
				} else {
					alert(
						response.data.message || 'Failed to remove the item.'
					);
				}
			},
			error: function () {
				alert('Something went wrong. Please try again.');
			},
			complete: function () {
				$button.prop('disabled', false);
			},
		});
	});
});
