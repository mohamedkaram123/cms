import React , {useRef,useEffect,useState} from 'react'
import axios from 'axios';
import { Urls } from "../../backend/urls";
import LoadingInline from '../../../helpers/LoadingInline';
import { Modal ,Button} from 'react-bootstrap';
import { csrf_token } from '../../../helpers/Headers';
export default function AddAddressModal({handleClose,show,handleSaveChange}) {

    // const [address, setaddress] = useState([])
        const [isLoading, setisLoading] = useState(true)
    const [DataAddresses, setDataAddresses] = useState({
        "address": "",
        "country_id": "",
        "governorate_id": "",
        "city_id": "",
        "postal_code": "",
        "phone":""
    })

     const [RequireDataAddresses, setRequireDataAddresses] = useState({
        "address": 0,
        "country_id": 0,
        "governorate_id": 0,
        "city_id": 0,
        "postal_code": 0,
        "phone":0
     })
        const [trans, settrans] = useState({
        "Add Address": "",
        "Enter Your Address": "",
        "please enter address": "",
        "Postal Code":"",
            "phone": "",
            "please enter phone": "",
            "Choose Country": "",
            "please enter country": "",
            "Choose Governorate": "",
            "please enter governorate": "",
            "please enter city": "",
            "Close": "",
        "Save Changes":""

    })



    const [countries, setcountries] = useState([])
    const [governorates, setgovernorates] = useState([])
    const [cities, setcities] = useState([])
    const [loadingBtn, setloadingBtn] = useState(false)

    const mounted = useRef(false)
        useEffect(() => {

            if (!mounted.current) {
                // adress();
                callTrans(trans)
                countries_data();
            mounted.current = true;
        }


    }, [])

    // const adress = () => {
    //     axios.get(Urls.url + "shipping/address")
    //         .then(res => {
    //         setaddress(res.data.address)
    //     setisLoading(false)
    //         })
    // }

    const countries_data = () => {
        axios.get(Urls.url + "shipping/countries")
            .then(res => {
                setcountries(res.data.countries)
                        setisLoading(false)

            })
    }


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

    const governorates_data = (id) => {
        axios.get(Urls.url + `shipping/governorates/${id}`)
            .then(res => {
            setgovernorates(res.data.governorates)
            })
    }

    const cities_data = (id) => {
        axios.get(Urls.url + `shipping/cities/${id}`)
            .then(res => {
            setcities(res.data.cities)

            })
    }


    const enterShippingData = (type,e) => {

                 setDataAddresses((prevState) => ({
                                                       ...prevState,
                                                       [type]: e.target.value
                 }));
        if (type == "country_id") {
            governorates_data(e.target.value)
        } else if (type == "governorate_id") {
            cities_data(e.target.value);
        }
    }

    const handleSaveChangeAddress = () => {


        let dataSubmit = true;
        setloadingBtn(true);
        for (const [key, value] of Object.entries(DataAddresses)) {
            if (value == "") {
                setRequireDataAddresses((prevState) => ({
                    ...prevState,
                    [key]: 1
                }));
                dataSubmit = false;
                setloadingBtn(false);

            } else {
                setRequireDataAddresses((prevState) => ({
                    ...prevState,
                    [key]: 0
                }));
            }
        }
            if (dataSubmit) {

                DataAddresses["_token"] = csrf_token;
                axios.post(Urls.url + "shipping/add/address",DataAddresses)
                    .then(res => {
                        setloadingBtn(false);
                        handleSaveChange()
                        handleClose();


                })
            }





    }
    return (
          <Modal  size="md" show={show} onHide={handleClose}>

{isLoading?<LoadingInline />:

                <div>

                <Modal.Header closeButton>
                <Modal.Title>{trans["Add Address"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>
                    <div className="row">
                            <div className="col-12">
                                  <div className="form-group">

                                <input type="text"
                                    className="form-control"
                                    placeholder={trans["Enter Your Address"]}
                                    onChange={enterShippingData.bind(this, "address")}
                                    required
                                    />
                                    {RequireDataAddresses.address == 1?<small className="require_data">{ trans["please enter address"]}</small>:null }
                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                                <input type="text"
                                    className="form-control"
                                    placeholder={trans["Postal Code"]}
                                    onChange={enterShippingData.bind(this, "postal_code")}
                                    required
                                    />
                                    {RequireDataAddresses.postal_code == 1?<small className="require_data">{ trans["please enter postal code"]}</small>:null }
                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                                <input type="number"
                                    min={0}
                                    className="form-control"
                                    placeholder={trans["phone"]}
                                    onChange={enterShippingData.bind(this, "phone")}
                                    required
                                />
                                {RequireDataAddresses.phone == 1?<small className="require_data">{ trans["please enter phone"]}</small>:null }
                                </div>
                            </div>
                           <div className="col-12">
                             <div className="form-group">
                            <select onChange={enterShippingData.bind(this, "country_id")} className="form-control"  required>
                               <option value="">{trans["Choose Country"]}</option>
                                {countries.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                            </select>
                                {RequireDataAddresses.country_id == 1?<small className="require_data">{ trans["please enter country"]}</small>:null }
                            </div>
                            </div>
                              <div className="col-12">
                             <div className="form-group">
                            <select onChange={enterShippingData.bind(this, "governorate_id")} className="form-control"  required>
                                <option value="">{trans["Choose Governorate"]}</option>
                                {governorates.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                                    </select>
                                {RequireDataAddresses.governorate_id == 1?<small className="require_data">{ trans["please enter governorate"]}</small>:null }

                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                            <select onChange={enterShippingData.bind(this, "city_id")} className="form-control"  required>
                                <option value="">{trans["Choose City"]}</option>
                                {cities.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                                    </select>
                                {RequireDataAddresses.city_id == 1?<small className="require_data">{ trans["please enter city"]}</small>:null }

                                    </div>
                                    </div>
                    </div>
                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={handleClose}>

                    {trans["Close"]}
                  </Button>
                  <Button disabled={loadingBtn} variant="primary" onClick={handleSaveChangeAddress}>
                    {trans["Save Changes"]}
                    {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                  </Button>
                </Modal.Footer>
                </div>
                }
              </Modal>
    )
}
