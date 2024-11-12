import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', function () {
	// Sale Products Swiper
	const saleSwiper = new Swiper('.sale-swiper-container', {
		modules: [Navigation],
		loop: false,
		slidesPerView: 4,
		spaceBetween: 16,
		navigation: {
			nextEl: '.sale-nav-button-next',
			prevEl: '.sale-nav-button-prev',
		},
		breakpoints: {
			1279: { slidesPerView: 4 },
			767: { slidesPerView: 3 },
			1: { slidesPerView: 2 },
		},
	});

	// New Products Swiper
	const newProductsSwiper = new Swiper('.new-products-swiper-container', {
		modules: [Navigation],
		loop: false,
		slidesPerView: 4,
		spaceBetween: 16,
		navigation: {
			nextEl: '.new-products-nav-button-next',
			prevEl: '.new-products-nav-button-prev',
		},
		breakpoints: {
			1279: { slidesPerView: 4 },
			767: { slidesPerView: 3 },
			1: { slidesPerView: 2 },
		},
	});

	// Popular Products Swiper
	const popularProductsSwiper = new Swiper(
		'.popular-products-swiper-container',
		{
			modules: [Navigation],
			loop: false,
			slidesPerView: 4,
			spaceBetween: 16,
			navigation: {
				nextEl: '.popular-products-nav-button-next',
				prevEl: '.popular-products-nav-button-prev',
			},
			breakpoints: {
				1279: { slidesPerView: 4 },
				767: { slidesPerView: 3 },
				1: { slidesPerView: 2 },
			},
		}
	);

	// Related Products Swiper
	const relatedProductsSwiper = new Swiper(
		'.related-products-swiper-container',
		{
			modules: [Navigation],
			loop: false,
			slidesPerView: 4,
			spaceBetween: 16,
			navigation: {
				nextEl: '.related-products-nav-button-next',
				prevEl: '.related-products-nav-button-prev',
			},
			breakpoints: {
				1279: { slidesPerView: 4 },
				767: { slidesPerView: 3 },
				1: { slidesPerView: 2 },
			},
		}
	);

	// New Products Section Swiper
	const newProductsSectionSwiper = new Swiper(
		'.new-products-section-swiper-container',
		{
			modules: [Navigation],
			loop: false,
			slidesPerView: 4,
			spaceBetween: 16,
			navigation: {
				nextEl: '.new-products-section-nav-button-next',
				prevEl: '.new-products-section-nav-button-prev',
			},
			breakpoints: {
				1279: { slidesPerView: 4 },
				767: { slidesPerView: 3 },
				1: { slidesPerView: 2 },
			},
		}
	);

	const instagramGallerySwiper = new Swiper('.instagram-gallery-swiper', {
		modules: [Pagination],
		spaceBetween: 16,
		slidesPerView: 3.5,
		breakpoints: {
			1279: { slidesPerView: 3.5 },
			1023: { slidesPerView: 3.5 },
			767: { slidesPerView: 2.6 },
			1: { slidesPerView: 2.2 },
		},
	});

	const relatedPostsSwiper = new Swiper('.related-posts-swiper-container', {
		modules: [Pagination],
		loop: false,
		slidesPerView: 3,
		spaceBetween: 16,
		breakpoints: {
			1279: { slidesPerView: 3 },
			767: { slidesPerView: 2 },
			1: { slidesPerView: 1 },
		},
	});
});
