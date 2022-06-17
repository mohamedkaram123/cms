import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../urls'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import {
  Chart,
  registerShape,
  Axis,
  Tooltip,
  Interval,
  Interaction,
  Coordinate,
} from "bizcharts";
import axios from 'axios';

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


export default function  ProductChart({trans,handleErrorLoad}){

        const [isLoading, setisLoading] = useState(true)
    const [total_products_published, settotal_products_published] = useState({})
        const [total_products_unpublished, settotal_products_unpublished] = useState({})

    // const [total_products_sellers, settotal_products_sellers] = useState({})
    // const [total_products_admins, settotal_products_admins] = useState({})
        const [incrementChecked, setincrementChecked] = useState(0)

        const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {

          total_products_published_axios()

        mounted.current = true;
      } else {


      }
    }, []);



        const total_products_published_axios = () => {
        axios.get(Urls.static_url + "total_products_published")
            .then(res => {


                settotal_products_published(res.data.total_products_published)
                settotal_products_unpublished(res.data.total_products_unpublished)
    setisLoading(false)



            })
            .catch(err => {
           handleErrorLoad()
        })
        }



    if (isLoading) {
        return (
            <div>

                 <SkeletonTheme color="#fff" highlightColor="#eee" >

                    <Skeleton width={300} height={400} />

                </SkeletonTheme>
            </div>
        )
    } else {

            const data = [
                total_products_published,
                            total_products_unpublished,


            ];
        console.log({data});
        return (
            <div  className="card">
                <div className="card-header">
                    <h6 className="mb-0 fs-14">{trans['Products']}</h6>
                </div>
                <div style={{direction:"ltr"}} className="card-body">
                <Chart   data={data} height={300} autoFit >
                    <Coordinate  type="theta" radius={0.8} innerRadius={0.75} />
                    <Axis  visible={false} />
                    <Tooltip  showTitle={false} />
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

