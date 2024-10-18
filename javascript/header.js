// sidebar.js
import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const sidebarOpenLinks = document.querySelectorAll('.shop-link'); // Main nav shop links (multiple)
	const sidebarCloseLink = document.getElementById('sidebar-close-link'); // Sidebar close link
	const sidebarCloseLinkSpan = document.querySelector(
		'#sidebar-close-link span'
	); // Sidebar close link
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

	// Open sidebar with animation for each shop-link
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

	// Close sidebar with animation
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
	});

	// Inject SVG icon into each .shop-link dynamically
	sidebarOpenLinks.forEach((link) => {
		link.insertAdjacentHTML(
			'beforeend',
			`
            <div class="flex items-center">
                <svg class="h-full inline-block" width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.5 5L9 0.621716L8.361 0L6.822 1.50613L4.5 3.76532L2.178 1.50613L0.639 0.00875643L0 0.630473L4.5 5Z" fill="black"/>
                </svg>
            </div>
        `
		);

		link.classList.add('flex', 'items-center', 'gap-1', 'cursor-pointer');
	});
});
