import { createNotification } from './notificationBanner';

document.addEventListener('DOMContentLoaded', function () {
	const cartCountElement = document.getElementById('cart-count');

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

			// Trigger WooCommerce fragment refresh for traditional cart/checkout
			jQuery(document.body).trigger('wc_fragment_refresh');

			// Trigger checkout block to refresh (for WooCommerce Blocks)
			if (window.wp && window.wp.data && window.wp.data.dispatch) {
				const store = window.wp.data.dispatch('wc/store/cart');
				if (store && typeof store.invalidateResolutionForStore === 'function') {
					store.invalidateResolutionForStore();
				}
			}

			// If the cart is empty, redirect to homepage
			if (response.data.redirect) {
				window.location.href = '/';
			}
		} else {
			console.error('Error updating cart:', response.data.message);
		}
	}

	function addToCart(productId, quantity, productName) {
		jQuery.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_ajax_add_to_cart',
				product_id: productId,
				quantity: quantity,
			},
			success: function (response) {
				if (response.success) {
					updateAllCarts(response); // Sinchronizuoti visus krepšelius
					createNotification(
						`${productName} sėkmingai pridėtas į krepšelį.`,
						true
					);
				} else {
					createNotification(
						response.data.message || 'Nepavyko pridėti į krepšelį.',
						false
					);
				}
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant pridėti į krepšelį.',
					false
				);
			},
		});
	}

	function addToCartVariable(productId, variationId, quantity, productName) {
		jQuery.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_ajax_add_to_cart',
				product_id: productId,
				variation_id: variationId,
				quantity: quantity,
			},
			success: function (response) {
				if (response.success) {
					updateAllCarts(response);
					createNotification(
						`${productName} sėkmingai pridėtas į krepšelį.`,
						true
					);
				} else {
					createNotification(
						response.data.message || 'Nepavyko pridėti į krepšelį.',
						false
					);
				}
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant pridėti į krepšelį.',
					false
				);
			},
		});
	}

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
				$input.prop('disabled', true); // Užkirsti kelią spaminimui
			},
			success: function (response) {
				updateAllCarts(response); // Sinchronizuoti visus krepšelius
			},
			complete: function () {
				$input.prop('disabled', false);
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant atnaujinti produkto kiekį.',
					false
				);
			},
		});
	}

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
						return false;
					} else {
						updateAllCarts(response);
						createNotification(
							`${productName} sėkmingai pašalintas iš krepšelio.`,
							true
						);
					}
				} else {
					createNotification(
						response.data.message || 'Nepavyko pašalinti produkto.',
						false
					);
				}
			},

			error: function () {
				createNotification(
					'Įvyko klaida bandant pašalinti produktą iš krepšelio.',
					false
				);
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
			const $form = $button.closest('form');
			const productId = $button.data('product_id');
			const productName = $button.data('product_name');
			const quantityInput = $form.find('.quantity-input');
			let quantity = parseInt(quantityInput.val(), 10) || 1;

			// Check if it's a variable product (has variation_id field)
			const variationIdInput = $form.find('input.variation_id');

			// Validate single product gift card fields
			if ($form[0]) {
				if (!$form[0].reportValidity()) {
					return;
				}
			}

			if (variationIdInput.length) {
				const variationId = variationIdInput.val();
				addToCartVariable(
					productId,
					variationId,
					quantity,
					productName
				);
			} else {
				// Simple product
				addToCart(productId, quantity, productName);
			}
		}
	);

	jQuery(document).on('change', '.ajax-cart-quantity', function () {
		const $input = jQuery(this);
		const cartItemKey = $input.data('cart-item-key');
		const quantity = $input.val();

		updateCartQuantity(cartItemKey, quantity, $input);
	});

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

	jQuery('#discount-code').on('keydown', function (event) {
		if (event.key === 'Enter') {
			event.preventDefault();
			jQuery('.apply-discount-button').click();
		}
	});

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
