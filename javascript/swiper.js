import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', function () {
	const saleSwiper = new Swiper('.swiper-container', {
		modules: [Navigation],
		loop: false,
		slidesPerView: 4,
		spaceBetween: 16,
		rows: 1,
		navigation: {
			nextEl: '.product-nav-button-next',
			prevEl: '.product-nav-button-prev',
		},
		breakpoints: {
			1279: {
				slidesPerView: 4,
			},
			1023: {
				slidesPerView: 3,
			},
			767: {
				slidesPerView: 2,
			},
			1: {
				slidesPerView: 2,
			},
		},
	});
});
