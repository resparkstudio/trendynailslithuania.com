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

				if (submenu.classList.contains('flex')) {
					submenu.classList.remove('flex');
					submenu.classList.add('hidden');
				} else {
					submenu.classList.remove('hidden');
					submenu.classList.add('flex');
				}
			}
		});
	});

	const sidebarOpenLinks = document.querySelectorAll('.shop-link');
	const mobileSidebarOpenLink = document.querySelector('.mobile-shop-link');
	const sidebarOpenedShopLink = document.getElementById(
		'sidebar-opened-shop-link'
	);
	const sidebar = document.getElementById('shop-sidebar');

	let sidebarOpen = false;

	// Initial state: Hide sidebar and sidebarOpenedShopLink
	gsap.set(sidebar, { x: '-100%', display: 'none' });
	gsap.set(sidebarOpenedShopLink, {
		opacity: 0,
		display: 'none',
		visibility: 'hidden',
	});

	// Create a single GSAP timeline (paused by default)
	const sidebarTimeline = gsap.timeline({ paused: true });

	sidebarTimeline
		.set(sidebar, { display: 'grid', visibility: 'visible' })
		.to(sidebar, { duration: 0.5, x: '0%', ease: 'power2.out' }, 0)
		.set(
			sidebarOpenedShopLink,
			{ display: 'flex', visibility: 'visible' },
			0
		)
		.to(
			sidebarOpenedShopLink,
			{ duration: 0.3, opacity: 1, ease: 'power2.out' },
			0.2
		);

	// Sidebar toggle logic
	function toggleSidebar(open) {
		if (open) {
			sidebarTimeline.play();
		} else {
			sidebarTimeline.reverse();
		}
		sidebarOpen = open;
	}

	sidebarOpenLinks.forEach((link) => {
		link.addEventListener('mouseover', function (e) {
			e.preventDefault();

			// Simultaneously hide the link and open the sidebar
			gsap.to(link, {
				duration: 0.3,
				opacity: 0,
				ease: 'power2.out',
				onComplete: function () {
					link.style.pointerEvents = 'none';
					link.style.visibility = 'hidden';
				},
			});

			// Flip both SVG icons
			const svgIcons = document.querySelectorAll(
				'.shop-link svg, #sidebar-opened-shop-link svg'
			);
			gsap.to(svgIcons, {
				duration: 0.6,
				rotation: 180,
				ease: 'power2.out',
			});

			toggleSidebar(true);
		});
	});

	sidebar.addEventListener('mouseleave', function (e) {
		if (window.innerWidth >= 767) {
			const relatedTarget = e.relatedTarget;
			const safeDiv = document.querySelector(
				'#sidebar-opened-shop-wrapper'
			);

			if (
				safeDiv &&
				(relatedTarget === safeDiv || safeDiv.contains(relatedTarget))
			) {
				return;
			}

			e.preventDefault();
			toggleSidebar(false);

			sidebarOpenLinks.forEach((link) => {
				link.style.visibility = 'visible';
				link.style.pointerEvents = 'auto';
				gsap.to(link, {
					duration: 0.3,
					opacity: 1,
					ease: 'power2.out',
				});
			});

			const svgIcons = document.querySelectorAll(
				'.shop-link svg, #sidebar-opened-shop-link svg'
			);
			gsap.to(svgIcons, {
				duration: 0.6,
				rotation: 0,
				ease: 'power2.out',
			});
		}
	});

	// Mobile shop link functionality
	if (mobileSidebarOpenLink) {
		mobileSidebarOpenLink.addEventListener('click', function (e) {
			e.preventDefault();
			toggleSidebar(!sidebarOpen);
		});
	}
});
