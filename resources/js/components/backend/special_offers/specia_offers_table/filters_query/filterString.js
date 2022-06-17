import React from 'react'

export default function FilterString({handleChange,type,width}) {
    return (
        <div style={{width:type == "email"?200:width}}>

        <span>
            <input onChange={handleChange.bind(this,type)} className="form-control"    />
        </span>

        </div>

    )
}
