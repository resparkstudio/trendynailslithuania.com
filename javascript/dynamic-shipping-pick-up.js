document.addEventListener('DOMContentLoaded', function () {
	const shippingMethods = document.querySelectorAll(
		'.shipping-method input[type="radio"]'
	);
	const pickupPointShipping = document.getElementById(
		'mp-wc-pickup-point-shipping'
	);

	if (!shippingMethods || !pickupPointShipping) return;

	function updatePickupPoint() {
		const selectedMethod = document.querySelector(
			'.shipping-method input[type="radio"]:checked'
		);

		if (selectedMethod) {
			const parentDiv = selectedMethod.closest('.shipping-method');

			if (parentDiv && !parentDiv.contains(pickupPointShipping)) {
				parentDiv.appendChild(pickupPointShipping);
			}
			pickupPointShipping.style.display = 'block';
			pickupPointShipping.removeAttribute('style');
		}
	}

	shippingMethods.forEach(function (method) {
		method.addEventListener('change', updatePickupPoint);
	});

	updatePickupPoint();
});
