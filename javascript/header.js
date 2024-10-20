import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const menuItems = document.querySelectorAll('.sidebar-toggle-menu');

	menuItems.forEach((item) => {
		item.addEventListener('click', (event) => {
			const hasChildren =
				item.getAttribute('data-has-children') === 'true';

			if (hasChildren) {
				event.preventDefault();

				const submenu = item.parentElement.querySelector('ul.submenu');
				const icon = item.querySelector('.sidebar-more-icon');

				if (submenu.classList.contains('flex')) {
					submenu.classList.remove('flex');
					submenu.classList.add('hidden');
					icon.classList.remove('menu-icon-flipped-90');
				} else {
					submenu.classList.remove('hidden');
					submenu.classList.add('flex');
					icon.classList.add('menu-icon-flipped-90');
				}
			}
		});
	});

	const sidebarOpenLinks = document.querySelectorAll('.shop-link');
	const mobileSidebarOpenLink = document.querySelector('.mobile-shop-link');
	const sidebarCloseLink = document.getElementById('sidebar-close-link');
	const sidebarCloseLinkSpan = document.querySelector(
		'#sidebar-close-link span'
	);
	const sidebar = document.getElementById('shop-sidebar');

	gsap.set(sidebar, { x: '-100%', display: 'none' });
	gsap.set(sidebarCloseLink, {
		opacity: 0,
		display: 'none',
		visibility: 'hidden',
	});

	function animateLinkOpen(link, color = 'white', rotate = 180) {
		const svg = link.querySelector('svg path');
		const text = link.querySelector('span');

		gsap.to(svg, {
			duration: 0.5,
			rotation: rotate,
			transformOrigin: 'center',
			fill: color,
			ease: 'power2.out',
		});

		gsap.to(text, {
			duration: 0.5,
			color: color,
			ease: 'power2.out',
		});
	}

	function animateLinkClose(link, color = 'black', rotate = 0) {
		const svg = link.querySelector('svg path');
		const text = link.querySelector('span');

		gsap.to(svg, {
			duration: 0.5,
			rotation: rotate,
			transformOrigin: 'center',
			fill: color,
			ease: 'power2.in',
		});

		gsap.to(text, {
			duration: 0.5,
			color: color,
			ease: 'power2.in',
		});
	}

	sidebarOpenLinks.forEach((link) => {
		link.addEventListener('click', function (e) {
			e.preventDefault();
			sidebarCloseLinkSpan.classList.add('toggle-underline');
			gsap.to(link, {
				duration: 0.3,
				opacity: 0,
				ease: 'power2.out',
				onComplete: function () {
					link.style.pointerEvents = 'none';
					link.style.visibility = 'hidden';
				},
			});

			gsap.set(sidebar, { display: 'grid', visibility: 'visible' });
			gsap.to(sidebar, {
				duration: 0.5,
				x: '0%',
				ease: 'power2.out',
			});

			gsap.set(sidebarCloseLink, {
				display: 'flex',
				visibility: 'visible',
			});
			gsap.to(sidebarCloseLink, {
				duration: 0.1,
				opacity: 1,
				ease: 'power2.out',
				onComplete: () => {
					animateLinkOpen(sidebarCloseLink);
				},
			});

			sidebarOpen = true;
		});
	});

	let sidebarOpen = false;

	if (mobileSidebarOpenLink) {
		mobileSidebarOpenLink.addEventListener('click', function (e) {
			e.preventDefault();

			if (sidebarOpen) {
				closeSidebar();
			} else {
				openSidebar();
			}
		});
	}

	sidebarCloseLink.addEventListener('click', function (e) {
		e.preventDefault();
		closeSidebar();
	});

	function closeSidebar() {
		sidebarCloseLinkSpan.classList.remove('toggle-underline');
		gsap.to(sidebar, {
			duration: 0.5,
			x: '-100%',
			ease: 'power2.in',
			onComplete: function () {
				sidebar.style.display = 'none';
			},
		});

		animateLinkClose(sidebarCloseLink);
		gsap.to(sidebarCloseLink, {
			duration: 0.4,
			opacity: 0,
			ease: 'power2.in',
			onComplete: () => {
				sidebarCloseLink.style.display = 'none';

				sidebarOpenLinks.forEach((link) => {
					link.style.visibility = 'visible';
					link.style.pointerEvents = 'auto';
					gsap.to(link, {
						duration: 0.3,
						opacity: 1,
						ease: 'power2.out',
					});
				});
			},
		});

		sidebarOpen = false;
	}

	function openSidebar() {
		sidebarCloseLinkSpan.classList.add('toggle-underline');

		gsap.set(sidebar, { display: 'grid', visibility: 'visible' });
		gsap.to(sidebar, {
			duration: 0.5,
			x: '0%',
			ease: 'power2.out',
		});

		gsap.set(sidebarCloseLink, {
			display: 'flex',
			visibility: 'visible',
		});
		gsap.to(sidebarCloseLink, {
			duration: 0.1,
			opacity: 1,
			ease: 'power2.out',
			onComplete: () => {
				animateLinkOpen(sidebarCloseLink);
			},
		});

		sidebarOpen = true;
	}
});
