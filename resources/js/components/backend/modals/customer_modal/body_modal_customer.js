import React from 'react'
import { Urls } from '../../urls'

export default function BodyModalCustomer({customer,classChooseCustomer,objectChoose}) {
    return (
        <div style={objectChoose[customer.id]?classChooseCustomer:null}>
            <div style={{border:"1px solid #eee",padding:10}}>
                <span className="d-flex align-items-center">
                        <img
                            src={Urls.public_url + "assets/img/avatar-place.png"}
                            className="img-fit lazyload size-60px rounded"
                        />
                        <span className="minw-0 pl-2 flex-grow-1">
                           <span className="fw-600 mb-1 text-truncate-2">
                                    {customer.name}
                            </span>
                            <span className="fw-600 mb-1 text-truncate-2">
                                    {customer.phone}
                            </span>

                        </span>
                </span>
            </div>
        </div>
    )
}
