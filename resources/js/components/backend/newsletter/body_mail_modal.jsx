import  React,{useState} from 'react'
import { Editor } from 'react-draft-wysiwyg';
import '../../../../../node_modules/react-draft-wysiwyg/dist/react-draft-wysiwyg.css';
import { Urls } from '../urls';


export default function BodyMailModal({ trans, setValue, onContentStateChange, selectMailView, mail_box }) {


    const [startDate, setStartDate] = useState(new Date((new Date()).setDate((new Date()).getDate()-5)).toISOString().substring(0,10) )
    const [endtDate, setEndDate] = useState(new Date().toISOString().substring(0, 10))
        const [type_mail, settype_mail] = useState("mail")

    return (
        <div>

            <div className="row">

                <div className="col-6">
                           <div className="form-group">
                                <label className="col-from-label">{trans['Users Type']}</label>
                                <select className="form-control" onChange={setValue.bind(this,"user_type")}>
                                    <option value="">{trans["All"]}</option>
                                    <option value="customer">{trans["Customer"]}</option>
                                    <option value="seller">{trans["Seller"]}</option>
                                </select>
                     </div>
                </div>

                <div className="col-6">
                           <div className="form-group">
                                <label className="col-from-label">{trans['Order Delivery Status']}</label>
                                <select className="form-control" onChange={setValue.bind(this,"delivery_status")}>
                                    <option value="">{trans["All"]}</option>
                                    <option value="pending">{trans["Pending"]}</option>
                                    <option value="confirmed">{trans["Confirmed"]}</option>
                                    <option value="on_delivery">{trans["On Delivery"]}</option>
                                     <option value="delivered">{trans["Delivered"]}</option>
                                     <option value="cancelled">{trans["Cancel"]}</option>
                                </select>
                     </div>
                </div>
            </div>
            <div className="row">
                <div className="col-12 col-md-6">
                                   <div className="form-group">
                                            <label >{trans["Start Date Orders"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-calendar"></i>
                                                </span>
                                           </div>
                                        <input className="form-control" type="date" value={startDate} onChange={(e)=>{
                                            setStartDate(e.target.value)
                                            setValue("start_date",e)
                                        }} />
                                           </div>
                                        </div>

                                     </div>
                              <div className="col-12 col-md-6">
                                   <div className="form-group">
                                            <label >{trans["End Date Orders"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-calendar"></i>
                                                </span>
                                           </div>
                                        <input className="form-control" type="date" value={endtDate} onChange={(e)=>{
                                            setEndDate(e.target.value)
                                            setValue("end_date",e)
                                        }} />
                                           </div>
                                        </div>

                                     </div>
            </div>
            <div className="row">

                <div className="col-6">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Msg Type']}</label>
                                <select  className="form-control" onChange={(e) => {
                            setValue.bind(e, "msg_type")
                            settype_mail(e.target.value)
                                }}>
                                    <option value="mail">{trans["Mail"]}</option>
                                    <option value="sms">{trans["SMS"]}</option>

                                </select>

                    </div>
                </div>


            </div>
            {type_mail == "mail" ? <>
                <div className="row">
                    <div className="col-6">
                        <div className="form-group">
                            <label className="col-from-label">{trans['Subject']}</label>
                            <input type="text" onChange={setValue.bind(this, "subject")} className="form-control" placeholder={trans['Subject']} />
                        </div>
                    </div>
                    <div className="col-6">
                        <div className="form-group">
                            <label className="col-from-label">{trans['Text Btn Link']}</label>
                            <input type="text" onChange={setValue.bind(this, "text_btn")} className="form-control" placeholder={trans['Text Btn Link']} />
                        </div>
                    </div>
                </div>
                <div className="row">


                    <div className="col-12">
                        <div className="form-group">
                            <label className="col-from-label">{trans['Link']}</label>
                            <input type="text" onChange={setValue.bind(this, "link")} className="form-control" placeholder={trans['Link']} />
                        </div>
                    </div>
                </div>
                <div className="row d-none">
                    <div className="col-3 ">
                        <label className="aiz-megabox d-block mb-3">
                            <input onChange={selectMailView} checked={mail_box.view == "emails.mail1"} value="emails.mail1" className="online_payment" type="radio" name="payment_option" />
                            <span className="d-block  aiz-megabox-elem">
                                <img src={Urls.public_url + "assets/img/mail_screens/mail1.png"} className="img-fluid mb-2" />
                                <span className="d-block text-center">
                                    <span className="d-block fw-600 fs-15">{trans['Mail View1']}</span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
            </> : null}

            <div className="row">
                <div className="col-12">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Content']}</label>
                                <textarea
                                        style={{height:250,border:"0.2px solid #aaa",borderRadius:5}}
                                        className="demo-editor form-control"
                                        onChange={onContentStateChange}
                                    />
                        </div>
                </div>
            </div>



        </div>
    )
}
