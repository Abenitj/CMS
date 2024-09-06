import React, { useState } from "react";
import Table from "../Components/Table";
import useReadData from "../api/Read";
import Form from "../Components/Form";
import CreateUser from "../assets/Form-Fields/user/CreateUser";
import Delete from "../api/delete";
import userTable from "../assets/Table-Head/userTable";
const User = () => {
  const [isopen, setisopen] = useState(false);
  const [title,setTitle]=useState('')
  const [api_info,setApi_info]=useState({})
  // Assuming useReadData returns an object with data and possibly an error state
  const { data } = useReadData(
    "http://localhost/cms/dashboard/api/usersApi/getUsers.php"
  );
 
  // Function to open the form
  const handleAddUser = () => {
    setisopen(true);
    setTitle('Create User')
    setApi_info(
      {
        type:"add",
        url:"create url"

      }
    )
  };
  // Function to close the form
const handleCloseForm = () => {
    setisopen(false);
  };
const handleEdit=(val)=>{
  setTitle('update User')
  setApi_info(
    {
      type:"edit",
      url:`update url`,
    }
  )
// header
setisopen(true)
}
const handleDelete=(val)=>{
alert("confirmation")
}
  return (
    <div>
      <Table
        tableHeaders={userTable}
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
        api_info={api_info}

      />
    </div>
  );
};

export default User;
