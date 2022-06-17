import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faEnvelope } from '@fortawesome/free-solid-svg-icons'

import React, { Component } from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Tab, TabList, TabPanel, Tabs } from 'react-tabs'

import Smtp from './smtp/smtp'
import MailChimp from './mailchimp/mailchimp'
import Mailgun from './mailgun/mailgun'
import axios from 'axios'
import { Urls } from '../urls'
import { toast,ToastContainer } from 'react-toastify'
import LoadingSettingSmtp from './loadingSettingSmtp'

export default class SettingSmtpMail extends Component{

    constructor(){
        super();

        this.asyncload = 0;
        this.loadingcheck = false;
        this.state={
            trans:{
                 "Smtp":"",
                 "MailChimp":"",
                 "Mailgun":"",
                 "MAIL HOST":"",
                 "MAIL PORT":"",
                 "MAIL USERNAME":"",
                 "MAIL PASSWORD":"",
                 "MAIL ENCRYPTION":"",
                 "MAIL FROM ADDRESS":"",
                 "MAIL FROM NAME":"",
                 "Save Configuration":"",
                 "Saved successfully":""

            },
            settings:{
                "smtp_host":"",
                "smtp_port":"",
                "smtp_username":"",
                "smtp_password":"",
                "smtp_encryption":"",
                "smtp_from_address":"",
                "smtp_from_name":"",

                "mailgun_host":"",
                "mailgun_port":"",
                "mailgun_username":"",
                "mailgun_password":"",
                "mailgun_encryption":"",
                "mailgun_from_address":"",
                "mailgun_from_name":"",

                "mailchimp_host":"",
                "mailchimp_port":"",
                "mailchimp_username":"",
                "mailchimp_password":"",
                "mailchimp_encryption":"",
                "mailchimp_from_address":"",
                "mailchimp_from_name":"",
            },

            isLoading:true,
            tab:"smtp",
            loadingBtn:false
        }


    }

    componentDidMount(){
        this.callTrans(this.state.trans)
        this.get_setting_data(this.state.settings)


    }
    callTrans = (transes)=>{

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{



            this.setState({
                trans:res.data,
            })
        })
        .catch(err=>{

        })
    }
    get_setting_data = (data)=>{

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      let  data_post = {
            data,
            "_token": csrf_token
        }
        let isLoading =true;


        axios.post(Urls.static_url+'setting_data', data_post)
        .then(res=>{




            this.setState({
                settings:res.data,
                isLoading:false

            })

        })
        .catch(err=>{

        })

    }


    set_setting_data(data){
      this.setState({
            loadingBtn:true
        })

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      let  data_post = {
            data,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+'set_setting_data', data_post)
        .then(res=>{


                this.setState({
                    settings:res.data,
                    loadingBtn:false

                })


            toast.success(this.state.trans["Saved successfully"], {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
                });
        })
        .catch(err=>{

        })

    }
    setValue = (type,e)=>{


            this.setState(prevState => ({
                settings: {                   // object that we want to update
                    ...prevState.settings,    // keep all other key-value pairs
                    [type]: e.target.value      // update the value of specific key
                }
            }))


    }

    saveConvegration = ()=>{

            // for (const [key, value] of Object.entries(this.state.settings)) {

            //     if(value == ""){
            //         this.setState(prevState => ({
            //             settings: {                   // object that we want to update
            //                 ...prevState.settings,    // keep all other key-value pairs
            //             }
            //         }))
            //     }

            // }

            if(this.state.settings["smtp_host"] == ""  && this.state.settings["smtp_password"] == "" && this.state.settings["smtp_username"] == ""){

                this.state.settings["smtp_encryption"] = "ssl"
                this.state.settings["smtp_from_address"] = "cms_fekra@demo.fekraerp.online"
                this.state.settings["smtp_from_name"] = "cms fekra"
                this.state.settings["smtp_port"] = "465"
                this.state.settings["smtp_value"] = 0
            }else if(this.state.settings["mailchimp_host"] == "" && this.state.settings["mailchimp_username"] == "" && this.state.settings["mailchimp_password"] == ""){
                this.state.settings["mailchimp_encryption"] = "ssl"
                this.state.settings["mailchimp_from_address"] = "cms_fekra@demo.fekraerp.online"
                this.state.settings["mailchimp_from_name"] = "cms fekra"
                this.state.settings["mailchimp_port"] = "465"
                this.state.settings["mailchimp_value"] = 0
            }else if(this.state.settings["mailgun_host"] == "" && this.state.settings["mailgun_password"] == "" && this.state.settings["mailgun_username"] == "" ){
                this.state.settings["mailgun_encryption"] = "ssl"
                this.state.settings["mailgun_from_address"] = "cms_fekra@demo.fekraerp.online"
                this.state.settings["mailgun_from_name"] = "cms fekra"
                this.state.settings["mailgun_port"] = "465"
                this.state.settings["mailgun_value"] = 0
            }


            this.set_setting_data(this.state.settings)



    }

    render(){
        if(this.state.isLoading){
            return (
                <div>
                    <LoadingSettingSmtp />
                </div>

            )
        }else{
            return (
                <div>
                    <ToastContainer />
                        <div className="card">

                        <Tabs onSelect={(index)=>{

                          if(index == 0){
                            this.setState({tab:"smtp"})
                          }else if(index == 1){
                            this.setState({tab:"mailchimp"})
                          }else if(index == 2){
                            this.setState({tab:"mailgun"})
                          }

                        }}  >
                        <div className="card-header">


                                <TabList>
                             <Tab  ><FontAwesomeIcon style={{marginInline:10}} icon={faEnvelope}  /><span >{this.state.trans["Smtp"]}</span></Tab>
                              <Tab   ><FontAwesomeIcon style={{marginInline:10}} icon={faEnvelope}  /><span >{this.state.trans["MailChimp"]}</span></Tab>
                              <Tab  ><span ><FontAwesomeIcon style={{marginInline:10}} icon={faEnvelope}  />{this.state.trans["Mailgun"]}</span></Tab>

                            </TabList>

                                </div>

                                <div className="card-body">
                                <TabPanel>



                                <Smtp trans={this.state.trans} settings={this.state.settings} setValue={this.setValue}  />

                            </TabPanel>

                            <TabPanel>


                            <MailChimp trans={this.state.trans} settings={this.state.settings} setValue={this.setValue}  />

                            </TabPanel>
                            <TabPanel>


                            <Mailgun trans={this.state.trans} settings={this.state.settings} setValue={this.setValue}  />

                            </TabPanel>

                                </div>

                                <div className="card-footer text-right">
            <div className="form-group mb-0 ">
                                        <button onClick={this.saveConvegration} disabled={this.state.loadingBtn} type="submit" className="btn btn-primary">{this.state.trans['Save Configuration'] } {this.state.loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }</button>
                                    </div>
                                </div>

                          </Tabs>
                            </div>


                </div>
            )
        }

    }

}
