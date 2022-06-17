import React from 'react'
import {
  Chart,
  Axis,
  Tooltip,
  Interval
} from "bizcharts";


    export default function  NumberBrandsSales({dataChart}){
   const scale = {
      vote: {
        min: 0
      }
    };

             return (

                   <>
                        <Chart
                            data={dataChart}
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

            </>

    );


}

