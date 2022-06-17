import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../urls'

export default function BodyModalProduct({product,trans,handleAddDataProduct,handleremoveDataProduct,products,selected_item,selectedItemProduct}) {


    const [backgroundColor, setbackgroundColor] = useState({})




    const mounted = useRef(false);
  useEffect(() => {


        if (!mounted.current) {
            // do componentDidMount logic
            let cehckproduct =  containsObject(product,products);
            if(cehckproduct){
              setbackgroundColor({
                  color:"#fff",backgroundColor:'#FF6900'
              })
            }
            mounted.current = true;

          } else {

            if (selectedItemProduct == product.id) {
                              setbackgroundColor({
                                   color:"#fff",backgroundColor:'#FF6900'
                                     })

            } else {
                setbackgroundColor({})
            }
            // getShippingData(dataShippingInfo)

            // do componentDidUpdate logic
          }
    },[selectedItemProduct])



    const containsObject = (obj, list)=>{
        var i;
        for (i = 0; i < list.length; i++) {
            if (list[i] === obj) {
                return true;
            }
        }

        return false;
    }

    return (
        <div >
            <div style={{border:"1px solid #eee",padding:10}}>
                <span className="d-flex align-items-center">
                        <img
                            src={Urls.public_url +  product.photo}
                            className="img-fit lazyload size-100px rounded"
                        />

                            <div className="container">

                        <div className="d-flex" style={{justifyContent:"space-around"}}>
                            <div className="d-flex flex-column">
                                <div className="d-flex flex-row">
                                        <span >{ trans['Product Name']}: </span>
                                        <span>{product.name}</span>
                                </div>

                                <div className="d-flex flex-row">
                                        <span >{ trans['Price']}: </span>
                                    {product.price_discount != product.price ? <del>{product.price}</del> :<span>{product.price}</span>}
                                </div>
                                {
                                    product.price_discount != product.price ?
                                        <div className="d-flex flex-row">
                                        <span >{ trans['Price Discount']}: </span>
                                        <span>{product.price_discount}</span>
                                </div>:false
                                }

                            </div>

                            <button style={backgroundColor} onClick={()=>{

                                           let productData={
                                            id:product.id,
                                           };
                                    if (Object.keys(backgroundColor).length === 0) {
                                        if (selected_item != 1) {
                                                        setbackgroundColor({
                                                    color:"#fff",backgroundColor:'#FF6900'
                                                })
                                                }

                                                handleAddDataProduct(product)
                                    } else {

                                        if (selected_item != 1) {

                                            setbackgroundColor({})
                                        }
                                                handleremoveDataProduct(product)

                                            }

                                        }} className="btn btn-icon btn-light"><i className="las la-shopping-basket"></i></button>
                        </div>


                            </div>


                </span>
            </div>
        </div>
    )
}
