import React from "react";
import DashboardCard from "../Components/DashboardCard";
import useReadData from "../api/Read";
import DataFetcher from "../assets/DataFetcher";
const UserCard = () => {
  return (
    <div className="md:pl-10 p-1 flex flex-col md:flex-row flex-wrap md:gap-x-3 md:gap-y-4 gap-y-3 justify-start">
      {DataFetcher.map((item, index) => {
        // Fetch data using the provided URL
        const data = useReadData(item.url);
        return (
          <DashboardCard
            key={index}
            label={item.label}
            value={data?.data?.length || 0} // Safely access the data length or default to 0
            Icon={item.Icon}
          />
        );
      })}
    </div>
  );
};

export default UserCard;
