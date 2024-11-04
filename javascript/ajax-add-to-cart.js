document.addEventListener('DOMContentLoaded', function () {
	const cartCountElement = document.getElementById('cart-count');
	const miniCartContainer = document.querySelector('.woocommerce-mini-cart');

	function addToCart(productId, quantity) {
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
					updateMiniCart();
				} else {
					alert(response.data.message);
				}
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
					miniCartContainer.innerHTML = response.data.mini_cart;
				}
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
				const quantityInput = document.querySelector('.quantity-input');
				const quantity = quantityInput ? quantityInput.value : 1; // Default to 1 if no input found
				addToCart(productId, quantity);
			});
		});
});
