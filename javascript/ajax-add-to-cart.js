import { createNotification } from './notificationBanner';
import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const cartCountElement = document.getElementById('cart-count');

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
					cartCountElement.textContent = response.data.cart_count;
					updateMiniCart(); // Refresh the mini cart contents
					createNotification(
						`${productName} sėkmingai pridėtas į krepšelį.`,
						true
					);
				} else {
					createNotification(
						response.data.message || 'Nepavyko pridėti į krepšelį',
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

	function updateMiniCart() {
		jQuery.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_update_mini_cart',
			},
			success: function (response) {
				if (response.success) {
					jQuery('#mini-cart-contents').html(response.data.mini_cart);
				}
			},
		});
	}

	function removeFromCart(cartItemKey, productName) {
		jQuery.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_remove_from_cart',
				cart_item_key: cartItemKey,
			},
			success: function (response) {
				if (response.success) {
					jQuery('#mini-cart-contents').html(response.data.mini_cart);
					cartCountElement.textContent = response.data.cart_count;
					createNotification(
						`${productName} sėkmingai pašalintas iš krepšelio.`,
						true
					);
				} else {
					createNotification(
						response.data.message ||
							'Nepavyko pašalinti į krepšelį',
						false
					);
				}
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant pašalinti iš norų sąrašo.',
					false
				);
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

	jQuery(document).on('click', '.remove_from_cart_button', function (event) {
		event.preventDefault();
		const cartItemKey = jQuery(this).data('cart_item_key');
		const productName = jQuery(this).data('product_name');
		removeFromCart(cartItemKey, productName);
	});
});
