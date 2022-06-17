import React,{useState,useRef,useEffect} from 'react'
import { Urls } from '../../backend/urls';
import axios from 'axios';
import LoadingInline from '../../../helpers/LoadingInline';
import AddModal from './permissionsModals/addModal';
import EditModal from './permissionsModals/editModal';
export default function Permission() {

    const [trans, settrans] = useState({
        "Title Permission": "",
        "Permission Link": "",
        "Role": "",
        "Created At": "",
        "Updated": "",
        "Not Found Rows": "",
        "Add Permissions": "",
        "Permissions": "",
        "Enter Your Title": "",
        "Link Permission": "",
        "Choose Role": "",
        "Close": "",
        "Save Changes":"",
        "Add Permission": "",
        "Edit": "",
        "Update Permission":""

    })

const [isLoading, setisLoading] = useState(true)
    const [allPermissions, setallPermissions] = useState([])
    const [showAddModal, setshowAddModal] = useState(false)
const [rowId, setrowId] = useState("")

    const [showEditModal, setshowEditModal] = useState(false)
    const handleCloseAddModal = () => {
        setshowAddModal(false)
    }


        const handleCloseEditModal = () => {
        setshowEditModal(false)
    }


  const  handleSaveChangeAddModal = () => {
        setisLoading(true)
        all_permissions()

    }
          const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic
        callTrans(trans)
          all_permissions()
        //   BrandsCountData();
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);
     const  callTrans = (transes)=>{

        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data_post = {
            data: transes,
            "_token": csrf_token
        }
        axios.post(Urls.static_url + "trans_data", data_post)
            .then(res => {


                settrans(res.data)
            })
            .catch(err => {

            })
     }


     const  all_permissions = ()=>{

        axios.get(Urls.static_url + "permission/allPermissions")
            .then(res => {


                setallPermissions(res.data.permissions)
                                setisLoading(false);

            })
            .catch(err => {

            })
    }

    return (
        <div>
            {isLoading ? <LoadingInline /> :
                <div className="row">
                    <div className="col-12">
                        <div className="card">
                            <div className="card-header">
                                <span>{trans["Permissions"]}</span>
                                <button onClick={() => {
                                            setshowAddModal(true)

                                }} className='btn btn-primary'>{ trans["Add Permissions"]} <i className="las la-plus"></i></button>
                            </div>
                            <div className="card-body table-responsive" >

                                <table className="table" >
                                    <thead className="table-light">
                                        <tr>
                                            <th className='text-center' scope="col">{trans["Title Permission"]}</th>
                                            <th className='text-center' scope="col">{trans["Permission Link"]}</th>
                                            <th className='text-center' scope="col">{trans["Role"]}</th>
                                            <th className='text-center' scope="col">{trans["Created At"]}</th>
                                            <th className='text-center' scope="col">{trans["Edit"]}</th>

                                        </tr>
                                    </thead>
                                    <tbody >

                                        {
                                              allPermissions.map((item, i) => {
                                                return (
                                                    <tr key={i}>

                                                        <td className='text-center'>{item.title}</td>
                                                        <td className='text-center'>{item.permission_link}</td>
                                                        <td className='text-center'>{item.roles}</td>
                                                        <td className='text-center'>{item.created_at}</td>
                                                        <td className='text-center'><button onClick={() => {
                                                            setrowId(item.id)
                                                            setshowEditModal(true)
                                                        }} className='btn-md btn-circle btn-info'><i  className="las la-edit"></i></button></td>
                                                    </tr>
                                                )
                                            })
                                        }

                                    </tbody>
                                </table>
                                {/* {loadData ? <LoadingInline /> : null} */}
                            </div>

                        </div>


                    </div>
                    <div>
                        <AddModal trans={trans} show={showAddModal} handleClose={handleCloseAddModal} handleSaveChange={handleSaveChangeAddModal} />
                    </div>

                    <div>
                        {rowId != "" ? <EditModal id={rowId} trans={trans} show={showEditModal} handleClose={handleCloseEditModal} handleSaveChange={handleSaveChangeAddModal} /> : null}
                    </div>

                </div>}
        </div>
    )
}
