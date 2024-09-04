import React, { useState } from "react";
import Table from "../Components/Table";
import useReadData from "../api/Read";
import Form from "../Components/Form";
import CreateUser from "../assets/Form-Fields/user/CreateUser";
import AddUser from "../Components/add-button";

const User = () => {
  const [isopen, setisopen] = useState(false);
  
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

  // Function to open the form
  const handleAddUser = () => {
    setisopen(true);
  };

  // Function to close the form
  const handleCloseForm = () => {
    setisopen(false);
  };

  return (
    <div>
      <Table tableHeaders={tableHeaders} onAdd={handleAddUser} data={data} />
      <Form 
        title="Add User" 
        formFields={CreateUser} 
        isOpenProp={isopen} 
        isclose={handleCloseForm} 
      />
    </div>
  );
};

export default User;
