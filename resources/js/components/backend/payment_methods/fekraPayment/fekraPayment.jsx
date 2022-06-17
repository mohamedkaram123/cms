import React, { useState ,useRef,useEffect} from 'react'
import axios from "axios";
import { Urls } from '../../urls';
import LoadingFekraPayment from './LoadingFekraPayment';
import { ToastContainer } from 'react-toastify';
import { toast } from 'react-toastify';
export default function FekraPayment() {

    const [trans, settrans] = useState({
        "FekraPay credential": "",
        "Security Key": "",
        "Live Mode": "",
        "SandBox": "",
        "Save": "",
        "Data saved successfully":""
    })

    const [setting, setsetting] = useState({
        "fekra_pay_key": "",
        "fekra_pay_mode": "",
        "fekra_pay_sandbox":""
    })

    const [loading, setloading] = useState(true)
 const mounted = useRef(false);
    useEffect(() => {
        if (!mounted.current) {
                    get_setting_data(setting)
          callTrans(trans)
        // do componentDidMount logic
        mounted.current = true;
      } else {
      }
    }, []);


      const callTrans = (transes)=>{
        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{
            settrans(res.data)
            setloading(false)
        })
        .catch(err=>{

        })
    }


    const get_setting_data = (data)=>{
      let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      let  data_post = {
            data,
            "_token": csrf_token
        }
        axios.post(Urls.static_url+'setting_data', data_post)
        .then(res=>{
            console.log(res.data);
            setsetting(res.data)
        })
        .catch(err=>{

        })

    }

    const save_date = () => {
            let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let  data_post = {
                  data:setting,
                  "_token": csrf_token
              }
              axios.post(Urls.static_url+'set_setting_data', data_post)
              .then(res=>{
                var title_trans = trans["Data saved successfully"];
                toast.success(title_trans, {
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

    if (loading) {
        return (
            <LoadingFekraPayment />
        )
    } else {
        return (
        <div>
            <div className="card">
                <div className="card-header">
                    {trans["FekraPay credential"]}
                </div>
                <div className="card-body">
                    <div className="row form-group">
                            <div className="col-md-4">
                               <label className="col-from-label">{trans["Security Key"]}</label>
                            </div>
                            <div className="col-md-8">
                                <input type="text" onChange={e=>{
                                    setsetting((prevState) => ({
                                        ...prevState,
                                        fekra_pay_key:e.target.value
                                    }))
                                            }} defaultValue={setting.fekra_pay_key} className="form-control" />
                            </div>
                    </div>
                    <div className="row form-group">
                            <div className="col-md-4">
                                <label className="col-form-label">{ trans["Live Mode"]}</label>
                            </div>
                            <div className="col-md-8">
                                  <label className="aiz-switch aiz-switch-success mb-0">
                                    <input onChange={e => {
                                              setsetting((prevState) => ({
                                        ...prevState,
                                        fekra_pay_mode:e.target.checked?"live":"test"
                                    }))
                                            }} defaultChecked={setting.fekra_pay_mode == "live"?true:false}   name="fekra_pay_mode" type="checkbox" />
                                        <span className="slider round"></span>
                                  </label>
                           </div>
                    </div>
                    <div className="row form-group">
                            <div className="col-md-4">
                                <label className="col-form-label">{ trans["SandBox"]}</label>
                            </div>
                            <div className="col-md-8">
                                  <label className="aiz-switch aiz-switch-success mb-0">
                                    <input onChange={e => {
                                              setsetting((prevState) => ({
                                        ...prevState,
                                        fekra_pay_sandbox:e.target.checked?"1":"0"
                                    }))
                                            }} defaultChecked={setting.fekra_pay_sandbox == "1"?true:false}   name="fekra_pay_sandbox" type="checkbox" />
                                        <span className="slider round"></span>
                                  </label>
                            </div>
                    </div>
                    <div className="form-group mb-0 text-right">
                        <button type="button" onClick={save_date} className="btn btn-sm btn-primary">{trans["Save"]}</button>
                    </div>
                                    <ToastContainer />
                </div>
            </div>
        </div>
    )
    }


}
