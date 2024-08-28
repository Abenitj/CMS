/** @type {import('tailwindcss').Config} */
export default {
  content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        primary: "#FFFFFF",
        secondary: {
          DEFAULT: "#F9F6F7",
          V2: "#e2e2e2",
        },
        nuetral: "#1E2A5E",
        error: "#FF0000",
        success: "#00FF00",
        accent: {
          DEFAULT: "#FF971D",
          v2: "#FFE8D6",
        },
      },
    },
  },
  plugins: [require("tailwind-scrollbar"), require("tailwind-scrollbar-hide")],
};
