import React from 'react';
import { FaPlus } from 'react-icons/fa'; // Import the FaPlus icon

const Add_Button = ({action,title}) => {
  return (
    <button
      onClick={action} // Replace with actual functionality later
      className="flex bg-secondary shadow-sm border-[1px] hover:bg-secondary-V3 transition-all duration-100  items-center space-x-2  text-neutral  py-2 px-4 rounded-md "
    >
      <span>add-{title}</span>
      <FaPlus size={16} /> {/* Icon */}
      {/* Button text */}
    </button>
  );
};

export default Add_Button;
