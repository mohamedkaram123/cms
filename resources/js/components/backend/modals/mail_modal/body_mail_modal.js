import React from 'react'
import { Editor } from 'react-draft-wysiwyg';
import '../../../../../..//node_modules/react-draft-wysiwyg/dist/react-draft-wysiwyg.css';
import { Urls } from '../../urls';


export default function BodyMailModal({trans,setValue,onContentStateChange,selectMailView,mail_box}) {
    return (
        <div>

            <div className="row">
                <div className="col-6">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Mail Driver']}</label>
                                <select className="form-control" onChange={setValue.bind(this,"mail_driver")}>
                                    <option value="smtp">{trans["Smtp"]}</option>
                                    <option value="mailgun">{trans["Mailgun"]}</option>
                                    <option value="mailchimp">{trans["Mailchimp"]}</option>

                                </select>

                    </div>
                </div>

                <div className="col-6">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Subject']}</label>
                                <input type="text"  onChange={setValue.bind(this,"subject")} className="form-control"  placeholder={ trans['Subject'] } />
                    </div>
                </div>

            </div>

            <div className="row">

            <div className="col-6">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Sender']}</label>
                                <input type="text"  onChange={setValue.bind(this,"sender")} className="form-control"  placeholder={ trans['Sender'] } />
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


            <div className="row">
                <div className="col-12">
                    <div className="form-group">
                                <label className="col-from-label">{trans['Content']}</label>
                                <Editor
                                        editorStyle={{height:150,border:"0.2px solid #aaa",borderRadius:5}}
                                        wrapperClassName="demo-wrapper"
                                        editorClassName="demo-editor form-control"
                                        onContentStateChange={onContentStateChange}
                                    />
                        </div>
                </div>
            </div>

            <div className="row">
            <div className="col-6 ">
                             <label className="aiz-megabox d-block mb-3">
                                <input onChange={selectMailView} checked={mail_box.view == "emails.mail1"} value="emails.mail1" className="online_payment" type="radio" name="payment_option" />
                                <span className="d-block  aiz-megabox-elem">
                                <img src={ Urls.public_url + "assets/img/mail_screens/mail1.png"} className="img-fluid mb-2" />
                                <span className="d-block text-center">
                               <span className="d-block fw-600 fs-15">{ trans['Mail View1']}</span>
                               </span>
                             </span>
                           </label>
                        </div>
            </div>
        </div>
    )
}
