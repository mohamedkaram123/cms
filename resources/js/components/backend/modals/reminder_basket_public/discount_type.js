import React from 'react'

export default function DiscountType({ trans,discounreminderData ,setdiscounreminderData}) {

    if (discounreminderData.discounttype == "amount") {
        return (
                <div className="row">
                                     <div className="col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-money-bill"></i>
                                                </span>
                                           </div>
                                           <input type="number" onChange={e=>{
                                               setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        discount: parseFloat(e.target.value),
                                                                    }));
                                           }}  placeholder={trans["amount from purches"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                 </div>

        )
    } else if(discounreminderData.discounttype == "percent"){
        return (
             <div className="row">
                                     <div className="col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-money-bill"></i>
                                                </span>
                                           </div>
                                           <input type="number" onChange={e=>{
                                               setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        discount: parseFloat(e.target.value),
                                                                    }));
                                           }}  placeholder={trans["percent from purches"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                 </div>
        )
    } else {
        return (
            null
        )

    }

}
