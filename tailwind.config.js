/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/View/Home/*.php",
    "./src/View/**/*.php", // Include other directories if needed
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
}
