import axios from "axios";
import { Component } from "react";
import { ToastContainer, toast } from 'react-toastify';
import { Urls } from "../urls";
import LoadingFirebase from './loadinFirebase.js';
import ErrorConnection from "../../errors/error_connect";

export default class Firebase extends Component{

    constructor(){
        super();

        this.state = {
            isLoading:true,
            loadingBtn: false,
            errorLoad:false,
            trans:{
               "Firebase Configration":"",
               "Api Key":"",
               "Auth Domain":"",
               "Project Id":"",
               "Storage Bucket":"",
               "Messagin Sender Id":"",
               "App Id":"",
               "Measurement Id":"",
               "Save Data":"",
               "the var is required":"",
               "Data saved successfully":""
            },
            setting:{
                "API KEY FIREBASE":"",
                "AUTH DOMAIN FIREBASE":"",
                "PROJECT ID FIREBASE":"",
                "STORAGE BUCKET FIREBASE":"",
                "MESSAGING SENDER ID FIREBASE":"",
                "APP ID FIREBASE":"",
                "MEASUREMENT ID FIREBASE":""

            },

        }
    }

    componentDidMount(){
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
    this.setState({
                errorLoad:true
            })
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
    this.setState({
                errorLoad:true
            })
        })

    }

    clickbtnSaveData = ()=>{

        let doneData = true;

        for (const [key, value] of Object.entries(this.state.setting)) {
            if(value == ""){

                var title_trans = this.state.trans["the var is required"];
                var title = title_trans.replace("var", key.toString());


                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                    });

                    doneData = false
            }
          }

          if(doneData){
            this.setState({
                loadingBtn:true
            })
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
                        loadingBtn:false
                    })


              })
              .catch(err=>{

              })
          }
    }
    render() {
        if (!this.state.errorLoad) {
                 if (this.state.isLoading) {
            return(
                <div>
                    <LoadingFirebase />
                </div>
            )
        }else{
            return(
                <div >
                       <ToastContainer />
                    <div style={{display:"flex",justifyContent:"center",alignItems:"center"}}>
                        <div className="card w-50">
                            <div className="card-header">
                                <div className="card-title">
                                    {this.state.trans["Firebase Configration"]}
                                </div>
                            </div>
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{this.state.trans["Api Key"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={e=>{
                                                   this.setState(prevState => ({
                                                    setting: {                   // object that we want to update
                                                        ...prevState.setting,    // keep all other key-value pairs
                                                        ["API KEY FIREBASE"]: e.target.value      // update the value of specific key
                                                    }
                                                }))
                                             }} value={this.state.setting["API KEY FIREBASE"]} placeholder={this.state.trans["Api Key"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>

                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{this.state.trans["Auth Domain"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={e=>{
                                                   this.setState(prevState => ({
                                                    setting: {                   // object that we want to update
                                                        ...prevState.setting,    // keep all other key-value pairs
                                                        ["AUTH DOMAIN FIREBASE"]: e.target.value      // update the value of specific key
                                                    }
                                                }))
                                             }} value={this.state.setting["AUTH DOMAIN FIREBASE"]} placeholder={this.state.trans["Auth Domain"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>

                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{this.state.trans["Project Id"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={e=>{
                                                   this.setState(prevState => ({
                                                    setting: {                   // object that we want to update
                                                        ...prevState.setting,    // keep all other key-value pairs
                                                        ["PROJECT ID FIREBASE"]: e.target.value      // update the value of specific key
                                                    }
                                                }))
                                             }} value={this.state.setting["PROJECT ID FIREBASE"]} placeholder={this.state.trans["Project Id"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>


                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{this.state.trans["Storage Bucket"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={e=>{
                                                   this.setState(prevState => ({
                                                    setting: {                   // object that we want to update
                                                        ...prevState.setting,    // keep all other key-value pairs
                                                        ["STORAGE BUCKET FIREBASE"]: e.target.value      // update the value of specific key
                                                    }
                                                }))
                                             }} value={this.state.setting["STORAGE BUCKET FIREBASE"]} placeholder={this.state.trans["Storage Bucket"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>


                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{this.state.trans["Messagin Sender Id"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={e=>{
                                                   this.setState(prevState => ({
                                                    setting: {                   // object that we want to update
                                                        ...prevState.setting,    // keep all other key-value pairs
                                                        ["MESSAGING SENDER ID FIREBASE"]: e.target.value      // update the value of specific key
                                                    }
                                                }))
                                             }} value={this.state.setting["MESSAGING SENDER ID FIREBASE"]} placeholder={this.state.trans["Messagin Sender Id"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>


                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{this.state.trans["App Id"]} <span style={{color:"red"}}>*</span> </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={e=>{
                                                   this.setState(prevState => ({
                                                    setting: {                   // object that we want to update
                                                        ...prevState.setting,    // keep all other key-value pairs
                                                        ["APP ID FIREBASE"]: e.target.value      // update the value of specific key
                                                    }
                                                }))
                                             }} value={this.state.setting["APP ID FIREBASE"]} placeholder={this.state.trans["App Id"]} className="form-control" />
                                           </div>
                                            </div>
                                    </div>

                                </div>

                                <div className="row">
                                    <div className="col-12">
                                      <div className="form-group">
                                            <label >{this.state.trans["Measurement Id"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={e=>{
                                                   this.setState(prevState => ({
                                                    setting: {                   // object that we want to update
                                                        ...prevState.setting,    // keep all other key-value pairs
                                                        ["MEASUREMENT ID FIREBASE"]: e.target.value      // update the value of specific key
                                                    }
                                                }))
                                             }} value={this.state.setting["MEASUREMENT ID FIREBASE"]} placeholder={this.state.trans["Measurement Id"]} className="form-control" />
                                           </div>
                                        </div>
                                    </div>

                                </div>

                                <div className="d-flex flex-row-reverse">
                                    <div className="p-2">
                                         <button onClick={this.clickbtnSaveData} disabled={this.state.loadingBtn} className="btn btn-primary">
                                            {this.state.trans["Save Data"]}
                                            {this.state.loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                                         </button>
                                    </div>

                                </div>

                            </div>
                       </div>
                    </div>
               </div>
            )
        }
        } else {
                      return (
                      <ErrorConnection />
                )
        }



    }

}


