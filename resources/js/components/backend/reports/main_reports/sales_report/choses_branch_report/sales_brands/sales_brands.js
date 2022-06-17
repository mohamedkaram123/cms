import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../../../../urls';
import NumberBrandsSales from './number_brands_sales';

export default function SalesBrands({ state,startDate,endDate,loadDataSalesBrands,data_is_reached,data_is_start_load}) {



       const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

            // callDataSales(startDate,endDate);
        mounted.current = true;
      } else {

          if (loadDataSalesBrands == true) {
              callDataSalesProducts(startDate, endDate);

          }
        // do componentDidUpdate logic
      }
    }, [loadDataSalesBrands]);


    const [isLoading, setisLoading] = useState(true)
         const [brands, setBrands] = useState([])

    // const [prices, setPrices] = useState({
    //               number_product_sales: 0,
    //               price_product_sales: 0,
    //  })

    // const [percents, setPercent] = useState({
    //              number_product_sales: 0,
    //               price_product_sales: 0,
    //  })

     const callDataSalesProducts = (startDate,endDate)=>{
data_is_start_load("sales")
        setisLoading(true)

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+"main/report/all_brands_products_sale",data)
            .then(res => {

                //        setPrices((prevState) => ({
                //          ...prevState,
                //   number_product_sales: res.data.number_product_sales,
                //   price_product_sales: res.data.price_product_sales,
                //        }));
                setBrands(res.data.brands)


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

            <div className="col-12">
       <div className="card" style={{ boxShadow: "5px 5px 5px #eee" }} >

                    <div className="card-header" style={{ background: "#eee" }}>

                        <span>{state.trans["Sales Products"]}</span>

                    </div>
                    <div style={{direction:"ltr"}} className="card-body">

                                <NumberBrandsSales dataChart={brands}  />

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
