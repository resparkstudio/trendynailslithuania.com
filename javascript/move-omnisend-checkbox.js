jQuery(document).ready(function ($) {
	var omnisendCheckbox = $('#omnisend_newsletter_checkbox_field');

	if (omnisendCheckbox.length) {
		var placeholder = $('.newsletter-checkbox-placeholder');

		omnisendCheckbox.detach().appendTo(placeholder);

		omnisendCheckbox.find('label').addClass('flex');
		omnisendCheckbox.find('input').addClass('input-checkbox');
		omnisendCheckbox.find('span').addClass('body-extra-small-light');
	}
});
