import React from 'react';
import SideBarList from './SideBarList';
import sideBarData from '../assets/sideBarData';
import profilePic from '../assets/image/cv pic.png'; // Ensure the file path is correct

const SideBar = () => {
  return (
    <div className="w-full h-screen overflow-y-scroll sm:block hidden bg-secondary text-neutral scrollbar-thin">
      {/* Sidebar Header */}
      <div className="p-4 bg-secondary flex flex-col items-center">
        {/* Profile Picture */}
        <img
          src={profilePic}
          alt="Profile"
          className="w-16 h-16 rounded-full border-2 border-neutral"
        />
        {/* Profile Name */}
        <h2 className="text-lg font-semibold">John Doe</h2>
      </div>

      {/* Sidebar Links */}
      <nav className="mt-4 box-border">
        {sideBarData.length > 0 ? (
          sideBarData.map((data) => (
            <SideBarList
              key={data.id} // Assuming sideBarData has unique ids
              label={data.label}
              icon={data.icon}
              link={data.link}
            />
          ))
        ) : (
          <p className="text-center">No items available</p> // Optional message if data is empty
        )}
      </nav>
    </div>
  );
};

export default SideBar;
