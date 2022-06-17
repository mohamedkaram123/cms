import React from 'react'
import Select from 'react-select';

export default function SelectData({name,error,options,value,required=false,onChange,type,placeholder = name,id=type,col_md="6",col="12",classes=""}) {
  return (
      <div className={`col-md-${col_md} col-${col}`}>
        <div className="form-group">
                <label >{name}  {required ? <span style={{ color: "red" }}>*</span>:null}</label>
                {/* <div className="input-group">
                <div className="input-group-prepend">
                <span className="input-group-text" style={{background:"#fff"}}>
                <i className="las la-phone-alt"></i>
                    </span>
                </div> */}
                     <Select   menuPosition={'fixed'}  id={id} style  value = {
                                    options.filter(option =>
                                        option.value === value)
                                  } onChange={(e)=>{
                                                let event = {target:{value:e.value}};
                                                  onChange(type, event)

                                             }}  placeholder={placeholder} options={options} />
        {error[type] !== "" ?
                              <small className="require_data">{error[type]}</small>
                              : null}
                {/* </div> */}
                </div>
    </div>
  )
}
