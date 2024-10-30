import gsap from 'gsap';

const expandElement = document.querySelector('.info-expand');
const infoTextElement = document.querySelector('.info-text');
const plusStripeV = document.querySelector('.plus-stripe-v');
const plusStripeH = document.querySelector('.plus-stripe-h');

let isExpanded = false;

expandElement.addEventListener('click', () => {
	isExpanded = !isExpanded;

	if (isExpanded) {
		infoTextElement.classList.remove('hidden');

		gsap.fromTo(
			infoTextElement,
			{ height: 0, opacity: 0 },
			{ height: 'auto', opacity: 1, ease: 'power2.out', duration: 0.6 }
		);

		gsap.to(plusStripeV, {
			rotation: 180,
			opacity: 0,
			ease: 'power2.out',
			duration: 0.6,
		});
		gsap.to(plusStripeH, {
			rotation: 180,
			ease: 'power2.out',
			duration: 0.6,
		});
	} else {
		gsap.to(infoTextElement, {
			height: 0,
			opacity: 0,
			ease: 'power2.in',
			duration: 0.6,
			onComplete: () => infoTextElement.classList.add('hidden'),
		});

		gsap.to(plusStripeV, {
			rotation: 90,
			opacity: 1,
			ease: 'power2.in',
			duration: 0.6,
		});
		gsap.to(plusStripeH, { rotation: 0, ease: 'power2.in', duration: 0.6 });
	}
});
