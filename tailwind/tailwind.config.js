// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

// Import Fluid Tailwind's extractor and plugin.
const fluid = require('fluid-tailwind');
const { extract } = require('fluid-tailwind');

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: {
		files: [
			// Ensure changes to PHP and custom CSS files trigger a rebuild.
			'./theme/**/*.php',
			'./assets/css/colors.css', // Add your colors.css
			'./assets/css/fonts.css', // Add your fonts.css
		],
		extract,
	},
	theme: {
		// Desktop-first approach
		screens: {
			'2xl': { max: '1535px' },
			xl: { max: '1279px' },
			lg: { max: '1023px' },
			md: { max: '767px' },
			sm: { max: '639px' },
		},
		extend: {
			fontFamily: {
				sans: ['"Albert Sans"', 'sans-serif'],
			},
			fontSize: {
				'heading-xl': ['2.5rem', { lineHeight: '3rem' }],
				'heading-lg': ['2.25rem', { lineHeight: '2.75rem' }],
				'heading-md': ['1.625rem', { lineHeight: '2.125rem' }],
				'heading-sm': ['1.125rem', { lineHeight: '1.375rem' }],
				'body-normal': ['1rem', { lineHeight: '1.25rem' }],
				'body-small': ['0.875rem', { lineHeight: '1.125rem' }],
				'body-extra-small': ['0.75rem', { lineHeight: '1rem' }],
				'body-extra-small-light': ['10px', { lineHeight: '20px' }],
			},
			colors: {
				black: '#000000',
				'dark-gray': '#201F1F',
				white: '#FFFFFF',
				'light-gray-1': '#F7F7F7',
				'light-gray-2': '#F5F5F5',
				gray: '#C3C3C3',
				'gray-dark': '#747474',
				muted: '#E5D7D1',
			},
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		require('@_tw/typography'),
		require('@_tw/themejson'),
		fluid, // Add the Fluid Tailwind plugin here
		require('postcss-import'), // Ensure CSS imports are handled
	],
};
