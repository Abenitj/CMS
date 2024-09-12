import React from 'react';
import { XMarkIcon, TrashIcon } from '@heroicons/react/24/solid';

const Modal = ({ isopen, onclose, onConfirm }) => {
  if (!isopen) return null;

  return (
    <div
      className='fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50'
    >
      <div className='relative flex flex-col justify-center items-center w-full max-w-md bg-secondary rounded-lg shadow-lg p-6'>
        {/* Close button with X icon */}
        <button
          onClick={onclose}
          className='absolute top-4 right-4 w-10 h-10 rounded-full bg-secondary-V2 flex justify-center items-center text-gray-600'
        >
          <XMarkIcon className='w-6 h-6 text-neutral' />
        </button>

        {/* Modal content */}
        <div className='text-center'>
          {/* Trash icon */}
          <TrashIcon className='w-16 h-16 text-red-600 mb-4 mx-auto' />

          {/* Confirmation message */}
          <p className="text-lg font-medium text-neutral  mb-1">
            Are you sure you want to delete this item?
          </p>
          <p className="text-sm text-neutral mb-6">
            This action cannot be undone.
          </p>

          {/* Action buttons */}
          <div className='flex justify-center gap-4'>
            <button
              onClick={onConfirm}
              className='bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700 transition duration-300'
            >
              Confirm
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Modal;
