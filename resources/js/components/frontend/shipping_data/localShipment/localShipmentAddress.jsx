import React ,{useState,useEffect,useRef} from 'react'
import { useSelector } from 'react-redux';
import LoadingInline from '../../../../helpers/LoadingInline';
import axios from 'axios';
import { Urls } from "../../../backend/urls";
import { csrf_token } from '../../../../helpers/Headers';

export default function LocalShipmentAddress({data:city}) {
             const state = useSelector(state => state);
    const trans = state["allTanslations"].trans;

    const [addresses, setaddresses] = useState([])
        const [isLoading, setisLoading] = useState(true)

    const mounted  = useRef(false)
    useEffect(() => {
        if (!mounted.current) {

            let data = {
                "_token": csrf_token,
                "city_id":city
            }

           axios.post(Urls.url + "localshipment/addresses",data)
               .then(res => {
                    setaddresses(res.data.addresses)
                    setisLoading(false)
            })
            mounted.current = true;
        } else {
setisLoading(true)
    let data = {
                "_token": csrf_token,
                "city_id":city
            }
           axios.post(Urls.url + "localshipment/addresses",data)
                .then(res => {
                    setaddresses(res.data.addresses)
                    setisLoading(false)
            })
        }
    }, [city])

      const setAddress = (address,e) => {


        address["type"] = "local_shipment";
        let data = {
            address,
            "_token":csrf_token
        }
        axios.post(Urls.url + "localshipment/setAddress",data)
            .then(res => {
        })
    }
    return (
        <div>
            {isLoading ? <div className="center_flex"><LoadingInline /></div>  :
                <div className="row">
                    {
                        addresses.map((address, i) => {
                            return (<div key={i} className="col-md-6 col-12 mb-3">
                               <label className="aiz-megabox d-block bg-white mb-0">
                                <input onChange={setAddress.bind(this,address)} type="radio" name="address_id" value={address.id} required />

                                    <span className="d-flex p-3 aiz-megabox-elem" style={{ border: "1px solid #ddd" }}>
                                    <span className="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                    <span className="flex-grow-1 pl-3 text-left">
                                        <div>
                                            <span className="opacity-60">{trans['Address']}:</span>
                                            <span className="fw-600 ml-2">{address.address}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['Shipping Days']}:</span>
                                            <span className="fw-600 ml-2">{address.shipping_days}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['City']}:</span>
                                            <span className="fw-600 ml-2">{address.city_name}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['Cost']}:</span>
                                            <span className="fw-600 ml-2">{address.cost}</span>
                                        </div>

                                    </span>
                                </span>
                            </label>

                            </div>)
                        })
                    }
                </div>}
        </div>
    )
}
