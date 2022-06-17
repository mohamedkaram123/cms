import React , {useRef,useEffect,useState} from 'react'
import axios from 'axios';
import { Urls } from "../../../backend/urls";
import LoadingInline from '../../../../helpers/LoadingInline';
import { Modal ,Button} from 'react-bootstrap';
import { csrf_token } from '../../../../helpers/Headers';
export default function AddModal({handleClose,show,handleSaveChange,trans}) {

    // const [address, setaddress] = useState([])
        const [isLoading, setisLoading] = useState(true)
    const [DataPermissions, setDataPermissions] = useState({
        "title": "",
        "permission_link": "",
        "role_id": "",
    })

     const [RequireDataPermissions, setRequireDataPermissions] = useState({
         "title": "",
        "permission_link": "",
        "role_id": "",
    })


        const [roles, setroles] = useState([])

    const [loadingBtn, setloadingBtn] = useState(false)

    const mounted = useRef(false)
        useEffect(() => {

            if (!mounted.current) {
                // adress();
                roles_data();
            mounted.current = true;
        }


    }, [])

 const roles_data = () => {
        axios.get(Urls.static_url + "permission/allRoles")
            .then(res => {
                setroles(res.data.roles)
                        setisLoading(false)

            })
    }


    const enterPermissionData = (type,e) => {
        console.log({ essss: e,type});

                 setDataPermissions((prevState) => ({
                                                       ...prevState,
                                                       [type]: e.target.value
                 }));

    }

    const handleSaveChangeAddress = () => {


        setloadingBtn(true);


        DataPermissions["_token"] = csrf_token;
        console.log({ DataPermissions });
        axios.post(Urls.static_url + "permission/store", DataPermissions)
            .then(res => {

                if (res.data.status == 1) {
                                    setloadingBtn(false);
                handleSaveChange();
                handleClose();

                } else if(res.data.status == 0) {
                    for (const [key, value] of Object.entries(RequireDataPermissions)) {

                        setRequireDataPermissions((prevState) => ({
                            ...prevState,
                            [key]: (key in res.data.msg)?res.data.msg[key][0]:""
                        }));
                                setloadingBtn(false);

                    }
                }

                console.log(RequireDataPermissions);
            })

                }
    return (
          <Modal  size="md" show={show} onHide={handleClose}>

{isLoading?<LoadingInline />:

                <div>

                <Modal.Header closeButton>
                <Modal.Title>{trans["Add Permission"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>
                    <div className="row">
                            <div className="col-12">
                                  <div className="form-group">

                                <input type="text"
                                    className="form-control"
                                    placeholder={trans["Enter Your Title"]}
                                    onChange={enterPermissionData.bind(this, "title")}
                                    required
                                    />
                                    {RequireDataPermissions.title != ""?<small className="require_data">{ RequireDataPermissions.title}</small>:null }
                                </div>
                            </div>
                            <div className="col-12">
                             <div className="form-group">
                                <input type="text"
                                    className="form-control"
                                    placeholder={trans["Link Permission"]}
                                    onChange={enterPermissionData.bind(this, "permission_link")}
                                    required
                                    />
                                    {RequireDataPermissions.permission_link != ""?<small className="require_data">{ RequireDataPermissions.permission_link}</small>:null }
                                </div>
                            </div>

                            <div className="col-12">
                             <div className="form-group">
                            <select onChange={enterPermissionData.bind(this, "role_id")} className="form-control"  required>
                               <option value="">{trans["Choose Role"]}</option>
                                {roles.map((item, i) => (
                                    <option key={i} value={item.id}>{item.name}</option>
                                ))}
                            </select>
                                {RequireDataPermissions.role_id != ""?<small className="require_data">{ RequireDataPermissions.role_id}</small>:null }
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
