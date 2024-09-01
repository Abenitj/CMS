import React from "react";
import PropTypes from 'prop-types'; // Import PropTypes for type checking
import { Link } from 'react-router-dom'; // Import Link for navigation

const SideBarList = ({ label, icon, link }) => {
  return (
        <Link
          to={link}
          className="flex items-center p-3   hover:bg-secondary-V2  hover:border-l-4 hover:border-nuetral hover:scale-105 mx-2 text-nuetral transition duration-200"
        >
          <div className="mr-3 text-lg">
            {icon} {/* Render the icon */}
          </div>
          <span>{label}</span> {/* Render the label */}
        </Link>
  );
};

// Define prop types for type checking
SideBarList.propTypes = {
  label: PropTypes.string.isRequired, // 'label' must be a string
  icon: PropTypes.element.isRequired, // 'icon' must be a React element
  link: PropTypes.string.isRequired, // 'link' must be a string
};

export default SideBarList;
