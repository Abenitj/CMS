import React, { useState, useEffect } from 'react';
import { XMarkIcon } from '@heroicons/react/24/outline';

const Form = ({ formFields, title, isOpenProp, isclose }) => {
  const [isOpen, setIsOpen] = useState(isOpenProp);

  useEffect(() => {
    setIsOpen(isOpenProp);
  }, [isOpenProp]);

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
      setErrors({ ...errors, [name]: '' });
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

    formFields.forEach(field => {
      if (field.required && !formData[field.name]) {
        newErrors[field.name] = `${field.label} is required`;
        valid = false;
      }
    });

    if (valid) {
      console.log('Form Data:', formData);
      setIsOpen(false);
      isclose(); // Call the parent function to handle form close
    } else {
      setErrors(newErrors);
    }
  };

  const handleClose = () => {
    setIsOpen(false);
    isclose(); // Call the parent function when the form is manually closed
  };

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div className="relative w-full max-w-3xl bg-white border text-neutral border-gray-200 rounded-md shadow-sm p-6">
        <button
          onClick={handleClose}
          className="absolute top-4 right-4 p-2 bg-gray-200 rounded-full hover:bg-gray-300 focus:outline-none"
        >
          <XMarkIcon className="h-6 w-6 text-gray-600" />
        </button>
        <h2 className="text-2xl font-semibold mb-6 text-gray-700 text-center">{title}</h2>
        <form onSubmit={handleSubmit} className="space-y-6 max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {formFields.map((field, index) => (
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
