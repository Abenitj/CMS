import React, { useState } from 'react';
import { FaMoon, FaSun, FaUserCircle } from 'react-icons/fa'; // Icons for dark mode, light mode, and profile

const Navbar = () => {
  const [isDarkMode, setIsDarkMode] = useState(false);

  const toggleDarkMode = () => {
    setIsDarkMode(!isDarkMode);
    document.body.classList.toggle('dark-mode', !isDarkMode);
  };

  return (
    <div className={`w-full h-[50px] flex items-center justify-between px-4 bg-gray-200 dark:bg-gray-800`}>
      {/* Name/Brand */}
      <div className="text-xl font-bold text-gray-800 dark:text-gray-200">
        Addis Software
      </div>
      
      {/* Right side: Dark mode toggle and profile */}
      <div className="flex items-center space-x-4">
        {/* Dark/Light Mode Toggle */}
        <button 
          onClick={toggleDarkMode} 
          className="text-gray-800 dark:text-gray-200"
        >
          {isDarkMode ? <FaSun size={20} /> : <FaMoon size={20} />}
        </button>
        
        {/* Profile Icon */}
        <div className="flex items-center space-x-2">
          <FaUserCircle size={30} className="text-gray-800 dark:text-gray-200" />
          <span className="hidden md:inline text-gray-800 dark:text-gray-200">Profile</span>
        </div>
      </div>
    </div>
  );
};

export default Navbar;
