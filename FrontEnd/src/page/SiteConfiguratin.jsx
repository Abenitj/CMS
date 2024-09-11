import React, { useState } from "react";
import Table from "../Components/Table";
import useReadData from "../api/Read";
import Form from "../Components/Form";
import SiteConfigForm from "../assets/Form-Fields/SiteConfigForm"
import Delete from "../api/delete";
import siteConfigTable from "../assets/Table-Head/siteConfigTable";
import Modal from "../Components/Modal";
const SiteConfiguration = () => {
  const [isopen, setisopen] = useState(false);
  const [isModalOpen, setisModalOpen] = useState(false);
  const [title, setTitle] = useState("");
  const [api_info, setApi_info] = useState({});
  const [selectedUser, setselectedUser] = useState(null)
  // Assuming useReadData returns an object with data and possibly an error state
  const { data } = useReadData(
    "http://localhost/cms/dashboard/api/siteConfigApi/getSiteConfig.php"
  );

  // Function to open the form
  const handleAddUser = () => {
    setisopen(true);
    setTitle("Create Site-Configuration");
    setApi_info({
      type: "add",
      url: "http://localhost/cms/dashboard/api/siteConfigApi/createSiteConfig.php",
    });
  };
  // Function to close the form
  const handleCloseForm = () => {
    setisopen(false);
  };
  const handleEdit = (val) => {
    setTitle("update Site-Configuration");
    setApi_info({
      type: "edit",
      url: `http://localhost/cms/dashboard/api/siteConfigApi/updateSiteConfig.php?id=${val.id}`,
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
      Delete(selectedUser,`http://localhost/cms/dashboard/api/siteConfigApi/deleteSiteConfig.php?id=${selectedUser}`)
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
        tableHeaders={siteConfigTable}
        title={"Site-Configuration"}
        onAdd={handleAddUser}
        data={data}
        onEdit={handleEdit}
        onDelete={handleDelete}
      />
      <Form
        title={title}
        formFields={SiteConfigForm}
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

export default SiteConfiguration;
