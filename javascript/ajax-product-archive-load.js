document.addEventListener('DOMContentLoaded', function () {
	let page = 2; // Start with page 2 as page 1 loads initially
	let loading = false;
	const container = document.querySelector('ul.products'); // Target the ul.products element
	const category = container
		.closest('#product-list')
		.getAttribute('data-category'); // Set this dynamically if you have a category-specific attribute

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

	window.addEventListener('scroll', loadMoreOnScroll);
});
