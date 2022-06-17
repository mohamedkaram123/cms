import React from 'react'

export default function InputData({ name, error, onChange, type,value= null ,required=false,placeholder = name, id = type, input_type = "text", col_md = "6", col = "12", classes = "" }) {
  
  
  return (
      <div className={`col-md-${col_md} col-${col}`}>
        <div className="form-group">
        <label >{name} {required ? <span style={{ color: "red" }}>*</span>:null}</label>
                {/* <div className="input-group">
                <div className="input-group-prepend">
                <span className="input-group-text" style={{background:"#fff"}}>
                <i className="las la-phone-alt"></i>
                    </span>
                </div> */}
              <input id={type} type={input_type} value={value == null ? "" : value} onChange={onChange.bind(this, type)} placeholder={placeholder} className={`form-control ${classes}`} />
                {error[type] !== "" ?
                              <small className="require_data">{error[type]}</small>
                              : null}
                {/* </div> */}
                </div>
    </div>
  )
}
