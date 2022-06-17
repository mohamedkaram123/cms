import React,{useState,useRef,useEffect, createRef} from 'react';
import LoadingInline from '../../../helpers/LoadingInline';
import axios from 'axios';
import { Urls } from '../../backend/urls';
import "./butonns_border.css";
import Login from './login';
import Register from './register';
import 'jquery';


export default function Index() {

            const [trans, settrans] = useState({
                "Login": "",
                "Register": "",
                "Create an account.": "",
                "Login to your account.": "",
                "Email": "",
                "Password": "",
                "Remember Me": "",
                "Forgot password?": "",
                "Login": "",
                "Full Name": "",
                "Phone": "",
                "Notes: Password must contain uppercase and lowercase letters, symbols, and at least 8 characters": "",
                "Confirm Password": "",
                "Create Account": "",
                "Choose Country": "",
                "By signing up you agree to our terms and conditions.": "",
                "If you have an account": "",
                "If you don't have an account": "",
                "or":""
            })
      const [login, setLogin] = useState(true)
       const mounted = useRef(false);
            useEffect(() => {
            if (!mounted.current) {


                callTrans(trans)
                countries_data()
            mounted.current = true;
            } else {


            }
            }, []);

            const [isLoading, setisLoading] = useState(true)
    const [countries, setcountries] = useState([])
      const countries_data = () => {
        axios.get(Urls.url+ "all_countries_data")
            .then(res => {
                setcountries(res.data.countries)
                setisLoading(false)


            })
    }
            const  callTrans = (transes)=>{
                let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                  let data_post = {
                 data: transes,
                '_token': csrf_token
                         }

                 axios.post(Urls.static_url + 'trans_data', data_post)
                 .then(res => {
                   settrans(res.data)
                  })
                  .catch(err => {
                   })
            }
    const toggleLogin = (reg=false,log=true) => {
        if (!log && reg) {
            setLogin(false)
            $("#btn_register").addClass("btn-active")
                        $("#btn_login").removeClass("btn-active")

        } else if(log && !reg){
            setLogin(true)
                      $("#btn_register").removeClass("btn-active")
                        $("#btn_login").addClass("btn-active")
        }
    }


    const changeWrapper = () => {
    const isTabletOrMobile =  window.matchMedia("(max-width: 768px)").matches ;
        console.log({isTabletOrMobile});
        if (isTabletOrMobile) {
                 $("#btn_container").addClass("d-none")
                     $("#wrapper_login_and_register").removeClass("d-none");
          }

}
  const reversechangeWrapper = () => {
    const isTabletOrMobile =  window.matchMedia("(max-width: 768px)").matches ;
        console.log({isTabletOrMobile});
        if (isTabletOrMobile) {
                 $("#btn_container").removeClass("d-none")
                     $("#wrapper_login_and_register").addClass("d-none");
          }

}
        if (isLoading) {

             return <LoadingInline />

         } else {



          return (
                   <div className='container py-6 my-6'>
                       <div className="row">
                           <div id='btn_container' className="col-md-6 col-12 d-md-block">
                               <div className="d-flex flex-column " style={{justifyContent:'center'}} >
                                   <div className="p-2 wrapper-btn" >
                                  <button id='btn_login' onClick={() => {
                                      toggleLogin(false, true)
                                       changeWrapper()
                                  }} tabIndex={1} className="btn-6 btn-login tab-btn-login btn-active">
                                      <div className="d-flex flex-column">
                                          <span className='span-login'>{trans["Login"]}</span>
                                          <p style={{marginBlock:15,fontSize:14}}>{ trans["If you have an account"] }</p>
                                      </div>
                                      </button>
                                   </div>

                                   <div className="p-2 wrapper-divider">
                                  <div className="hr-sect">
                                      {trans["or"]}
                                       </div>
                                   </div>
                                   <div className="p-2 wrapper-btn">
                                  <button id='btn_register' onClick={() => {
                                      toggleLogin(true, false)
                                       changeWrapper()
                                  }} tabIndex={2} className="btn-6 btn-login tab-btn-login">
                                      <div className="d-flex flex-column">
                                          <span className='span-login'>{trans["Register"]}</span>
                                          <p style={{marginBlock:15,fontSize:14}}>{ trans["If you don't have an account"] }</p>
                                      </div>
                                      </button>
                                   </div>
                               </div>
                           </div>
                           <div id='wrapper_login_and_register' className=" col-md-5 col-12 d-md-block d-none">
                               <button onClick={reversechangeWrapper} style={{marginInlineStart:"80%"}} className='btn btn-exite d-md-none d-block'><i style={{fontSize:24,fontWeight:'bold'}} className="las la-sign-out-alt"></i></button>
                               {login?<Login trans={trans} />:<Register countries={countries} trans={trans} />}
                           </div>
                       </div>
                   </div>
          )
        }


       }
