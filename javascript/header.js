// SU TIMELINE

import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const sidebarOpenLinks = document.querySelectorAll('.shop-link');
	const sidebarOpenedShopLink = document.getElementById(
		'sidebar-opened-shop-link'
	);
	const sidebarOpenedShopLinkSpan = document.querySelector(
		'#sidebar-opened-shop-link span'
	);
	const sidebar = document.getElementById('shop-sidebar');

	gsap.set(sidebar, { x: '-100%', display: 'none' });
	gsap.set(sidebarOpenedShopLink, {
		opacity: 0,
		display: 'none',
		visibility: 'hidden',
	});

	let isAnimating = false;

	const timeline = gsap.timeline({ paused: true });

	timeline
		.set(sidebar, { display: 'grid', visibility: 'visible' }) // Prepare sidebar
		.set(sidebarOpenedShopLink, { display: 'flex', visibility: 'visible' }) // Prepare link
		.to(
			sidebarOpenLinks,
			{
				duration: 0.3,
				opacity: 0,
				ease: 'power2.out',
				onStart: () => {
					sidebarOpenedShopLinkSpan.classList.add('toggle-underline');
					sidebarOpenLinks.forEach((link) => {
						link.style.pointerEvents = 'none';
						link.style.visibility = 'hidden';
					});
				},
			},
			0
		)
		.to(
			sidebar,
			{
				duration: 0.5,
				x: '0%',
				ease: 'power2.out',
			},
			0
		)
		.to(
			sidebarOpenedShopLink,
			{
				duration: 0.1,
				opacity: 1,
				ease: 'power2.out',
				onComplete: () => {
					animateLinkOpen(sidebarOpenedShopLink);
					isAnimating = false;
				},
			},
			0
		);

	function closeSidebar() {
		if (isAnimating) return;

		isAnimating = true;

		gsap.timeline()
			.to(
				sidebar,
				{
					duration: 0.5,
					x: '-100%',
					ease: 'power2.in',
					onComplete: () => {
						sidebar.style.display = 'none';
					},
				},
				0
			)
			.to(
				sidebarOpenedShopLink,
				{
					duration: 0.4,
					opacity: 0,
					ease: 'power2.in',
					onComplete: () => {
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
						isAnimating = false;
					},
				},
				0
			);
	}

	sidebarOpenLinks.forEach((link) => {
		link.addEventListener('mouseover', function (e) {
			if (isAnimating) return;

			isAnimating = true;
			timeline.restart(); // Restart animation
		});
	});

	sidebar.addEventListener('mouseleave', function (e) {
		if (!isAnimating) {
			closeSidebar();
		}
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
});

// BE TIMELINE

// import gsap from 'gsap';

// document.addEventListener('DOMContentLoaded', function () {
// 	const menuItems = document.querySelectorAll('.sidebar-toggle-menu');

// 	menuItems.forEach((item) => {
// 		item.addEventListener('click', (event) => {
// 			const hasChildren =
// 				item.getAttribute('data-has-children') === 'true';

// 			if (hasChildren) {
// 				event.preventDefault();

// 				const submenu = item.parentElement.querySelector('ul.submenu');
// 				const icon = item.querySelector('.sidebar-more-icon');

// 				if (submenu.classList.contains('flex')) {
// 					submenu.classList.remove('flex');
// 					submenu.classList.add('hidden');
// 					icon.classList.remove('menu-icon-flipped-90');
// 				} else {
// 					submenu.classList.remove('hidden');
// 					submenu.classList.add('flex');
// 					icon.classList.add('menu-icon-flipped-90');
// 				}
// 			}
// 		});
// 	});

// 	const sidebarOpenLinks = document.querySelectorAll('.shop-link');
// 	const mobileSidebarOpenLink = document.querySelector('.mobile-shop-link');
// 	const sidebarOpenedShopLink = document.getElementById(
// 		'sidebar-opened-shop-link'
// 	);
// 	const sidebarOpenedShopLinkSpan = document.querySelector(
// 		'#sidebar-opened-shop-link span'
// 	);
// 	const sidebar = document.getElementById('shop-sidebar');

// 	gsap.set(sidebar, { x: '-100%', display: 'none' });
// 	gsap.set(sidebarOpenedShopLink, {
// 		opacity: 0,
// 		display: 'none',
// 		visibility: 'hidden',
// 	});

// 	function animateLinkOpen(link, color = 'white', rotate = 180) {
// 		const svg = link.querySelector('svg path');
// 		const text = link.querySelector('span');

// 		gsap.to(svg, {
// 			duration: 0.5,
// 			rotation: rotate,
// 			transformOrigin: 'center',
// 			fill: color,
// 			ease: 'power2.out',
// 		});

