document.addEventListener('DOMContentLoaded', function () {
	const searchInput = document.getElementById(
		'woocommerce-product-search-field-0'
	);
	const resultsContainer = document.getElementById('product-search-results');
	const searchButton = document.querySelector('button[type="submit"]'); // Select the search button

	// Disable the button initially
	searchButton.disabled = true;

	searchInput.addEventListener('input', function () {
		const query = searchInput.value;

		// Enable or disable the search button based on the input
		searchButton.disabled = query.length === 0;

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
		resultsContainer.innerHTML = data.html; // Inject the HTML directly

		// Enable or disable the button based on whether products were found
		searchButton.disabled = !data.has_results;
	}
});
