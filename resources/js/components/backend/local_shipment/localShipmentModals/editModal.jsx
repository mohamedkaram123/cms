import React , {useRef,useEffect,useState} from 'react'
import axios from 'axios';
import { Urls } from "../../../backend/urls";
import LoadingInline from '../../../../helpers/LoadingInline';
import { Modal ,Button} from 'react-bootstrap';
import { csrf_token } from '../../../../helpers/Headers';
export default function EditModal({handleClose,show,handleSaveChange,trans,id}) {

    // const [address, setaddress] = useState([])
        const [isLoading, setisLoading] = useState(true)
    const [DataAddresses, setDataAddresses] = useState({
        "address": "",
        "governorate_id": "",
        "city_id": "",
        "shipping_days": "",
        "cost": "",
        "country_id": "",
        "id":id
    })

     const [RequireDataAddresses, setRequireDataAddresses] = useState({
        "address": 0,
         "governorate_id": 0,
        "country_id":0,
        "city_id": 0,
        "shipping_days": 0,
        "cost":0
    })
    const [countries, setcountries] = useState([])

    const [governorates, setgovernorates] = useState([])
    const [cities, setcities] = useState([])
    const [loadingBtn, setloadingBtn] = useState(false)

    const mounted = useRef(false)
        useEffect(() => {

            if (!mounted.current) {
                // adress();
                get_data_adress(id);
            mounted.current = true;
        }


    }, [])


    const governorates_data = (id) => {
        axios.get(Urls.static_url + `localShipment/governorates/${id}`)
            .then(res => {
                setgovernorates(res.data.governorates)
            })
    }

    const cities_data = (id) => {
        axios.get(Urls.static_url + `localShipment/cities/${id}`)
            .then(res => {
            setcities(res.data.cities)

            })
    }
   const get_data_adress = (id) => {
        axios.get(Urls.static_url + `localShipment/edit/${id}`)
            .then(res => {
                setDataAddresses({
                           "address": res.data.address.address,
        "governorate_id": res.data.address.governorate_id,
        "city_id": res.data.address.city_id,
        "shipping_days": res.data.address.shipping_days,
        "cost":res.data.address.cost,
                    "id": res.data.address.id,
        "country_id":res.data.address.country_id
                })
                setcountries(res.data.countries)
            setgovernorates(res.data.governorates)
               setcities(res.data.cities)


                                setisLoading(false)


            })
    }

    const enterShippingData = (type,e) => {

                 setDataAddresses((prevState) => ({
                                                       ...prevState,
                                                       [type]: e.target.value
                 }));
         if (type == "country_id") {
            governorates_data(e.target.value);
        }
                 else if (type == "governorate_id") {
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
                axios.post(Urls.static_url + "localShipment/update/address",DataAddresses)
                    .then(res => {
                        setloadingBtn(true);
                        handleSaveChange();
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
                                        value={DataAddresses.address}
                                    />
                                    {RequireDataAddresses.address == 1?<small className="require_data">{ trans["please enter address"]}</small>:null }
                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                                <input type="text"
                                    className="form-control"
                                    placeholder={trans["Shipping Days"]}
                                    onChange={enterShippingData.bind(this, "shipping_days")}
                                    value={DataAddresses.shipping_days}
                                    required
                                    />
                                    {RequireDataAddresses.shipping_days == 1?<small className="require_data">{ trans["please enter shipping days"]}</small>:null }
                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                                <input type="number"
                                    min={0}
                                    className="form-control"
                                    placeholder={trans["cost"]}
                                    onChange={enterShippingData.bind(this, "cost")}
                                    value={DataAddresses.cost}
                                    required
                                />
                                {RequireDataAddresses.cost == 1?<small className="require_data">{ trans["please enter cost"]}</small>:null }
                                </div>
                            </div>
                              <div className="col-12">
                             <div className="form-group">
                            <select value={DataAddresses.country_id} onChange={enterShippingData.bind(this, "country_id")} className="form-control"  required>
                               <option value="" >{trans["Choose Country"]}</option>
                                {countries.map((item, i) => (
                                    <option  key={i} value={item.id}>{item.name}</option>
                                ))}
                            </select>
                                {RequireDataAddresses.country_id == 1?<small className="require_data">{ trans["please enter country"]}</small>:null }
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
                                {RequireDataAddresses.governorate_id == 1?<small className="require_data">{ trans["please enter governorate"]}</small>:null }

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
