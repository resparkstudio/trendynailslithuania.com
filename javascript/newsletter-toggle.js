import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const aside = document.querySelector('aside');
	const innerAside = document.querySelector('.inner-aside');
	const openButton = document.querySelector('.newsletter-button-outer');
	const closeButton = document.querySelector('.newsletter-close-button');

	function getAsideTargetPosition() {
		const isSmallScreen = window.innerWidth <= 639; // Tailwind `sm` breakpoint
		return isSmallScreen ? '-100vw' : '-36rem';
	}

	openButton.addEventListener('click', function (event) {
		event.stopPropagation();
		const asideWidth = window.innerWidth; // Dynamic full-width for `sm`
		gsap.to(aside, {
			right: '0rem',
			width: asideWidth <= 639 ? `${asideWidth}px` : '36rem',
			duration: 0.5,
			ease: 'power2.out',
		});
	});

	closeButton.addEventListener('click', function (event) {
		event.stopPropagation();
		gsap.to(aside, {
			right: getAsideTargetPosition(),
			duration: 0.5,
			ease: 'power2.in',
		});
	});

	document.addEventListener('click', function (event) {
		if (
			!innerAside.contains(event.target) &&
			parseInt(getComputedStyle(aside).right) === 0
		) {
			gsap.to(aside, {
				right: getAsideTargetPosition(),
				duration: 0.5,
				ease: 'power2.in',
			});
		}
	});

	// Adjust aside width dynamically on resize
	window.addEventListener('resize', function () {
		if (parseInt(getComputedStyle(aside).right) === 0) {
			const asideWidth = window.innerWidth; // Adjust for `sm`
			gsap.to(aside, {
				width: asideWidth <= 639 ? `${asideWidth}px` : '36rem',
				duration: 0.2,
			});
		}
	});
});
