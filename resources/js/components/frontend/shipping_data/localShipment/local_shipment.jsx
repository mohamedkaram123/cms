import React ,{useState,useEffect,useRef} from 'react'
import { useSelector } from 'react-redux';
import LoadingInline from '../../../../helpers/LoadingInline';
import axios from 'axios';
import { Urls } from "../../../backend/urls";
import { csrf_token } from '../../../../helpers/Headers';
import LocalShipmentAddress from './localShipmentAddress';
export default function LocalShipment() {
         const state = useSelector(state => state);
    const trans = state["allTanslations"].trans;

    const [country, setcountry] = useState({
        "id": "",
        "name":""
    })
    const [governorates, setgovernorates] = useState([])
    const [cities, setcities] = useState([])
    const [localShipData, setlocalShipData] = useState({
        "country_id": "",
        "governorate_id": "",
        "city_id":""
    })
    const [city, setcity] = useState("")
    // const [dataCgc, setdataCgc] = useState({
    //     "governorates": [],
    //     "cities":[],
    //  })
        const [isLoading, setisLoading] = useState(true)
        const [loadAddress, setloadAddress] = useState(false)
    const mounted  = useRef(false)
    useEffect(() => {
        if (!mounted.current) {

            axios.get(Urls.url + "localshipment/dataCountry")
                .then(res => {
                    setcountry(res.data.country)
                    setgovernorates(res.data.governorates)
                    setisLoading(false)
            })
            mounted.current = true;
        }
    }, [])
const cities_data = (id) => {
        axios.get(Urls.url + `shipping/cities/${id}`)
            .then(res => {
            setcities(res.data.cities)

            })
}

    const localShipDataSend = (type,e) => {
                setlocalShipData((prevState) => ({
                                                       ...prevState,
                    [type]: e.target.value,
                     country_id:country.id
                }));

        if (type == "governorate_id") {
            if (e.target.value != "") {
                             cities_data(e.target.value);

             }
         }

        if (type == "city_id" && localShipData.governorate_id != "") {
            setcity(e.target.value)
            setloadAddress(true);
        } else {
                        setloadAddress(false);

             }
    }
    return (
        <div>
            {isLoading?<LoadingInline />:


       (<><div className="row">
            <div className="col-12">
                             <div className="form-group">
                            <select  onChange={localShipDataSend.bind(this, "country_id")} disabled={true} className="form-control"  required>
                               {/* <option value="">{trans["Choose Country"]}</option> */}
                                    <option  value={country.id}>{country.name}</option>

                            </select>
                                {/* {RequireDataAddresses.country_id == 1?<small className="require_data">{ trans["please enter country"]}</small>:null } */}
                            </div>
                            </div>
                              <div className="col-12">
                             <div className="form-group">
                            <select onChange={localShipDataSend.bind(this, "governorate_id")} className="form-control"  required>
                                <option value="">{trans["Choose Governorate"]}</option>
                                {governorates.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                                    </select>
                                {/* {RequireDataAddresses.governorate_id == 1?<small className="require_data">{ trans["please enter governorate"]}</small>:null } */}

                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                            <select onChange={localShipDataSend.bind(this, "city_id")} className="form-control"  required>
                                <option value="">{trans["Choose City"]}</option>
                                {cities.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                                    </select>
                                {/* {RequireDataAddresses.city_id == 1?<small className="require_data">{ trans["please enter city"]}</small>:null } */}

                                    </div>
                                    </div>

                </div>
                    <div >
                            {loadAddress?<LocalShipmentAddress data={city} />:null}
                        </div>
                </>)}

        </div>
    )
}
