/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"*/**.html",
		"*/**.js",
		"*/**.php",
		"*/views/**.php",
		"*/views/**/*.php",
	],
	theme: {
		extend: {
			screens: {
				"2xl": { max: "1535px" },
				xl: { max: "1280px" },
				lg: { max: "1024px" },
				lgt: { max: "920px" },
				md: { max: "768px" },
				sm: { max: "640px" },
				xs: { max: "440px" },
			},
		},
	},
	plugins: {
		plugins: ["prettier-plugin-tailwindcss"],
		tailwindcss: {},
		autoprefixer: {},
	},
};
