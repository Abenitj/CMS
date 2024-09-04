import React from 'react'
import Form from '../Components/Form';
import CreateUser from '../assets/Form-Fields/user/CreateUser';
const Faq = () => {
    return (
        <div>
        <Form title={'Create user'} formFields={CreateUser}/> 
        </div>
      );
}
 
export default Faq;