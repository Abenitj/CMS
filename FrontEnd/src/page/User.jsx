import React, { useState, useEffect } from "react";
import Table from "../Components/Table";
import useReadData from "../api/Read";

const User = () => {
  // Assuming useReadData returns an object with data and possibly an error state
  const { data } = useReadData(
    "http://localhost/cms/dashboard/api/usersApi/getUsers.php"
  );
  const tableHeaders = [
    { header: "id", key: "id" },
    { header: "name", key: "name" },
    { header: "phone", key: "phone" },
    { header: "email", key: "email" },
    { header: "city", key: "city" },
    { header: "country", key: "country" },
  ];

  return (
    <div>
      <Table tableHeaders={tableHeaders} data={data} />
    </div>
  );
};

export default User;
