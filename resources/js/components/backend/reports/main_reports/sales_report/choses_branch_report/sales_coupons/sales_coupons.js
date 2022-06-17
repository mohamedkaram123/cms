import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../../../../urls';
import NumberShow from '../../../percent_number'
import NumberCouponsSales from './number_coupons_sales';

export default function SalesCoupons({ state,startDate,endDate,loadDataSalesCoupons,data_is_reached,data_is_start_load}) {



       const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

            // callDataSales(startDate,endDate);
        mounted.current = true;
      } else {

          if (loadDataSalesCoupons == true) {
              callDataSalesCoupons(startDate, endDate);

          }
        // do componentDidUpdate logic
      }
    }, [loadDataSalesCoupons]);


    const [isLoading, setisLoading] = useState(true)
         const [total_discount_amount, settotal_discount_amount] = useState(0)
         const [total_discount_percent, settotal_discount_percent] = useState(0)
         const [total_coupons_usage, settotal_coupons_usage] = useState(0)
         const [coupons_chart_data, setcoupons_chart_data] = useState([])

    // const [prices, setPrices] = useState({
    //               number_product_sales: 0,
    //               price_product_sales: 0,
    //  })

    // const [percents, setPercent] = useState({
    //              number_product_sales: 0,
    //               price_product_sales: 0,
    //  })

     const callDataSalesCoupons = (startDate,endDate)=>{
data_is_start_load("sales")
        setisLoading(true)

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+"main/report/sales_coupons_data",data)
            .then(res => {


                settotal_discount_amount(res.data.total_discount_amount)
                settotal_discount_percent(res.data.total_discount_percent)
                settotal_coupons_usage(res.data.total_coupons_usage)
                setcoupons_chart_data(res.data.coupons_chart_data)



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

                        <span>{state.trans["Sales Coupons"]}</span>

                    </div>
                    <div className="card-body">
                        <table className="table table-borderless " >

                            <tbody>
                                <tr style={{ borderTop: "0" }}>
                                    <th scope="row">{state.trans["Total Coupons Discount Amount"]}</th>
                                    <td><NumberShow price={total_discount_amount} percent={0} /> </td>
                                </tr>
                                <tr>
                                    <th scope="row">{state.trans["Total Coupons Discount Percent"]}</th>
                                    <td> <NumberShow price={total_discount_percent} percent={0} /> </td>
                                </tr>
                                <tr>
                                    <th scope="row">{state.trans["Total Coupons Usages"]}</th>
                                    <td> <NumberShow price={total_coupons_usage} percent={0} /> </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

          <div className="col-md-6 col-12">
                  <div className="card " style={{boxShadow: "5px 5px 5px #eee"}}>

            <div className="card-header" style={{background:"#eee", }}>

               <span>{state.trans["Coupons Number Usage"]}</span>

            </div>
            <div style={{direction:"ltr"}} className="card-body">

                                               <NumberCouponsSales dataChart={coupons_chart_data}  />

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
