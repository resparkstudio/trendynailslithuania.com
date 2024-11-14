import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const successModal = document.getElementById('success-modal');
	const closeModalButton = document.getElementById('close-modal');

	// Hide modal initially with opacity set to 0 and scale to prevent flash
	gsap.set(successModal, { opacity: 0 });

	// Event listener for Contact Form 7 response
	document.addEventListener(
		'wpcf7mailsent',
		function (event) {
			if (event.detail.contactFormId === 351) {
				// Animate modal appearance
				gsap.fromTo(
					successModal,
					{ opacity: 0 },
					{ opacity: 1, duration: 0.3, ease: 'power2.in' }
				);
				successModal.classList.remove('hidden'); // Remove hidden class if needed for display
			}
		},
		false
	);

	// Function to close the modal with an animation
	function closeModal() {
		gsap.to(successModal, {
			opacity: 0,
			duration: 0.3,
			ease: 'power2.out',
			onComplete: () => successModal.classList.add('hidden'), // Hide after animation
		});
	}

	// Close the modal when clicking the close button
	closeModalButton.addEventListener('click', closeModal);

	// Close the modal on outside click
	window.addEventListener('click', function (event) {
		if (event.target === successModal) {
			closeModal();
		}
	});
});
