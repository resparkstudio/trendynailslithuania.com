import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const sidebarOpenLinks = document.querySelectorAll('.shop-link'); // Main nav shop links (multiple)
	const mobileSidebarOpenLink = document.querySelector('.mobile-shop-link'); // Mobile nav shop link
	const sidebarCloseLink = document.getElementById('sidebar-close-link'); // Sidebar close link
	const sidebarCloseLinkSpan = document.querySelector(
		'#sidebar-close-link span'
	); // Sidebar close link span
	const sidebar = document.getElementById('shop-sidebar');

	// Initial state of sidebar and sidebar-close-link (hidden off-screen)
	gsap.set(sidebar, { x: '-100%', display: 'none' });
	gsap.set(sidebarCloseLink, {
		opacity: 0,
		display: 'none',
		visibility: 'hidden',
	}); // Initially hidden

	// Function to flip SVG 180 degrees and change color
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

	// Function to reset SVG and text color
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

	// Open sidebar with animation for each shop-link (desktop)
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

			gsap.set(sidebar, { display: 'flex', visibility: 'visible' });
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
		});
	});

	// Open or Close sidebar for mobile-shop-link with a toggle state
	let sidebarOpen = false; // Track sidebar state

	if (mobileSidebarOpenLink) {
		mobileSidebarOpenLink.addEventListener('click', function (e) {
			e.preventDefault();

			if (sidebarOpen) {
				// Close the sidebar
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
					},
				});

				sidebarOpen = false; // Update state
			} else {
				// Open the sidebar
				sidebarCloseLinkSpan.classList.add('toggle-underline');

				gsap.set(sidebar, { display: 'flex', visibility: 'visible' });
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

				sidebarOpen = true; // Update state
			}
		});
	}

	// Close sidebar with animation (applies to both desktop and mobile)
	sidebarCloseLink.addEventListener('click', function (e) {
		e.preventDefault();
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
		sidebarOpen = false; // Ensure the state is updated
	});
});
