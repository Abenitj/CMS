import React from 'react';

const DashboardCard = ({ icon: Icon, label, value, color }) => {
  return (
    <div
      className={`relative md:w-[30%] w-full overflow-hidden border-l-8 h-32 rounded-xl flex items-center md:p-4 shadow-md text-neutral`}
      style={{ borderColor: color,
        backgroundColor:color
       }}
    >
      {/* Background Icon */}
      <div className="absolute left-24 inset-0 flex items-center justify-center"
      style={{color:color}}
      >
        <Icon size={140} className="text-accent opacity-20" />
      </div>

      {/* Content */}
      <div className="relative flex items-center">
        <div
          className={`w-14 bg-secondary h-14 rounded-full flex items-center justify-center shadow-md`}
          style={{ color:color }}
        >
          <Icon size={24} />
        </div>
        <div className="ml-4 text-primary">
          <div className="font-semibold text-xl"
          >{label}</div>
         <div className='font-bold'>........................................</div>
          <div className="text-2xl font-bold">{value}</div>
        </div>
      </div>
    </div>
  );
};

export default DashboardCard;
