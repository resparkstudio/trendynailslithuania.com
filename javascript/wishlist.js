import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	function addToWishlist(productId, productName) {
		jQuery.ajax({
			url: ajax_wishlist_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_add_to_wishlist',
				product_id: productId,
			},
			success: function (response) {
				if (response.success) {
					// Success notification
					createNotification(
						response.data.message ||
							`${productName} buvo pridėtas į norų sarašą.`,
						true
					);
				} else {
					// Failure notification
					createNotification(
						response.data.message ||
							'nepavyko pridėti į norų sąrašą.',
						false
					);
				}
			},
			error: function () {
				// Error notification
				createNotification(
					'įvyko klaida bandant pridėti į norų sarašą',
					false
				);
			},
		});
	}

	function createNotification(message, isSuccess) {
		const notificationContainer =
			document.getElementById('notification-container') ||
			createNotificationContainer();
		const notification = document.createElement('div');

		notification.classList.add(
			'notification-banner',
			'bg-white',
			'body-extra-small-regular',
			'drop-shadow-md',
			'rounded-l-[6px]',
			'p-3',
			'flex',
			'items-center',
			'w-60'
		);

		// Determine the SVG icon based on success or failure
		const iconSvg = isSuccess
			? `
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 0C3.14 0 0 3.14 0 7C0 10.86 3.14 14 7 14C10.86 14 14 10.86 14 7C14 3.14 10.86 0 7 0Z" fill="black"/>
                    <path d="M10.5486 5.99591L6.75694 9.78751C6.64319 9.90126 6.49387 9.95851 6.34454 9.95851C6.19522 9.95851 6.0459 9.90126 5.93214 9.78751L4.03635 7.89171C3.8082 7.66367 3.8082 7.29495 4.03635 7.06691C4.26439 6.83876 4.633 6.83876 4.86115 7.06691L6.34454 8.55031L9.72385 5.17111C9.95189 4.94296 10.3205 4.94296 10.5486 5.17111C10.7767 5.39915 10.7767 5.76776 10.5486 5.99591Z" fill="#FAFAFA"/>
                </svg>`
			: `
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <path d="M7 0C3.14005 0 0 3.14005 0 7C0 10.86 3.14005 14 7 14C10.86 14 14 10.86 14 7C14 3.14005 10.86 0 7 0Z" fill="black"/>
                <g clip-path="url(#clip0_63_760)">
                <path d="M12 2H2V12H12V2Z" fill="url(#pattern0_63_760)"/>
                </g>
                <defs>
                <pattern id="pattern0_63_760" patternContentUnits="objectBoundingBox" width="1" height="1">
                <use xlink:href="#image0_63_760" transform="scale(0.0111111)"/>
                </pattern>
                <clipPath id="clip0_63_760">
                <rect width="10" height="10" fill="white" transform="translate(2 2)"/>
                </clipPath>
                <image id="image0_63_760" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACq0lEQVR4nO2c3WoUQRCFC//1Qi/00giiD6AvpogoIuiVP0/mhSQYFaIoLq55h+2xDolHWnZlETPszsz21OycD/o2W/WlUl2z6R4zIYQQQgghhBBCCCGEEEKIVSB5huTp6LZIniN5yoYEycsAngL47O5w92MAHwE8InnRgpBjAfAYwEGO0XOwwBcAT0heschUVXULwDcAPGF9SCnt9B1njmH+yz8pzq9VVd22iJC8BOB7TfCcr0lK6UZfcebPzjGsEmekv8C/AHi2QvDsU/YakhfruUUDwPs1EiCAaVVVNwu3i7q29r+1b9Gmi/mmt04SLFXZDSr5z8o5hZtG3P1nA9HcdGU3rOSF6MqiAeBdQ9HcVGU3reSltWfRAHC/RULsWnYHkvO6Z9Egedbd37RMbNpFG2nTLpbaxtv8xGgRmc1m1zuookmbyu6okic5F4tMF9WEhpXd52f3Qh8Jp7FJ7iPxNFbJJQWksUsuISJJ8uaFJEnefGUnSS4z46LnWX0QpG6qcdwb3wBkT0cjuUfZ45Pcg+zxSi4oW5ILyJbkArIluYBsSa5DoguQ1DoGKZlqIf+g8a4ASQ8sWyWZo20jSV8qbbVkjqayk774LyJ5R//KGpBk2+DPHDQ6blAAHaApgI6EFUCHHAugY7sF0EH0ApC84O67Ecat1M3ot59vA1s05hfYe5fcseyHFo38NoMtvP72ySJB8ry7H0Wo5I4vdB6FupmV3wLg7r+iSW4rO+eU9x6LBIDDCO2i4zbyw6Lh7q+jVXLbynb3FxYNktdWrOrJQF6MckjyqkXE3e/WyXb33Qg3UucPVnt1LcPd71hkcmW7+6sc7GLnBnAA4EGkjSXHkufkPMItTUxZ8MuwlVyXTKjxqP51bGGKQAghhBBCCCGEEEIIIYQQFpvfIh1AsHznqRQAAAAASUVORK5CYII="/>
                </defs>
            </svg>

                `;

		notification.innerHTML = `
            <div class="pr-2">
                ${iconSvg}
            </div>
            <div>${message}</div>
        `;
		notificationContainer.prepend(notification);

		gsap.fromTo(
			notification,
			{ x: 300, opacity: 0 },
			{ x: 0, opacity: 1, duration: 0.5, ease: 'power2.out' }
		);

		setTimeout(() => {
			gsap.to(notification, {
				x: 300,
				opacity: 0,
				duration: 0.5,
				ease: 'power2.in',
				onComplete: () => notification.remove(),
			});
		}, 10000);
	}

	function createNotificationContainer() {
		const container = document.createElement('div');
		container.id = 'notification-container';
		container.style.position = 'fixed';
		container.style.top = '10px';
		container.style.right = '10px';
		container.style.zIndex = '1000';
		document.body.appendChild(container);
		return container;
	}

	document
		.querySelectorAll('.add-to-wishlist-btn')
		.forEach(function (button) {
			button.addEventListener('click', function (event) {
				event.preventDefault();
				const productId = button.getAttribute('data-product_id');
				const productName = button.getAttribute('data-product_name');
				addToWishlist(productId, productName);
			});
		});

	function removeFromWishlist(productId, productName) {
		jQuery.ajax({
			url: ajax_wishlist_params.ajax_url,
			type: 'POST',
			data: {
				action: 'custom_remove_from_wishlist',
				product_id: productId,
			},
			success: function (response) {
				if (response.success) {
					createNotification(
						`${productName} sėkmingai pašalintas iš norų sąrašo.`,
						true
					);
					jQuery('.wishlist-items').load(
						location.href + ' .wishlist-items > *'
					);
				} else {
					createNotification(
						response.data.message ||
							'Nepavyko pašalinti iš norų sąrašo.',
						false
					);
				}
			},
			error: function () {
				createNotification(
					'Įvyko klaida bandant pašalinti iš norų sąrašo.',
					false
				);
			},
		});
	}

	// Event delegation for dynamically loaded content
	jQuery('.wishlist-items').on(
		'click',
		'.remove-from-wishlist-btn',
		function (event) {
			event.preventDefault();
			const button = jQuery(this);
			const productId = button.data('product_id');
			const productName = button.data('product_name');
			removeFromWishlist(productId, productName);
		}
	);
});
