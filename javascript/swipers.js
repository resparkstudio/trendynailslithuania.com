import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

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
			767: {
				slidesPerView: 3,
			},
			1: {
				slidesPerView: 2,
			},
		},
	});

	const gallerySwiper = new Swiper('.instagram-gallery-swiper', {
		loop: false,
		spaceBetween: 16,
		slidesPerView: 3.5,
		breakpoints: {
			1023: {
				slidesPerView: 3.5,
			},
			767: {
				slidesPerView: 2.6,
			},
			1: {
				slidesPerView: 2.2,
			},
		},
	});

	const productGallerySwiper = new Swiper('.product-gallery-swiper', {
		modules: [Pagination],
		loop: false,
		slidesPerView: 1,
		spaceBetween: 16,
		pagination: {
			el: '.product-gallery-swiper-pagination',
			clickable: true,
		},
	});
});
