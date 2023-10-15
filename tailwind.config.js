/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [""],
    theme: {
        extend: {
            screens: {
                "2xl": { max: "1440px" },
                xl: { max: "1280px" },
                lg: { max: "1024px" },
                md: { max: "768px" },
                sm: { max: "640px" },
                xs: { max: "480px" },
            },
        },
    },
    plugins: ["prettier-plugin-tailwindcss"],
};
