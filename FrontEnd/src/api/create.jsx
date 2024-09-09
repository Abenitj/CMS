import axios from 'axios';

const Create = async (formData, url) => {
  try {
    // Send POST request with form data
    const response = await axios.post(url, formData, {
      headers: {
        'Content-Type': 'multipart/form-data', // Ensure correct content type
      },
    });

    // Log or return the response data
    console.log(response.data);
    return response.data; // Return the response data if needed
  } catch (error) {
    // Handle any errors
    console.error('Error posting form data:', error);
    throw error; // Re-throw the error for further handling if necessary
  }
};

export default Create;
