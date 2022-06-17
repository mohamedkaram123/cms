import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../../../urls'

export default function ProductsQuantity({ state , startDate,endDate ,data_is_reached,data_is_start_load,loadDataProduct  }) {


    const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

        //    loadProduct();
        mounted.current = true;
      } else {

          if (loadDataProduct == true) {
          loadProduct(startDate, endDate);

          }
        // do componentDidUpdate logic
      }
    }, [loadDataProduct]);


     const [isLoading, setisLoading] = useState(true)
     const [products, setproducts] = useState([])


    const loadProduct = (startDate,endDate) => {
        data_is_start_load("product")

        setisLoading(true)
         let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+"main/report/products",data)
        .then(res=>{

            // this.convert_price(res)
          setproducts(res.data.products)
              setisLoading(false)
                data_is_reached("product")



        })
        .catch(err=>{

        })
    }


    if (isLoading) {
        return (
        <div>
            {/* <LoadingInline /> */}
        </div>
    )
    } else {
            return (
        <div>
             <div className="card ">

            <div className="card-header" style={{background:"#eee"}}>

               <span>{state.trans["Products"]}</span>

            </div>
            <div className="card-body">

                    <div className="row" style={{marginBlock:10}}>
                        <div className="col-8">
                            <span style={{fontSize:14}}>{state.trans["Product"]}</span>
                        </div>
                        <div className="col-4">
                          <span style={{fontSize:14}}>{state.trans["Product Quantity"]}</span>
                        </div>
                    </div>

                    {
                        products.map((item, i) => (
                    <div className="row" key={i}>
                        <div className="col-8">
                            <div className="d-flex flex-row">
                                <div className="p-2">
                                       <img src={ item.photos} style={{width:50,height:50}} />
                                </div>
                                <div className="p-2">
                                            <a href={item.slug}>{ item.name}</a>
                                </div>
                            </div>
                        </div>
                        <div className="col-4">
                                    <a href={item.slug}>{ item.num_of_sale}</a>
                        </div>
                    </div>
                        ))
                    }

            </div>
        </div>

        </div>
    )
}
}
