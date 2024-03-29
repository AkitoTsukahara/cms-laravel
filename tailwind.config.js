/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.svelte",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
  purge: {
    content: [
      './src/**/*.svelte',
      './src/**/*.html',
    ],
  },
};
