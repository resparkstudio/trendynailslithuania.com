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
	const sidebarOpenedShopLink = document.getElementById(
		'sidebar-opened-shop-link'
	);
	const sidebarOpenedShopLinkSpan = document.querySelector(
		'#sidebar-opened-shop-link span'
	);
	const sidebar = document.getElementById('shop-sidebar');

	// GSAP Timeline
	const timeline = gsap.timeline({ paused: true });

	// Initial State
	sidebarOpenedShopLink.style.display = 'none';

	// Define Timeline Animations
	timeline
		.set(sidebar, { x: '-100%', display: 'none' })
		.set(sidebarOpenedShopLink, {
			opacity: 0,
			display: 'none',
			visibility: 'hidden',
		})
		.to(sidebar, {
			duration: 0.5,
			x: '0%',
			display: 'grid',
			visibility: 'visible',
			ease: 'power2.out',
		})
		.to(
			sidebarOpenedShopLink,
			{
				duration: 0.1,
				opacity: 1,
				display: 'flex',
				visibility: 'visible',
				ease: 'power2.out',
				onComplete: () => {
					animateLinkOpen(sidebarOpenedShopLink);
				},
			},
			'<'
		)
		.to(
			sidebarOpenLinks,
			{
				duration: 0.3,
				opacity: 0,
				pointerEvents: 'none',
				visibility: 'hidden',
				ease: 'power2.out',
			},
			'<'
		);

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
			opacity: 1,
			color: color,
			ease: 'power2.out',
		});
	}

	function animateLinkClose(link, color = 'black', rotate = 0) {
		const svg = link.querySelector('svg path');
		const text = link.querySelector('span');

		gsap.to(svg, {
			duration: 0.3,
			rotation: rotate,
			transformOrigin: 'center',
			fill: color,
			ease: 'power2.in',
		});

		gsap.to(text, {
			duration: 0.3,
			opacity: 0,
			color: color,
			ease: 'power2.in',
		});
	}

	sidebarOpenLinks.forEach((link) => {
		link.addEventListener('mouseover', function (e) {
			e.preventDefault();
			sidebarOpenedShopLinkSpan.classList.add('link-hover');

			gsap.to(link, {
				onStart: () => disableHover(),
				duration: 0.3,
				opacity: 0,
				ease: 'power2.out',
				onComplete: function () {
					link.style.pointerEvents = 'none';
					link.style.visibility = 'hidden';
					enableHover();
				},
			});

			timeline.play();
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
			closeSidebar();
		}
	});

	function closeSidebar() {
		sidebarOpenedShopLinkSpan.classList.remove('link-hover');
		timeline.reverse();
		animateLinkClose(sidebarOpenedShopLink);
		timeline.eventCallback('onReverseComplete', () => {
			sidebarOpenedShopLink.style.display = 'none';

			sidebarOpenLinks.forEach((link) => {
				link.style.visibility = 'visible';
				link.style.pointerEvents = 'auto';
				gsap.to(link, {
					duration: 0.3,
					opacity: 1,
					ease: 'power2.out',
				});
			});
		});

		sidebarOpen = false;
	}

	function openSidebar() {
		sidebarOpenedShopLinkSpan.classList.add('link-hover');
		timeline.play();
		sidebarOpen = true;
	}

	function disableHover() {
		document.body.classList.add('disable-hover');
	}

	function enableHover() {
		document.body.classList.remove('disable-hover');
	}
});
