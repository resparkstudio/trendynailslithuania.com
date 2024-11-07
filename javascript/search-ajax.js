document.addEventListener('DOMContentLoaded', function () {
	const searchInput = document.getElementById(
		'woocommerce-product-search-field-0'
	);
	const resultsContainer = document.getElementById('product-search-results');

	searchInput.addEventListener('input', function () {
		const query = searchInput.value;

		if (query.length > 0) {
			fetchProducts(query);
		} else {
			resultsContainer.innerHTML = '';
		}
	});

	function fetchProducts(query) {
		const url = `${ajax_product_archive_params.ajax_url}?action=${ajax_product_archive_params.action}&query=${encodeURIComponent(query)}`;

		fetch(url)
			.then((response) => response.json())
			.then((data) => {
				displayResults(data);
			})
			.catch((error) => {
				console.error('Error fetching products:', error);
			});
	}

	function displayResults(data) {
		const resultsContainer = document.getElementById(
			'product-search-results'
		);
		resultsContainer.innerHTML = data.html; // Inject the HTML directly
	}
});
