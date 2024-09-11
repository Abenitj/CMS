import React, { useState } from "react";
import Table from "../Components/Table";
import useReadData from "../api/Read";
import Form from "../Components/Form";
import faqForm from "../assets/Form-Fields/faqForm"
import Delete from "../api/delete";
import faqTable from "../assets/Table-Head/faqTable";
import Modal from "../Components/Modal";
const Faq = () => {
  const [isopen, setisopen] = useState(false);
  const [isModalOpen, setisModalOpen] = useState(false);
  const [title, setTitle] = useState("");
  const [api_info, setApi_info] = useState({});
  const [selectedUser, setselectedUser] = useState(null)
  // Assuming useReadData returns an object with data and possibly an error state
  const { data } = useReadData(
    "http://localhost/cms/dashboard/api/faqAPI/getFaq.php"
  );

  // Function to open the form
  const handleAddUser = () => {
    setisopen(true);
    setTitle("Create Faq");
    setApi_info({
      type: "add",
      url: "http://localhost/cms/dashboard/api/faqAPI/createFaq.php",
    });
  };
  // Function to close the form
  const handleCloseForm = () => {
    setisopen(false);
  };
  const handleEdit = (val) => {
    setTitle("update Testimony");
    setApi_info({
      type: "edit",
      url: `http://localhost/cms/dashboard/api/faqAPI/updateFaq.php?id=${val.id}`,
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
      Delete(selectedUser,`http://localhost/cms/dashboard/api/faqAPI/deleteFaq.php?id=${selectedUser}`)
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
        tableHeaders={faqTable}
        title={"Testimony"}
        onAdd={handleAddUser}
        data={data}
        onEdit={handleEdit}
        onDelete={handleDelete}
      />
      <Form
        title={title}
        formFields={faqForm}
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

export default Faq;
