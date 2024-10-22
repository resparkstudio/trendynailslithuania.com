document.addEventListener('DOMContentLoaded', function () {
	const toggleMenus = document.querySelectorAll('.md-footer-toggle-menu');

	function handleMenuClick(menu) {
		let targetMenu;
		const icon = menu.querySelector('.menu-icon-rotate');

		if (menu.nextElementSibling.id === 'footer-shop-menu') {
			targetMenu = document.getElementById('footer-shop-menu');
		} else if (menu.nextElementSibling.id === 'footer-info-menu') {
			targetMenu = document.getElementById('footer-info-menu');
		}

		if (targetMenu) {
			targetMenu.classList.toggle('md:hidden');
			icon.classList.toggle('menu-icon-flipped');
		}
	}

	function attachToggleListeners() {
		if (window.innerWidth <= 767) {
			toggleMenus.forEach((menu) => {
				menu.addEventListener('click', function () {
					handleMenuClick(this);
				});
			});
		} else {
			toggleMenus.forEach((menu) => {
				menu.removeEventListener('click', function () {
					handleMenuClick(this);
				});
			});
		}
	}

	attachToggleListeners();

	window.addEventListener('resize', attachToggleListeners);

	document.getElementById('currentYear').textContent =
		new Date().getFullYear();
});
