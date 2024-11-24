import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const aside = document.querySelector('aside#newsletter-popup');
	const innerAside = document.querySelector('.inner-aside');
	const openButton = document.querySelector('.newsletter-button-outer');
	const closeButton = document.querySelector('.newsletter-close-button');
	const overlay = document.querySelector('#newsletter-mobile-overlay');

	function isSmallScreen() {
		return window.innerWidth <= 639;
	}

	function openNewsletterPopup() {
		aside.classList.remove('sm:right-[-100vw]', 'right-[-36rem]');
		aside.style.right = isSmallScreen() ? '-100vw' : '-36rem';

		gsap.to(aside, {
			right: '0rem',
			duration: 0.5,
			ease: 'power2.out',
			onComplete: () => {
				aside.style.right = '';
				aside.classList.add('right-0');
			},
		});

		if (isSmallScreen()) {
			overlay.classList.remove('hidden');
			gsap.to(overlay, {
				opacity: 1,
				duration: 0.3,
				ease: 'power2.out',
			});
			document.body.style.overflow = 'hidden';
		}
	}

	function closeNewsletterPopup() {
		aside.classList.remove('right-0');
		aside.style.right = '0rem';

		gsap.to(aside, {
			right: isSmallScreen() ? '-100vw' : '-36rem',
			duration: 0.5,
			ease: 'power2.in',
			onComplete: () => {
				aside.style.right = '';
				if (isSmallScreen()) {
					aside.classList.add('sm:right-[-100vw]');
				} else {
					aside.classList.add('right-[-36rem]');
				}
			},
		});

		if (isSmallScreen()) {
			gsap.to(overlay, {
				opacity: 0,
				duration: 0.3,
				ease: 'power2.in',
				onComplete: () => {
					overlay.classList.add('hidden');
				},
			});
			document.body.style.overflow = '';
		}
	}

	function updateOverlayOnResize() {
		if (aside.classList.contains('right-0')) {
			// Sidebar is open
			if (isSmallScreen()) {
				overlay.classList.remove('hidden');
				document.body.style.overflow = 'hidden';
			} else {
				overlay.classList.add('hidden');
				document.body.style.overflow = '';
			}
		} else {
			overlay.classList.add('hidden');
			document.body.style.overflow = '';
		}
	}

	openButton.addEventListener('click', function (event) {
		event.stopPropagation();
		openNewsletterPopup();
	});

	closeButton.addEventListener('click', function (event) {
		event.stopPropagation();
		closeNewsletterPopup();
	});

	document.addEventListener('click', function (event) {
		if (
			!innerAside.contains(event.target) &&
			aside.classList.contains('right-0')
		) {
			closeNewsletterPopup();
		}
	});

	overlay.addEventListener('click', function (event) {
		if (!innerAside.contains(event.target)) {
			closeNewsletterPopup();
		}
	});

	window.addEventListener('resize', function () {
		if (aside.classList.contains('right-0')) {
			aside.classList.remove('sm:right-[-100vw]', 'right-[-36rem]');
			aside.classList.add('right-0');
		} else {
			aside.classList.remove('right-0');
			if (isSmallScreen()) {
				aside.classList.add('sm:right-[-100vw]');
			} else {
				aside.classList.add('right-[-36rem]');
			}
		}

		updateOverlayOnResize();
	});
});
