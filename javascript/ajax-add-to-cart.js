document.addEventListener('DOMContentLoaded', function () {
	// Listen for clicks on the Add to Cart button
	document.body.addEventListener('click', function (event) {
		if (event.target.classList.contains('add_to_cart_button')) {
			event.preventDefault();

			let button = event.target;
			let productId = button.getAttribute('data-product_id');
			let quantity = button.getAttribute('data-quantity') || 1;
			let productSku = button.getAttribute('data-product_sku') || '';

			// AJAX request to add product to cart
			fetch(ajax_add_to_cart_params.ajax_url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams({
					action: 'custom_ajax_add_to_cart',
					product_id: productId,
					quantity: quantity,
					product_sku: productSku,
				}),
			})
				.then((response) => response.json())
				.then((data) => {
					if (data.error) {
						console.error(data.message);
					} else {
						// Trigger WooCommerce fragment refresh
						document.body.dispatchEvent(
							new Event('wc_fragment_refresh')
						);
					}
				})
				.catch((error) => console.error('Error:', error));
		}
	});

	// Function to update the cart count badge
	function updateCartCount() {
		const cartCount = document.getElementById('cart-count');
		if (cartCount) {
			// Fetch the updated cart count from WooCommerce's global fragment parameters
			const newCount = parseInt(
				wc_cart_fragments_params.cart_contents_count,
				10
			);
			cartCount.textContent = newCount > 0 ? newCount : '';
		}
	}

	// Listen for WooCommerce events to update the cart count
	document.body.addEventListener('wc_fragments_refreshed', updateCartCount);
	document.body.addEventListener('added_to_cart', updateCartCount);
});
