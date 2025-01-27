import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', () => {
	const faqItems = document.querySelectorAll('.duk-item');

	faqItems.forEach((item) => {
		const question = item.querySelector('.duk-question');
		const answer = item.querySelector('.duk-answer');
		const arrow = question.querySelector('svg:last-child');

		// Ensure answer starts hidden
		gsap.set(answer, { height: 0, overflow: 'hidden', opacity: 0 });

		question.addEventListener('click', () => {
			const isOpen = item.classList.contains('open');

			faqItems.forEach((otherItem) => {
				if (
					otherItem !== item &&
					otherItem.classList.contains('open')
				) {
					const otherAnswer = otherItem.querySelector('.duk-answer');
					const otherArrow =
						otherItem.querySelector('svg:last-child');
					otherItem.classList.remove('open');

					gsap.to(otherAnswer, {
						height: 0,
						opacity: 0,
						duration: 0.5,
						ease: 'power2.out',
						onComplete: () => otherAnswer.classList.add('hidden'), // Hide after animation
					});
					gsap.to(otherArrow, {
						rotate: 0,
						duration: 0.4,
						ease: 'power2.out',
					});
				}
			});

			if (!isOpen) {
				item.classList.add('open');
				answer.classList.remove('hidden'); // Remove 'hidden' to make it visible
				gsap.fromTo(
					answer,
					{ height: 0, opacity: 0 },
					{
						height: 'auto',
						opacity: 1,
						duration: 0.5,
						ease: 'power2.out',
						onComplete: () => gsap.set(answer, { height: 'auto' }), // Ensure it stays open
					}
				);
				gsap.to(arrow, {
					rotate: 180,
					duration: 0.4,
					ease: 'power2.out',
				});
			} else {
				item.classList.remove('open');
				gsap.to(answer, {
					height: 0,
					opacity: 0,
					duration: 0.5,
					ease: 'power2.in',
					onComplete: () => answer.classList.add('hidden'), // Hide after animation
				});
				gsap.to(arrow, {
					rotate: 0,
					duration: 0.4,
					ease: 'power2.in',
				});
			}
		});
	});
});
