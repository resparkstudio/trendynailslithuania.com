document.addEventListener('DOMContentLoaded', function () {
	let page = 2; // Start with page 2 (page 1 is already loaded initially)
	let loading = false;

	const container = document.querySelector('ul.products'); // Target the ul.products element
	if (!container) {
		console.warn(
			"Container element 'ul.products' not found. Exiting script."
		);
		return;
	}

	// Get the category from a parent element's data attribute, if set
	const productList = container.closest('#product-list');
	const category = productList
		? productList.getAttribute('data-category')
		: null;

	// Get current orderby parameter from the URL (if set)
	const urlParams = new URLSearchParams(window.location.search);
	const orderby = urlParams.get('orderby') || 'default';

	// Scroll handler function to load more products on scroll
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
			data.append('orderby', orderby);
			if (category) data.append('category', category);

			fetch(woocommerce_params.ajax_url, {
				method: 'POST',
				body: data,
			})
				.then((response) => response.text())
				.then((response) => {
					if (response == '0') {
						// No more products; remove the scroll event listener
						window.removeEventListener('scroll', loadMoreOnScroll);
					} else {
						container.insertAdjacentHTML('beforeend', response);
						page++;
						loading = false;

						// Fade-in effect for newly loaded products
						// This selects all new product cards; adjust the selector if needed.
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

	// Add the scroll event listener
	window.addEventListener('scroll', loadMoreOnScroll);
});
