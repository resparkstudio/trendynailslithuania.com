document.addEventListener('DOMContentLoaded', function () {
	const shippingMethods = document.querySelectorAll(
		'.shipping-method input[type="radio"]'
	);
	const pickupPointShipping = document.getElementById(
		'mp-wc-pickup-point-shipping'
	);

	if (!shippingMethods || !pickupPointShipping) return;

	const supportedMethods = [
		'multiparcels_dpd_terminal:8',
		'multiparcels_omniva_lt_pickup_point:9',
	];

	function updatePickupPoint() {
		const selectedMethod = document.querySelector(
			'.shipping-method input[type="radio"]:checked'
		);

		if (selectedMethod) {
			const selectedMethodId = selectedMethod.value;

			if (supportedMethods.includes(selectedMethodId)) {
				const parentDiv = selectedMethod.closest('.shipping-method');

				if (parentDiv && !parentDiv.contains(pickupPointShipping)) {
					parentDiv.appendChild(pickupPointShipping);
				}
				pickupPointShipping.style.display = 'block';
				pickupPointShipping.removeAttribute('style');
			} else {
				pickupPointShipping.style.display = 'none';
			}
		}
	}

	shippingMethods.forEach(function (method) {
		method.addEventListener('change', updatePickupPoint);
	});

	updatePickupPoint();
});
