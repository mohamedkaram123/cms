import axios from "axios";
import { Component } from "react";
import { toast , ToastContainer} from "react-toastify";
import { Urls } from "../urls";
import ProvideFekra from "./provide_fekra/provide_fekra";
import ProvideFekraLoading from "./provide_fekra/provide_fekra_loading";
export default class SmsSetting extends Component{

    constructor() {
        super();
        this.state = {
            isLoading:true,
            trans: {
                "Provide Fekra": "",
                "Sender Name": "",
                "User Name": "",
                "User Password": "",
                "Save": "",
                "Data saved successfully": "",
                "Enter Count":""

            },
            setting: {
                "PROVIDE_FEKRA_SMS_SENDER_NAME": "",
                "PROVIDE_FEKRA_SMS_PASSWORD": "",
                "PROVIDE_FEKRA_SMS_USERNAME":""
            },
            LoadinBtnProvideFekra:false
        }
    }

    componentDidMount() {
            this.get_setting_data(this.state.setting)

        this.callTrans(this.state.trans)
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
                trans:res.data,
                isLoading:false
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

    saveData = () => {
        this.setState({
            LoadinBtnProvideFekra:true
        })
        this.set_setting_data();
}
    set_setting_data() {
          let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');


            let  data_post = {
                  data:this.state.setting,
                  "_token": csrf_token
              }

              axios.post(Urls.static_url+'set_setting_data', data_post)
              .then(res=>{


                    var title_trans = this.state.trans["Data saved successfully"];

                toast.success(title_trans, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                    });

                        this.setState({
            LoadinBtnProvideFekra:false
        })


              })
              .catch(err=>{

              })
    }

    setValue = (type,e) => {
          this.setState(prevState => ({
                    setting: {                   // object that we want to update
                  ...prevState.setting,    // keep all other key-value pairs
                   [type]: e.target.value      // update the value of specific key
                  }
               }))
    }

    render() {
        if (this.state.isLoading) {
            return (
                <div>

                <div className="container">
                    <div className="row">
                            <div className="col-6">
                                   <ProvideFekraLoading />

                            </div>
                        </div>
                    </div>
                </div>
            )
        } else {
            return (
                <div>
                                           <ToastContainer />

                <div className="container">
                    <div className="row">
                        <div className="col-6">
                            <ProvideFekra loadingBtn={this.state.LoadinBtnProvideFekra} saveData={this.saveData} trans={this.state.trans} setting={this.state.setting} setValue={this.setValue} />
                        </div>
                    </div>
                </div>


            </div>
        )

        }
    }
}
