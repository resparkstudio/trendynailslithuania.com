document.addEventListener('DOMContentLoaded', function () {
	let page = 2; // Start with page 2 as page 1 loads initially
	let loading = false;
	const container = document.querySelector('.products'); // Adjust to match your product container class

	window.addEventListener('scroll', () => {
		if (
			window.innerHeight + window.scrollY >=
				document.body.offsetHeight - 500 &&
			!loading
		) {
			loading = true;

			const data = new FormData();
			data.append('action', 'load_more_products');
			data.append('page', page);

			fetch(woocommerce_params.ajax_url, {
				method: 'POST',
				body: data,
			})
				.then((response) => response.text())
				.then((response) => {
					if (response == '0') {
						window.removeEventListener('scroll', this);
					} else {
						container.insertAdjacentHTML('beforeend', response);
						page++;
						loading = false;

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
	});
});
