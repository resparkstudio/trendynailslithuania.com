import gsap from 'gsap';
import { ExpoScaleEase } from 'gsap/EasePack';
import { CustomEase } from 'gsap/CustomEase';
gsap.registerPlugin(ExpoScaleEase);
gsap.registerPlugin(CustomEase);

const expandElements = document.querySelectorAll('.info-expand');
const infoTextElements = document.querySelectorAll('.info-text');

expandElements.forEach((expandElement, index) => {
	const infoTextElement = infoTextElements[index];
	const plusIconWrap = expandElement.querySelector('.plus-icon-wrap');
	const plusStripeV = plusIconWrap.querySelector('.plus-stripe-v');

	let isExpanded = false;

	expandElement.addEventListener('click', () => {
		isExpanded = !isExpanded;

		if (isExpanded) {
			infoTextElement.classList.remove('hidden');

			gsap.fromTo(
				infoTextElement,
				{ height: 0, opacity: 0, paddingBottom: 0, y: 20 },
				{
					height: 'auto',
					opacity: 1,
					y: 0,
					ease: 'power1.out',
					duration: 0.4,
				}
			);

			gsap.to(plusIconWrap, {
				rotation: 180,
				ease: 'power1.out',
				duration: 0.4,
			});
			gsap.to(plusStripeV, {
				opacity: 0,
				ease: 'power1.out',
				duration: 0.4,
			});
		} else {
			gsap.to(infoTextElement, {
				height: 0,
				opacity: 0,
				y: 20,
				ease: 'power1.out',
				duration: 0.5,
				onComplete: () => {
					infoTextElement.classList.add('hidden');
				},
			});

			gsap.to(plusIconWrap, {
				rotation: 0,
				ease: 'power1.out',
				duration: 0.5,
			});
			gsap.to(plusStripeV, {
				opacity: 1,
				ease: 'power1.out',
				duration: 0.5,
			});
		}
	});
});
