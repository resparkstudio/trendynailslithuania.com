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
			// Ensure changes to PHP files trigger a rebuild.
			'./theme/**/*.php',
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
	],
};
