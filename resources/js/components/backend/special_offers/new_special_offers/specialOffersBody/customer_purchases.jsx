import React, { useEffect, useRef, useState } from 'react'
import CustomerPurchesesCondition from './customer_purcheses_condition';
import Select from 'react-select';

export default function CustomerPurchases({trans,specialoffercheck,optionsCategories,dataFixedCustomerPurches,dataPercentCustomerPurches}) {

    const [DiscountValue, setDiscountValue] = useState(0)
    const [MaximumDiscount, setMaximumDiscount] = useState(0)
    const [CheckConditionsOffer, setCheckConditionsOffer] = useState(1)
    const [OptionLimitOffers, setOptionLimitOffers] = useState([
        {
            label:trans["Limit for Purchese Price"],
            value:"price"
        },
        {
            label:trans["Limit for Products Quantity"],
            value:"quantity"
        }
    ])

    const [showLimit, setshowLimit] = useState(true)
    const [OptionLimitOffersValue, setOptionLimitOffersValue] = useState("price")

    const [LimitOffersPrice, setLimitOffersPrice] = useState(0)
    const [LimitOffersQuntity, setLimitOffersQuntity] = useState(0)

    const [CheckedWithCoupon, setCheckedWithCoupon] = useState(0)

   const handleCheckConditionsOffer = (val)=>{

       if (val.target.value == 2) {
           setshowLimit(false)
       } else {
        setshowLimit(true)
       }
            setCheckConditionsOffer(val.target.value)
            dataFixedCustomerPurches({offer_applies:parseInt(val.target.value)})
            dataPercentCustomerPurches({offer_applies:parseInt(val.target.value)})
 }


    const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic
        mounted.current = true;
      } else {

        setDiscountValue(0)
        setLimitOffersPrice(0)
        setLimitOffersQuntity(0)
        setCheckConditionsOffer(1)
        setOptionLimitOffersValue("price")
        setCheckedWithCoupon(0)

        dataFixedCustomerPurches({discount:0})

        dataPercentCustomerPurches({discount_percent:0})

        dataPercentCustomerPurches({max_discount:0})

        dataFixedCustomerPurches({limit_price_or_product:"price"})
        dataPercentCustomerPurches({limit_price_or_product:"price"})

        dataFixedCustomerPurches({offer_applies:1})
        dataPercentCustomerPurches({offer_applies:1})

        dataFixedCustomerPurches({price:0})
        dataPercentCustomerPurches({price:0})


        dataFixedCustomerPurches({quantity:0})
        dataPercentCustomerPurches({quantity:0})

        dataFixedCustomerPurches({with_coupon:0})

        dataPercentCustomerPurches({with_coupon:0})

        // do componentDidUpdate logic
      }
    }, [specialoffercheck]);
    return (
        <div>
        <div className="card">
            <div className="card-header">
                    <span>{trans["Offer Options"]} - <span style={{color:"#aaa"}}>{specialoffercheck == 2?trans["Fixed amount of customer purchases"]:trans["Percent of customer purchases"] }</span></span>
            </div>

        <div className="card-body">
        {specialoffercheck == 2?
        <div className="row">
            <div className="col-12">
                         <div className="form-group">
                                        <label >{trans["discount value"]}</label>
                                        <p style={{color:"#aaa"}}>{trans["The customer received the discount"]}</p>
                                        <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-money-bill-alt"></i>
                                            </span>
                                       </div>
                                       <input type="number"
                                       value={DiscountValue}
                                              onChange={e=>{
                                                setDiscountValue(parseInt(e.target.value))
                                                dataFixedCustomerPurches({discount:parseInt(e.target.value)})
                                              }}
                                              className="form-control"
                                              placeholder={trans["discount value"]} />
                                       </div>
                                        </div>
            </div>
            </div>
        :
        <div className="row">
        <div className="col-6">
        <div className="form-group">
                                        <label >{trans["discount value"]}</label>
                                        <p style={{color:"#aaa"}}>{trans["The customer received the discount"]}</p>
                                        <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-money-bill-alt"></i>
                                            </span>
                                       </div>
                                       <input type="number"
                                             value={DiscountValue}
                                              onChange={e=>{
                                                setDiscountValue(parseInt(e.target.value))
                                                dataPercentCustomerPurches({discount_percent:parseInt(e.target.value)})

                                              }}
                                              className="form-control"
                                              placeholder={trans["discount value"]} />
                                                <div className="input-group-append">
                                                    <span className="input-group-text">%</span>
                                                </div>
                                       </div>
                                        </div>
            </div>
        <div className="col-6">
                    <div className="form-group">
                                        <label >{trans["Maximum discount"]}</label>
                                        <p style={{color:"#aaa"}}>{trans["The total cost of the stimulus that the customer will receive may be"]}</p>
                                        <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-money-bill-alt"></i>
                                            </span>
                                       </div>
                                       <input type="number"
                                              onChange={e=>{
                                                setMaximumDiscount(parseInt(e.target.value))
                                                dataPercentCustomerPurches({max_discount:parseInt(e.target.value)})

                                              }}
                                              className="form-control"
                                              placeholder={trans["Maximum discount"]} />

                                       </div>
                    </div>
        </div>

        </div>
        }

         <div className="row">
         <div className="col-6">
                            <label>{trans["Offer applies to"]}</label>
                            <p style={{color:"#aaa"}}>{trans["Choose one of the following conditions to apply the offer"]}</p>

                            <div className="form-check">
                                <input
                                className="form-check-input"
                                type="radio"
                                name="conditionOffer"
                                id="flexRadioDefault1"
                                value={1}
                                checked={CheckConditionsOffer == 1}
                                onChange={handleCheckConditionsOffer}
                                />
                                <label className="form-check-label" >
                                    {trans["All products in the cart"]}
                                </label>
                                </div>
                                <div className="form-check">
                                <input
                                className="form-check-input"
                                type="radio"
                                name="conditionOffer"
                                id="flexRadioDefault2"
                                value={2}
                                checked={CheckConditionsOffer == 2}
                                onChange={handleCheckConditionsOffer}

                                />
                                <label className="form-check-label" >
                                    {trans["Selected Products"]}
                                </label>
                            </div>
                            <div className="form-check">
                                <input
                                className="form-check-input"
                                type="radio"
                                name="conditionOffer"
                                id="flexRadioDefault2"
                                value={3}
                                checked={CheckConditionsOffer == 3}
                                onChange={handleCheckConditionsOffer}
                                />
                                <label className="form-check-label" >
                                    {trans["Selected Categories"]}
                                </label>
                            </div>
                            <div className="form-check">
                                <input
                                className="form-check-input"
                                type="radio"
                                name="conditionOffer"
                                id="flexRadioDefault2"
                                value={4}
                                checked={CheckConditionsOffer == 4}
                                onChange={handleCheckConditionsOffer}
                                />
                                <label className="form-check-label" >
                                    {trans["Selected Payment Methods"]}
                                </label>
                            </div>
                            </div>
         </div>

          <div style={{marginTop:20}}>
          <CustomerPurchesesCondition dataPercentCustomerPurches={dataPercentCustomerPurches}  dataFixedCustomerPurches={dataFixedCustomerPurches} optionsCategories={optionsCategories} trans={trans} CheckConditionsOffer={CheckConditionsOffer} />


          </div>
{showLimit?<div>

        <div className="row">
        <div className="col-12">
                        <div className="form-group">
                                    <label >{trans["Limit Offer"]}</label>
                                    <div className="input-group">
                                    <div className="input-group-prepend">
                                    <span className="input-group-text" style={{background:"#fff"}}>
                                    <i className="las la-luggage-cart"></i>
                                        </span>
                                    </div>
                                    <Select
                                            maxMenuHeight={200}
                                            menuPosition={'fixed'}
                                            className="custom-select"
                                            styles={
                                                {control: styles => ({ ...styles, borderRadius:0,fontSize:12}),}
                                            }
                                            value={OptionLimitOffers.filter(option => option.value === OptionLimitOffersValue)}

                                        onChange={e=>{
                                        setOptionLimitOffersValue(e.value)
                                        dataFixedCustomerPurches({limit_price_or_product:e.value})
                                        dataPercentCustomerPurches({limit_price_or_product:e.value})
                                        }}
                                    options={OptionLimitOffers}/>
                                    </div>
                                    </div>
                        </div>

        </div>
          <div className="row">
            <div className="col-12">
                {OptionLimitOffersValue == "price"?    <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-money-bill-alt"></i>
                                         </span>
                                       </div>
                                       <input type="text"
                                              className="form-control"
                                              value={LimitOffersPrice}

                                              onChange={(e)=>{
                                                  setLimitOffersPrice(parseInt(e.target.value))
                                                  dataFixedCustomerPurches({price:parseInt(e.target.value)})
                                                  dataPercentCustomerPurches({price:parseInt(e.target.value)})
                                              }}

                                              placeholder={trans["Limit for Purchese Price"]} />
                                       </div>:<div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-grip-horizontal"></i>
                                           </span>
                                       </div>
                                       <input type="text"
                                              className="form-control"
                                              value={LimitOffersQuntity}
                                              onChange={(e)=>{
                                                  setLimitOffersQuntity(parseInt(e.target.value))
                                                  dataFixedCustomerPurches({quantity:parseInt(e.target.value)})
                                                  dataPercentCustomerPurches({quantity:parseInt(e.target.value)})
                                              }}

                                              placeholder={trans["Limit for Products Quantity"]} />
                                       </div>}
            </div>
        </div>
</div>:null}


          {/* <div className="row" style={{marginTop:20}}>

         <div className="col-12">
         <div className="form-check">
        <input checked={CheckedWithCoupon == 1} className="form-check-input" onChange={()=>{
            if(CheckedWithCoupon == 1){
                setCheckedWithCoupon(0)
                dataFixedCustomerPurches({with_coupon:0})
                dataPercentCustomerPurches({with_coupon:0})
            }else{
                setCheckedWithCoupon(1)
                dataFixedCustomerPurches({with_coupon:1})
                dataPercentCustomerPurches({with_coupon:1})
            }
        }} type="checkbox" value={CheckedWithCoupon}  />
        <label className="form-check-label" >
            {trans["Apply the offer with the discount coupon"]}
        </label>
        </div>
         </div>

          </div> */}
        </div>

        </div>
        </div>
    )
}
