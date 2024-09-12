import React, { useState } from 'react';
import { FaMoon, FaSun,FaBars, FaUserCircle } from 'react-icons/fa'; // Icons for dark mode, light mode, and profile

const Navbar = ({onClose}) => {
  const [isDarkMode, setIsDarkMode] = useState(false);

  const toggleDarkMode = () => {
    setIsDarkMode(!isDarkMode);
    document.body.classList.toggle('dark-mode', !isDarkMode);
  };

  return (
    <div 
      className={`w-full h-[50px] flex items-center justify-between px-4  text-nuetral shadow-md ${isDarkMode ? 'bg-dark text-light' : ''}`}
    >
    <div>  <FaBars className='hover:cursor-pointer' onClick={onClose} size={20}/></div>
      {/* Name/Brand */}
      <div className="text-xl font-bold">
        Abissinia Software
      </div>
      
      {/* Right side: Dark mode toggle and profile */}
      <div className="flex items-center space-x-4">
        {/* Dark/Light Mode Toggle */}
        <button 
          onClick={toggleDarkMode} 
          className="focus:outline-none"
        >
          {isDarkMode ? <FaSun size={20} /> : <FaMoon size={20} />}
        </button>
        
        {/* Profile Icon */}
        <div className="flex items-center space-x-2">
          <FaUserCircle size={30} className="" />
          <span className="hidden md:inline">Profile</span>
        </div>
      </div>
    </div>
  );
};

export default Navbar;
