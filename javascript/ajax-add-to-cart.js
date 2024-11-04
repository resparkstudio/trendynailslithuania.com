import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const cartCountElement = document.getElementById('cart-count');
	const miniCartContainer = document.querySelector('.woocommerce-mini-cart');

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
					updateMiniCart();
					createNotification(productName || 'Product');
				} else {
					alert(response.data.message || 'Failed to add to cart.');
				}
			},
			error: function () {
				alert('Error occurred while adding the product to cart.');
			},
		});
	}

	function removeFromCart(cartItemKey) {
		jQuery.ajax({
			url: ajax_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_ajax_remove_from_cart',
				cart_item_key: cartItemKey,
			},
			success: function (response) {
				if (response.success) {
					cartCountElement.textContent = response.data.cart_count;
					updateMiniCart();
					createNotification('Item removed from cart');
				} else {
					alert(
						response.data.message || 'Failed to remove from cart.'
					);
				}
			},
			error: function () {
				alert('Error occurred while removing the item from cart.');
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
					// Update cart contents
					const miniCartContents = document.querySelector(
						'.woocommerce-mini-cart ul'
					);
					if (miniCartContents) {
						miniCartContents.innerHTML =
							response.data.mini_cart_contents;
					}

					// Update cart totals
					const miniCartTotals =
						document.getElementById('mini-cart-totals');
					if (miniCartTotals) {
						miniCartTotals.innerHTML =
							response.data.mini_cart_totals;
					}
				}
			},
			error: function () {
				console.error('Failed to update mini cart.');
			},
		});
	}

	function createNotification(message) {
		const notificationContainer =
			document.getElementById('notification-container') ||
			createNotificationContainer();
		const notification = document.createElement('div');
		notification.classList.add(
			'notification-banner',
			'bg-white',
			'body-extra-small-regular',
			'notification-banner-shadow',
			'rounded-l-[6px]',
			'p-3',
			'flex',
			'items-center',
			'w-60'
		);
		notification.innerHTML = `
			<div class=" pr-2">
			<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M7 0C3.14005 0 0 3.14005 0 7C0 10.86 3.14005 14 7 14C10.86 14 14 10.86 14 7C14 3.14005 10.86 0 7 0Z" fill="black"/>
			<path d="M10.5486 5.99591L6.75694 9.78751C6.64319 9.90126 6.49387 9.95851 6.34454 9.95851C6.19522 9.95851 6.0459 9.90126 5.93214 9.78751L4.03635 7.89171C3.8082 7.66367 3.8082 7.29495 4.03635 7.06691C4.26439 6.83876 4.633 6.83876 4.86115 7.06691L6.34454 8.55031L9.72385 5.17111C9.95189 4.94296 10.3205 4.94296 10.5486 5.17111C10.7767 5.39915 10.7767 5.76776 10.5486 5.99591Z" fill="#FAFAFA"/>
			</svg>
			</div>
			<div>${message}</div>
		`;
		notificationContainer.prepend(notification);

		gsap.fromTo(
			notification,
			{ x: 300, opacity: 0 },
			{ x: 0, opacity: 1, duration: 0.5, ease: 'power2.out' }
		);

		const notifications = Array.from(notificationContainer.children);
		const tl = gsap.timeline();

		notifications.forEach((notif, index) => {
			tl.to(
				notif,
				{
					y: index * 10,
					duration: 0.5,
					ease: 'power2.out',
				},
				'<'
			);
		});

		setTimeout(() => {
			gsap.to(notification, {
				x: 300,
				opacity: 0,
				duration: 0.5,
				ease: 'power2.in',
				onComplete: () => notification.remove(),
			});
		}, 10000);
	}

	function createNotificationContainer() {
		const container = document.createElement('div');
		container.id = 'notification-container';
		container.style.position = 'fixed';
		container.style.top = '10px';
		container.style.right = '10px';
		container.style.zIndex = '1000';
		document.body.appendChild(container);
		return container;
	}

	// Attach event listeners to all Add to Cart buttons
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

	// Attach event listeners to all Remove from Cart buttons
	document.addEventListener('click', function (event) {
		if (event.target.closest('.remove_from_cart_button')) {
			event.preventDefault();
			const button = event.target.closest('.remove_from_cart_button');
			const cartItemKey = button.getAttribute('data-cart_item_key');
			removeFromCart(cartItemKey);
		}
	});
});
