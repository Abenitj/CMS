import axios from 'axios'
import React from 'react'
const Delete =async (id,url) => {

    try {
        // Send DELETE request to the specified URL with optional ID
        const response = await axios.delete(`${url}/${id}`);
    
        // Log or return the response data
        console.log(response.data);
        return response.data; // Return the response data if needed
      } catch (error) {
        // Handle any errors
        console.error('Error deleting resource:', error);
        throw error; // Re-throw the error for further handling if necessary
      }
}
 
export default Delete;