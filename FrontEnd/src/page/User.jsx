import React, { useState } from "react";
import Table from "../Components/Table";
import useReadData from "../api/Read";
import Form from "../Components/Form";
import CreateUser from "../assets/Form-Fields/user/CreateUser";
import AddUser from "../Components/add-button";
import postData from "../api/post";
import Update from "../api/update";
const User = () => {
  const [isopen, setisopen] = useState(false);
  const [title,setTitle]=useState('')
  const [type,settype]=useState({})
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
    setTitle('Create User')
  };
  // Function to close the form
const handleCloseForm = () => {
    setisopen(false);
  };
const handleEdit=(val)=>{
  setTitle('update User')
  settype(
    {
      edit:"edit",
      url:"this is url",
      id:val.id,
    }
  )
// header
setisopen(true)
}
const handleDelete=(val)=>{
  alert(val)
}
const handleSubmit=(data)=>
{

}
  return (
    <div>
      <Table
        tableHeaders={tableHeaders}
        title={"user"}
        onAdd={handleAddUser}
        data={data}
        onEdit={handleEdit}
        onDelete={handleDelete}
      />
      <Form
        title={title}
        formFields={CreateUser}
        isOpenProp={isopen}
        isclose={handleCloseForm}
        onHandleSubmit={handleSubmit}
        type={type}
      />
    </div>
  );
};

export default User;
