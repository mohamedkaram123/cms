import React, { useContext } from 'react'
import { Urls } from '../../urls'
import { CheckRoles } from '../../../../context/CheckRoles';

export default function Row7({ row ,trans,swalRemove}) {
  const Roles = useContext(CheckRoles);



    return (
         <div className="text-right">

            { Roles[5]?<button onClick={()=>{
                                swalRemove(row.original.id)
                            }} className="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"  title={trans['Delete'] }>
                                <i className="las la-undo-alt"></i>
                            </button>:null}
                        </div>
    )
}
