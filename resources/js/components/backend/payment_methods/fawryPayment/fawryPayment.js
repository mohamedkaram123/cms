    import axios from "axios";
    import { Component } from "react"

    import { ToastContainer, toast } from 'react-toastify';
    import 'react-toastify/dist/ReactToastify.css';
import LoadingFawry from "./LoadingFawry";

    export default class FawrPayment extends Component {

        constructor(){
            super()


            this.inc = 0;
            this.state = {
                loading:true,
                fawry_merchant_code : "",
                fawry_security_key : "",
                fawry_security_key_lang : "",

                fawry_credential_lang : "",
                fawry_mode:"",
                save_btn:"",
                fawry_merchant_code_lang:"",
                security_code_lang:"",
                fawry_sandbox:0,
                fawry_live:0,

                fawry_sandbox_lang:"",

                fawry_sandbox_on_and_off:true,
                fawry_mode_live_on_and_off:true,


                fawry_live_lang:""


            }

        }

        componentDidMount(){

            this.get_setting("fawry_merchant_code");
            this.get_setting("fawry_security_key");
            this.get_setting("fawry_sandbox");
            this.get_setting("fawry_live");

            this.lang("Fawry Credential");
            this.lang("Merchant Code");
            this.lang("Security Key");
            this.lang("Fawry Sandbox Mode");
            this.lang("Fawry Live");
            this.lang("Save");




        }


        save_date = ()=>{

            // this.setState({
            //     loading:true
            // })
        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let data = {
                fawry_merchant_code:this.state.fawry_merchant_code,
                fawry_security_key:this.state.fawry_security_key,
                fawry_sandbox:this.state.fawry_sandbox_on_and_off == true?1:0,
                fawry_live:this.state.fawry_mode_live_on_and_off == true?1:0,

                "_token": csrf_token,


            }


            axios.post("saveData/setting/fawry/setting",data)
            .then(res=>{

                this.setState({
                    loading:false
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
            .catch(res=>{

            })
        }

        get_setting(key){

            axios.get('setting/'+ key)
            .then(res=>{

                this.inc +=1;

                if(key == "fawry_merchant_code"){

                    this.setState({
                        fawry_merchant_code:res.data
                    })
                }else if(key == "fawry_security_key"){

                    this.setState({
                        fawry_security_key:res.data
                    })
                }else if(key == "fawry_sandbox"){

                    //console.log(res.data);
                    this.setState({
                        fawry_sandbox:res.data,
                        fawry_sandbox_on_and_off:res.data == 1?true:false
                    })
                }else if(key == "fawry_live"){

                    //console.log(res.data);
                    this.setState({
                        fawry_live:res.data,
                        fawry_mode_live_on_and_off:res.data == 1?true:false

                    })
                }

                // if(this.inc == 9){
                //     this.setState({
                //         loading:false
                //     })
                // }


            })
            .catch(err=>{

            })

        }

    lang(key) {

        let lang = "";



        axios.get('trans/' + key)
        .then( (response) => {

            this.inc +=1;



            if(key == "Merchant Code"){


                this.setState({
                    fawry_merchant_code_lang:response.data
                })

            }else if(key == "Security Key"){

                this.setState({
                    fawry_security_key_lang:response.data
                })
            }else if(key == "Fawry Live"){

                this.setState({
                    fawry_live_lang:response.data
                })
            }else if(key == "Fawry Sandbox Mode"){


                this.setState({
                    fawry_sandbox_lang:response.data
                })

            }else if(key == "Save"){


                this.setState({
                    save_btn:response.data
                })


            }else if(key == "Fawry Credential"){


                this.setState({
                    fawry_credential_lang:response.data
                })


            }

            if(this.inc == 10){
                this.setState({
                    loading:false
                })
            }




        })
        .catch(function (error) {
        // handle error
        console.log(error);
        });

        return lang;
    }

        render(){

            if(this.state.loading == true){
                return(

                    <LoadingFawry />

                )
            }else{
                return(
                    <div className="card">
                        <div className="card-header">
                           <h6>{this.state.fawry_credential_lang}</h6>
                        </div>
                        <div className="card-body">

                        <div className="form-group row">
                                        <div className="col-md-4">
                                            <label className="col-from-label">{this.state.fawry_merchant_code_lang}</label>
                                        </div>
                                        <div className="col-md-8">
                                            <input type="text" onChange={e=>{
                                                this.setState({
                                                    fawry_merchant_code:e.target.value
                                                })
                                            }} defaultValue={this.state.fawry_merchant_code} className="form-control" />
                                        </div>
                                    </div>

                                    <div className="form-group row">
                                        <div className="col-md-4">
                                            <label className="col-from-label">{this.state.fawry_security_key_lang}</label>
                                        </div>
                                        <div className="col-md-8">
                                            <input onChange={e=>{
                                                this.setState({
                                                    fawry_security_key:e.target.value
                                                })
                                            }} type="text" defaultValue={this.state.fawry_security_key} className="form-control" />
                                        </div>
                                    </div>

                                    <div className="form-group row">

                                        <div className="col-md-4">
                                            <label className="col-from-label">{this.state.fawry_sandbox_lang}</label>
                                        </div>
                                                <div className="col-md-8">

                                                    <label className="aiz-switch aiz-switch-success mb-0">
                                                        <input  onChange={e=>{
                                                this.setState({
                                                    fawry_sandbox_on_and_off:e.target.checked,
                                                    fawry_sandbox:e.target.checked?1:0
                                                });
                                            }} defaultChecked={this.state.fawry_sandbox == 1?true:false}   name="fawry_sandbox" type="checkbox" />
                                                        <span className="slider round"></span>
                                                    </label>
                                                </div>
                                    </div>


                                    <div className="form-group row">

                                        <div className="col-md-4">
                                            <label className="col-from-label">{this.state.fawry_live_lang}</label>
                                        </div>
                                                <div className="col-md-8">

                                                    <label className="aiz-switch aiz-switch-success mb-0">
                                                        <input  onChange={e=>{

                                                this.setState({
                                                    fawry_mode_live_on_and_off:e.target.checked,
                                                    fawry_live:e.target.checked?1:0
                                                });

                                            }} defaultChecked={this.state.fawry_live == 1?true:false}   name="fawry_live" type="checkbox" />
                                                        <span className="slider round"></span>
                                                    </label>
                                                </div>
                                    </div>
                                    <div className="form-group mb-0 text-right">
                                        <button type="button" onClick={this.save_date} className="btn btn-sm btn-primary">{this.state.save_btn}</button>
                                    </div>
                                    <ToastContainer />

                    </div>

                        </div>

                )
            }

        }

    }
