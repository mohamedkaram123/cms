import React from 'react'
import { Urls } from "../backend/urls"
export default function ErrorConnection() {
    return (
        <div>
            <section className="text-center py-6">
	<div className="container">
		<div className="row">
			<div className="col-lg-6 mx-auto">
				<img src={Urls.public_url + "assets/img/500.svg" }  className="img-fluid w-75" />
				<h1 style={{color:"#8d8c8c"}} className="h2 fw-700 mt-5">There is a problem with the connection !</h1>
			</div>
		</div>
	</div>
</section>
        </div>
    )
}
