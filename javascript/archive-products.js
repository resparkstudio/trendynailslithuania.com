document.addEventListener('DOMContentLoaded', function () {
	const filterButtons = document.querySelectorAll('.filter-button');
	const sortDropdown = document.querySelector('.orderby');

	filterButtons.forEach((button) => {
		button.addEventListener('click', function () {
			const filter = this.getAttribute('data-filter');
			const orderby = sortDropdown.value;

			// Remove active class from all buttons and add it to the clicked button
			filterButtons.forEach((btn) => btn.classList.remove('link-active'));
			this.classList.add('link-active');

			// Fetch products based on selected filter and orderby
			fetchFilteredProducts(filter, orderby);
		});
	});

	sortDropdown.addEventListener('change', function () {
		const orderby = this.value;
		const activeFilter =
			document
				.querySelector('.filter-button.link-active')
				?.getAttribute('data-filter') || 'all';
		fetchFilteredProducts(activeFilter, orderby);
	});

	function fetchFilteredProducts(filter, orderby) {
		const productList = document.getElementById('product-list');
		const productCount = document.querySelector('.product-count');
		productList.innerHTML = '';

		const url = `${ajax_product_archive_params.ajax_url}?action=filter_products&filter=${filter}&orderby=${orderby}`;

		fetch(url)
			.then((response) => response.json())
			.then((data) => {
				// Update the product list and product count
				productList.innerHTML = data.products;
				productCount.innerHTML = data.product_count;
			})
			.catch((error) => {
				productList.innerHTML = '<p>Produktų nerasta</p>';
				console.error(error);
			});
	}
});
