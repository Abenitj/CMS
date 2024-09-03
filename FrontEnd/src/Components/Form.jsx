import React, { useState } from 'react';
import { XMarkIcon } from '@heroicons/react/24/outline'; // Updated import for Heroicons v2

const Form = () => {
  const [isOpen, setIsOpen] = useState(true); // State to control modal visibility

  const formFields = [
    { name: 'firstName', type: 'text', required: true, label: 'First Name' },
    { name: 'lastName', type: 'text', required: true, label: 'Last Name' },
    { name: 'email', type: 'email', required: true, label: 'Email' },
    { name: 'password', type: 'password', required: true, label: 'Password' },
    { name: 'file', type: 'file', required: true, label: 'File Upload' },
  ];

  const [formData, setFormData] = useState(
    formFields.reduce((acc, field) => ({ ...acc, [field.name]: '' }), {})
  );
  const [errors, setErrors] = useState({});

  const handleInputChange = (event) => {
    const { name, value, type, files } = event.target;
    setFormData({
      ...formData,
      [name]: type === 'file' ? files[0] : value,
    });

    if (type === 'file') {
      setErrors({ ...errors, [name]: '' }); // Clear file input errors
    } else {
      validateField(name, value);
    }
  };

  const validateField = (name, value) => {
    let errorMessage = '';
    const field = formFields.find(field => field.name === name);
    
    if (field.required && !value) {
      errorMessage = `${field.label} is required`;
    }
    
    setErrors({ ...errors, [name]: errorMessage });
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    let valid = true;
    const newErrors = {};

    // Validate all required fields
    formFields.forEach(field => {
      if (field.required && !formData[field.name]) {
        newErrors[field.name] = `${field.label} is required`;
        valid = false;
      }
    });

    if (valid) {
      console.log('Form Data:', formData);
      setIsOpen(false); // Close the modal after submission
    } else {
      setErrors(newErrors);
    }
  };

  const handleClose = () => {
    setIsOpen(false); // Close the modal
  };

  if (!isOpen) return null; // Do not render the modal if it's closed

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div className="relative w-full max-w-3xl bg-white border text-neutral border-gray-200 rounded-md shadow-sm p-6">
        <button
          onClick={handleClose}
          className="absolute top-4 right-4 p-2 bg-gray-200 rounded-full hover:bg-gray-300 focus:outline-none"
        >
          <XMarkIcon className="h-6 w-6 text-gray-600" />
        </button>
        <h2 className="text-2xl font-semibold mb-6 text-gray-700 text-center">Form</h2>
        <form onSubmit={handleSubmit} className="space-y-6">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {formFields.slice(0, 4).map((field, index) => (
              <div key={index} className="flex flex-col">
                <label className="mb-1 flex items-center">
                  {field.label}
                  {field.required && <span className="text-red-500 ml-1">*</span>}
                </label>
                <input
                  type={field.type}
                  name={field.name}
                  value={formData[field.name] || ''}
                  onChange={handleInputChange}
                  className={`border-b border-gray-300 rounded-none p-2 focus:outline-none focus:border-blue-500 ${errors[field.name] ? 'border-red-500' : ''}`}
                />
                {errors[field.name] && (
                  <span className="text-red-500 text-sm mt-1">{errors[field.name]}</span>
                )}
              </div>
            ))}
          </div>
          <div className="mt-6">
            <div className="flex flex-col">
              {formFields.slice(4, 5).map((field, index) => (
                <div key={index} className="flex flex-col">
                  <label className="mb-1 flex items-center">
                    {field.label}
                    {field.required && <span className="text-red-500 ml-1">*</span>}
                  </label>
                  <input
                    type={field.type}
                    name={field.name}
                    onChange={handleInputChange}
                    className={`border-b border-gray-300 rounded-none p-2 focus:outline-none focus:border-blue-500 ${errors[field.name] ? 'border-red-500' : ''}`}
                  />
                  {errors[field.name] && (
                    <span className="text-red-500 text-sm mt-1">{errors[field.name]}</span>
                  )}
                </div>
              ))}
            </div>
          </div>
          {/* Remaining fields in a two-column grid if they exist */}
          {formFields.slice(5).length > 0 && (
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
              {formFields.slice(5).map((field, index) => (
                <div key={index} className="flex flex-col">
                  <label className="mb-1 flex items-center">
                    {field.label}
                    {field.required && <span className="text-red-500 ml-1">*</span>}
                  </label>
                  <input
                    type={field.type}
                    name={field.name}
                    value={formData[field.name] || ''}
                    onChange={handleInputChange}
                    className={`border-b border-gray-300 rounded-none p-2 focus:outline-none focus:border-blue-500 ${errors[field.name] ? 'border-red-500' : ''}`}
                  />
                  {errors[field.name] && (
                    <span className="text-red-500 text-sm mt-1">{errors[field.name]}</span>
                  )}
                </div>
              ))}
            </div>
          )}
          <div className="flex justify-center">
            <button
              type="submit"
              className="w-1/3 bg-secondary-V2 py-2 px-4 rounded-md hover:scale-105 text-md transition"
            >
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Form;
