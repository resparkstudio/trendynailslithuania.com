import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	// Shop sidebar
	const sidebarOpenLink = document.querySelector('.shop-link'); // Main nav shop link
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

	// Open sidebar with animation
	if (sidebarOpenLink) {
		sidebarOpenLink.addEventListener('click', function (e) {
			e.preventDefault();
			sidebarCloseLinkSpan.classList.add('toggle-underline');
			// Visually hide the shop-link without affecting layout and flip its icon
			gsap.to(sidebarOpenLink, {
				duration: 0.3,
				opacity: 0,
				ease: 'power2.out',
				onComplete: function () {
					sidebarOpenLink.style.pointerEvents = 'none'; // Disable clicks on shop-link
					sidebarOpenLink.style.visibility = 'hidden'; // Hide visually but keep layout
				},
			});

			// Animate the opening of the sidebar and appearance of the sidebar-close-link
			gsap.set(sidebar, { display: 'flex', visibility: 'visible' });
			gsap.to(sidebar, {
				duration: 0.5,
				x: '0%',
				ease: 'power2.out',
			});

			// Animate the appearance and icon flip of the sidebar-close-link
			gsap.set(sidebarCloseLink, {
				display: 'flex',
				visibility: 'visible',
			});
			gsap.to(sidebarCloseLink, {
				duration: 0.1,
				opacity: 1,
				ease: 'power2.out',
				onComplete: () => {
					animateLinkOpen(sidebarCloseLink); // Flip the SVG and change the color
				},
			});
		});
	}

	// Close sidebar with animation
	sidebarCloseLink.addEventListener('click', function (e) {
		e.preventDefault();
		sidebarCloseLinkSpan.classList.remove('toggle-underline');
		// Animate the sidebar sliding out and hide it after animation
		gsap.to(sidebar, {
			duration: 0.5,
			x: '-100%',
			ease: 'power2.in',
			onComplete: function () {
				sidebar.style.display = 'none';
			},
		});

		// Reverse the icon flip and text color, then hide the sidebar-close-link
		animateLinkClose(sidebarCloseLink);
		gsap.to(sidebarCloseLink, {
			duration: 0.4,
			opacity: 0,
			ease: 'power2.in',
			onComplete: () => {
				sidebarCloseLink.style.display = 'none';

				// Bring back the shop-link with animation and reset the icon
				sidebarOpenLink.style.visibility = 'visible'; // Make the shop-link visible again
				sidebarOpenLink.style.pointerEvents = 'auto'; // Re-enable clicks
				gsap.to(sidebarOpenLink, {
					duration: 0.3,
					opacity: 1,
					ease: 'power2.out',
				});
			},
		});
	});

	// Inject SVG icon into the main nav shop-link dynamically
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

	sidebarOpenLink.classList.add(
		'flex',
		'items-center',
		'gap-1',
		'cursor-pointer'
	);

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
