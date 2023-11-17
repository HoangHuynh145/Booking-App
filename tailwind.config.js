module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        epilogue: ["Epilogue", "sans-serif"],
        poppins: ["Poppins", "sans-serif"],
      },
      colors: {
        "mint-green": "#8DD3BB",
        "salmon": "#FF8682"
      }
    },
  },
  plugins: [],
}
