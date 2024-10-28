import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', function () {
	const cursorText = 'Skaityti<br>daugiau';
	const cursor = document.createElement('div');
	cursor.classList.add('custom-cursor');
	cursor.innerHTML = cursorText;
	document.body.appendChild(cursor);

	gsap.set(cursor, { xPercent: -50, yPercent: -50, autoAlpha: 0, scale: 0 });
	let xTo = gsap.quickTo(cursor, 'x', { duration: 0.15, ease: 'power3' });
	let yTo = gsap.quickTo(cursor, 'y', { duration: 0.15, ease: 'power3' });

	function handleCursor() {
		// Only apply the cursor logic if screen width is >= 1023px
		if (window.innerWidth >= 1023) {
			window.addEventListener('pointermove', onPointerMove);
			aboutSection.addEventListener('mouseenter', onSectionEnter);
			aboutSection.addEventListener('mouseleave', onSectionLeave);
		} else {
			// Hide the cursor and remove event listeners on smaller screens
			gsap.set(cursor, { autoAlpha: 0 });
			window.removeEventListener('pointermove', onPointerMove);
			aboutSection.removeEventListener('mouseenter', onSectionEnter);
			aboutSection.removeEventListener('mouseleave', onSectionLeave);
		}
	}

	// Cursor move and animation functions
	function onPointerMove(e) {
		xTo(e.clientX);
		yTo(e.clientY);
	}

	function onSectionEnter() {
		gsap.to(cursor, {
			autoAlpha: 1,
			scale: 1,
			duration: 0.3,
			ease: 'power2.out',
		});
	}

	function onSectionLeave() {
		gsap.to(cursor, {
			autoAlpha: 0,
			scale: 0,
			duration: 0.3,
			ease: 'power2.in',
		});
	}

	const aboutSection = document.querySelector('#about-section');
	if (aboutSection) {
		handleCursor(); // Initial check on page load
		window.addEventListener('resize', handleCursor); // Update on resize
	}
});
