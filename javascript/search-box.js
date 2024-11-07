import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const headerSearchIcon = document.getElementById('search-icon');
	const searchBoxContainer = document.getElementById('search-form-container');
	const searchInputText =
		document.getElementsByClassName('search-input-text')[0];
	let searchToggle = false;
	initSearchBox();

	headerSearchIcon.addEventListener('click', () => {
		if (searchToggle === false) {
			searchToggle = true;
			openSearchBox();
		} else {
			searchToggle = false;
			closeSearchBox();
		}
	});

	searchBoxContainer.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && searchToggle) {
			searchToggle = false;
			closeSearchBox();
		}
	});

	function initSearchBox() {
		gsap.set(searchBoxContainer, {
			opacity: 0,
			y: -70,
		});
	}

	function openSearchBox() {
		searchBoxContainer.classList.add('flex');
		searchBoxContainer.classList.remove('hidden');
		gsap.to(searchBoxContainer, {
			duration: 0.3,
			opacity: 1,
			y: 0,
			ease: 'power2.out',
			onComplete: () => {
				searchInputText.focus();
				searchInputText.setSelectionRange(
					searchInputText.value.length,
					searchInputText.value.length
				);
			},
		});
	}

	function closeSearchBox() {
		gsap.to(searchBoxContainer, {
			duration: 0.3,
			opacity: 0,
			y: -70,
			ease: 'power2.in',
			onComplete: () => {
				searchBoxContainer.classList.add('hidden');
				searchBoxContainer.classList.remove('flex');
				searchInputText.blur();
			},
		});
	}
});
