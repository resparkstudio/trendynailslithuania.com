document.addEventListener('DOMContentLoaded', function () {
	// Shop sidebar
	const shopLink = document.querySelector('.shop-link');
	const sidebar = document.getElementById('shop-sidebar');
	// Toggle sidebar visibility
	if (shopLink && sidebar) {
		shopLink.addEventListener('click', function (e) {
			e.preventDefault();

			if (sidebar.classList.contains('hidden')) {
				sidebar.classList.remove('hidden');
			} else {
				sidebar.classList.add('hidden');
			}
		});
	}
});
