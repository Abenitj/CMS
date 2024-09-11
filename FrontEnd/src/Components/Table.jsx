import React, { useState } from 'react';
import { FaEdit, FaTrash, FaSearch } from 'react-icons/fa';
import Add_Button from './add-button';

const Table = ({ tableHeaders, data = [], onEdit, onDelete, onAdd, title }) => {
  const [searchTerm, setSearchTerm] = useState('');

  const handleSearchChange = (event) => {
    setSearchTerm(event.target.value);
  };

  // Ensure that data is an array before filtering
  const filteredData = Array.isArray(data)
    ? data.filter((item) =>
        tableHeaders.some((header) =>
          item[header.key]
            ? item[header.key].toString().toLowerCase().includes(searchTerm.toLowerCase())
            : false
        )
      )
    : [];

  return (
    <div className="overflow-x-auto">
      <div className="flex justify-center items-center mb-4 ">
        <div className="flex space-x-5">
          <div className="relative">
            <input
              type="text"
              value={searchTerm}
              onChange={handleSearchChange}
              placeholder="Search..."
              className="w-[300px] py-2 px-4 border border-gray-300 rounded-md outline-secondary-V2"
            />
            <FaSearch className="absolute top-3 right-3 text-gray-500" size={20} />
          </div>
          <Add_Button action={onAdd} title={title} />
        </div>
      </div>
     <div className='overflow-auto'>
     <table className="w-full bg-secondary border border-secondary-V2">
        <thead>
          <tr className="bg-secondary-V2 text-neutral uppercase text-sm leading-normal">
            {tableHeaders.map((header, index) => (
              <th key={index} className="py-3 px-6 text-left">
                {header.header}
              </th>
            ))}
            <th className="py-3 px-6 text-left">Actions</th>
          </tr>
        </thead>
        <tbody className="text-neutral text-sm font-light">
          {filteredData.length > 0 ? (
            filteredData.map((item, rowIndex) => (
              <tr key={rowIndex} className="border-b">
                {tableHeaders.map((header, colIndex) => (
                  <td key={colIndex} className="py-3 px-6 text-left h-4">
                    <div className='max-w-[240px] break-words'>
                      {header.key === 'ufile' && item[header.key] ? (
                        <img
                          src={`http://localhost/cms/dashboard/uploads/${item[header.key]}`}
                          alt="Uploaded file"
                          className="w-16 h-16 object-cover rounded"
                        />
                      ) : (
                        item[header.key] || 'N/A'
                      )}
                    </div>
                  </td>
                ))}
                <td className="py-3 px-6 text-left flex space-x-2">
                  <button
                    onClick={() => onEdit(item)}
                    className="text-neutral active:scale-110"
                    title="Edit"
                  >
                    <FaEdit size={16} />
                  </button>
                  <button
                    onClick={() => onDelete(item)}
                    className="text-neutral active:scale-110"
                    title="Delete"
                  >
                    <FaTrash size={16} />
                  </button>
                </td>
              </tr>
            ))
          ) : (
            <tr>
              <td colSpan={tableHeaders.length + 1} className="py-3 px-6 text-center">
                {data.length === 0 ? 'No data available' : 'No results found'}
              </td>
            </tr>
          )}
        </tbody>
      </table>
     </div>
     
    </div>
  );
};

export default Table;
