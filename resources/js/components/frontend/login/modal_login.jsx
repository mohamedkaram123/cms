import React , {useRef,useEffect,useState} from 'react'
import axios from 'axios';
import { Urls } from "../../backend/urls";
import LoadingInline from '../../../helpers/LoadingInline';
import {Modal,Button} from 'react-bootstrap';
import { csrf_token } from '../../../helpers/Headers';
export default function ModalLogin({handleClose,show}) {

        const [trans, settrans] = useState({
        "Successful orders": "",
        "Total earnings": "",
        "Products": "",
        "Total sale":""

    })
        const [isLoading, setisLoading] = useState(true)
    const [DataLogin, setDataLogin] = useState({
        "email": "",
        "password": "",
    })

     const [RequireDataLogin, setRequireDataLogin] = useState({
        "email": 0,
        "password": 0,

     })

    const [ErrorLogin, setErrorLogin] = useState({
        "email": "",
        "password": "",

     })

     const  callTrans = (transes)=>{

        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data_post = {
            data: transes,
            "_token": csrf_token
        }
        axios.post(Urls.static_url + "trans_data", data_post)
            .then(res => {


                settrans(res.data)

            })
            .catch(err => {

            })
    }

    const [loadingBtn, setloadingBtn] = useState(false)

    const mounted = useRef(false)
        useEffect(() => {

            if (!mounted.current) {
                // adress();
                callTrans(trans)
            mounted.current = true;
        }


    }, [])



    const enterLoginData = (type,e) => {

                 setDataLogin((prevState) => ({
                                                       ...prevState,
                                                       [type]: e.target.value
                 }));

    }

    const handleSaveChangeAddress = () => {


        let dataSubmit = true;
        setloadingBtn(true);
        for (const [key, value] of Object.entries(DataLogin)) {
            if (value == "") {
                setRequireDataLogin((prevState) => ({
                    ...prevState,
                    [key]: 1
                }));
                dataSubmit = false;
                setloadingBtn(false);

            } else {
                setRequireDataLogin((prevState) => ({
                    ...prevState,
                    [key]: 0
                }));
            }
        }
            if (dataSubmit) {

                // DataLogin["_token"] = csrf_token;
                // console.log({DataLogin});
                // axios.post(Urls.url + "shipping/add/address",DataAddresses)
                //     .then(res => {
                //         setloadingBtn(true);
                //         handleSaveChange();
                //         handleClose();


                // })
            }





    }
    return (
          <Modal  size="md" show={show} onHide={handleClose}>

{isLoading?<LoadingInline />:

                <div>

                <Modal.Header closeButton>
                <Modal.Title>{trans["Login"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>
                    <div className="row">
                            <div className="col-12">
                                  <div className="form-group">

                                <input type="text"
                                    className="form-control"
                                    placeholder={trans["Enter Your Email"]}
                                    onChange={enterLoginData.bind(this, "email")}
                                    required
                                    />
                                    {RequireDataLogin.email == 1?<small className="require_data">{ ErrorLogin.email}</small>:null }
                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                                <input type="text"
                                    className="form-control"
                                    placeholder={trans["Password"]}
                                    onChange={enterLoginData.bind(this, "password")}
                                    required
                                    />
                                    {RequireDataLogin.password == 1?<small className="require_data">{ ErrorLogin.password}</small>:null }
                                </div>
                            </div>

                            <div className=" mb-5 ">
                                <button onClick={handleSaveChangeAddress} disabled={loadingBtn} type="submit" className="btn btn-primary btn-block fw-600">
                                {trans['Login']}
                                {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                                </button>
                            </div>
                             <div className="text-center mb-3">
                        <p className="text-muted mb-0">{ trans['Dont have an account?']}</p>
                        <a /*href="{{ route('user.registration') }}"*/ >{ trans['Register Now']}</a>
                    </div>

                    </div>
                </Modal.Body>
                {/* <Modal.Footer>
                  <Button variant="secondary" onClick={handleClose}>

                    {trans["Close"]}
                  </Button>
                  <Button disabled={loadingBtn} variant="primary" onClick={handleSaveChangeAddress}>
                    {trans["Login"]}
                    {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                  </Button>
                </Modal.Footer> */}
                </div>
                }
              </Modal>
    )
}
