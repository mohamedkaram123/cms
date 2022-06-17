import React from 'react'
import { Urls } from '../../backend/urls'

export default function customNotification(data) {
    return (
        <div className="container"  style={{background:'#fff',paddingInline:10,paddingTop:8,borderRadius:10,boxShadow:" 5px 10px 18px #888888"}}>

        <div className="row">
            <div className="col-2" >
            <img src={Urls.public_url +"assets/img/sala.png"} className="rounded" style={{width:80,height:80,borderRadius:50,marginBottom:10}} />

            </div>

            <div className="col-10">
                <div className="col-12">
                <p style={{fontSize:14,fontWeight:"bold"}}>{data.title}</p>

                </div>
                <div className="col-12">
                <p style={{fontSize:12}}>{data.body}</p>

                </div>

            </div>

        </div>
{/*
        <div className="row">

        <div className="col-3">

        </div>
        <div className="col-9">
        <p>this is new cart user mohamed karam accepted in user dsds</p>

        </div>

        </div> */}

        </div>
    )
}
