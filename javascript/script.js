import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	// ------------------- Header
	// Shop sidebar
	const sidebarOpenLink = document.querySelector('.shop-link');
	const sidebarCloseLink = document.getElementById('sidebar-close-link');
	const sidebar = document.getElementById('shop-sidebar');

	// Initial state of sidebar (hidden off-screen)
	gsap.set(sidebar, { x: '-100%', display: 'none' });

	// Open sidebar with animation
	if (sidebarOpenLink) {
		sidebarOpenLink.addEventListener('click', function (e) {
			e.preventDefault();

			// Check if the sidebar is hidden
			if (sidebar.style.display === 'none') {
				// Make the sidebar visible and animate it coming in from the left
				sidebar.style.display = 'flex';
				gsap.to(sidebar, {
					duration: 0.5,
					x: '0%',
					ease: 'power2.out',
				});
			}
		});

		// Close sidebar with animation
		sidebarCloseLink.addEventListener('click', function (e) {
			e.preventDefault();

			// Animate the sidebar sliding out to the left and hide it after animation
			gsap.to(sidebar, {
				duration: 0.5,
				x: '-100%',
				ease: 'power2.in',
				onComplete: function () {
					sidebar.style.display = 'none';
				},
			});
		});

		sidebarOpenLink.insertAdjacentHTML(
			'beforeend',
			`
			  <div class="flex items-center">
				<svg class="h-full inline-block" width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
				  <path d="M4.5 5L9 0.621716L8.361 0L6.822 1.50613L4.5 3.76532L2.178 1.50613L0.639 0.00875643L0 0.630473L4.5 5Z" fill="black"/>
				</svg>
			  </div>
			`
		);

		sidebarOpenLink.classList.add('flex', 'items-center', 'gap-1');
	}

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
});
