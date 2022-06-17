import React from 'react'
import SummaryReport from './sales_summary/summary_report'
import SalesProducts from './sales_products/sales_products';
import SalesBrands from './sales_brands/sales_brands';
import SalesCategories from './sales_categories/sales_categories';
import SalesCoupons from './sales_coupons/sales_coupons';

export default function BranchesReport({
    option,
    state,
    startDate,
    endDate,
    loadDataSales,
    loadDataSalesProduct,
    loadDataSalesBrands,
    loadDataSalesCategories,
    loadDataSalesCoupons,
    data_is_reached,
    data_is_start_load

}) {

    if (option == "summary") {
            return (
        <div>
            <SummaryReport data_is_reached={data_is_reached} data_is_start_load={data_is_start_load} loadDataSales={loadDataSales} state={state} startDate={startDate} endDate={endDate}  />
        </div>
    )
    } else if (option == "sales_products") {
                    return (
        <div>
            <SalesProducts data_is_reached={data_is_reached} data_is_start_load={data_is_start_load} loadDataSalesProduct={loadDataSalesProduct} state={state} startDate={startDate} endDate={endDate}  />
        </div>
    )
    } else if (option == "sales_brands") {
                    return (
        <div>
            <SalesBrands data_is_reached={data_is_reached} data_is_start_load={data_is_start_load} loadDataSalesBrands={loadDataSalesBrands} state={state} startDate={startDate} endDate={endDate}  />
        </div>
    )
    }else if (option == "sales_categories") {
                    return (
        <div>
            <SalesCategories data_is_reached={data_is_reached} data_is_start_load={data_is_start_load} loadDataSalesCategories={loadDataSalesCategories} state={state} startDate={startDate} endDate={endDate}  />
        </div>
    )
    }else if (option == "sales_coupons") {
                    return (
        <div>
            <SalesCoupons data_is_reached={data_is_reached} data_is_start_load={data_is_start_load} loadDataSalesCoupons={loadDataSalesCoupons} state={state} startDate={startDate} endDate={endDate}  />
        </div>
    )
    }

}
