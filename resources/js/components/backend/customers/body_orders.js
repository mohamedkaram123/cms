import React from 'react'
import { encrypt } from '../hashes'
import { Urls } from '../urls'

export default function BodyOrders({item,trans}) {
    return (
        <div>
            <div className="card">
                <div className="card-header">
                    <span style={{ fontSize: 18, color: "#3598f8",marginInline:10 }}>{trans["order code"] + " " + item.code}</span>
                    <span style={{ fontSize: 18, color: "#aaa" }}>{trans["order created at"] + " " + item.created_at}</span>
                </div>
                <div className="card-body">
                    <div className="d-flex flex-row">
                        <div className="p-2">
                            <img src={Urls.public_url + item.file_name} style={{width:100,height:80}} />
                        </div>
                        <div className="p-2">
                            <div className="d-flex flex-column">
                                <div className="p-2">
                                    <span style={{fontSize:14}}>{item.name}</span>
                                </div>
                                  <div className="p-2">
                                    <span style={{fontSize:18,color:"#3598f8"}}>{item.delivery_status}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="card-footer">
                    <a href={Urls.static_url + "all_orders/" + encrypt((item.id).toString()) + "/show"} type="button" className="btn btn-outline-primary">{ trans["review this is order"]}</a>
                </div>
            </div>
        </div>

    )
}
