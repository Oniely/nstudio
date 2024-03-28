/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./*.php",
      "./**.php",
      "./views/*.php",
      "./views/**.php",
      "./views/dashboard/*.php",
      "./views/dashboard/**.php",
      "./views/partials/*.php",
      "./views/partials/**.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

