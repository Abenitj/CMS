import React from 'react';
import { FaEdit, FaTrash } from 'react-icons/fa'; // Import icons

const Table = ({ tableHeaders, data, onEdit, onDelete }) => {
  return (
    <div className="overflow-x-auto">
      <table className="min-w-full bg-secondary border border-secondary-V2">
        <thead>
          <tr className="bg-secondary-V2 text-nuetral uppercase text-sm leading-normal">
            {tableHeaders.map((header, index) => (
              <th key={index} className="py-3 px-6 text-left">
                {header.header}
              </th>
            ))}
            <th className="py-3 px-6 text-left">Actions</th> {/* Actions header */}
          </tr>
        </thead>
        <tbody className="text-nuetral text-sm font-light">
          {data.map((item, rowIndex) => (
            <tr key={rowIndex} className="border-b">
              {tableHeaders.map((header, colIndex) => (
                <td key={colIndex} className="py-3 px-6 text-left">
                  {item[header.key] || 'N/A'}
                </td>
              ))}
              <td className="py-3 px-6 text-left flex space-x-2">
                <button
                  onClick={() => onEdit(item)}
                  className="text-nuetral active:scale-110"
                  title="Edit"
                >
                  <FaEdit size={16} />
                </button>
                <button
                  onClick={() => onDelete(item)}
                  className="text-nuetral active:scale-110"
                  title="Delete"
                  
                >
                  <FaTrash size={16} />
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Table;
