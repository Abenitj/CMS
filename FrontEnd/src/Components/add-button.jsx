import React from 'react';
import { FaPlus } from 'react-icons/fa'; // Import the FaPlus icon

const Add_Button = ({action,title}) => {
  return (
    <button
      onClick={action} // Replace with actual functionality later
      className="flex bg-secondary shadow-sm border-[1px] hover:bg-gray-100 transition-all duration-100 border-nuetral items-center space-x-2  text-nuetral py-2 px-4 rounded-md hover:bg-primary-dark"
    >
      <span>add-{title}</span>
      <FaPlus size={16} /> {/* Icon */}
      {/* Button text */}
    </button>
  );
};

export default Add_Button;
