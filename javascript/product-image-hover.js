import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const productImages = document.querySelectorAll('.product-image-container');

	productImages.forEach((container) => {
		const originalImage = container.querySelector('.original-image');
		const galleryImage = container.querySelector('.gallery-image');

		// Only add hover effects if a gallery image exists
		if (galleryImage) {
			container.addEventListener('mouseenter', () => {
				gsap.to(originalImage, {
					opacity: 0,
					duration: 0.2,
					ease: 'none',
				});
				gsap.to(galleryImage, {
					opacity: 1,
					duration: 0.2,
					ease: 'none',
				});
			});

			container.addEventListener('mouseleave', () => {
				gsap.to(originalImage, {
					opacity: 1,
					duration: 0.2,
					ease: 'none',
				});
				gsap.to(galleryImage, {
					opacity: 0,
					duration: 0.2,
					ease: 'none',
				});
			});
		}
	});
});
