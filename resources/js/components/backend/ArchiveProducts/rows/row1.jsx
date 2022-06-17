import React from 'react'
import { Urls } from '../../urls'
export default function Row1({row}) {
    return (
        <div className='d-flex flex-row'>
            <img src={Urls.public_url + row.original.photo} className='size-50px img-fit' />
            <span  className="text-muted text-truncate-2" style={{marginInline:10}}>{row.original.name }</span>
        </div>
    )
}
