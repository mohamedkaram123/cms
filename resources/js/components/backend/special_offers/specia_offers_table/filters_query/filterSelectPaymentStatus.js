import React from 'react'

export default function FilterSelectPaymentStatus({handleChange,type,width = 120,trans}) {
    return (
        <div style={{width:width}}>

      <select onChange={handleChange.bind(this,type)} className="form-control">
          <option value="">{trans["All"]}</option>
          <option value="paid">{trans["Paid"]}</option>
          <option value="unpaid">{trans["Un Paid"]}</option>

      </select>

        </div>

    )
}
