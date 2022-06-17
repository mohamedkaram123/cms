import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../../../urls'

export default function AbandonedBaskets({ state , startDate,endDate ,loadDataAbanfonedBaskets,data_is_reached,data_is_start_load }) {


    const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

         //   loadAbandonedBaskets();
        mounted.current = true;
      } else {


          if (loadDataAbanfonedBaskets == true) {
          loadAbandonedBaskets(startDate, endDate);

          }
        // do componentDidUpdate logic
      }
    }, [loadDataAbanfonedBaskets]);


     const [isLoading, setisLoading] = useState(true)
     const [AbandonedBaskets, setAbandonedBaskets] = useState([])


    const loadAbandonedBaskets = (startDate, endDate) => {
                data_is_start_load("product")

        setisLoading(true)
         let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+"main/report/abandoned_baskets",data)
        .then(res=>{

            // this.convert_price(res)
          setAbandonedBaskets(res.data.abandoned_baskets)
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

               <span>{state.trans["Abandoned Baskets"]}</span>

            </div>
            <div className="card-body">
                    <table className="table">
                    <thead>
                        <tr>
                        <th scope="col">{state.trans["Customer Name"]}</th>
                        <th scope="col">{state.trans["Customer Phone"]}</th>
                        <th scope="col">{state.trans["Product"]}</th>
                        <th scope="col">{state.trans["Date Add In Baskets"]}</th>
                        <th scope="col">{state.trans["Product Quantity"]}</th>
                        <th scope="col">{state.trans["Basket Product Price"]}</th>

                        </tr>
                    </thead>
                    <tbody>
                        {
                          AbandonedBaskets.map((item,i)=>(
                                    <tr key={i} style={{borderTop:'hidden'}}>
                                    <td>{item.name}</td>
                                    <td>{item.phone}</td>
                                    <td><a href={Urls.url + "product/" + item.slug}>{item.product_name}</a></td>
                                    <td>{item.created_at}</td>
                                    <td>{item.quantity}</td>
                                    <td>{item.prices}</td>

                                    </tr>
                          ))
                        }
                    </tbody>
                    </table>

            </div>
        </div>

        </div>
    )
}
}
