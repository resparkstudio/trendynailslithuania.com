document.addEventListener('DOMContentLoaded', function () {
	let page = 2; // Start with page 2 as page 1 loads initially
	let loading = false;

	const container = document.querySelector('ul.products'); // Target the ul.products element

	// Check if container exists to avoid errors
	if (!container) {
		console.warn(
			"Container element 'ul.products' not found. Exiting script."
		);
		return;
	}

	const productList = container.closest('#product-list');
	const category = productList
		? productList.getAttribute('data-category')
		: null; // Set this dynamically if it exists

	// Scroll handler function to be removed if no more products are available
	const loadMoreOnScroll = () => {
		if (
			window.innerHeight + window.scrollY >=
				document.body.offsetHeight - 500 &&
			!loading
		) {
			loading = true;

			const data = new FormData();
			data.append('action', 'load_more_products');
			data.append('page', page);
			if (category) data.append('category', category); // Include category if it exists

			fetch(woocommerce_params.ajax_url, {
				method: 'POST',
				body: data,
			})
				.then((response) => response.text())
				.then((response) => {
					if (response == '0') {
						// Stop further AJAX calls, no more products to load
						window.removeEventListener('scroll', loadMoreOnScroll);
					} else {
						container.insertAdjacentHTML('beforeend', response);
						page++;
						loading = false;

						// Fade-in effect for newly loaded products
						const newProducts =
							container.querySelectorAll('li.product-card');
						newProducts.forEach((product) => {
							product.style.opacity = '0';
							product.style.transition = 'opacity 0.5s ease';
							setTimeout(() => (product.style.opacity = '1'), 50);
						});
					}
				})
				.catch((error) =>
					console.error('Error loading more products:', error)
				);
		}
	};

	// Add the scroll event listener only if the container exists
	window.addEventListener('scroll', loadMoreOnScroll);
});
