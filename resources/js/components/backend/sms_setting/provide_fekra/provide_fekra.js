import React from 'react'
import { Urls } from '../../urls'

export default function ProvideFekra({trans,setValue,setting,saveData,loadingBtn}) {
    return (
        <div>
            <div className="card">
                <div className="card-header">
                    <span>{trans["Provide Fekra"]}</span>
                </div>
                <div className="card-body">
                    <div className="row">
                                <div className="col-12">
                                    <div className="form-group">
                                            <label >{trans["Sender Name"]}</label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-mail-bulk"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={setValue.bind(this,"PROVIDE_FEKRA_SMS_SENDER_NAME")} value={setting["PROVIDE_FEKRA_SMS_SENDER_NAME"]} placeholder={trans["Sender Name"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>
                    </div>

                    <div className="row">
                                    <div className="col-12">
                                        <div className="form-group">
                                                <label >{trans["User Name"]}</label>
                                                <div className="input-group">
                                                <div className="input-group-prepend">
                                                <span className="input-group-text" style={{background:"#fff"}}>
                                                    <i className="las la-user"></i>
                                                </span>
                                                </div>
                                                <input type="text" onChange={setValue.bind(this,"PROVIDE_FEKRA_SMS_USERNAME")} value={setting["PROVIDE_FEKRA_SMS_USERNAME"]} placeholder={trans["User Name"]} className="form-control" />
                                                </div>
                                        </div>
                                     </div>
                    </div>
                   <div className="row">
                                    <div className="col-12">
                                        <div className="form-group">
                                                <label >{trans["User Password"]}</label>
                                                <div className="input-group">
                                                <div className="input-group-prepend">
                                                <span className="input-group-text" style={{background:"#fff"}}>
                                                    <i className="las la-key"></i>
                                                </span>
                                                </div>
                                                <input type="text" onChange={setValue.bind(this,"PROVIDE_FEKRA_SMS_PASSWORD")} value={setting["PROVIDE_FEKRA_SMS_PASSWORD"]} placeholder={trans["User Password"]} className="form-control" />
                                                </div>
                                        </div>
                                     </div>
                    </div>

                <div className="row">
                    <div className="col-12">
                     <div className="d-flex flex-row-reverse">
                            <button disabled={loadingBtn} onClick={saveData} className="btn btn-primary">
                                {trans["Save"]}
                            {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                            </button>
                    </div>
                    </div>
                </div>
                </div>


            </div>
        </div>
    )
}
