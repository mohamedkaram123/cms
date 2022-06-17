import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../urls'

export default function BodyOptions({ index, trans ,handleOptionsChoose,loadingBtn,handleclickShow }) {

    const [OptionsSales, setOptionsSales] = useState("summary")
    const [OptionsProduct, setOptionsProduct] = useState("product")

       const mounted = useRef(false);
    useEffect(() => {
        if (!mounted.current) {
        // do componentDidMount logic
        //   handleOptionsChoose(OptionsSales, "sales")
        //   handleOptionsChoose(OptionsProduct,"product")


            // callDataSales(startDate,endDate);
        mounted.current = true;
      } else {
            setOptionsSales("summary")
            setOptionsProduct("product")

        // do componentDidUpdate logic
      }
    }, [index]);

    if (index == 0) {
           return (

                                    <div className="col-12">
                                   <div className="form-group">
                                    <label >{trans["Choose Branch Report"]}</label>
                                      <div className="input-group ">
                                                <select className="form-control" onChange={(e)=>{
                                                    setOptionsSales(e.target.value)
                                                    handleOptionsChoose(e.target.value,"sales")

                                                }} value={OptionsSales}>
                                                    <option value="summary" >{trans["Summary"]}</option>
                                                    <option value="sales_products">{trans["Sales Products"]}</option>
                                                    <option value="sales_brands">{trans["Sales Brands"]}</option>
                                                    <option value="sales_categories">{trans["Sales Categories"]}</option>
                                                    <option value="sales_coupons">{trans["Sales Coupons"]}</option>
                                                </select>
                                            <div className="input-group-append">
                                                    <button disabled={loadingBtn == "sales"} onClick={()=>{
                                                        handleclickShow("sales")
                                                    }} className="btn btn-outline-primary" type="button">
                                                        {trans["show"]}
                                                        {loadingBtn == "sales"?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                                                        </button>
                                            </div>
                                           </div>

                                        </div>

                                    </div>

    )
    } else if (index == 1) {

        return (
                                    <div className="col-12">
                                          <div className="form-group">
                                                <label >{trans["Choose Branch Report"]}</label>
                                                <div className="input-group ">
                                                <select className="form-control" onChange={(e)=>{
                                                    setOptionsProduct(e.target.value)
                                                    handleOptionsChoose(e.target.value,"product")
                                                }} value={OptionsProduct}>
                                                    <option value="products_quantity" >{trans["Product"]}</option>
                                                    <option value="abandoned_baskets">{trans["Abandoned Baskets"]}</option>

                                                </select>
                                                <div className="input-group-append">
                                                    <button disabled={loadingBtn == "product"} onClick={()=>{
                                                        handleclickShow("product")
                                                    }} className="btn btn-outline-primary" type="button">
                                                        {trans["show"]}
                                                        {loadingBtn == "product"?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                                                        </button>
                                            </div>
                                           </div>

                                            </div>
                                    </div>
        )
    }else{
        return (
            <div></div>
        )
    }

}
