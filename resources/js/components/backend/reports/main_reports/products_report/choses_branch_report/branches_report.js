import React, { useState } from 'react'
import ProductQuantity from './products_quantity'

import AbandonedBaskets from './abandoned_baskets';

export default function BranchesReport({ state, option ,startDate,endDate ,data_is_reached,data_is_start_load,loadDataProduct,loadDataAbanfonedBaskets  }) {




    if (option == "products_quantity") {

            return (
                <div>
                    <ProductQuantity data_is_reached={data_is_reached} data_is_start_load={data_is_start_load} loadDataProduct={loadDataProduct} startDate={startDate} endDate={endDate} state={state} />
                </div>
            )

    } else if (option == "abandoned_baskets") {

            return (
                <div>
                    <AbandonedBaskets data_is_reached={data_is_reached} data_is_start_load={data_is_start_load} loadDataAbanfonedBaskets={loadDataAbanfonedBaskets} startDate={startDate} endDate={endDate} state={state} />
                </div>
            )
    }
}
