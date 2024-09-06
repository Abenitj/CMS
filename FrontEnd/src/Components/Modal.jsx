// src/Components/DeleteModal.jsx
import React from "react";
import Modal from "./Modal"; // Import the base Modal component

const DeleteModal = ({ isOpen, onClose, onDelete, userToDelete }) => {
  return (
    <Modal isOpen={isOpen} onClose={onClose}>
      <div>
        <h2 className="text-lg font-semibold">Confirm Delete</h2>
        <p className="mt-2">Are you sure you want to delete {userToDelete?.name}?</p>
        <div className="mt-4 flex justify-end">
          <button
            className="bg-red-500 text-white px-4 py-2 rounded mr-2"
            onClick={onDelete}
          >
            Delete
          </button>
          <button
            className="bg-gray-300 text-black px-4 py-2 rounded"
            onClick={onClose}
          >
            Cancel
          </button>
        </div>
      </div>
    </Modal>
  );
};

export default DeleteModal;
