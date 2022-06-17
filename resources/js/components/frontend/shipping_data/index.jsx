import React,{useState,useEffect,useRef} from 'react'
import ShippingHome from './shippingHome/shipping_home'
import axios from 'axios'
import { Urls } from "../../backend/urls";
import { useDispatch} from 'react-redux';
import LoadingInline from '../../../helpers/LoadingInline';
import { setTranslations } from '../../../redux/actions/langsActions';
import LocalShipment from './localShipment/local_shipment';
export default function Index({product_manage_by_admin}) {

const [shippingHome, setshippingHome] = useState(true)
    const [publicPoint, setpublicPoint] = useState(false)
    const [isLoading, setisLoading] = useState(true)
    const dispatch = useDispatch()


    const [trans, settrans] = useState({
        "Shipping Home": "",
        "Public Point": "",
        "public point": "",
        "shipping home": "",
        "Address": "",
        "Code": "",
        "Postal Code": "",
        "City": "",
        "Country": "",
        "Phone": "",
        "Edit": "",
        "Add New Address": "",
        "Add Address": "",
        "Enter Your Address": "",
        "Close": "",
        "Save Changes": "",
        "Choose Country": "",
        "Choose Governorate": "",
        "Choose City": "",
        "phone": "",
        "please enter postal code": "",
        "please enter phone": "",
        "please enter address": "",
        "please enter country": "",
        "please enter governorate": "",
        "please enter city": "",
        "Are you sure?": "",
        "Once deleted, you will not be able to recover this imaginary data!": "",
        "remove": "",
        "Your imaginary data is safe!":"",
        "Delete": "",
        "cancel": "",
        "Local Shipment": "",
        "Shipping Days": "",
        "Cost": "",
        "Choose Adress Type": "",
        "please enter Adress Type": "",
        "Address Type": "",
        "home": "",
        "office":""

    })

    const mounted =  useRef(false)
    useEffect(() => {

        if (!mounted.current) {
            callTrans(trans);
            mounted.current = true;
        }


    }, [])

     const callTrans = (transes)=>{

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
            .then(res => {
            settrans(res.data)
            setisLoading(false)
            dispatch(setTranslations(res.data))
        })
        .catch(err=>{

        })
 }

    return (
        <div>
             {isLoading?<LoadingInline />:<div className="card">
                <div className="card-header">
                    <div className="d-flex flex-row" style={{justifyContent:"space-between",width:"100%"}}>
                        <div className="form-check">
                            <input onChange={e => {
                                setshippingHome(e.target.checked)
                                setpublicPoint(false)
                            }} className="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" defaultChecked={shippingHome} />
                            <label className="form-check-label" htmlFor="flexRadioDefault1">
                                {trans["Shipping Home"]}
                            </label>
                            </div>

                            <div className="form-check">
                                <input onChange={e => {
                                    setpublicPoint(e.target.checked)
                                    setshippingHome(false)

                                }} className="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" defaultChecked={publicPoint} />
                                <label className="form-check-label" htmlFor="flexRadioDefault2">
                                    {trans["Local Shipment"]}
                                </label>
                            </div>
                    </div>
                </div>
                <div className="card-body">
                    {shippingHome?<ShippingHome  />: <LocalShipment />}
                </div>
            </div>}
        </div>
    )
}
