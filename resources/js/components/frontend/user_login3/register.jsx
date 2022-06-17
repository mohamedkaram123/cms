import React,{useRef,useEffect,useState } from 'react'
import 'jquery';
import axios from 'axios';
import { Urls } from '../../backend/urls';
import { csrf_token } from '../../../helpers/Headers';
import { isObject } from 'lodash';
import Select from 'react-select'

export default function Register({ trans,countries }) {
    const [RequireDataRegister, setRequireDataRegister] = useState({
        "name": "",
        "country_id": "",
        "country_tel":"",
         "email": "",
        "password": "",
        "phone":"",
         "password_confirmation":"",
         "remember": false
     })

    const [DataRegister, setDataRegister] = useState({
         "name": "",
        "country_id": "",
        "country_tel":"",
        "email": "",
         "phone":"",
        "password": "",
         "password_confirmation":"",
    })

       const   RegisterData = (type,e)=>{

          setDataRegister(prevState => ({
              ...prevState,
              [type]:e.target.value
     }))
       }

       const [errorMsg, setErrorMsg] = useState("")
    const [loadingBtn, setloadingBtn] = useState(false)



    const register = () => {

                 setloadingBtn(true);
                 DataRegister["_token"] = csrf_token;
                 axios.post(Urls.url + 'user_register3',DataRegister)
                     .then(res => {
                     console.log({res});
                        if (res.data.status == 1) {
                            location.href =res.data.url
                        } else if (res.data.status == 0) {
                            if (isObject(res.data.msg)) {
                                    for (const [key, value] of Object.entries(RequireDataRegister)) {

                                    setRequireDataRegister((prevState) => ({
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
    const mounted = useRef(false);
            useEffect(() => {
            if (!mounted.current) {

     $("#ey_p_bt").click(function(e) {
            e.preventDefault();
            toggle_pass()
        });

        $("#ey_pc_bt").click(function(e) {
            e.preventDefault();
            toggle_pass_confirm()
        });
        var toggle_pass = () => {
            if ($("#pass").attr("type") == "password") {
                $("#pass").attr("type", "text")
                $("#ey_p").removeClass("d-none");
                $("#eys_p").addClass("d-none");
            } else {
                $("#pass").attr("type", "password")
                $("#ey_p").addClass("d-none");
                $("#eys_p").removeClass("d-none");
            }
        }

        var toggle_pass_confirm = () => {
            if ($("#passCon").attr("type") == "password") {
                $("#passCon").attr("type", "text")
                $("#ey_pc").removeClass("d-none");
                $("#eys_pc").addClass("d-none");

            } else {
                $("#passCon").attr("type", "password")
                $("#ey_pc").addClass("d-none");
                $("#eys_pc").removeClass("d-none");
            }
        }

                       $("#country").change(function(e) {
                           e.preventDefault();
                           let id = $(this).val();
                           let tel = $(`#country_tel` + id).data("tel");
                            setDataRegister(prevState => ({
                                         ...prevState,
                                       country_tel:tel
                                   }))

                           let option = new Option( $(`#country_tel`+id).data("tel") + "+",$(`#country_tel`+id).data("tel"));
                $("#country_tel_data").html(option);
            });
            mounted.current = true;
            } else {


            }
            }, []);

    const customStyles = {
  option: (provided, state) => ({
    ...provided,
    borderBottom: '1px dotted pink',
    color: state.isSelected ? 'red' : 'blue',
    padding: 20,
  }),
  control: () => ({
    // none of react-select's styles are passed to <Control />
    width: 200,
  }),

}
  return (
      <div className="card">
                            <div className="text-center pt-4">
                                <h1 className="h4 fw-600">
                                    { trans['Create an account.'] }
                                </h1>
                            </div>
                            <div className="px-4 py-3 py-lg-4">
                                {errorMsg != ""?<div className="alert alert-danger" role="alert">
                                 {errorMsg}
                            </div>:null}
                                <div className="">

                                        <div className="form-group">
                                            <input type="text"
                                                className="form-control"
                                                 placeholder={trans['Full Name'] }
                                                 onChange={RegisterData.bind(this,"name")}
                                                name="name" />
                                                {RequireDataRegister.name != ""?<small className="require_data">{ RequireDataRegister.name}</small>:null }
                                        </div>
                                        <div className="form-group">
                      {/* <select id='country' onFocus={e => { e.target.size = 10 }} onBlur={e => { e.target.size = 1 }} onChange={e => {
                          RegisterData("country_id", e)
                          e.target.onblur

                      }} className="form-control" required>
                                                    <option value="">{trans["Choose Country"]}</option>
                                                        {countries.map((item, i) => (
                                                            <option  key={i} id={`country_tel${item.value}`} data-tel={ item.tel} value={item.value}>{item.label}</option>
                                                        ))}
                                            </select> */}
                                             <Select  id='country' style onChange={(e)=>{
                                                 event = {target:{value:e.value}};
                                                  RegisterData("country_id", event)
                                                 let option = new Option( e.tel + "+",e.tel);
                                             $("#country_tel_data").html(option);
                                             }}  placeholder={trans["Choose Country"]} options={countries} />
                                            {RequireDataRegister.country_id != ""?<small className="require_data">{ RequireDataRegister.country_id}</small>:null }

                                        </div>


                                        <div className="form-group">

                                            <div className="d-flex flex-row">


                                                <div style={{width: "100%",marginInlineEnd:10}} className="form-group">
                                                    <input id="phone" type="number"
                                                        className="form-control"
                                                        onChange={RegisterData.bind(this,"phone")}
                                                        name="phone"  autoFocus={true}
                                                        placeholder={ trans['Phone']}  />
                                                {RequireDataRegister.phone != ""?<small className="require_data">{ RequireDataRegister.phone}</small>:null }

                                                </div>
                                                <div style={{width:"30%"}}>
                                                    <select disabled id="country_tel_data"
                                                        className=" form-control " name="country_tel"
                                                        >


                                                    </select>
                                                </div>


                                            </div>

                                        </div>


                                            <div className="form-group">
                                                <input id="email" type="email"
                                                    className="form-control"
                                                    name="email"
                                                    onChange={RegisterData.bind(this,"email")}
                                                    placeholder={ trans['Email'] } />
                                                    {RequireDataRegister.email != ""?<small className="require_data">{ RequireDataRegister.email}</small>:null }

                                            </div>

                                        <div className="form-group">
                                            <div className="input-group">
                                                <input id="pass" type="password"
                                                onChange={RegisterData.bind(this,"password")}
                                                    className="form-control"
                                                    placeholder={ trans['Password'] } name="password" />
                                                <div className="input-group-append">
                                                    <button style={{zIndex:0}} id="ey_p_bt" className="btn btn-outline-primary" type="button">
                                                        <i id="ey_p" className="las la-eye d-none"></i>
                                                        <i id="eys_p" className="las la-eye-slash"></i>
                                                    </button>

                                                </div>
                                            </div>
                                            <div className="d-flex flex-column">
                                                {RequireDataRegister.password != ""?<small className="require_data">{ RequireDataRegister.password}</small>:null }
                                            <small
                                                className='small_note'>{ trans['Notes: Password must contain uppercase and lowercase letters, symbols, and at least 8 characters']}</small>

                                            </div>

                                        </div>

                                        <div className="form-group">
                                            <div className="input-group">
                                                <input id="passCon" type="password" className="form-control"
                                                    placeholder={ trans['Confirm Password'] }
                                                    onChange={RegisterData.bind(this,"password_confirmation")}
                                                    name="password_confirmation" />
                                                    {RequireDataRegister.password_confirmation != ""?<small className="require_data">{ RequireDataRegister.password_confirmation}</small>:null }
                                                <div className="input-group-append">
                                                    <button  style={{zIndex:0}} id="ey_pc_bt" className="btn btn-outline-primary" type="button">
                                                        <i id="ey_pc" className="las la-eye  d-none"></i>
                                                        <i id="eys_pc" className="las la-eye-slash "></i>
                                                    </button>

                                                </div>
                                            </div>

                                        </div>



                                        <div className="mb-3">
                                            <label className="aiz-checkbox">
                                                <input onChange={e=>{
                                                                  setDataRegister(prevState => ({
                                                                        ...prevState,
                                                                        remember:e.target.checked
                                                                }))
                                                    }} type="checkbox"   />
                                                <span >{ trans['By signing up you agree to our terms and conditions.']}</span>
                                                <span className="aiz-square-check"></span>
                                            </label>
                                        </div>
                                        <div id="recaptcha-container"></div>

                                        <div className="mb-5">
                                            <button onClick={register} type="submit" id="btn-submit" disabled={loadingBtn}
                                                className="btn btn-primary btn-block fw-600">
                                                    { trans['Create Account']}
                                                        {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }

                                                    </button>
                                        </div>


                                </div>

                            </div>
                        </div>
  )
}
