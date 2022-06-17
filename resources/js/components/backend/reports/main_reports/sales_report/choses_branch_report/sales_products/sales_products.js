import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../../../../urls';
import NumberShow from '../../../percent_number'

export default function SalesProducts({ state,startDate,endDate,loadDataSalesProduct,data_is_reached,data_is_start_load}) {



       const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

            // callDataSales(startDate,endDate);
        mounted.current = true;
      } else {

          if (loadDataSalesProduct == true) {
              callDataSalesProducts(startDate, endDate);

          }
        // do componentDidUpdate logic
      }
    }, [loadDataSalesProduct]);


    const [isLoading, setisLoading] = useState(true)
         const [products, setProducts] = useState([])

    const [prices, setPrices] = useState({
                  number_product_sales: 0,
                  price_product_sales: 0,
     })

    const [percents, setPercent] = useState({
                 number_product_sales: 0,
                  price_product_sales: 0,
     })

     const callDataSalesProducts = (startDate,endDate)=>{
data_is_start_load("sales")
        setisLoading(true)

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+"main/report/sales_products",data)
            .then(res => {

                       setPrices((prevState) => ({
                         ...prevState,
                  number_product_sales: res.data.number_product_sales,
                  price_product_sales: res.data.price_product_sales,
                       }));
                setProducts(res.data.products)


                setisLoading(false)
                data_is_reached("sales")
                // setisLoading(false)



        })
        .catch(err=>{

        })
    }



    if (isLoading) {
        return (
            <div>
            </div>
        )
    } else {


        return (
            <div>

                <div className="row" style={{ justifyContent: "space-around" }}>

            <div className="col-md-6 col-12">
       <div className="card" style={{ boxShadow: "5px 5px 5px #eee" }} >

                    <div className="card-header" style={{ background: "#eee" }}>

                        <span>{state.trans["Sales Products"]}</span>

                    </div>
                    <div className="card-body">
                        <table className="table table-borderless " >

                            <tbody>
                                <tr style={{ borderTop: "0" }}>
                                    <th scope="row">{state.trans["Number Product Sales"]}</th>
                                    <td><NumberShow price={prices.number_product_sales} percent={0} /> </td>
                                </tr>
                                <tr>
                                    <th scope="row">{state.trans["Product Sales Total Prices"]}</th>
                                    <td> <NumberShow price={prices.price_product_sales} percent={0} /> </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

          <div className="col-md-6 col-12">
                  <div className="card " style={{boxShadow: "5px 5px 5px #eee"}}>

            <div className="card-header" style={{background:"#eee", }}>

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


                </div>

        {/* <div className="row">
            <div className="col-12">
             <div className="card" style={{ boxShadow: "5px 5px 5px #eee" }}>

            <div className="card-header" style={{background:"#eee"}}>

               <span>{state.trans["AVG Bascktes"]}</span>

            </div>
            <div className="card-body">
             <div className="d-flex flex-row">
                    <div className="p-2">
                        <h1>{avgPrice}</h1>
                    </div>
                    <div className="p-2">

                    </div>
                </div>
                <ChartAvgCarts data_avg_carts={data_avg_carts} trans={state.trans} />
            </div>
        </div>
            </div>
        </div> */}

            </div>
        )
    }
}