// 		gsap.to(text, {
// 			duration: 0.5,
// 			color: color,
// 			ease: 'power2.out',
// 		});
// 	}

// 	function animateLinkClose(link, color = 'black', rotate = 0) {
// 		const svg = link.querySelector('svg path');
// 		const text = link.querySelector('span');

// 		gsap.to(svg, {
// 			duration: 0.5,
// 			rotation: rotate,
// 			transformOrigin: 'center',
// 			fill: color,
// 			ease: 'power2.in',
// 		});

// 		gsap.to(text, {
// 			duration: 0.5,
// 			color: color,
// 			ease: 'power2.in',
// 		});
// 	}

// 	sidebarOpenLinks.forEach((link) => {
// 		link.addEventListener('mouseover', function (e) {
// 			e.preventDefault();
// 			sidebarOpenedShopLinkSpan.classList.add('toggle-underline');
// 			gsap.to(link, {
// 				onStart: () => disableHover(),
// 				duration: 0.3,
// 				opacity: 0,
// 				ease: 'power2.out',
// 				onComplete: function () {
// 					link.style.pointerEvents = 'none';
// 					link.style.visibility = 'hidden';
// 					enableHover();
// 				},
// 			});

// 			gsap.set(sidebar, { display: 'grid', visibility: 'visible' });
// 			gsap.to(sidebar, {
// 				onStart: () => disableHover(),
// 				duration: 0.5,
// 				x: '0%',
// 				ease: 'power2.out',
// 				onComplete: function () {
// 					enableHover();
// 				},
// 			});

// 			gsap.set(sidebarOpenedShopLink, {
// 				display: 'flex',
// 				visibility: 'visible',
// 			});
// 			gsap.to(sidebarOpenedShopLink, {
// 				duration: 0.1,
// 				opacity: 1,
// 				ease: 'power2.out',
// 				onComplete: () => {
// 					animateLinkOpen(sidebarOpenedShopLink);
// 				},
// 			});

// 			sidebarOpen = true;
// 		});
// 	});

// 	let sidebarOpen = false;

// 	if (mobileSidebarOpenLink) {
// 		mobileSidebarOpenLink.addEventListener('click', function (e) {
// 			e.preventDefault();

// 			if (sidebarOpen) {
// 				closeSidebar();
// 			} else {
// 				openSidebar();
// 			}
// 		});
// 	}

// 	sidebar.addEventListener('mouseleave', function (e) {
// 		if (window.innerWidth >= 767) {
// 			const relatedTarget = e.relatedTarget;
// 			const safeDiv = document.querySelector(
// 				'#sidebar-opened-shop-wrapper'
// 			);

// 			if (
// 				safeDiv &&
// 				(relatedTarget === safeDiv || safeDiv.contains(relatedTarget))
// 			) {
// 				return;
// 			}

// 			e.preventDefault();
// 			closeSidebar();
// 		}
// 	});

// 	function closeSidebar() {
// 		sidebarOpenedShopLinkSpan.classList.remove('toggle-underline');
// 		gsap.to(sidebar, {
// 			duration: 0.5,
// 			x: '-100%',
// 			ease: 'power2.in',
// 			onComplete: function () {
// 				sidebar.style.display = 'none';
// 			},
// 		});

// 		animateLinkClose(sidebarOpenedShopLink);
// 		gsap.to(sidebarOpenedShopLink, {
// 			duration: 0.4,
// 			opacity: 0,
// 			ease: 'power2.in',
// 			onComplete: () => {
// 				sidebarOpenedShopLink.style.display = 'none';

// 				sidebarOpenLinks.forEach((link) => {
// 					link.style.visibility = 'visible';
// 					link.style.pointerEvents = 'auto';
// 					gsap.to(link, {
// 						duration: 0.3,
// 						opacity: 1,
// 						ease: 'power2.out',
// 					});
// 				});
// 			},
// 		});

// 		sidebarOpen = false;
// 	}

// 	function openSidebar() {
// 		sidebarOpenedShopLinkSpan.classList.add('toggle-underline');

// 		gsap.set(sidebar, { display: 'grid', visibility: 'visible' });
// 		gsap.to(sidebar, {
// 			duration: 0.5,
// 			x: '0%',
// 			ease: 'power2.out',
// 		});

// 		gsap.set(sidebarOpenedShopLink, {
// 			display: 'flex',
// 			visibility: 'visible',
// 		});
// 		gsap.to(sidebarOpenedShopLink, {
// 			duration: 0.1,
// 			opacity: 1,
// 			ease: 'power2.out',
// 			onComplete: () => {
// 				animateLinkOpen(sidebarOpenedShopLink);
// 			},
// 		});

// 		sidebarOpen = true;
// 	}
// });
