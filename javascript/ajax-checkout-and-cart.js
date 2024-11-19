import { createNotification } from './notificationBanner';
import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const cartCountElement = document.getElementById('cart-count');

	function updateAllCarts(response) {
		if (response.success) {
			if (response.data.mini_cart) {
				jQuery('#mini-cart-contents').html(response.data.mini_cart); // Update sidebar cart
			}

			if (response.data.product_list) {
				jQuery('.cart-items').html(response.data.product_list); // Update checkout product list
			}

			if (response.data.cart_summary) {
				jQuery('.cart-summary-details').html(
					response.data.cart_summary
				); // Update checkout summary
			}

			if (response.data.cart_count !== undefined) {
				cartCountElement.textContent = response.data.cart_count; // Update cart count
			}
		} else {
			console.error(
				'Nepavyko atnaujinti krepšelio:',
				response.data.message
			);
			createNotification(
				response.data.message || 'Veiksmas nepavyko.',
				false
			);
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

	document
		.querySelectorAll(
			'#single-product-add-to-cart, .add-to-cart-swiper-btn'
		)
		.forEach(function (button) {
			button.addEventListener('click', function (event) {
				event.preventDefault();
				const productId = button.getAttribute('data-product_id');
				const productName = button.getAttribute('data-product_name');
				let quantity = 1;

				const quantityInput = document.querySelector('.quantity-input');
				if (
					quantityInput &&
					button.id === 'single-product-add-to-cart'
				) {
					quantity = quantityInput.value;
				}

				addToCart(productId, quantity, productName);
			});
		});

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
