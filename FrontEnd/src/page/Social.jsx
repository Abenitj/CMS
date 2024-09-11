import React, { useState } from "react";
import Table from "../Components/Table";
import useReadData from "../api/Read";
import Form from "../Components/Form";
import SocialForm from "../assets/Form-Fields/SocialForm"
import Delete from "../api/delete";
import socialTable from "../assets/Table-Head/socialTable";
import Modal from "../Components/Modal";
const Social = () => {
  const [isopen, setisopen] = useState(false);
  const [isModalOpen, setisModalOpen] = useState(false);
  const [title, setTitle] = useState("");
  const [api_info, setApi_info] = useState({});
  const [selectedUser, setselectedUser] = useState(null)
  // Assuming useReadData returns an object with data and possibly an error state
  const { data } = useReadData(
    "http://localhost/cms/dashboard/api/socialApi/getSocial.php"
  );

  // Function to open the form
  const handleAddUser = () => {
    setisopen(true);
    setTitle("Create Social");
    setApi_info({
      type: "add",
      url: "http://localhost/cms/dashboard/api/socialApi/createSocial.php",
    });
  };
  // Function to close the form
  const handleCloseForm = () => {
    setisopen(false);
  };
  const handleEdit = (val) => {
    setTitle("update Social");
    setApi_info({
      type: "edit",
      url: `http://localhost/cms/dashboard/api/socialApi/updateSocial.php?id=${val.id}`,
    });
    // header
    setisopen(true);
  };
  const handleDelete = (val) => {
    setisModalOpen(true)
    setselectedUser(val.id)
  };
  const handleConfirmation=()=>
  {
     if(selectedUser)
     {
      Delete(selectedUser,`http://localhost/cms/dashboard/api/socialApi/deleteSocial.php?id=${selectedUser}`)
       setisModalOpen(false)
     }
  }
  const handleCancelDelete=()=>
  {
    setisModalOpen(false)
    setselectedUser(null)
  }
  return (
    <div>
      <Table
        tableHeaders={socialTable}
        title={"Social"}
        onAdd={handleAddUser}
        data={data}
        onEdit={handleEdit}
        onDelete={handleDelete}
      />
      <Form
        title={title}
        formFields={SocialForm}
        isOpenProp={isopen}
        isclose={handleCloseForm}
        api_info={api_info}
      />
      <Modal 
      isopen={isModalOpen} 
      onclose={handleCancelDelete}
      onConfirm={handleConfirmation}
      />
    </div>
  );
};

export default Social;
