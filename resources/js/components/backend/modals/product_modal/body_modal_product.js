import React, { useState } from 'react'
import { Urls } from '../../urls'

export default function BodyModalProduct({product,trans,handleAddDataProduct,handleremoveDataProduct}) {

    const [minQuantity, setMinQuantity] = useState(product.min_qty)
    const [disableMines, setDisableMines] = useState(true)
    const [disablePlus, setDisablePlus] = useState(product.current_stock == product.min_qty?true:false)
    const [totalPrice, setTotalPrice] = useState(product.total_price)
    const [colorItem, setColorItem] = useState(product.colors[0])
    const [backgroundColor, setbackgroundColor] = useState({})

    const [productData, setproductData] = useState([])

const handleDisableButton = (val)=>{


    setTotalPrice(val * (product.total_price / product.min_qty ) )
    if(val <= product.min_qty){
        setDisableMines(true)
    }else if(val > product.min_qty){
        setDisableMines(false)

    }
    if(val >= product.current_stock){
        setDisablePlus(true)
    }else if(val < product.current_stock){
        setDisablePlus(false)

    }

}
    return (
        <div >
            <div style={{border:"1px solid #eee",padding:10}}>
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

                                    <div className="col-7 " style={{display:'flex',justifyContent:'center',alignItems:"center"}}>
                                    <button disabled={disableMines} onClick={()=>{
                                       setMinQuantity(minQuantity - 1)
                                       handleDisableButton(minQuantity - 1)

                                    }} className="btn  btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" >
                                                    <i className="las la-minus"></i>
                                                </button>
                                                <input type="text" name="quantity" style={{width:40}} className=" border-0 text-center input-number"  value={ minQuantity }   readOnly />
                                                <button disabled={disablePlus} onClick={()=>{


                                        setMinQuantity(minQuantity + 1)
                                        handleDisableButton(minQuantity + 1)



                                    }} className="btn btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                                    <i className="las la-plus"></i>
                                                </button>
                                    </div>
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

                                    <div className="col-2">
                                        <button style={backgroundColor} onClick={()=>{

                                           let productData={
                                            id:product.id,
                                            quantity:minQuantity,
                                            color:colorItem,
                                            totalPrice:totalPrice
                                           };
                                            if(Object.keys(backgroundColor).length === 0){
                                                setbackgroundColor({
                                                    color:"#fff",backgroundColor:'#FF6900'
                                                })
                                                handleAddDataProduct(productData)
                                            }else{
                                                setbackgroundColor({})
                                                handleremoveDataProduct(productData)

                                            }

                                        }} className="btn btn-icon btn-light"><i className="las la-shopping-basket"></i></button>
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
                                                {product.currency_symbol +""+ Number(totalPrice).toFixed(3) }
                                            </span>

                                        </div>
                                    </div>



                                </div>

                            </div>


                </span>
            </div>
        </div>
    )
}
