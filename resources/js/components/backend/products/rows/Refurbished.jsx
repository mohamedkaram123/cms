
import React,{useState} from 'react'
export default function Refurbished({ row ,trans}) {

    if (row.original.refurbished == 1) {
        return <span className='badge badge-success' style={{width:"auto"}}>{ trans["Refurbished"]}</span>
    } else {
                return <span className='badge badge-info' style={{width:"auto"}}>{ trans["unRefurbished"]}</span>

    }

}

