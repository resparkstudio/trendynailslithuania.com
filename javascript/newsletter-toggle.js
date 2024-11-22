import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const aside = document.querySelector('aside');
	const innerAside = document.querySelector('.inner-aside');
	const openButton = document.querySelector('.newsletter-button-outer');
	const closeButton = document.querySelector('.newsletter-close-button');

	openButton.addEventListener('click', function (event) {
		event.stopPropagation(); // Prevent triggering document click
		if (parseInt(getComputedStyle(aside).right) === -576) {
			gsap.to(aside, {
				right: '0rem',
				duration: 0.5,
				ease: 'power2.out',
			});
		}
	});

	closeButton.addEventListener('click', function (event) {
		event.stopPropagation();
		gsap.to(aside, { right: '-36rem', duration: 0.5, ease: 'power2.in' });
	});

	document.addEventListener('click', function (event) {
		if (
			!innerAside.contains(event.target) &&
			parseInt(getComputedStyle(aside).right) === 0
		) {
			gsap.to(aside, {
				right: '-36rem',
				duration: 0.5,
				ease: 'power2.in',
			});
		}
	});
});
