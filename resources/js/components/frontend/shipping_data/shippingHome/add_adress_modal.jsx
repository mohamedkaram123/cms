import React , {useRef,useEffect,useState} from 'react'
import { useSelector } from 'react-redux';
import axios from 'axios';
import { Urls } from "../../../backend/urls";
import LoadingInline from '../../../../helpers/LoadingInline';
import { Modal ,Button} from 'react-bootstrap';
import { csrf_token } from '../../../../helpers/Headers';
export default function AddAddressModal({handleClose,show,handleSaveChange}) {
        const state = useSelector(state => state);
    const trans = state["allTanslations"].trans;

    // const [address, setaddress] = useState([])
        const [isLoading, setisLoading] = useState(true)
    const [DataAddresses, setDataAddresses] = useState({
        "address": "",
        "country_id": "",
        "governorate_id": "",
        "city_id": "",
        "postal_code": "",
        "phone": "",
        "adress_type":""

    })

     const [RequireDataAddresses, setRequireDataAddresses] = useState({
        "address": "",
        "country_id": "",
        "governorate_id": "",
        "city_id": "",
         "phone": "",
        "adress_type":""
    })

    const [countries, setcountries] = useState([])
    const [governorates, setgovernorates] = useState([])
    const [cities, setcities] = useState([])
    const [loadingBtn, setloadingBtn] = useState(false)
    const [postal_code, setpostal_code] = useState(0)

    const mounted = useRef(false)
        useEffect(() => {

            if (!mounted.current) {
                // adress();
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

    const governorates_data = (id) => {
        axios.get(Urls.url + `shipping/governorates/${id}`)
            .then(res => {
                setgovernorates(res.data.governorates)
                 setDataAddresses((prevState) => ({
                     ...prevState,
                     postal_code: res.data.postal_code
                 }));
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
        // for (const [key, value] of Object.entries(DataAddresses)) {
        //     if (value == "") {
        //         setRequireDataAddresses((prevState) => ({
        //             ...prevState,
        //             [key]: 1
        //         }));
        //         dataSubmit = false;
        //         setloadingBtn(false);

        //     } else {
        //         setRequireDataAddresses((prevState) => ({
        //             ...prevState,
        //             [key]: 0
        //         }));
        //     }
        // }
            if (dataSubmit) {

                DataAddresses["_token"] = csrf_token;
                axios.post(Urls.url + "shipping/add/address",DataAddresses)
                    .then(res => {
                        if (res.data.status == 1) {
                              setloadingBtn(false);
                        handleSaveChange();
                        handleClose();
                        } else if(res.data.status == 0) {
                    for (const [key, value] of Object.entries(RequireDataAddresses)) {

                        setRequireDataAddresses((prevState) => ({
                            ...prevState,
                            [key]: (key in res.data.msg)?res.data.msg[key][0]:""
                        }));
                                setloadingBtn(false);

                    }
                }



                })
            }





    }
    return (
          <Modal style={{zIndex:1250}}  size="md" show={show} onHide={handleClose}>

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
                                            value={DataAddresses.address}

                                    required
                                    />
                                 {RequireDataAddresses.address != ""?<small className="require_data">{ RequireDataAddresses.address}</small>:null }

                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                            <select value={DataAddresses.country_id} onChange={enterShippingData.bind(this, "country_id")} className="form-control"  required>
                               <option value="">{trans["Choose Country"]}</option>
                                {countries.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                            </select>
                              {RequireDataAddresses.country_id != ""?<small className="require_data">{ RequireDataAddresses.country_id}</small>:null }

                                </div>
                            </div>
                            <div className="col-9">
                             <div className="form-group">
                                <input type="number"
                                    min={0}
                                    className="form-control"
                                    placeholder={trans["phone"]}
                                        onChange={enterShippingData.bind(this, "phone")}
                                            value={DataAddresses.phone}
                                    required
                                />
                                 {RequireDataAddresses.phone != ""?<small className="require_data">{ RequireDataAddresses.phone}</small>:null }

                                </div>
                            </div>
                            <div className="col-3">
                             <div className="form-group">
                                    <input type="text"
                                        style={{direction:"rtl"}}
                                    className="form-control"
                                        placeholder={trans["Code"]}
                                        value={ DataAddresses.postal_code != ""?DataAddresses.postal_code +" + ":""}
                                        onChange={enterShippingData.bind(this, "postal_code")}
                                        disabled
                                    required
                                    />
                                </div>
                            </div>

                            <div className="col-12">
                             <div className="form-group">
                            <select  value={DataAddresses.adress_type} onChange={enterShippingData.bind(this, "adress_type")} className="form-control"  required>
                               <option value="">{trans["Choose Adress Type"]}</option>
                                    <option  value="home">{trans["home"]}</option>
                                    <option  value="office">{trans["office"]}</option>

                            </select>
                              {RequireDataAddresses.adress_type != ""?<small className="require_data">{ RequireDataAddresses.adress_type}</small>:null }

                                </div>
                            </div>


                              <div className="col-12">
                             <div className="form-group">
                            <select value={DataAddresses.governorate_id} onChange={enterShippingData.bind(this, "governorate_id")} className="form-control"  required>
                                <option value="">{trans["Choose Governorate"]}</option>
                                {governorates.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                                    </select>
                              {RequireDataAddresses.governorate_id != ""?<small className="require_data">{ RequireDataAddresses.governorate_id}</small>:null }

                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                            <select value={DataAddresses.city_id} onChange={enterShippingData.bind(this, "city_id")} className="form-control"  required>
                                <option value="">{trans["Choose City"]}</option>
                                {cities.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                                    </select>
                              {RequireDataAddresses.city_id != ""?<small className="require_data">{ RequireDataAddresses.city_id}</small>:null }

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
