import React from 'react'

export default function FilterNumber({handleChange,type,width=120}) {

    return (
        <div style={{width:width}}>

        <span>
            <input onChange={handleChange.bind(this,type)} className="form-control"   type="number" />
        </span>

        </div>

    )
}
