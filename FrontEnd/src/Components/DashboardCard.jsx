import React from "react";

const DashboardCard = ({ label, value, Icon }) => {
  return (
    <div className="relative md:w-[30%] w-full overflow-hidden border-l-8 border-nuetral hover:scale-105 transition-all duration-200 h-32 rounded-xl flex items-center md:p-4 p-3 shadow-lg text-neutral bg-secondary">
      {/* Background Icon */}
      <div className="absolute left-20 inset-0 flex items-center justify-center opacity-10 bg-secondary-V3">
        <Icon className="text-9xl text-nuetral " />
      </div>

      {/* Content */}
      <div className="relative flex items-center text-nuetral">
        <div className="w-14 h-14 rounded-full flex items-center justify-center shadow-lg">
          <Icon className="text-2xl " />
        </div>
        <div className="ml-4">
          <div className=" text-xl font-bold">{label}</div>
          <div className="text-2xl font-bold ">{value}</div>
        </div>
      </div>
    </div>
  );
};

export default DashboardCard;
