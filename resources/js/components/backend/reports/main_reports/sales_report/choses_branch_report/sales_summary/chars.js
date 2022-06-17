import React, { useState } from "react";
import { Chart, Line, Point, Tooltip } from "bizcharts";


export default function ChartDates({dataChart,trans}) {

    // const [DataChart, setDataChart] = useState()

	return (
		<>
			<Chart
				appendPadding={[10, 0, 0, 10]}
				autoFit
				height={500}
				data={dataChart}
				scale={{ value: { min: 0, alias:trans["order"] , type: 'linear-strict' }, year: { range: [0, 1] } }}
			>

				<Line position="year*value" />
				<Point position="year*value" />
				<Tooltip showCrosshairs />
			</Chart>
		</>
	);
}

