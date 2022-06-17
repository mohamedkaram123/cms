import React, { useState } from 'react'

export default function FilterDate({handleChange,type,width=120}) {

    const [startDate, setStartDate] = useState(new Date(2020,12).toISOString().substring(0,10) )
    const [endtDate, setEndDate] = useState(new Date().toISOString().substring(0,10))

    return (
        <div className="row">

            <div  style={{width:250,marginInline:10}}>

<span>
    <input className="form-control"  type="date" value={startDate}  onChange={e=>{
        setStartDate(e.target.value)

        handleChange(type,e,e.target.value,endtDate)
    }} />
</span>

</div>




<div style={{width:250,marginInline:10}}>

<span>
    <input className="form-control"  type="date" value={endtDate}  onChange={e=>{
        setEndDate(e.target.value)
        handleChange(type,e,startDate,e.target.value)
    }} />
</span>

</div>

        </div>
    )
}
