import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	// Hero Swiper
	function setHeroSlideInitialState(slide) {
		const titleInner = slide.querySelector('.hero-slide-title-inner');
		const desc = slide.querySelector('.hero-slide-desc');
		const cta = slide.querySelector('.hero-slide-cta');
		if (titleInner) gsap.set(titleInner, { y: '110%' });
		if (desc) gsap.set(desc, { opacity: 0, y: 24 });
		if (cta) gsap.set(cta, { opacity: 0, y: 24 });
	}

	function animateHeroSlide(slide) {
		const titleInner = slide.querySelector('.hero-slide-title-inner');
		const desc = slide.querySelector('.hero-slide-desc');
		const cta = slide.querySelector('.hero-slide-cta');
		if (titleInner) {
			gsap.killTweensOf(titleInner);
			gsap.to(titleInner, { y: '0%', duration: 0.8, ease: 'power3.out' });
		}
		if (desc) {
			gsap.killTweensOf(desc);
			gsap.to(desc, { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out', delay: 0.35 });
		}
		if (cta) {
			gsap.killTweensOf(cta);
			gsap.to(cta, { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out', delay: 0.5 });
		}
	}

	const heroSwiper = new Swiper('.hero-swiper', {
		modules: [Pagination, Autoplay, EffectFade],
		loop: true,
		slidesPerView: 1,
		effect: 'fade',
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.hero-swiper-pagination',
			clickable: true,
		},
		on: {
			init(swiper) {
				swiper.slides.forEach((slide) => setHeroSlideInitialState(slide));
				animateHeroSlide(swiper.slides[swiper.activeIndex]);
			},
			slideChange(swiper) {
				setHeroSlideInitialState(swiper.slides[swiper.activeIndex]);
			},
			slideChangeTransitionEnd(swiper) {
				animateHeroSlide(swiper.slides[swiper.activeIndex]);
			},
		},
	});

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
		modules: [Navigation],
		spaceBetween: 16,
		loop: true,
		slidesPerView: 3.5,
		navigation: {
			prevEl: '.instagram-gallery-button-prev',
		},
		breakpoints: {
			1279: { slidesPerView: 3.5 },
			1023: { slidesPerView: 3.5 },
			767: { slidesPerView: 2.6 },
			1: { slidesPerView: 2.2 },
		},
	});

	const blogPostsSwiper = new Swiper('.blog-posts-gallery-swiper-container', {
		modules: [Navigation],
		loop: false,
		slidesPerView: 3,
		spaceBetween: 16,
		navigation: {
			nextEl: '.blog-posts-button-next',
			prevEl: '.blog-posts-button-prev',
		},
		breakpoints: {
			1279: { slidesPerView: 3 },
			767: { slidesPerView: 2 },
			1: { slidesPerView: 1.3 },
		},
	});

	const relatedPostsSwiper = new Swiper('.related-posts-swiper-container', {
		modules: [Navigation],
		loop: false,
		slidesPerView: 3,
		spaceBetween: 16,
		breakpoints: {
			1279: { slidesPerView: 3 },
			767: { slidesPerView: 2 },
			1: { slidesPerView: 1.3 },
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
