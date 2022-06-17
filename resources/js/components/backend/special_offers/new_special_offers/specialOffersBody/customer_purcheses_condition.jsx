import React, { useEffect, useRef, useState } from 'react'
import ProductModal from '../../../modals/product_modal_selection/product_modal';
import Select from 'react-select';

export default function CustomerPurchesesCondition({CheckConditionsOffer,trans,optionsCategories,dataFixedCustomerPurches,dataPercentCustomerPurches}) {


    const [ShowProduct, setShowProduct] = useState(false)
    const [LoadSearchCarts, setLoadSearchCarts] = useState(false)
    const [SelectproductOrCategory, setSelectproductOrCategory] = useState("product")
    const [Products, setProducts] = useState([])
    const [Category, setCategory] = useState([])
    const [Payment, setPayment] = useState([])




    const [optionsPayments, setOptionsPayments] = useState([
        {
            label:trans["Fawry"],
            value:'fawry'
        },
        {
            label:trans["TapPayment"],
            value:'tappayment'
        },
        {
            label:trans["Paytab saudi"],
            value:'paytabsaudi'
        },
        {
            label:trans["Paytab egypt"],
            value:'paytabegypt'
        },
        {
            label:trans["Cash on delivery"],
            value:'cash_on_delivery'
        }
    ])


    const saveChangeProduct = (products)=>{
        setProducts(products)
        setShowProduct(false)

        dataFixedCustomerPurches({products:products})
        dataPercentCustomerPurches({products:products})
    }
    const handleCloseProduct = ()=>{
        setShowProduct(false)
    }

    if(CheckConditionsOffer == 1){
        return (
            <div>

            </div>
        )
    }else if(CheckConditionsOffer == 2){
        return (
            <div className="row">
                  <div className="col-12">
                      <div className="form-group">
                  <label >{trans["categories"]}</label>
                  <div className="input-group">

                                    <div className="input-group-prepend">
                                    <span className="input-group-text" style={{background:"#fff"}}>
                                    <i className="las la-search"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                            className="form-control"
                                            onClick={()=>{
                                                setShowProduct(true)
                                            }}

                                            placeholder={Products.length > 0? trans["Products Items are Choosing "] + (Products.length).toString():trans["Choose Products"] } />
                                    </div>

                                    <div className="card">

                                <ProductModal
                                show={ShowProduct}
                                loadSearch={LoadSearchCarts}
                                saveChange={saveChangeProduct}
                                handleClose={handleCloseProduct}
                                products={Products}
                                //  clearData={this.state.clearData}
                                />
                                </div>
                  </div>

            </div>
            </div>
        )
    }else if(CheckConditionsOffer == 3){
        return (
            <div className="row" >
                <div className="col-12">
                <div className="form-group ">
                                        <label >{trans["categories"]}</label>
                                        <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-tags"></i>
                                            </span>
                                       </div>
                                       <Select

                                                maxMenuHeight={200}
                                                menuPosition={'fixed'}
                                                className="custom-select basic-multi-select"
                                                isMulti
                                                closeMenuOnSelect={false}
                                                 value={Category}
                                                styles={
                                                    {control: styles => ({ ...styles, borderRadius:0,fontSize:12}),}
                                                }

                                                placeholder={trans["Choose Categories"]}

                                         onChange={items=>{
                                             setCategory(items)
                                             dataFixedCustomerPurches({categories:items})
                                             dataPercentCustomerPurches({categories:items})
                                            //  items.map(item=>{
                                            //     setCategory(oldArray => [...oldArray, item])
                                            //  })
                                            }}

                                        options={optionsCategories}/>
                                       </div>
                                        </div>

                </div>

            </div>
        )
    }else if(CheckConditionsOffer == 4){
        return (

      <div className="row" >
                <div className="col-12">
                <div className="form-group ">
                                        <label >{trans["Payments"]}</label>
                                        <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-tags"></i>
                                            </span>
                                       </div>
                                       <Select
                                                maxMenuHeight={200}
                                                menuPosition={'fixed'}
                                                className="custom-select basic-multi-select"
                                                isMulti
                                                closeMenuOnSelect={false}
                                                value={Payment}

                                                styles={
                                                    {control: styles => ({ ...styles, borderRadius:0,fontSize:12}),}
                                                }

                                                placeholder={trans["Choose Payments"]}
                                         onChange={items=>{

                                            dataFixedCustomerPurches({payments:items})
                                            dataPercentCustomerPurches({payments:items})
                                                setPayment(items)

                                            }}
                                        options={optionsPayments}/>
                                       </div>
                                        </div>

                </div>

            </div>


        )
    }

}
