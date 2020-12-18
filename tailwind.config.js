/*eslint-disable*/
module.exports = {
	important: true,
	purge: {
		enabled: false,
	},
	// future: {
	// 	removeDeprecatedGapUtilities: true,
	// 	purgeLayersByDefault: true,
	// },
	theme: {
		screens: {
      '2xl': {'max': '1535px'},
      // => @media (max-width: 1535px) { ... }

      'xl': {'max': '1279px'},
      // => @media (max-width: 1279px) { ... }

      'lg': {'max': '1023px'},
      // => @media (max-width: 1023px) { ... }

      'md': {'max': '767px'},
      // => @media (max-width: 767px) { ... }

      'sm': {'max': '639px'},
      // => @media (max-width: 639px) { ... }
    },
		inset: {
			'0': 0,
			auto: 'auto',
			'1/2': '50%',
			'1/3': '33%',
			'1/4': '25%',
			'1/5': '20%',
		},
		container: {
			center: true,
		},
		colors: {
			white: 'var(--color-white)',
			black: 'var(--color-black)',
			green: 'var(--color-green)',
			lightest: 'var(--color-lightest)',
			lighter: 'var(--color-lighter)',
			light: 'var(--color-light)',
			dark: 'var(--color-dark)',
			darker: 'var(--color-darker)',
			primary: 'var(--color-primary)',
			secondary: 'var(--color-secondary)',
			gray: 'var(--color-gray)',
		},
		linearGradientColors: {
			// defaults to {}
			red: ['#E00011', '#790009'],
			gray: ['#6E6D6D', '#3C3C3C'],
			lighter: ['#D9D9D9', '#9B9A9A'],
		},
		fontFamily: {
			body: [
				'Lato',
				'DINPro-Regular',
				'SF Pro TC',
				'SF Pro Display',
				'SF Pro Icons',
				'PingFang TC',
				'Helvetica Neue',
				'Helvetica',
				'微軟正黑體',
				'Microsoft\\ JhengHei',
				'Arial',
				'新細明體',
				'PMingLiU',
				'細明體',
				'MingLiU',
				'標楷體',
				'DFKai-sb',
				'serif',
			],
			heading: [
				'Lato',
				'DINPro bold',
				'SF Pro TC',
				'SF Pro Display',
				'SF Pro Icons',
				'PingFang TC',
				'Helvetica Neue',
				'Helvetica',
				'Microsoft YaHei',
				'微軟正黑體',
				'Microsoft\\ JhengHei',
				'Arial',
				'新細明體',
				'PMingLiU',
				'細明體',
				'MingLiU',
				'標楷體',
				'DFKai-sb',
				'serif',
			],
		},

		extend: {
			spacing: {
				'12': '3rem',
				'14': '4rem',
				'16': '5rem',
				'2/3': '66.666667%',
			},
		},
	},
	variants: {
		alignContent: ['responsive'],
		alignItems: ['responsive'],
		alignSelf: ['responsive'],
		appearance: ['responsive'],
		// backgroundAttachment: ['responsive'],
		backgroundColor: ['hover', 'focus'],
		// backgroundPosition: ['responsive'],
		// backgroundRepeat: ['responsive'],
		// backgroundSize: ['responsive'],
		// borderCollapse: ['responsive'],
		borderColor: ['hover', 'focus'],
		// borderRadius: ['responsive'],
		// borderStyle: ['responsive'],
		// borderWidth: ['responsive'],
		// boxShadow: ['responsive', 'hover', 'focus'],
		// cursor: ['responsive'],
		display: ['responsive'],
		// fill: ['responsive'],
		flex: ['responsive'],
		flexDirection: ['responsive'],
		flexGrow: ['responsive'],
		flexShrink: ['responsive'],
		flexWrap: ['responsive'],
		float: ['responsive'],
		// fontFamily: ['responsive'],
		fontSize: ['responsive'],
		// fontSmoothing: ['responsive'],
		// fontStyle: ['responsive'],
		fontWeight: ['hover', 'focus'],
		height: ['responsive'],
		// inset: ['responsive'],
		justifyContent: ['responsive'],
		letterSpacing: ['responsive'],
		lineHeight: ['responsive'],
		// listStylePosition: ['responsive'],
		// listStyleType: ['responsive'],
		margin: ['responsive'],
		maxHeight: ['responsive'],
		maxWidth: ['responsive'],
		minHeight: ['responsive'],
		minWidth: ['responsive'],
		// objectFit: ['responsive'],
		// objectPosition: ['responsive'],
		opacity: ['responsive', 'hover', 'focus'],
		order: ['responsive'],
		// outline: ['responsive', 'focus'],
		overflow: ['responsive'],
		padding: ['responsive'],
		// pointerEvents: ['responsive'],
		position: ['responsive'],
		// resize: ['responsive'],
		// stroke: ['responsive'],
		// tableLayout: ['responsive'],
		textAlign: ['responsive'],
		textColor: ['responsive', 'hover', 'focus'],
		// textDecoration: ['responsive', 'hover', 'focus'],
		// textTransform: ['responsive'],
		// userSelect: ['responsive'],
		// verticalAlign: ['responsive'],
		// visibility: ['responsive'],
		// whitespace: ['responsive'],
		width: ['responsive'],
		// wordBreak: ['responsive'],
		// zIndex: ['responsive']
	},

	// plugins: [
	// 	function({ addComponents }) {
	// 		// const buttons = {
	// 		// 	'.btn-123': {
	// 		// 		padding: '.5rem 1rem',
	// 		// 		borderRadius: '.25rem',
	// 		// 		fontWeight: '600'
	// 		// 	}
	// 		// }

	// 		// addComponents(buttons)
	// 	}
	// ]
}
