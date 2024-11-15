function applyIncrementalPadding() {
	// Select all elements with the class 'shop-archive-nav-menu'
	const elements = document.querySelectorAll('.shop-archive-nav-menu');

	// Loop through each element and apply incremental padding-left
	elements.forEach((element, index) => {
		// Calculate the padding-left value based on the index (0 for the first, then 0.5rem, 1rem, etc.)
		const paddingValue = `${index * 0.5}rem`;
		// Apply the padding-left style to the element
		element.style.paddingLeft = paddingValue;
	});
}

// Call the function to apply the padding
applyIncrementalPadding();
