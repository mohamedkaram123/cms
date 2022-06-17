import React, { useState } from 'react'
import { toast } from 'react-toastify';

export default function BodyEditProfile({user,trans,userProfile}) {


    return (
        <div>

            <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{trans["Name"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-user"></i>
                                                </span>
                                           </div>
                                             <input type="text" value={user.name} onChange={userProfile.bind(this,"name")}  placeholder={trans["Name"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>


                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{trans["Email"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-at"></i>
                                                </span>
                                           </div>
                                             <input type="text" value={user.email} onChange={userProfile.bind(this,"email")}  placeholder={trans["Email"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>


                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{trans["Phone"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-phone-alt"></i>
                                                </span>
                                           </div>
                                             <input type="number" value={user.phone == null?"":user.phone} onChange={userProfile.bind(this,"phone")}  placeholder={trans["Phone"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>
              <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{trans["Balance"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-wallet"></i>
                                                </span>
                                           </div>
                                             <input type="number" value={user.balance == null?"":user.balance} onChange={userProfile.bind(this,"balance")}  placeholder={trans["Balance"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>

        </div>
    )
}
