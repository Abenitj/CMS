/** @type {import('tailwindcss').Config} */
export default {
  content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        primary: "var(--primary)",
        secondary: {
          DEFAULT: "var(--secondary)",
          V2: "var(--secondary-v2)",
          V3: "var(--secondary-v3)",
        },
        neutral: "var(--neutral)",
      },
    },
  },
  plugins: [require("tailwind-scrollbar"),
    require("tailwind-scrollbar-hide")],
};
