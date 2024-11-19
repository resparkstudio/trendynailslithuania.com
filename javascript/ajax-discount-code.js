import { createNotification } from './notificationBanner.js';

document.addEventListener('DOMContentLoaded', () => {
	const discountCodeInput = document.getElementById('discount-code');
	const applyDiscountButton = document.querySelector(
		'.apply-discount-button'
	);

	applyDiscountButton.addEventListener('click', (e) => {
		e.preventDefault();

		const discountCode = discountCodeInput.value.trim();
		if (!discountCode) {
			createNotification('Įveskite nuolaidos kodą.', false);
			return;
		}

		// AJAX Request to validate and apply the discount code
		jQuery.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'apply_discount_code', // WooCommerce AJAX action
				discount_code: discountCode,
			},
			success: function (response) {
				if (response.success) {
					createNotification(response.data.message, true);
					// Re-render the cart-summary-details
					fetchCartSummaryDetails();
				} else {
					createNotification(response.data.message, false);
				}
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant pritaikyti nuolaidos kodą.',
					false
				);
			},
		});
	});

	function fetchCartSummaryDetails() {
		// AJAX request to fetch the updated cart-summary-details template
		jQuery.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'fetch_cart_summary', // Custom WooCommerce action
			},
			success: function (response) {
				if (response.success && response.data.cart_summary) {
					const cartSummaryDetails = document.querySelector(
						'.cart-summary-details'
					);
					cartSummaryDetails.innerHTML = response.data.cart_summary;
				} else {
					createNotification(
						'Nepavyko atnaujinti krepšelio suvestinės.',
						false
					);
				}
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant atnaujinti krepšelio suvestinę.',
					false
				);
			},
		});
	}
});
