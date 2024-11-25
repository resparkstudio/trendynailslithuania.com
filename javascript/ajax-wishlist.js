import { createNotification } from './notificationBanner';
import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	// Function to update wishlist count
	function updateWishlistCount() {
		jQuery.ajax({
			url: ajax_wishlist_params.ajax_url,
			type: 'POST',
			data: {
				action: 'get_wishlist_count',
			},
			success: function (response) {
				if (response.success) {
					const wishlistCountElement =
						document.getElementById('wishlist-count');
					if (wishlistCountElement) {
						wishlistCountElement.textContent =
							response.data.wishlist_count;
					}
				}
			},
		});
	}

	// Function to toggle a product in the wishlist
	function toggleWishlist(productId, productName, button) {
		jQuery.ajax({
			url: ajax_wishlist_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_add_to_wishlist',
				product_id: productId,
			},
			success: function (response) {
				if (response.success) {
					const iconPath = button.querySelector('svg path');
					const isAdding = response.data.message.includes('pridėtas');

					// Toggle UI state
					button.classList.toggle('active', isAdding);
					iconPath.setAttribute(
						'fill',
						isAdding ? 'currentColor' : 'none'
					);

					// Show notification
					createNotification(response.data.message, true);

					// Update wishlist count
					updateWishlistCount();
				} else {
					createNotification(
						response.data.message ||
							'Nepavyko atnaujinti norų sąrašo.',
						false
					);
				}
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant atnaujinti norų sąrašą.',
					false
				);
			},
		});
	}

	// Function to remove a product explicitly from the wishlist
	function removeFromWishlist(productId, productName, card) {
		jQuery.ajax({
			url: ajax_wishlist_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_remove_from_wishlist',
				product_id: productId,
			},
			success: function (response) {
				if (response.success) {
					// Show notification
					createNotification(
						`${productName} sėkmingai pašalintas iš norų sąrašo.`,
						true
					);

					// Remove the product card from the wishlist page
					if (card) {
						gsap.to(card, {
							opacity: 0,
							duration: 0.5,
							onComplete: function () {
								card.remove();
							},
						});
					}

					// Update wishlist count
					updateWishlistCount();
				} else {
					createNotification(
						response.data.message ||
							'Nepavyko pašalinti iš norų sąrašo.',
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

	// Attach click event to wishlist buttons
	jQuery(document).on('click', '.add-to-wishlist-btn', function (event) {
		event.preventDefault();
		const button = this;
		const productId = jQuery(button).data('product_id');
		const productName = jQuery(button).data('product_name');
		toggleWishlist(productId, productName, button);
	});

	// Attach click event to remove-from-wishlist buttons on the wishlist page
	jQuery(document).on('click', '.remove-from-wishlist-btn', function (event) {
		event.preventDefault();
		const button = this;
		const productId = jQuery(button).data('product_id');
		const productName = jQuery(button).data('product_name');
		const productCard = button.closest('.product-card'); // Find the parent card
		removeFromWishlist(productId, productName, productCard);
	});

	// Initial load of the wishlist count
	updateWishlistCount();
});
