import React from 'react'

export default function MailChimp({trans,settings,setValue}) {



    return (
        <div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label">{trans['MAIL HOST']}</label>
                            </div>
                            <div className="col-md-9">
                                <input type="text" value={settings["mailchimp_host"]} onChange={setValue.bind(this,"mailchimp_host")} className="form-control"  placeholder={ trans['MAIL HOST'] } />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label">{trans['MAIL PORT'] }</label>
                            </div>
                            <div className="col-md-9">
                                <input type="text" value={settings["mailchimp_port"]} onChange={setValue.bind(this,"mailchimp_port")}  className="form-control"  placeholder={ trans['MAIL PORT'] } />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label">{trans['MAIL USERNAME'] }</label>
                            </div>
                            <div className="col-md-9">
                                <input type="text" value={settings["mailchimp_username"]} onChange={setValue.bind(this,"mailchimp_username")} className="form-control"  placeholder={ trans['MAIL USERNAME'] }  />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label">{trans['MAIL PASSWORD'] }</label>
                            </div>
                            <div className="col-md-9">
                                <input type="text" value={settings["mailchimp_password"]} onChange={setValue.bind(this,"mailchimp_password")} className="form-control"  placeholder={ trans['MAIL PASSWORD'] } />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label">{trans['MAIL ENCRYPTION'] }</label>
                            </div>
                            <div className="col-md-9">
                                <input type="text" className="form-control" value={settings["mailchimp_encryption"]} onChange={setValue.bind(this,"mailchimp_encryption")}  placeholder={ trans['MAIL ENCRYPTION'] }  />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label">{trans['MAIL FROM ADDRESS'] }</label>
                            </div>
                            <div className="col-md-9">
                                <input type="text" className="form-control" value={settings["mailchimp_from_address"]} onChange={setValue.bind(this,"mailchimp_from_address")}  placeholder={ trans['MAIL FROM ADDRESS'] }   />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label">{trans['MAIL FROM NAME'] }</label>
                            </div>
                            <div className="col-md-9">
                                <input type="text" className="form-control" value={settings["mailchimp_from_name"]} onChange={setValue.bind(this,"mailchimp_from_name")}  placeholder={ trans['MAIL FROM NAME'] }  />
                            </div>
                        </div>



        </div>

    )
}
