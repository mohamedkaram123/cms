import React,{useState} from 'react';
import axios from 'axios';
import { Urls } from '../../backend/urls';
import { csrf_token } from '../../../helpers/Headers';
import { isObject } from 'lodash';


export default function Login({trans}) {
     const [RequireDataLogin, setRequireDataLogin] = useState({
         "email": "",
         "password": "",
         "remember": false
     })

    const [DataLogin, setDataLogin] = useState({
         "email": "",
        "password": "",
    })

        const [errorMsg, setErrorMsg] = useState("")
    const [loadingBtn, setloadingBtn] = useState(false)

    const login = () => {

                 setloadingBtn(true);
                 DataLogin["_token"] = csrf_token;
                 axios.post(Urls.url + 'user_login3',DataLogin)
                     .then(res => {
                     console.log({res});
                        if (res.data.status == 1) {
                            location.reload();
                        } else if (res.data.status == 0) {
                            if (isObject(res.data.msg)) {
                                    for (const [key, value] of Object.entries(RequireDataLogin)) {

                                    setRequireDataLogin((prevState) => ({
                                        ...prevState,
                                        [key]: (key in res.data.msg)?res.data.msg[key][0]:""
                                    }));
                                }
                            } else {
                                setErrorMsg(res.data.msg)
                            }
                                       setloadingBtn(false);

                        }
                  })
                  .catch(err => {
                   })
    }

   const   LoginData = (type,e)=>{

          setDataLogin(prevState => ({
              ...prevState,
              [type]:e.target.value
     }))
  }

          return (
                        <div className="card">
                            <div className="text-center pt-4">
                                <h1 className="h4 fw-600">
                                    { trans['Login to your account.']}
                                </h1>
                            </div>


                            <div className="px-4 py-3 py-lg-4">
                                {errorMsg != ""?<div className="alert alert-danger" role="alert">
                                 {errorMsg}
                            </div>:null}

                                <div className="">
                                       <div className="form-group">
                                          <input onChange={LoginData.bind(this,"email")} type="email" className="form-control"  placeholder={trans['Email']} name="email" />
                                             {RequireDataLogin.email != ""?<small className="require_data">{ RequireDataLogin.email}</small>:null }

                                       </div>
                                        <div className="form-group">
                                            <input onChange={LoginData.bind(this,"password")} type="password" className="form-control" placeholder={trans["Password"]} name="password" id="password" />
                                             {RequireDataLogin.password != ""?<small className="require_data">{ RequireDataLogin.password}</small>:null }
                                        </div>

                                        <div className="row mb-2">
                                            <div className="col-6">
                                                <label className="aiz-checkbox">
                                                    <input onChange={e=>{
                                                                  setDataLogin(prevState => ({
                                                                        ...prevState,
                                                                        remember:e.target.checked
                                                                }))
                                                    }} type="checkbox" name="remember" />
                                                    <span >{  trans['Remember Me'] }</span>
                                                    <span className="aiz-square-check"></span>
                                                </label>
                                            </div>
                                            <div className="col-6 text-right">
                                                <a href={Urls.url + "password/reset"} className="text-reset opacity-60 fs-14">{ trans['Forgot password?']}</a>
                                            </div>
                                        </div>

                                        <div className="mb-5">
                                            <button onClick={login} disabled={loadingBtn} type="submit" className="btn btn-primary btn-block fw-600">
                                                {  trans['Login'] }
                                              {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                                            </button>
                                        </div>
                                </div>

                            </div>
                        </div>
             )



       }
