import React from 'react';
import DashboardCard from '../Components/DashboardCard';
import DashboardData from '../assets/DashboardData';

const UserCard = () => {
  return (
    <div className="md:pl-10 p-1  flex flex-col md:flex-row  flex-wrap md:gap-x-3 md:gap-y-4 gap-y-3 justify-start">
      {DashboardData.map((data,index)=>{
        return(
            <DashboardCard
            key={index}
            label={data?.label}
            icon={data?.icon}
            value={data?.value}
            color={data?.color}/>
        )
      })
    }
    </div>
  );
};

export default UserCard;
