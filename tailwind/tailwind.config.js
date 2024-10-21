// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: {
		files: [
			'./theme/**/*.php',
			'./theme/**/*.js',
			'./css/**/*.css', // Include all the new CSS files
		],
	},
	theme: {
		// Desktop-first approach
		screens: {
			'2xl': { max: '1535px' },
			xl: { max: '1279px' },
			lg: { max: '1023px' },
			'max-850px': { max: '850px' },
			md: { max: '767px' },
			sm: { max: '639px' },
		},
		extend: {
			fontFamily: {
				sans: ['"Albert Sans"', 'sans-serif'],
			},
			colors: {
				black: '#000000',
				'deep-dark-gray': '#201F1F',
				white: '#FFFFFF',
				'light-gray': '#F7F7F7',
				gray: '#F5F5F5',
				'mid-gray': '#C3C3C3',
				'dark-gray': '#747474',
				pink: '#E5D7D1',
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
		require('postcss-import'), // Ensure CSS imports are handled
	],
};
