// footer.js

document.addEventListener('DOMContentLoaded', function () {
	// Mobile footer toggle menus
	const toggleMenus = document.querySelectorAll('.md-footer-toggle-menu');

	toggleMenus.forEach((menu) => {
		menu.addEventListener('click', function () {
			let targetMenu;
			const icon = this.querySelector('.menu-icon-rotate');

			if (this.nextElementSibling.id === 'footer-shop-menu') {
				targetMenu = document.getElementById('footer-shop-menu');
			} else if (this.nextElementSibling.id === 'footer-info-menu') {
				targetMenu = document.getElementById('footer-info-menu');
			}

			if (targetMenu) {
				targetMenu.classList.toggle('md:hidden');
				icon.classList.toggle('menu-icon-flipped');
			}
		});
	});

	// Footer dynamic date
	document.getElementById('currentYear').textContent =
		new Date().getFullYear();
});
