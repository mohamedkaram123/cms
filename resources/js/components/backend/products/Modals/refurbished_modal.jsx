import React , {useRef,useEffect,useState} from 'react'
import axios from 'axios';
import { Urls } from "../../urls";
import LoadingInline from '../../../../helpers/LoadingInline';
import { Modal ,Button} from 'react-bootstrap';
import { csrf_token } from '../../../../helpers/Headers';
import SelectData  from "../../forms/SelectData";
// import InputData

export default function AddModal({handleClose,show,handleSaveChange,row,trans,refurbushedDegrees}) {

    // const [address, setaddress] = useState([])
   const [DataRefurbished, setDataRefurbished] = useState({
       "refurbished_degree_id": "",
       "product_id":row.id

    })

     const [RequireDataRefurbished, setRequireDataRefurbished] = useState({
         "refurbished_degree_id": "",
         "product_id":""

    })

    const [loadingBtn, setloadingBtn] = useState(false)

 const setData = (type, e) => {
    setDataRefurbished((prevState) => ({
        ...prevState,
        [type]: e.target.value
    }));

  }

    const handleSaveChangeAddress = () => {


        setloadingBtn(true);


        DataRefurbished["_token"] = csrf_token;
        console.log({ DataRefurbished });
        axios.post(Urls.static_url + "create_refurbished_product", DataRefurbished)
            .then(res => {
                console.log({res:res.data});

                if (res.data.status == 1) {
                                    setloadingBtn(false);
                handleSaveChange();
                handleClose();

                } else if(res.data.status == 0) {
                    for (const [key, value] of Object.entries(RequireDataRefurbished)) {

                        setRequireDataRefurbished((prevState) => ({
                            ...prevState,
                            [key]: (key in res.data.msg)?res.data.msg[key][0]:""
                        }));
                                setloadingBtn(false);

                    }
                }

                console.log(RequireDataRefurbished);
            })

                }
    return (
          <Modal  size="md" show={show} onHide={handleClose}>



                <div>

                <Modal.Header closeButton>
                <Modal.Title>{trans["Add Refurbished Product"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>
                    <div className="row">
                                          {/* <InputData name={trans("Name")} error={RequiredUserData} required={true} type="name" value={userData.name} onChange={setData} /> */}
                    <SelectData name={trans["Refurbished Degree"]}  error={RequireDataRefurbished } required={true}  options={refurbushedDegrees} col_md={12} type="refurbished_degree_id"  value={DataRefurbished.refurbished_degree_id} onChange={setData} />
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

              </Modal>
    )
}
