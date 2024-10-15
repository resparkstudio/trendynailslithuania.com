document.addEventListener('DOMContentLoaded', function () {
	// Shop sidebar
	const shopLink = document.querySelector('.shop-link');
	const sidebar = document.getElementById('shop-sidebar');
	// Toggle sidebar visibility
	if (shopLink) {
		shopLink.addEventListener('click', function (e) {
			e.preventDefault();

			if (sidebar.classList.contains('hidden')) {
				sidebar.classList.remove('hidden');
				sidebar.classList.add('flex');
			} else {
				sidebar.classList.add('hidden');
				sidebar.classList.remove('flex');
			}
		});

		shopLink.insertAdjacentHTML(
			'beforeend',
			`
              <svg class="h-full" width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.5 5L9 0.621716L8.361 0L6.822 1.50613L4.5 3.76532L2.178 1.50613L0.639 0.00875643L0 0.630473L4.5 5Z" fill="black"/>
              </svg>
            `
		);

		shopLink.classList.add('flex', 'items-center', 'space-x-[0.25rem]');
	}
});
