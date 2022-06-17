import React, { useState } from 'react'
import { Urls } from '../urls'

export default function BodyProducts({product,trans}) {

    const [colorItem, setColorItem] = useState(product.colors[0])

    return (
        <div>
           <div >
            <div style={{padding:10}}>
                <span className="d-flex align-items-center">
                        <img
                            src={Urls.public_url + product.photo}
                            className="img-fit lazyload size-100px rounded"
                        />

                            <div className="container">

                             <div className="row">
                             {
                                        product.colors.map((item,i)=>(

                                            <div key={product.id+ i} className="col-1">
                                         <label className="aiz-megabox pl-0 mr-2" data-toggle="tooltip" >
                                            <input
                                                type="radio"
                                                name={"color"+product.id}
                                                value={item}
                                                onChange={(e)=>{
                                                    setColorItem(e.target.value)
                                                }}

                                            />
                                            <span className="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                             <span className="size-30px d-inline-block rounded" style={{ background: item }} ></span>
                                            </span>
                                        </label>
                                            </div>

                                        ))
                                    }

                             </div>
                            <div className="row ">

                            <div className="col-sm-3">
                                        <div >{ trans['Product Name']}:</div>
                                    </div>
                                    <div className="col-sm-1">
                                        <div >
                                            <span>
                                            {product.name}

                                            </span>

                                        </div>
                                    </div>
                                    <div className="col-sm-1 offset-1">
                                        <div className="opacity-50">{ trans['Price']}:</div>
                                    </div>
                                    <div className="col-sm-4">
                                        <div className="opacity-60">
                                            <del>
                                                {product.price}

                                            </del>
                                        </div>
                                    </div>


                                </div>

                                <div className="row ">
                                    <div className="col-sm-2">
                                        <div className="opacity-50">{ trans['Discount Price']}:</div>
                                    </div>
                                    <div className="col-sm-4">
                                        <div className="">
                                            <span className=" text-primary">
                                                {product.discount_price}
                                            </span>

                                        </div>
                                    </div>

                                    <div className="col-sm-2">
                                        <div >{ trans['Total Price']}:</div>
                                    </div>
                                    <div className="col-sm-4">
                                        <div className="">
                                            <span className=" text-primary">
                                                {product.currency_symbol +""+ Number(product.total_price).toFixed(3) }
                                            </span>

                                        </div>
                                    </div>



                                </div>

                            </div>


                </span>
            </div>
        </div>
      </div>

    )
}
