/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["*/**.html", "*/**.js", "*/**.jsx", "*/**.ts", "*/**.tsx", "*/**.php", "*/views/**.php"],
    theme: {
        extend: {
            screens: {
                "2xl": { max: "1535px" },
                xl: { max: "1280px" },
                lg: { max: "1024px" },
                md: { max: "768px" },
                sm: { max: "640px" },
                xs: { max: "440px" },
            },
        },
    },
    plugins: ["prettier-plugin-tailwindcss"],
};
