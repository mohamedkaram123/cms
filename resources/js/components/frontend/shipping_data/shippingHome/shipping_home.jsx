import React , {useRef,useEffect,useState} from 'react'
import { useSelector } from 'react-redux';
import axios from 'axios';
import { Urls } from "../../../backend/urls";
import LoadingInline from '../../../../helpers/LoadingInline';
import AddAddressModal from './add_adress_modal';
import EditAddressModal from './edit_adress_modal';
import swal from "sweetalert";
import { csrf_token } from '../../../../helpers/Headers';
export default function ShippingHome() {
        const state = useSelector(state => state);
    const trans = state["allTanslations"].trans;

    const [address, setaddress] = useState([])
        const [isLoading, setisLoading] = useState(true)

    const [show, setshow] = useState(false)
    const [showEdit, setshowEdit] = useState(false)
const [addressId, setaddressId] = useState(0)
    const handleClose = () => {
        setshow(false);
    }

    const handleCloseEdit = () => {
        setshowEdit(false);
                                                setaddressId(0)
    }
    const handleSaveChange = (data) => {

                adress();
    }

        const swalRemove = (id) => {


 swal({
  title: trans["Are you sure?"],
  text: trans["Once deleted, you will not be able to recover this imaginary data!"],
     icon: "warning",
  buttons: [trans["cancel"],trans["remove"]],
     dangerMode: true,


})
     .then((willDelete) => {

    if (willDelete) {

        axios.get(Urls.url + `shipping/address/delete/${id}`)
            .then(res => {
                adress();

            })
            .catch(err => {
            console.log({err});
        })
  }
});
    }

    const mounted = useRef(false)
        useEffect(() => {

            if (!mounted.current) {
                adress();
            mounted.current = true;
        }


    }, [])

    const adress = () => {
        axios.get(Urls.url + `shipping/address`)
            .then(res => {
            setaddress(res.data.address)
        setisLoading(false)
            })
    }

    const setAddress = (address,e) => {


        address["type"] = "shipping_home";
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
            {isLoading ? <LoadingInline /> :
               <div>
                <div className="row">
                    {address.map((address, i) => (
                        <div key={i} className="col-md-6 mb-3">
                            <label className="aiz-megabox d-block bg-white mb-0">
                                <input onChange={setAddress.bind(this,address)} type="radio" name="address_id" value={address.id} required />
                                <span className="d-flex p-3 aiz-megabox-elem">
                                    <span className="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                    <span className="flex-grow-1 pl-3 text-left">
                                        <div>
                                            <span className="opacity-60">{trans['Address']}:</span>
                                            <span className="fw-600 ml-2">{address.address}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['Postal Code']}:</span>
                                            <span className="fw-600 ml-2">{address.postal_code}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['City']}:</span>
                                            <span className="fw-600 ml-2">{address.city}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['Country']}:</span>
                                            <span className="fw-600 ml-2">{address.country}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['Phone']}:</span>
                                            <span className="fw-600 ml-2">{address.phone}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['Address Type']}:</span>
                                            <span className="fw-600 ml-2">{trans[address.adress_type]}</span>
                                        </div>
                                    </span>
                                </span>
                            </label>
                            <div className="dropdown position-absolute drop_menue_setting_address" >
                                <button className="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                    <i className="la la-ellipsis-v"></i>
                                </button>
                                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <button id='shipping_edit' type='button' className="dropdown-item shipping_btn" onClick={() => {
                                        setaddressId(address.id)
                                        setshowEdit(true)
                                    }} >
                                        {trans['Edit']}
                                    </button>
                                    <button type='button' id='shipping_delete' className="dropdown-item shipping_btn" onClick={() => {
                                        swalRemove(address.id)
                                    }} >
                                        {trans['Delete']}
                                    </button>
                                </div>
                            </div>

                        </div>
                    ))}
                    </div>
                    <div className="row">
                        <div onClick={() => {
                                      setshow(true)
                            }} className="col-md-6 mx-auto mb-3" >
                                    <div className="border p-3 rounded mb-3 c-pointer text-center bg-white h-100 d-flex flex-column justify-content-center" >
                                        <i className="las la-plus la-2x mb-3"></i>
                                        <div className="alpha-7">{ trans['Add New Address'] }</div>
                                    </div>
                                </div>
                    </div>
                </div>}

            <div>
                <AddAddressModal  show={show} handleClose={handleClose} handleSaveChange={handleSaveChange} />
            </div>
          <div>
               {addressId != 0? <EditAddressModal  show={showEdit} id={addressId} handleClose={handleCloseEdit} handleSaveChange={handleSaveChange} />:null}
            </div>

        </div>
    )
}
