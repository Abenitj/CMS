import axios from 'axios';

const postData = async (data) => {
  try {
    const response = await axios.post("http://localhost/cms/dashboard/api/AAA.php", data, {
      headers: {
        'Content-Type': 'multipart/form-data', // Adjust header based on your data type
      },
    });
    console.log(response.data);
  } catch (error) {
    console.error(error);
  }
};

export default postData;
