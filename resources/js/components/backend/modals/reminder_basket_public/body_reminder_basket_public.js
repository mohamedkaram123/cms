import React, { useEffect, useRef, useState } from 'react'
import { toast } from 'react-toastify';
import DiscountType from './discount_type';
import "./reminder.css";
import { TextField } from '@material-ui/core';

export default function BodyReminderBasketPublic({trans,objectGetData,getData}) {

        const isRtl = $("html").children().css("direction");

    const  convertDate = (date_covert)=>{
        let date = new Date(date_covert + ":00z");
            date = date.getUTCFullYear() + '-' +
         ('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
         ('00' + date.getUTCDate()).slice(-2) + ' ' +
         ('00' + date.getUTCHours()).slice(-2) + ':' +
         ('00' + date.getUTCMinutes()).slice(-2) + ':' +
         ('00' + date.getUTCSeconds()).slice(-2);
         return date;
    }

    // const [state, setstate] = useState(initialState)
    const [discounreminderData, setdiscounreminderData] = useState({
            discountBasket:true,
            discounttype:"",
            shippingFree:false,
            discount:0,
            channel_msg:"all",
            title_mail:"",
            msg:trans["hello {var_name} We would like to offer you a special discount {var_discount_amount} on the shopping cart But the discount ends on {var_date}, don't miss it!"],
            date_expire_offer:convertDate(new Date(new Date().setDate((new Date()).getDate()+30)).toISOString().toString().slice(0,16)),
            date_send_offer:convertDate(new Date(new Date().setDate((new Date()).getDate()+2)).toISOString().toString().slice(0,16)),
            date_send_type:"time",
        duration_discount_hour: 0,
        minmum_amount_basket:0,
        total_usage_for_all:0,
            total_usage_for_one_user:0
    })

    const [msgdata, setmsgdata] = useState()
 const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic
        mounted.current = true;
      } else {

          if (objectGetData) {
                        getData(discounreminderData);

          }

        // do componentDidUpdate logic
      }
    }, [objectGetData]);


    return (
        <div>

                     <div className="row">
                                    <div className="col-12">
                                        <div className="d-flex flex-column">
                                            <h6>{trans["Reminder Terms"]}</h6>
                                            <p style={{color:"#aaa"}}>{trans["The reminder will be sent after the customer has left the cart for a specified period and exceeded the cart for a certain value"]}</p>
                                        </div>
                                    </div>

                                </div>
                  <div className="row">
                                     <div className="col-md-6 col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-calendar-alt"></i>
                                                </span>
                                           </div>
                                           <input type="number" onChange={e=>{
                                               setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        duration_discount_hour:parseInt(e.target.value) ,
                                                                    }));
                                           }}  placeholder={trans["The period of leaving the basket"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>
                                    <div className="col-md-6 col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-calendar-alt"></i>
                                                </span>
                                           </div>
                                           <input type="number" onChange={e=>{
                                               setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        minmum_amount_basket:parseFloat(e.target.value) ,
                                                                    }));
                                           }}  placeholder={trans["Minimum total basket"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>


                                 </div>

                          <div className="row">
                                    <div className="col-12">
                                        <div className="d-flex flex-row justify-content-between">
                                            <h6>{trans["shipping free"]}</h6>

                                                    <label className="aiz-switch aiz-switch-success mb-0">
                                                        <input checked={discounreminderData.shippingFree} onChange={e=>{
                                                            setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        shippingFree: e.target.checked,
                                                                    }));
                                                                }}
                                                                     type="checkbox" />
                                                        <span className="slider round"></span>
                                                    </label>
                                        </div>

                                    </div>

                                </div>

                                      <div style={{marginBlock:20}} className="row">
                                    <div className="col-12">
                                        <div className="d-flex flex-row justify-content-between">

                                          <div className="d-flex flex-column">
                                             <h6>{trans["discount basket"]}</h6>
                                         <p style={{color:"#aaa"}}>{trans["grant the customer discount and define discount type is amount or percent from purches"]}</p>
                                          </div>

                                                    <label className="aiz-switch aiz-switch-success mb-0">
                                                        <input checked={discounreminderData.discountBasket} onChange={e=>{
                                                            setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        discountBasket: e.target.checked,
                                                                    }));
                                                                    if(!e.target.checked){
                                                                        setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        msg:trans["Your basket is full of products, please complete the order"],
                                                                    }));
                                                                    } else {

                                                                    }
                                                            console.log({e:e.target.checked});
                                                        }} type="checkbox" />
                                                        <span className="slider round"></span>
                                                    </label>
                                        </div>

                                    </div>

                                 </div>
            {discounreminderData.discountBasket ? (
                <div>

                    <div className="row">
                                      <div className="col-6">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-users"></i>
                                                </span>
                                           </div>
                                            <input type="number" min={1} placeholder={trans["Total Usage For All"]} className="form-control"  onChange={(e) => {
                                                setdiscounreminderData((prevState) => ({
                                                                                        ...prevState,
                                                                                        total_usage_for_all: parseInt(e.target.value) ,
                                                                                    }))
                                                        }} />

                                           </div>
                                            </div>
                                    </div>
                                    <div className="col-6">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-male"></i>
                                                </span>
                                           </div>
                                            <input type="number" min={1}  placeholder={trans["Total Usage For One User"]} className="form-control"  onChange={(e) => {
                                                setdiscounreminderData((prevState) => ({
                                                                                        ...prevState,
                                                                                        total_usage_for_one_user: parseInt(e.target.value) ,
                                                                                    }))
                                                        }} />

                                           </div>
                                            </div>
                                    </div>
                                 </div>
                <div className="row">
                                     <div className="col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-money-bill"></i>
                                                </span>
                                           </div>
                                           <select onChange={(e)=>{
                                               setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        discounttype: e.target.value,
                                                                    }));

                                           }} className="form-control" >
                                               <option value="">{trans["discount type"]}</option>
                                               <option value="amount">{trans["amount from purches"]}</option>
                                               <option value="percent">{trans["percent from purches"]}</option>
                                           </select>
                                           </div>
                                            </div>
                                    </div>

                </div>
                                 <DiscountType trans={trans} discounreminderData={discounreminderData} setdiscounreminderData={setdiscounreminderData}   />

                   <div style={{marginBlock:20}} className="row">
                                     <div className="col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-history"></i>
                                                </span>
                                           </div>
                                           <TextField
                                                    id="datetime-local"
                                                    label={trans["expire date"]}
                                                    type="datetime-local"
                                                    defaultValue={new Date(new Date().setDate((new Date()).getDate()+30)).toISOString().toString().slice(0,16)}
                                                    style={{width:"80%"}}
                                                    onChange={e=>{
                                                          setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        date_expire_offer: convertDate(e.target.value),
                                                                    }));
                                                    }}

                                                    // className={classes.textField}
                                                   // className="form-control"
                                                    InputLabelProps={{
                                                    shrink: true,
                                                    }}
                                                />
                                           </div>
                                            </div>
                                    </div>

                                 </div>
                              </div>
                                        ):null}



                                <div className="row">
                                    <div className="col-12">
                                        <div className="d-flex flex-column">
                                            <h6>{trans["text msg"]}</h6>
                                            <p style={{color:"#aaa"}}>{trans["Choose send way and text msg"]}</p>
                                        </div>
                                    </div>

                                </div>
                                <div className="row">
                                     <div className="col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-sms"></i>
                                                </span>
                                           </div>
                                           <select  onChange={(e)=>{
                                               setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        channel_msg: e.target.value,
                                                                    }));

                                           }} className="form-control" >
                                            <option value="all">{trans["all"]}</option>
                                               <option value="sms">{trans["msg sms"]}</option>
                                               <option value="email">{trans["email"]}</option>
                                           </select>
                                           </div>
                                            </div>
                                    </div>

                                 </div>
                                 {discounreminderData.channel_msg == "all" || discounreminderData.channel_msg == "email"?(
                                             <div className="row">
                                     <div className="col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-comment-dots"></i>
                                                </span>
                                           </div>
                                           <input type="text" onChange={e=>{
                                               setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        title_mail:e.target.value,
                                                                    }));
                                           }}  placeholder={trans["title email"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                 </div>

                                 ):null}
                                       <div className="row">
                                     <div className="col-12">
                                    <div className="form-group">
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-comment-dots"></i>
                                                </span>
                                           </div>
                                           <textarea rows={4} value={discounreminderData.msg} className="form-control" onChange={e=>{
                                               setdiscounreminderData((prevState) => ({
                                                                        ...prevState,
                                                                        msg:e.target.value,
                                                                    }));
                                           }}>

                                           </textarea>

                                           </div>
                                            </div>
                                    </div>

                                 </div>
                     <div style={{marginBlock:10}} className="row">
                                 <div className="col-md-4 col-12">
                    <span>{trans["user name"]} : </span><span className="badge badge-primary" style={{ width: "auto" }}>{"{var_name}"}</span>
                                 </div>
                                 <div className="col-md-4 col-12">
                                       <span>{trans["total discount"]} : </span><span className="badge badge-primary" style={{width:"auto"}}>{"{var_discount_amount}"}</span>
                                 </div>
                                 <div className="col-md-4 col-12">
                    <span>{trans["discount expiry date"]} : </span><span className="badge badge-primary" style={{ width: "auto" }}>{"{var_date}"}</span>
                                 </div>
                                 </div>

                                 <div className="d-flex flex-row" style={{justifyContent:"center",alignItems:"center"}}>
                                     <span style={{border:"1px solid #aaa",width:"45%"}}></span>
                                     <i style={{marginInline:20}} className="las la-eye"></i>
                                     <span style={{border:"1px solid #aaa",width:"45%"}}></span>
                                 </div>
                                 <div className="row">
                                     <div style={{
                                         margin:20
                                     }} className={isRtl == "rtl"?"message-orange":" message-blue"} >
                                     {discounreminderData.msg}
                                       </div>
                                 </div>




        </div>
    )
}
