import { createNotification } from './notificationBanner';
import gsap from 'gsap';
document.addEventListener('DOMContentLoaded', function () {
	const cartCountElement = document.getElementById('cart-count');

	// Update all cart elements (mini cart, product list, summary, count)
	function updateAllCarts(response) {
		if (response.success) {
			if (response.data.mini_cart) {
				jQuery('#mini-cart-contents').html(response.data.mini_cart); // Update mini-cart
			}

			if (response.data.product_list) {
				jQuery('.cart-items').html(response.data.product_list); // Update product list
			}

			if (response.data.cart_summary) {
				jQuery('.cart-summary-details').html(
					response.data.cart_summary
				); // Update cart summary
			}

			if (response.data.cart_count !== undefined) {
				const cartCountElement = document.getElementById('cart-count');
				if (cartCountElement) {
					cartCountElement.textContent = response.data.cart_count; // Update cart count
				}
			}

			// Redirect to homepage if cart is empty
			if (response.data.redirect) {
				window.location.href = '/';
			}
		} else {
			console.error('Error updating cart:', response.data.message);
		}
	}

	// Add product to cart
	function addToCart(productId, quantity, productName) {
		jQuery.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_ajax_add_to_cart',
				product_id: productId,
				quantity: quantity || 1, // Default to 1 if no quantity specified
			},
			success: function (response) {
				if (response.success) {
					updateAllCarts(response); // Synchronize all cart elements
					createNotification(
						`${productName} has been successfully added to your cart.`,
						true
					);
				} else {
					createNotification(
						response.data.message ||
							'Failed to add product to cart.',
						false
					);
				}
			},
			error: function () {
				createNotification('Error adding product to cart.', false);
			},
		});
	}

	// Update cart quantity
	function updateCartQuantity(cartItemKey, quantity, $input) {
		jQuery.ajax({
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
				updateAllCarts(response); // Synchronize all cart elements
			},
			complete: function () {
				$input.prop('disabled', false);
			},
			error: function () {
				createNotification('Error updating product quantity.', false);
			},
		});
	}

	// Remove item from cart
	function removeFromCart(cartItemKey, productName, $button) {
		jQuery.ajax({
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
					if (response.data.redirect === true) {
						window.location.href = '/';
					} else {
						updateAllCarts(response);
						createNotification(
							`${productName} has been successfully removed from your cart.`,
							true
						);
					}
				} else {
					createNotification(
						response.data.message || 'Failed to remove product.',
						false
					);
				}
			},
			error: function () {
				createNotification('Error removing product from cart.', false);
			},
			complete: function () {
				$button.prop('disabled', false);
			},
		});
	}

	jQuery(document).on(
		'click',
		'#single-product-add-to-cart, .add-to-cart-swiper-btn',
		function (event) {
			event.preventDefault();
			const $button = jQuery(this);
			const productId = $button.data('product_id');
			const productName = $button.data('product_name');
			let quantity = 1;

			const quantityInput = jQuery('.quantity-input');
			if (
				quantityInput.length &&
				$button.is('#single-product-add-to-cart')
			) {
				quantity = quantityInput.val();
			}

			addToCart(productId, quantity, productName);
		}
	);

	// Update quantity via input field
	jQuery(document).on('change', '.ajax-cart-quantity', function () {
		const $input = jQuery(this);
		const cartItemKey = $input.data('cart-item-key');
		const quantity = $input.val();

		updateCartQuantity(cartItemKey, quantity, $input);
	});

	// Update quantity via custom buttons
	jQuery(document).on('click', '.custom-minus, .custom-plus', function () {
		const $button = jQuery(this);
		const $input = $button.siblings('.ajax-cart-quantity');
		const cartItemKey = $button.data('cart-item-key');
		let quantity = parseInt($input.val(), 10);

		if ($button.hasClass('custom-minus')) {
			quantity = Math.max(1, quantity - 1);
		} else if ($button.hasClass('custom-plus')) {
			quantity += 1;
		}

		$input.val(quantity);
		updateCartQuantity(cartItemKey, quantity, $input);
	});

	// Remove product from cart
	jQuery(document).on(
		'click',
		'.remove-item, .remove_from_cart_button',
		function (event) {
			event.preventDefault();
			const $button = jQuery(this);
			const cartItemKey =
				$button.data('remove-item') || $button.data('cart_item_key');
			const productName = $button.data('product_name');

			removeFromCart(cartItemKey, productName, $button);
		}
	);
});
