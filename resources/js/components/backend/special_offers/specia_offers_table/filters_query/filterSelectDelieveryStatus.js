import React from 'react'

export default function FilterSelectDelieveryStatus({handleChange,type,width = 120,trans}) {
    return (
        <div onChange={handleChange.bind(this,type)} style={{width:width}}>

      <select className="form-control">
          <option value="">{trans["All"]}</option>
          <option value="pending">{trans["Pending"]}</option>
          <option value="confirmed">{trans["Confirmed"]}</option>
          <option value="on_delivery">{trans["On Delivery"]}</option>
          <option value="delivered">{trans["Delivered"]}</option>

      </select>

        </div>

    )
}
