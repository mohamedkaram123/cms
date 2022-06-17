import React,{useState} from 'react'
import { Editor } from 'react-draft-wysiwyg';
import { Urls } from '../../../urls';

export default function MainMails({ trans, mail_box,setValue,selectMailView,onContentStateChange,required_mail_box }) {
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
                        <small></small>
                     </div>
                </div>
                  <div className="col-6">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Msg Type']}</label>
                        <select className="form-control" onChange={(e) => {
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
                                <label className="col-from-label">{trans['Subject Mail']} <span style={{color:"#dc3545"}}>*</span></label>
                                <input type="text"  onChange={setValue.bind(this,"subject")} className="form-control"  placeholder={ trans['Subject'] } />
                            {required_mail_box.subject != "" ? <small className='require_data'>{required_mail_box.subject}</small> : null}
                        </div>
                </div>



                <div className="col-6">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Text Btn Link']}</label>
                                <input type="text"  onChange={setValue.bind(this,"text_btn")} className="form-control"  placeholder={ trans['Text Btn Link'] } />
                    </div>
                </div>
            </div>
            <div className="row">
                <div className="col-12">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Link']}</label>
                                <input type="text"  onChange={setValue.bind(this,"link")} className="form-control"  placeholder={ trans['Link'] } />
                    </div>
                </div>
            </div>
                <div className="row d-none">
                    <div className="form-group">

                   <label>{ trans["views mails"]}</label>
                   <div className="d-flex flex-row">
                         <div className="col-3 ">
                             <label className="aiz-megabox d-block mb-3">
                                <input onChange={selectMailView} checked={mail_box.view == "emails.mail_design.newsletter"} value="emails.mail_design.newsletter" className="online_payment" type="radio" name="payment_option" />
                                <span className="d-block  aiz-megabox-elem">
                                <img src={ Urls.public_url + "assets/img/mail_screens/mail2.png"} className="img-fluid mb-2" />
                                <span className="d-block text-center">
                               <span className="d-block fw-600 fs-15">{ trans['Mail NewsLetter']}</span>
                               </span>
                             </span>
                           </label>
                    </div>

                    <div className="col-3 ">
                             <label className="aiz-megabox d-block mb-3">
                                <input onChange={selectMailView} checked={mail_box.view == "emails.mail_design.mail3"} value="emails.mail_design.mail3" className="online_payment" type="radio" name="payment_option" />
                                <span className="d-block  aiz-megabox-elem">
                                <img src={ Urls.public_url + "assets/img/mail_screens/mail3.png"} className="img-fluid mb-2" />
                                <span className="d-block text-center">
                               <span className="d-block fw-600 fs-15">{ trans['Mail NewsLetter']}</span>
                               </span>
                             </span>
                           </label>
                        </div>
                   </div>

                        </div>
            </div>
            </>:null}

            <div className="row">
                <div className="col-12">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Content']} <span style={{color:"#dc3545"}}>*</span></label>
                                <textarea
                                        style={{height:250,border:"0.2px solid #aaa",borderRadius:5}}
                                        className="demo-editor form-control"
                                        onChange={onContentStateChange}
                                    />
                        {required_mail_box.content != "" ? <small className='require_data'>{required_mail_box.content}</small>:null}
                        </div>
                </div>
            </div>




        </div>

    )
}
