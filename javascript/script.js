/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */
document.addEventListener('DOMContentLoaded', function () {
	// ------------------- Header
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
			  <div class="flex items-center">
				<svg class="h-full inline-block" width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
				  <path d="M4.5 5L9 0.621716L8.361 0L6.822 1.50613L4.5 3.76532L2.178 1.50613L0.639 0.00875643L0 0.630473L4.5 5Z" fill="black"/>
				</svg>
			  </div>
			`
		);

		shopLink.classList.add('flex', 'items-center', 'gap-1');

		// ------------------- Footer

		// Footer dynamic date
		document.getElementById('currentYear').textContent =
			new Date().getFullYear();

		// Mobile footer toggle menus
		const toggleMenus = document.querySelectorAll('.md-footer-toggle-menu');

		toggleMenus.forEach((menu) => {
			menu.addEventListener('click', function () {
				let targetMenu;
				const icon = this.querySelector('.menu-icon-rotate'); // Select the icon inside this menu header

				if (this.nextElementSibling.id === 'footer-shop-menu') {
					targetMenu = document.getElementById('footer-shop-menu');
				} else if (this.nextElementSibling.id === 'footer-info-menu') {
					targetMenu = document.getElementById('footer-info-menu');
				}

				// Toggle the visibility of the target menu
				if (targetMenu) {
					targetMenu.classList.toggle('md:hidden');

					// Toggle the rotation of the icon
					icon.classList.toggle('menu-icon-flipped');
				}
			});
		});
	}
});
