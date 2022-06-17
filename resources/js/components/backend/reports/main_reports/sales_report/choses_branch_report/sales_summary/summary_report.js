import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import { decryptLocalStorage, encryptLocalStorage } from '../../../../../hashes';
import { Urls } from '../../../../../urls';
import NumberShow from '../../../percent_number'
import ChartDates from '../sales_summary/chars';
import ChartAvgCarts from '../sales_summary/chart_avg_cart';
export default function SummaryReport({ state,startDate,endDate,loadDataSales,data_is_reached,data_is_start_load}) {



       const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

            // callDataSales(startDate,endDate);
        mounted.current = true;
      } else {

          if (loadDataSales == true) {
                        callDataSales(startDate, endDate);

                        loadLocalStorage()

          }
        // do componentDidUpdate logic
      }
    }, [loadDataSales]);


     const [isLoading, setisLoading] = useState(true)
    const [prices, setPrices] = useState({
            sales: 0,
                  product_prices: 0,
                  discount: 0,
                  taxes:0,
                  shipping_cost:0,
                  sales_elec_pay:0
     })

    const [percents, setPercent] = useState({
                sales:0,
            product_prices:0,
            discount:0,
     })
    const [data_avg_carts, setdata_avg_carts] = useState([])
        const [sales, setsales] = useState([])

        const [avgPrice, setavgPrice] = useState(0)


     const callDataSales = (startDate,endDate)=>{
data_is_start_load("sales")
        setisLoading(true)

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+"main/report/sales",data)
            .then(res => {

                  encryptLocalStorage(res.data,"report_sales_summary")

                       setPrices((prevState) => ({
                        ...prevState,
            sales: res.data.sales_now,
                  product_prices: res.data.product_prices,
                  discount: res.data.discount,
                  taxes:res.data.taxes,
                  shipping_cost:res.data.shipping_cost,
                           sales_elec_pay: res.data.sales_elec_pay,
                       }));

                      setPercent((prevState) => ({
                        ...prevState,
          sales:res.data.change_per_24,
            product_prices:res.data.change_per_24_product_price,
            discount:res.data.change_per_24_product_discount,
                      }));
                setdata_avg_carts(res.data.data_avg_carts)
                setavgPrice(res.data.avgPrice)
                setsales(res.data.sales_chart)
                setisLoading(false)
                data_is_reached("sales")
                // setisLoading(false)



        })
        .catch(err=>{

        })
    }



  const  loadLocalStorage = () => {
               if (decryptLocalStorage("report_sales_summary") !== null) {

                                 let data = decryptLocalStorage("report_sales_summary");

                                             setPrices((prevState) => ({
                        ...prevState,
            sales: data.sales_now,
                  product_prices: data.product_prices,
                  discount: data.discount,
                  taxes:data.taxes,
                  shipping_cost:data.shipping_cost,
                           sales_elec_pay: data.sales_elec_pay,
                       }));

                      setPercent((prevState) => ({
                        ...prevState,
          sales:data.change_per_24,
            product_prices:data.change_per_24_product_price,
            discount:data.change_per_24_product_discount,
                      }));
                setdata_avg_carts(data.data_avg_carts)
                setavgPrice(data.avgPrice)
                setsales(data.sales_chart)
                setisLoading(false)
                data_is_reached("sales")
                    }
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

                        <span>{state.trans["Sales"]}</span>

                    </div>
                    <div className="card-body">
                        <table className="table table-borderless " >

                            <tbody>
                                <tr style={{ borderTop: "0" }}>
                                    <th scope="row">{state.trans["Sales"]}</th>
                                    <td><NumberShow price={prices.sales} percent={percents.sales} /> </td>
                                </tr>
                                <tr>
                                    <th scope="row">{state.trans["Product price"]}</th>
                                    <td> <NumberShow price={prices.product_prices} percent={percents.product_prices} /> </td>
                                </tr>
                                <tr>
                                    <th scope="row">{state.trans["Taxes"]}</th>
                                    <td><NumberShow price={prices.taxes} percent={0} /></td>
                                </tr>
                                <tr >
                                    <th scope="row">{state.trans["Discounts"]}</th>
                                    <td><NumberShow price={prices.discount} percent={percents.discount} /></td>
                                </tr>
                                <tr >
                                    <th scope="row">{state.trans["Shipping Cost"]}</th>
                                    <td><NumberShow price={prices.shipping_cost} percent={0} /></td>
                                </tr>
                                <tr >
                                    <th scope="row">{state.trans["Sales By Elec Pay"]}</th>
                                    <td><NumberShow price={prices.sales_elec_pay} percent={0} /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

          <div className="col-md-6 col-12">
                      <div className="card" style={{ boxShadow: "5px 5px 5px #eee" }} >

            <div className="card-header" style={{background:"#eee"}}>

               <span>{state.trans["Number Order Sales"]}</span>

            </div>
            <div style={{direction:"ltr"}} className="card-body">

                <ChartDates trans={state.trans} dataChart={sales} />
            </div>
        </div>


              </div>


                </div>

        <div className="row">
            <div className="col-12">
             <div className="card" style={{ boxShadow: "5px 5px 5px #eee" }}>

            <div className="card-header" style={{background:"#eee"}}>

               <span>{state.trans["AVG Bascktes"]}</span>

            </div>
            <div style={{direction:"ltr"}} className="card-body">
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
        </div>

            </div>
        )
    }
}
