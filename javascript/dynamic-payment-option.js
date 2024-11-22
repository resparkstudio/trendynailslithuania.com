function adjustPayseraOptions() {
	const mainPaymentMethods = document.querySelector(
		'.wc_payment_methods.payment_methods'
	);
	const payseraMethod = document.querySelector(
		'.wc_payment_method.payment_method_paysera'
	);

	if (!mainPaymentMethods || !payseraMethod) {
		return;
	}

	const payseraOptionsWrapper = payseraMethod.querySelector(
		'.payment_box.payment_method_paysera'
	);

	if (payseraOptionsWrapper) {
		const payseraOptions = payseraOptionsWrapper.querySelectorAll(
			'.paysera-payment-method'
		);

		payseraOptions.forEach((option) => {
			const radioInput = option.querySelector('input[type="radio"]');

			if (radioInput) {
				radioInput.name = 'payment_method';
				radioInput.classList.add('custom-radio');
			}

			const containerDiv = option.querySelector('div');
			if (containerDiv) {
				containerDiv.classList.add('custom-radio-button-container');
			}

			const newLi = document.createElement('li');
			newLi.className =
				'flex gap-x-2 items-center wc_payment_method paysera_sub_option';
			newLi.appendChild(option);
			mainPaymentMethods.appendChild(newLi);
		});

		payseraMethod.style.display = 'none';
	}
}

document.addEventListener('DOMContentLoaded', adjustPayseraOptions);

jQuery(document.body).on('updated_checkout', adjustPayseraOptions);
