import React , {useRef,useEffect,useState} from 'react'
import axios from 'axios';
import { Urls } from "../../urls";
import LoadingInline from '../../../../helpers/LoadingInline';
import { Modal ,Button} from 'react-bootstrap';
import { csrf_token } from '../../../../helpers/Headers';
export default function EditModal({handleClose,show,handleSaveChange,trans,id}) {

    // const [address, setaddress] = useState([])
        const [isLoading, setisLoading] = useState(true)
    const [DataPermissions, setDataPermissions] = useState({
        "title": "",
        "permission_link": "",
        "role_id": "",
        "id":id,
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
                get_data_adress(id);
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

                 setDataPermissions((prevState) => ({
                                                       ...prevState,
                                                       [type]: e.target.value
                 }));

    }


    const get_data_adress = (id) => {
        axios.get(Urls.static_url + `permission/edit/${id}`)
            .then(res => {
                setDataPermissions({
                           "title": res.data.permission.title,
        "permission_link": res.data.permission.permission_link,
        "role_id": res.data.permission.role_id,
                    "id": res.data.permission.id,
                })
                setroles(res.data.roles)


                                setisLoading(false)


            })
    }

    const handleSaveChangeAddress = () => {


        setloadingBtn(true);


        DataPermissions["_token"] = csrf_token;
        axios.post(Urls.static_url + "permission/update", DataPermissions)
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

            })

                }
    return (
          <Modal  size="md" show={show} onHide={handleClose}>

{isLoading?<LoadingInline />:

                <div>

                <Modal.Header closeButton>
                <Modal.Title>{trans["Update Permission"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>
                    <div className="row">
                            <div className="col-12">
                                  <div className="form-group">

                                <input type="text"
                                    className="form-control"
                                    placeholder={trans["Enter Your Title"]}
                                        onChange={enterPermissionData.bind(this, "title")}
                                         value={DataPermissions.title}
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
                                        value={DataPermissions.permission_link}
                                    required
                                    />
                                    {RequireDataPermissions.permission_link != ""?<small className="require_data">{ RequireDataPermissions.permission_link}</small>:null }
                                </div>
                            </div>

                            <div className="col-12">
                             <div className="form-group">
                            <select  value={DataPermissions.role_id} onChange={enterPermissionData.bind(this, "role_id")} className="form-control"  required>
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
