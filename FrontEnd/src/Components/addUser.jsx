import React from 'react';
import { FaPlus } from 'react-icons/fa'; // Import the FaPlus icon

const AddUser = () => {
  return (
    <button
      onClick={() => alert('hello')} // Replace with actual functionality later
      className="flex items-center space-x-2  text-nuetral py-2 px-4 rounded-md hover:bg-primary-dark"
    >
      <FaPlus size={16} /> {/* Icon */}
      <span>{}</span> {/* Button text */}
    </button>
  );
};

export default AddUser;
