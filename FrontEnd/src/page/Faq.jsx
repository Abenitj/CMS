import React, { useEffect, useState } from 'react'
import Form from '../Components/Form';
import Modal from '../Components/Modal';
const Faq = () => {
const [isopen, setisopen] = useState(true)
const [isConfirmed,setisConfirmed]=useState(false)
const handleConfirmation=()=>
{
  setisConfirmed(true);
  setisopen(false);
  
}

    return (
        <div>
        <Modal isopen={isopen} onConfirm={handleConfirmation} close={()=>setisopen(false)}/>
        </div>
      );
}
 
export default Faq; 