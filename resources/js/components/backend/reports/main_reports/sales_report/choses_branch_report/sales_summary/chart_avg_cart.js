import React, { useEffect, useRef, useState } from 'react'
import {
  G2,
  Chart,
  Geom,
  Axis,
  Tooltip,
  Coord,
  Label,
  Legend,
  View,
  Guide,
  Facet,
  Util,
  Point,
  Interval
} from "bizcharts";



export default function ChartAvgCarts({ data_avg_carts, trans }) {

    const data = [
        {
            name: trans["Max Price"],
            number: data_avg_carts.maxPrice
        },
        {
            name: trans["Min Price"],
            number: data_avg_carts.minPrice
        }
    ];

             return (

           <>
                        <Chart
                            data={data}
                            padding={[60, 20, 40, 60]}

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
              </>

    );


}

