document.addEventListener('DOMContentLoaded', function () {
	// Attach click event to all wishlist buttons
	const wishlistButtons = document.querySelectorAll('.add-to-wishlist-btn');

	wishlistButtons.forEach((button) => {
		button.addEventListener('click', function () {
			const iconPath = this.querySelector('svg path');

			// Toggle active class
			this.classList.toggle('active');

			// Update SVG fill color
			if (this.classList.contains('active')) {
				iconPath.setAttribute('fill', 'currentColor');
			} else {
				iconPath.setAttribute('fill', 'none');
			}
		});
	});
});
