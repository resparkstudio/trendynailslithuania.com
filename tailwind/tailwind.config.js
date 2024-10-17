// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: {
		files: [
			// Ensure changes to PHP and custom CSS files trigger a rebuild.
			'./theme/**/*.php',
		],
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
		require('postcss-import'), // Ensure CSS imports are handled
	],
};
