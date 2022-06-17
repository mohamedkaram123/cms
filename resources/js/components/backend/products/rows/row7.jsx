import React, { useState,useContext } from 'react'
import { Urls } from '../../urls'
import { CheckRoles } from '../../../../context/CheckRoles';
import { encrypt ,hash_role} from '../../hashes';
export default function Row7({ row ,trans,swalRemove,swalduplicate,openModalAddRefurbished}) {
  const Roles = useContext(CheckRoles);
    const show_url = Urls.url + `product/${row.original.slug}`;
    const edit_url = Urls.static_url + `products/admin/${row.original.id}/edit${hash_role(15)}`;
    const duplicate_url = Urls.url + `products/duplicate/${row.original.id + hash_role(17)}`;


    return (
                     <div className="text-right">
                            <a className="btn btn-soft-success btn-icon btn-circle btn-sm"  href={show_url} target="_blank" title={trans['View'] }>
                                <i className="las la-eye"></i>
                            </a>
                            {Roles[15]?<a className="btn btn-soft-primary btn-icon btn-circle btn-sm" href={edit_url} title={trans['Edit'] }>
                                <i className="las la-edit"></i>
                            </a>:null

                            }
                             {Roles[17]?<button onClick={()=>{
                                swalduplicate(row.original.id)
                             }} className="btn btn-soft-warning btn-icon btn-circle btn-sm"  title={trans['Duplicate'] } >
                                <i className="las la-copy"></i>
                            </button>:null

                            }
                            {Roles[16]?<button onClick={()=>{
                                swalRemove(row.original.id)
                            }} className="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"  title={trans['Delete'] }>
                                <i className="las la-trash"></i>
                            </button>:null

                            }
                            {Roles[15]?(row.original.refurbished !=  1?<button onClick={()=>{openModalAddRefurbished(row.original)}} className="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"  title={trans['Refurbished'] }>
                                <i className="las la-sync-alt"></i>
                            </button>:null ) :null

                            }


                        </div>

    )
}
