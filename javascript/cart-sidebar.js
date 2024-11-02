import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	document.getElementById('cart-icon').addEventListener('click', function () {
		document
			.getElementById('cart-sidebar')
			.classList.toggle('translate-x-full');
	});

	document
		.getElementById('close-sidebar')
		.addEventListener('click', function () {
			document
				.getElementById('cart-sidebar')
				.classList.add('translate-x-full');
		});
});
