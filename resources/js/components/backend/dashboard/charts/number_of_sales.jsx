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



    export default function  Number_of_Sales({trans,start_date,end_date,handleErrorLoad}){
    const [isLoading, setisLoading] = useState(true)
    const [numberOfSales, setnumberOfSales] = useState([])

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

        number_of_sales()


        //   BrandsCountData();
        mounted.current = true;
      } else {

        // do componentDidUpdate logic
      }
    }, []);

        const number_of_sales = (loading = false) => {
                                    //   setisLoading(loading)

        axios.get(Urls.static_url + "number_of_sales")
            .then(res => {

                setnumberOfSales(res.data.number_of_sales)
                        //   encryptLocalStorage(res.data.number_of_sales,'number_of_sales');
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
                    <h6 className="mb-0 fs-14">{ trans['Category wise product sale'] }</h6>
                </div>
                <div style={{direction:"ltr"}} className="card-body">
                        <Chart
                            data={numberOfSales}
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

