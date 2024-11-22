import jQuery from 'jquery';
import 'jquery-validation';

(function ($) {
	$(document).ready(function () {
		// Custom phone validation method
		$.validator.addMethod(
			'validPhone',
			function (value, element) {
				return (
					this.optional(element) ||
					/^[+]?[\d\s\-()]{8,15}$/.test(value)
				);
			},
			'Įvestas telefono numeris neteisingas'
		);

		// Custom email validation method
		$.validator.addMethod(
			'validEmail',
			function (value, element) {
				// Email regex to validate domain and TLD
				const emailRegex = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;
				return this.optional(element) || emailRegex.test(value);
			},
			'Įvestas el. pašto adresas neteisingas'
		);

		// Disable default email validation
		$.validator.addMethod(
			'email',
			function () {
				// Always return true to disable default email validation
				return true;
			},
			''
		);

		const validationRules = {
			rules: {
				billing_first_name: { required: true },
				billing_last_name: { required: true },
				billing_address_1: { required: true },
				billing_city: { required: true },
				billing_email: { required: true, validEmail: true }, // Only use validEmail rule
				billing_phone: { required: true, validPhone: true },
				billing_postcode: { required: true },
				terms: { required: true }, // Add terms validation
				account_password: {
					required: function () {
						return $('#createaccount').is(':checked');
					},
				},
				account_password_confirm: {
					required: function () {
						return $('#createaccount').is(':checked');
					},
					equalTo: '#account_password',
				},
			},
			messages: {
				billing_first_name:
					'<strong>Vardas</strong> yra būtinas laukelis.',
				billing_last_name:
					'<strong>Pavardė</strong> yra būtinas laukelis.',
				billing_address_1:
					'<strong>Gatvė, namo numeris</strong> yra būtinas laukelis.',
				billing_city: '<strong>Miestas</strong> yra būtinas laukelis.',
				billing_email: {
					required:
						'<strong>El. paštas</strong> yra būtinas laukelis.',
					validEmail: 'Įvestas el. pašto adresas neteisingas.', // Custom error message
				},
				billing_phone: {
					required:
						'<strong>Telefonas</strong> yra būtinas laukelis.',
					validPhone: 'Įvestas telefono numeris neteisingas.',
				},
				billing_postcode:
					'<strong>Pašto kodas</strong> yra būtinas laukelis.',
				terms: 'Jūs turite sutikti su taisyklėmis ir sąlygomis.',
				account_password: 'Slaptažodis yra būtinas laukelis.',
				account_password_confirm: {
					required: 'Patvirtinkite slaptažodį.',
					equalTo: 'Slaptažodžiai turi sutapti.',
				},
			},
			onfocusout: function (element) {
				this.element(element);
			},
			onkeyup: function (element) {
				this.element(element);
			},
			errorPlacement: function (error, element) {
				if (element.attr('type') === 'checkbox') {
					error.insertBefore(element.parent());
				} else {
					const labelElement = element
						.closest('.form-row')
						.find('.checkout-form-label');

					const errorWrapper = $('<div></div>').addClass(
						'error-wrapper flex gap-x-2 items-center body-small-regular mb-2 body-extra-small-light'
					);
					const svgIcon = $(
						'<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">' +
							'<circle cx="7" cy="7" r="7" fill="#A81919"/>' +
							'<path d="M6.09626 3H7.89305L7.70053 8.22034H6.28877L6.09626 3ZM6.99465 11C6.69519 11 6.45277 10.9058 6.26738 10.7175C6.08913 10.5217 6 10.2881 6 10.0169C6 9.73069 6.08913 9.49341 6.26738 9.30509C6.45277 9.11676 6.69519 9.0226 6.99465 9.0226C7.28699 9.0226 7.52584 9.11676 7.71123 9.30509C7.90374 9.49341 8 9.73069 8 10.0169C8 10.2881 7.90374 10.5217 7.71123 10.7175C7.52584 10.9058 7.28699 11 6.99465 11Z" fill="white"/>' +
							'</svg>'
					);

					errorWrapper.append(svgIcon).append(error);

					if (labelElement.length) {
						errorWrapper.insertBefore(labelElement);
					} else {
						errorWrapper.insertBefore(element);
					}
				}
			},
			highlight: function (element) {
				$(element).addClass('border-error');
				$(element).closest('.form-row').css('color', '#A81919');
			},
			unhighlight: function (element) {
				$(element).removeClass('border-error');
				$(element)
					.closest('.form-row')
					.css('color', '')
					.find('.error-wrapper')
					.remove();
			},
		};

		// Initialize validation
		const $form = $('form.checkout');
		$form.validate(validationRules);

		// Revalidate password fields on checkbox toggle
		$('#createaccount').on('change', function () {
			$('#account_password, #account_password_confirm').valid();
		});

		// Reinitialize validation on WooCommerce updates
		$(document).on('updated_checkout', function () {
			$form.validate(validationRules);
		});

		// Prevent form submission if validation fails
		$form.on('submit', function (e) {
			if (!$form.valid()) {
				e.preventDefault();
			}
		});
	});
})(jQuery);
