import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../urls'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import {
  Chart,
  registerShape,
  Geom,
  Axis,
  Tooltip,
  Interval,
  Interaction,
  Coordinate,
} from "bizcharts";
import axios from 'axios';
import {encryptLocalStorage,decryptLocalStorage} from '../../hashes';

let increment = 0;

const sliceNumber = 0.01; // 自定义 other 的图形，增加两条线

registerShape("interval", "sliceShape", {
  draw(cfg, container) {
    const points = cfg.points;
    let path = [];
    path.push(["M", points[0].x, points[0].y]);
    path.push(["L", points[1].x, points[1].y - sliceNumber]);
    path.push(["L", points[2].x, points[2].y - sliceNumber]);
    path.push(["L", points[3].x, points[3].y]);
    path.push("Z");
    path = this.parsePath(path);
    return container.addShape("path", {
      attrs: {
        fill: cfg.color,
        path: path
      }
    });
  }
});


export default function  SellerChart({trans}){

        const [isLoading, setisLoading] = useState(true)
    const [total_sellers, settotal_sellers] = useState({})
    const [total_approved_sellers, settotal_approved_sellers] = useState({})
    const [total_pendding_sellers, settotal_pendding_sellers] = useState({})
        const [incrementChecked, setincrementChecked] = useState(0)

        const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic
        //            if (decryptLocalStorage("data_sellers") !== null) {
        //   let data_sellers = decryptLocalStorage("data_sellers");
        //            settotal_sellers(data_sellers.total_sellers)
        //               settotal_approved_sellers(data_sellers.total_approved_sellers)
        //                settotal_pendding_sellers(data_sellers.total_pendding_sellers)
        //                        setisLoading(false)
        //             }
          total_sellers_axios()
          total_approved_sellers_axios()
          total_pendding_sellers_axios()
        //   BrandsCountData();
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);



        const total_sellers_axios = () => {
        axios.get(Urls.static_url + "total_sellers")
            .then(res => {


                settotal_sellers(res.data.total_sellers)


                increment += 1;
                if (increment == 3) {
                                    setincrementChecked(1)
                                    setisLoading(false)

                }

            })
            .catch(err => {
            console.log({err});
        })
        }

       const total_approved_sellers_axios = () => {
        axios.get(Urls.static_url + "total_approved_sellers")
            .then(res => {

                settotal_approved_sellers(res.data.total_approved_sellers)

                increment += 1;

                if (increment == 3) {
                         setincrementChecked(1)
                    setisLoading(false)


                }


            })
            .catch(err => {
            console.log({err});
        })
       }

       const total_pendding_sellers_axios = () => {
        axios.get(Urls.static_url + "total_pendding_sellers")
            .then(res => {

                settotal_pendding_sellers(res.data.total_pendding_sellers)
                increment += 1;

                if (increment == 3) {
                         setincrementChecked(1)
                                    setisLoading(false)

                }

            })
            .catch(err => {
            console.log({err});
        })
    }

            const data = [
            total_sellers,
            total_approved_sellers,
            total_pendding_sellers,

            ];
    if (isLoading) {
        return (
            <div>

                 <SkeletonTheme color="#fff" highlightColor="#eee" >

                    <Skeleton width={300} height={400} />

                </SkeletonTheme>
            </div>
        )
    } else {
        return (
            <div className="card">
                <div className="card-header">
                    <h6 className="mb-0 fs-14">{trans['Sellers']}</h6>
                </div>
                <div style={{direction:"ltr"}} className="card-body">
                <Chart data={data} height={300} autoFit >
                    <Coordinate type="theta" radius={0.8} innerRadius={0.75} />
                    <Axis visible={false} />
                    <Tooltip showTitle={false} />
                    <Interval
                        adjust="stack"
                        position="value"
                        color="type"
                        shape="sliceShape"
                    />
                    <Interaction type="element-single-selected" />
                </Chart>
                </div>
            </div>
        );
    }
}

