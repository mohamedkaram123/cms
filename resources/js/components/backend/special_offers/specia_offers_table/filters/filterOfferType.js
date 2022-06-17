import React from 'react'

export default function FilterOfferType({handleChange,type,width = 120,trans}) {
    return (
        <div onChange={handleChange.bind(this,type)} style={{width:width}}>

      <select className="form-control">
          <option value="">{trans["All"]}</option>
          <option value="percent">{trans["Percent"]}</option>
          <option value="amount">{trans["Amount"]}</option>


      </select>

        </div>

    )
}
