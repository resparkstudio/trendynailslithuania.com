// Import Swiper core and required modules
import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';

document.addEventListener('DOMContentLoaded', function () {
	const saleSwiper = new Swiper('.swiper-container', {
		modules: [Navigation],
		loop: false,
		slidesPerView: 4,
		spaceBetween: 20,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		breakpoints: {
			1535: {
				slidesPerView: 5,
				spaceBetween: 10,
			},
			1279: {
				slidesPerView: 4,
				spaceBetween: 10,
			},
			1023: {
				slidesPerView: 3,
				spaceBetween: 10,
			},
			767: {
				slidesPerView: 2,
				spaceBetween: 10,
			},
		},
	});
});
