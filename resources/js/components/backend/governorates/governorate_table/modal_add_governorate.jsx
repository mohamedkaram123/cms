import React,{useState,useRef,useEffect} from 'react'
import { Modal ,Button} from 'react-bootstrap';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import LoadingInline from "./LoadingInline";
import { Urls } from "../../urls";
import axios from "axios";

export default function ModalAddGovernorate({show,handleClose,trans,loadingupdate}) {



    const [governorateData, setgovernorateData] = useState({
        name: "",
        country_id: "1",

    })
    const [countriesData, setcountriesData] = useState([])
    const [loading, setloading] = useState(true)
    const [loadingBtn, setloadingBtn] = useState(false)
const [requiredname, setrequiredname] = useState(false)
    const mounted =  useRef(false)
    useEffect(() => {
        if (!mounted.current) {
getCountries()
            mounted.current = true;
        } else {

        }
    }, [])


    const getCountries = () => {
        axios.get(Urls.static_url + "governorate/countries")
            .then(res => {
                setcountriesData(res.data.countries)
                setloading(false)
            })

    }

    const sendData = () => {
        setloadingBtn(true);
        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        governorateData["_token"] = csrf_token;


        if (governorateData.name == "") {
            setrequiredname(true)
                    setloadingBtn(false);

        }else{
            setrequiredname(false)
                axios.post(Urls.static_url + "governorate/sendData",governorateData)
            .then(res => {
                setloadingBtn(false)
                let governorates = res.data.governorates;
                loadingupdate({limit:10,skip:0,objectData:governorates})
                handleClose()

            })
        }


    }

    return (
      <div>

         <Modal size="lg" show={show} onHide={handleClose}>
          <Modal.Header >
            <Modal.Title>{trans["Add Governorate"]}</Modal.Title>
          </Modal.Header>

                <Modal.Body>
                    {loading ? <LoadingInline /> :<>
                                              <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{trans["governorate name"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-flag"></i>
                                                </span>
                                           </div>
                                             <input type="text" onChange={e=>{
                                                    setgovernorateData((prevState) => ({
                                                                ...prevState,
                                                                name: e.target.value ,
                                                               }));
                                        }} placeholder={trans["governorate name"]} className="form-control" />
                                           </div>
                                    {requiredname? <small style={{color:"red"}}>{trans["please enter governorate name"]}</small> : null}

                                            </div>
                                    </div>

                                </div>
                                 <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label >{trans["country name"]} <span style={{color:"red"}}>*</span></label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-globe-europe"></i>
                                        </span>
                                           </div>

                                        <select onChange={e=>{
                                                    setgovernorateData((prevState) => ({
                                                                ...prevState,
                                                                country_id: e.target.value ,
                                                               }));
                                             }} className="form-control">
                                                    {
                                            countriesData.map((country, i) => (
                                                      <option key={i} value={country.id}>{country.name}</option>
                                                        ))
                                                    }
                                                </select>
                                           </div>
                                            </div>
                                    </div>

                                </div>
                                <div className="row">
                            <button onClick={sendData} className="btn btn-primary">

                                   {trans["Save Data"]}
                                            {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }

                                    </button>
                                </div>
                                </>
                                }
          </Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={handleClose}>
              {trans["Close"]}
            </Button>

          </Modal.Footer>
        </Modal>
      </div>
    );
  }
