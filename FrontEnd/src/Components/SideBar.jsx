import React from 'react';
import SideBarList from './SideBarList';
import sideBarData from '../assets/sideBarData';
 // Ensure the file path is correct
import profile from '../assets/profile';
const SideBar = () => {
  return (
    <div className="w-full h-screen overflow-y-scroll scrollbar-track-secondary scrollbar-thumb-secondary-V3 overflow-x-hidden bg-secondary text-neutral scrollbar-thin">
      {/* Sidebar Container */}
      <nav className="mt-4 box-border relative">
        {/* Profile Picture and Name */}
        <div className="flex flex-col items-center p-4">
          <img
            src={profile.image}
            alt="Profile"
            className="w-16 h-16  rounded-full border-2 border-neutral"
          />
          <h2 className="text-xl font-semibold text-center mt-2">{profile.firstname}{profile.lastname}</h2>
        </div>

        {/* Sidebar Links */}
        <div className="mt-4">
          {sideBarData.length > 0 ? (
            sideBarData.map((data, index) => (
              <SideBarList
                key={index} // Assuming sideBarData does not have unique ids
                label={data.label}
                icon={data.icon}
                link={data.link}
              />
            ))
          ) : (
            <p className="text-center">No items available</p>
          )}
        </div>
      </nav>
    </div>
  );
};

export default SideBar;
