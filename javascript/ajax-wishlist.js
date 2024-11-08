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

	// Function to add a product to the wishlist
	function addToWishlist(productId, productName) {
		jQuery.ajax({
			url: ajax_wishlist_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_add_to_wishlist',
				product_id: productId,
			},
			success: function (response) {
				if (response.success) {
					createNotification(
						`${productName} sėkmingai pridėtas į norų sarašą.`,
						true
					);
					updateWishlistCount(); // Update wishlist count on success
				} else {
					createNotification(
						response.data.message ||
							'Nepavyko pridėti į norų sąrašą.',
						false
					);
				}
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant pridėti į norų sarašą.',
					false
				);
			},
		});
	}

	// Function to remove a product from the wishlist
	function removeFromWishlist(productId, productName) {
		jQuery.ajax({
			url: ajax_wishlist_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_remove_from_wishlist',
				product_id: productId,
			},
			success: function (response) {
				if (response.success) {
					createNotification(
						`${productName} sėkmingai pašalintas iš norų sąrašo.`,
						true
					);
					jQuery('.wishlist-items').load(
						location.href + ' .wishlist-items > *'
					); // Refresh wishlist
					updateWishlistCount(); // Update wishlist count on removal
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

	// Event listeners for adding to and removing from wishlist
	document
		.querySelectorAll('.add-to-wishlist-btn')
		.forEach(function (button) {
			button.addEventListener('click', function (event) {
				event.preventDefault();
				const productId = button.getAttribute('data-product_id');
				const productName = button.getAttribute('data-product_name');
				addToWishlist(productId, productName);
			});
		});

	jQuery('.wishlist-items').on(
		'click',
		'.remove-from-wishlist-btn',
		function (event) {
			event.preventDefault();
			const button = jQuery(this);
			const productId = button.data('product_id');
			const productName = button.data('product_name');
			removeFromWishlist(productId, productName);
		}
	);

	// Initial load of the wishlist count
	updateWishlistCount();
});
