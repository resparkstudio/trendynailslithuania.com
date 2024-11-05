document.addEventListener('DOMContentLoaded', function () {
	const sortDropdown = document.querySelector('.orderby');

	if (sortDropdown) {
		const currentCategory = window.location.pathname.includes(
			'/product-category/'
		)
			? window.location.pathname
					.split('/product-category/')[1]
					.split('/')[0]
			: '';

		// Listen for changes in the sorting dropdown
		sortDropdown.addEventListener('change', function () {
			const orderby = this.value;
			const url = new URL(window.location.href);
			url.searchParams.set('orderby', orderby);

			// Update URL without reloading the page
			window.history.pushState({}, '', url);

			// Fetch sorted products via AJAX, including category
			fetchSortedProducts(orderby, currentCategory);
		});
	}
});

function fetchSortedProducts(orderby, category) {
	const productList = document.getElementById('product-list');
	const productCount = document.querySelector('.product-count');
	productList.innerHTML = ''; // Clear current products

	// AJAX URL for sorting, including category and sorting parameters
	const ajaxUrl = `${ajax_product_archive_params.ajax_url}?action=filter_products&orderby=${orderby}&category=${category}`;

	fetch(ajaxUrl)
		.then((response) => response.json())
		.then((data) => {
			productList.innerHTML = data.products;
			productCount.innerHTML = data.product_count;
		})
		.catch((error) => {
			productList.innerHTML = '<p>Produktų nerasta</p>';
			console.error(error);
		});
}
