import React from 'react'
import { Urls } from '../urls'

export default function LoadingInline() {
    return (
        <div style={{justifyContent:"center",alignItems:"center",display:"flex"}}>

            <img src={ Urls.public_url + "assets/img/loader.gif"}   width={80} height={80} />

        </div>
    )
}
