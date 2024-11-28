import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const cartIcon = document.getElementById('cart-icon');
	const sidebar = document.getElementById('cart-sidebar');
	const overlay = document.getElementById('cart-sidebar-overlay');
	const closeSidebarButton = document.getElementById('close-sidebar');
	const mobileShopLink = document.querySelector('.mobile-shop-link');
	function openSidebar() {
		overlay.classList.remove('hidden');
		sidebar.classList.remove('hidden');
		if (window.innerWidth <= 767) {
			document.body.classList.add('overflow-y-hidden');
		}
		gsap.to(overlay, {
			duration: 0.5,
			opacity: 1,
			ease: 'power2.out',
		});

		gsap.fromTo(
			sidebar,
			{ x: '100%' },
			{ x: '0%', duration: 0.5, ease: 'power2.out' }
		);
	}

	function closeSidebar() {
		gsap.to(overlay, {
			duration: 0.5,
			opacity: 0,
			ease: 'power2.in',
			onComplete: () => overlay.classList.add('hidden'),
		});

		gsap.to(sidebar, {
			x: '100%',
			duration: 0.5,
			ease: 'power2.in',
			onComplete: () => sidebar.classList.add('hidden'),
		});

		if (document.body.classList.contains('overflow-y-hidden')) {
			document.body.classList.remove('overflow-y-hidden');
		}
	}

	// Toggle sidebar open/close
	cartIcon.addEventListener('click', function () {
		if (sidebar.classList.contains('hidden')) {
			openSidebar();
		} else {
			closeSidebar();
		}
	});

	mobileShopLink.addEventListener('click', function () {
		if (!sidebar.classList.contains('hidden')) {
			closeSidebar();
		}
	});

	closeSidebarButton.addEventListener('click', closeSidebar);
	overlay.addEventListener('click', closeSidebar);
});
