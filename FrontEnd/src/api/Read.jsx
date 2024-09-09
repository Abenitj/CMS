import { useState, useEffect } from 'react';
import axios from 'axios';

const useReadData = (url) => {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(url);
        setData(response.data);
        setLoading(false);
      } catch (err) {
        setError(err);
        setLoading(false);
      }
    };

  setInterval(() => {
    fetchData();
  }, 500);
  }, [url]);

  return { data, loading, error };
};

export default useReadData;
