import React, { useState, useEffect } from 'react';
import { XMarkIcon } from '@heroicons/react/24/outline';
import Create from "../api/create";
import Update from '../api/update';

const Form = ({ api_info, formFields, title, isOpenProp, isclose, url }) => {
  const [isOpen, setIsOpen] = useState(isOpenProp);

  useEffect(() => {
    setIsOpen(isOpenProp);
  }, [isOpenProp]);

  const [formData, setFormData] = useState(
    formFields.reduce((acc, field) => ({ ...acc, [field.name]: '' }), {})
  );
  const [fileNames, setFileNames] = useState({});
  const [errors, setErrors] = useState({});

  const handleInputChange = (event) => {
    const { name, value, type, files } = event.target;
    if (type === 'file') {
      setFormData((prevData) => ({
        ...prevData,
        [name]: files[0],
      }));
      setFileNames({
        ...fileNames,
        [name]: files[0] ? files[0].name : '',
      });
      setErrors((prevErrors) => ({ ...prevErrors, [name]: '' }));
    } else {
      setFormData((prevData) => ({
        ...prevData,
        [name]: value,
      }));
      validateField(name, value);
    }
  };

  const validateField = (name, value) => {
    let errorMessage = '';
    const field = formFields.find((field) => field.name === name);
    
    if (field && field.required && !value) {
      errorMessage = `${field.label} is required`;
    }

    setErrors((prevErrors) => ({ ...prevErrors, [name]: errorMessage }));
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    let valid = true;
    const newErrors = {};

    formFields.forEach((field) => {
      if (field.required && (!formData[field.name] || (field.type === 'file' && !formData[field.name]))) {
        newErrors[field.name] = `${field.label} is required`;
        valid = false;
      }
    });

    if (valid) {
      const formDataObject = new FormData();
      Object.keys(formData).forEach((key) => {
        formDataObject.append(key, formData[key]);
      });

      if (api_info.type === 'edit') {
        Update(formDataObject, api_info.url);
      } else {
        Create(formDataObject, api_info.url);
      }
      
      setIsOpen(false);
      isclose();
    } else {
      setErrors(newErrors);
    }
  };

  const handleClose = () => {
    setIsOpen(false);
    isclose();
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
                  onChange={handleInputChange}
                  className={`border-b border-gray-300 rounded-none p-2 focus:outline-none focus:border-blue-500 ${errors[field.name] ? 'border-red-500' : ''}`}
                  accept={field.accept || ''}
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
              className="w-1/4 bg-secondary-V2 hover:bg-gray-200 py-2 px-4 rounded-md text-md transition-all duration-100"
            >
              {title}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Form;
