import React from 'react';

const renderField = ({ input, label, type, meta: { touched, error, warning } }) => (
  <div>
	  <label>{label}</label>
	  <div className="form-group">
		  <input className="form-control" {...input} placeholder={label} type={type}/>
	  </div>
	  <div style={{paddingBottom:"20px"}}>
		  {touched && ((error && <span className="alert alert-danger">{error}</span>) || (warning && <span className="alert alert-danger">{warning}</span>))}
	  </div>
  </div>
)

export default renderField