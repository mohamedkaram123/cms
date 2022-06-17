import React from 'react'
import { Urls } from "../components/backend/urls";

export default function LoadingCircle({size=80}) {
    return (
        <div style={{justifyContent:"center",alignItems:"center",display:"flex"}}>

            <img src={ Urls.public_url + "assets/img/Loading_2.gif"}   width={size} height={size} />

        </div>
    )
}
