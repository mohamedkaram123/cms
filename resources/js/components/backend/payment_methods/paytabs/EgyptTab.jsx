import axios from "axios";
import { Component } from "react"

import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import LoadPayTabsBody from "./LoadPayTabsBody";
import { Urls } from "../../urls";

export default class EgyptTab extends Component {

    constructor() {
        super()


        this.inc = 0;
        this.state = {
            loading: true,
            profile_id: "",
            server_key: "",
            pay_tabs_credential: "",
            paytab_mode: "",
            save_btn: "",
            PAYTAB_PROFILE_ID: "",
            PAYTAB_SERVER_KEY: "",
            paytab_sandbox: 0,
            paytab_sandbox_on_and_off: true,
            paytab_defualt:true,
            langs:{
               "Profile Id":"",
               "Api Key":"",
               "Server Key":"",
               "PayTabs Credential":"",
                "PayTab Sandbox Mode": "",
               "PayTab Defualt":"",
               "Save":"",
            },
            setting:{
                "PAYTAB_PROFILE_ID":"",
                "PAYTAB_SERVER_KEY":"",
                "paytab_sandbox":"",
                "pay_tab_defualt":"",

            },


        }

    }

    componentDidMount() {

  this.get_setting_data(this.state.setting)

        this.callTrans(this.state.langs)

    }


    save_date = () => {


        // this.setState({
        //     loading:true
        // })
        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            PAYTAB_PROFILE_ID: this.state.PAYTAB_PROFILE_ID == ""?this.state.setting["PAYTAB_PROFILE_ID"]:this.state.PAYTAB_PROFILE_ID,
            PAYTAB_SERVER_KEY:this.state.PAYTAB_SERVER_KEY == ""?this.state.setting["PAYTAB_SERVER_KEY"]:this.state.PAYTAB_SERVER_KEY,
            paytab_sandbox: this.state.paytab_sandbox_on_and_off == true ? 1 : 0,
            pay_tab_defualt: this.state.paytab_defualt == true ? "eg" : "sa",
            "_token": csrf_token,


        }

        axios.post("saveData/setting/paytabs/egypt", data)
            .then(res => {

                this.setState({
                    loading: false
                })

                toast('تم حفظ البيانات بنجاح', {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
            })
            .catch(res => {

            })
    }



        callTrans(transes){

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{

            this.setState({
                langs:res.data,
                loading:false
            })
        })
        .catch(err=>{

        })
    }


    get_setting_data(data){

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      let  data_post = {
            data,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+'setting_data', data_post)
        .then(res=>{

            this.setState({
                setting:res.data
            })

        })
        .catch(err=>{

        })

    }


    render() {

        if (this.state.loading == true) {
            return (

                <LoadPayTabsBody />


            )
        } else {
            return ( <div>

                <div className = "form-group row" >
                <div className = "col-md-4" >
                <label className = "col-from-label" > { this.state.langs["Profile Id"] }</label>
                </div>
                <div className = "col-md-8" >
                <input type = "text"
                onChange = {
                    e => {
                        this.setState({
                            PAYTAB_PROFILE_ID: e.target.value
                        })
                    }
                }
                defaultValue = { this.state.setting["PAYTAB_PROFILE_ID"] }
                className = "form-control" />
                </div>
                </div>

                <div className = "form-group row" >
                <div className = "col-md-4" >
                <label className = "col-from-label" > { this.state.langs["Server Key"] } </label>
                </div>
                <div className = "col-md-8" >
                <input onChange = {
                    e => {
                        this.setState({
                            PAYTAB_SERVER_KEY: e.target.value
                        })
                    }
                }
                type="text"
                defaultValue={ this.state.setting["PAYTAB_SERVER_KEY"] }
                className="form-control" />
                </div>
                </div>

                <div className = "form-group row" >

                <div className = "col-md-4" >
                <label className = "col-from-label" > { this.state.langs["PayTab Sandbox Mode"] } </label>
                </div>
                <div className = "col-md-8" >

                <label className = "aiz-switch aiz-switch-success mb-0" >
                <input onChange = {
                    e => {
                        this.setState({
                            paytab_sandbox_on_and_off: e.target.checked
                        });
                        e.target.checked == true ? this.setState({ paytab_sandbox: 1 }) : this.setState({ paytab_sandbox: 0 });

                    }
                }
                defaultChecked = { parseInt(this.state.setting["paytab_sandbox"]) == 1 ? true : false }
                name="paytab_sandbox"
                type="checkbox" />
                <span className="slider round" > </span>
                </label>
                </div>
                </div>

                <div className = "form-group row" >

                <div className = "col-md-4" >
                <label className = "col-from-label" > { this.state.langs["PayTab Defualt"] } </label>
                </div>
                <div className = "col-md-8" >

                <label className = "aiz-switch aiz-switch-success mb-0" >
                <input onChange = {
                    e => {

                         this.setState({
                            paytab_defualt: e.target.checked
                        });

                    }
                }
                defaultChecked = { this.state.setting["pay_tab_defualt"] == "eg" ? true : false }
                name="paytab_sandbox"
                type="checkbox" />
                <span className="slider round" > </span>
                </label>
                </div>
                </div>
                <div className="form-group mb-0 text-right" >
                <button type="button"
                onClick = { this.save_date }
                className="btn btn-sm btn-primary" > { this.state.langs["Save"] } </button>
                </div>



                <ToastContainer />

                </div>
            )
        }

    }

}
