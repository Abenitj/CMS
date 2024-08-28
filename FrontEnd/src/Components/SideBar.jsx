import React from 'react';
import { Link } from 'react-router-dom'; // Import Link for navigation
import { FaHome, FaUser, FaQuestionCircle, FaStar, FaBlog, FaSlidersH, FaCog, FaShareAlt } from 'react-icons/fa'; // Icons for the sidebar

const SideBar = () => {
  return (
    <div className="w-[250px] h-screen overflow-y-scroll bg-blue-800 text-white sidebar-scrollbar">
      {/* Sidebar Header */}
      <div className="p-4 bg-blue-900 flex items-center">
        <h1 className="text-lg font-bold">Dashboard</h1>
      </div>

      {/* Sidebar Links */}
      <nav className="mt-2">
        <ul className="space-y-2">
          <li>
            <Link to="/" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaHome className="mr-3 text-lg" />
              <span>Dashboard</span>
            </Link>
          </li>
          <li>
            <Link to="/user" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaUser className="mr-3 text-lg" />
              <span>User</span>
            </Link>
          </li>
          <li>
            <Link to="/faq" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaQuestionCircle className="mr-3 text-lg" />
              <span>FAQ</span>
            </Link>
          </li>
          <li>
            <Link to="/testimonial" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaStar className="mr-3 text-lg" />
              <span>Testimonial</span>
            </Link>
          </li>
          <li>
            <Link to="/section-title" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaStar className="mr-3 text-lg" /> {/* Change icon if needed */}
              <span>Section Title</span>
            </Link>
          </li>
          <li>
            <Link to="/site-configuration" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaCog className="mr-3 text-lg" />
              <span>Site Configuration</span>
            </Link>
          </li>
          <li>
            <Link to="/blog" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaBlog className="mr-3 text-lg" />
              <span>Blog</span>
            </Link>
          </li>
          <li>
            <Link to="/slider" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaSlidersH className="mr-3 text-lg" />
              <span>Slider</span>
            </Link>
          </li>
          <li>
            <Link to="/social" className="flex items-center p-3 text-white hover:bg-blue-700 transition duration-200">
              <FaShareAlt className="mr-3 text-lg" />
              <span>Social</span>
            </Link>
          </li>
        </ul>
      </nav>

      {/* Sidebar Footer (Optional) */}
      <div className="p-4 bg-blue-900 mt-auto">
        <p className="text-center text-sm">© 2024 Your Company</p>
      </div>
    </div>
  );
};

export default SideBar;
