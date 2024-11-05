document.addEventListener('DOMContentLoaded', function () {
	const filterButtons = document.querySelectorAll('.filter-button');
	const sortDropdown = document.querySelector('.orderby');

	// Event listeners for filter buttons
	filterButtons.forEach((button) => {
		button.addEventListener('click', function () {
			const filter = this.getAttribute('data-filter');
			const orderby = sortDropdown.value;
			fetchFilteredProducts(filter, orderby);
		});
	});

	// AJAX sorting on dropdown change
	sortDropdown.addEventListener('change', function () {
		const orderby = this.value;
		const activeFilter =
			document
				.querySelector('.filter-button.active')
				?.getAttribute('data-filter') || 'all';
		fetchFilteredProducts(activeFilter, orderby);
	});

	function fetchFilteredProducts(filter, orderby) {
		const productList = document.getElementById('product-list');
		const productCount = document.querySelector(
			'.woocommerce-result-count'
		);
		productList.innerHTML = '<p>Loading...</p>';

		const url = `${ajax_product_archive_params.ajax_url}?action=filter_products&filter=${filter}&orderby=${orderby}`;

		fetch(url)
			.then((response) => response.json())
			.then((data) => {
				productList.innerHTML = data.products;
				productCount.innerHTML = data.product_count;
			})
			.catch((error) => {
				productList.innerHTML = '<p>Failed to load products.</p>';
				console.error(error);
			});
	}
});
