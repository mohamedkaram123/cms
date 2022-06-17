import React, { useEffect, useRef, useState } from 'react'
import {
  Chart,

  Axis,
  Tooltip,

  Interval
} from "bizcharts";
import axios from 'axios';
import { Urls } from '../../urls'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'


    export default function  Number_of_Stock_Products({trans,start_date,end_date,status_date,handleErrorLoad}){
    const [isLoading, setisLoading] = useState(true)
    const [numberOfStockProducts, setnumberOfStockProducts] = useState([])

    var data = [
      {
        name: "John",
        number: 35654
      },
      {
        name: "Damon",
        number: 65456
      },
      {
        name: "Patrick",
        number: 45724
      },
      {
        name: "Mark",
        number: 13654
      }
    ];

    const scale = {
      vote: {
        min: 0
      }
    };
            const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic
        number_of_stock_products(isLoading)



        //   BrandsCountData();
        mounted.current = true;
      } else {

   if (status_date == "number_of_stock_products" || status_date == "all") {
                            number_of_stock_products(true);

          }


        // do componentDidUpdate logic
      }
    }, [start_date,end_date]);

        const number_of_stock_products = (loading = false) => {
                                                 setisLoading(loading)

        axios.get(Urls.static_url + "number_of_stock_products?start_date="+start_date+"&end_date="+end_date)
            .then(res => {

                setnumberOfStockProducts(res.data.number_of_stock_products)
                        //   encryptLocalStorage(res.data.number_of_stock_products,'number_of_stock_products');
                 setisLoading(false)


            })
            .catch(err => {
            handleErrorLoad()
        })
    }

        if (isLoading) {
            return (
                <SkeletonTheme color="#fff" highlightColor="#eee" >


                   <div className="card">
                <div className="card-header">
                    <h6 className="mb-0 fs-14">{ trans['Category wise product stock'] }</h6>
                </div>
                <div className="card-body">
                  <Skeleton width={650} height={600} />
                </div>
            </div>



                </SkeletonTheme>
            )
        } else {
             return (

                   <div className="card">
                <div className="card-header">
                    <h6 className="mb-0 fs-14">{ trans['Category wise product stock'] }</h6>
                </div>
                <div style={{direction:"ltr"}} className="card-body">
                        <Chart
                            data={numberOfStockProducts}
                            padding={[60, 20, 40, 60]}
                            scale={scale}
                            autoFit
                            height={600}
                            >
                            <Axis
                                name="number"
                                labels={null}
                                title={null}
                                line={null}
                                tickLine={null}
                            />
                            <Interval
                                position="name*number"
                                color={["name", ["#7f8da9", "#fec514", "#db4c3c", "#daf0fd"]]}
                            />
                            <Tooltip />

                        </Chart>
                </div>
            </div>

    );
        }

}

