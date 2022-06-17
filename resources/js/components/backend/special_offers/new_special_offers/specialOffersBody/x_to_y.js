import React, { useState } from 'react'
import Select from 'react-select';
import ProductModal from '../../../modals/product_modal_return_selection/product_modal';

export default function XToYBody({trans,optionsCategories,dataXTOY}) {


    const [DataXtoY, setDataXtoY] = useState({
        products1:[],
        products2:[],
        categories1:[],
        categories2:[],
        quantify1:0,
        quantify2:0,
        product_or_category1:"product",
        product_or_category2:"product",

        discount_type:"discount",
        discount:0


    })


    const [ShowProduct, setShowProduct] = useState(false)
    const [LoadSearchCarts, setLoadSearchCarts] = useState(false)

    const [ShowProduct2, setShowProduct2] = useState(false)
    const [LoadSearchCarts2, setLoadSearchCarts2] = useState(false)


    const [Quantify, setQuantify] = useState(0)
    const [SelectproductOrCategory, setSelectproductOrCategory] = useState("product")
    const [Products, setProducts] = useState([])
    const [Category, setCategory] = useState([])



    const [Quantify2, setQuantify2] = useState(0)
    const [SelectproductOrCategory2, setSelectproductOrCategory2] = useState("product")
    const [Products2, setProducts2] = useState([])
    const [Category2, setCategory2] = useState([])



    const [DiscountType, setDiscountType] = useState("discount")
    const [Discount, setDiscount] = useState(0)

    const saveChangeProduct = (products)=>{

        setProducts(products)
        setShowProduct(false)

        dataXTOY({products1:products})
    }
    const handleCloseProduct = ()=>{
        setShowProduct(false)
    }


    const saveChangeProduct2 = (products)=>{

        setProducts2(products)
        setShowProduct2(false)

        dataXTOY({products2:products})

    }
    const handleCloseProduct2 = ()=>{
        setShowProduct2(false)
    }
   const options = [
        {
            label:trans["products"],
            value:"product"
        },
        {
            label:trans["categories"],
            value:"category"
        }
    ]


    const optionsDiscount = [
        {
            label:trans["discount percent"],
            value:"discount"
        },
        {
            label:trans["free product"],
            value:"free"
        }
    ]
    return (
        <div>

            <div className="card">
                <div className="card-header">
                   <span>{trans["Offer Options"]} - <span style={{color:"#aaa"}}>{trans["When the customer buy X get on y"]}</span></span>
                </div>

                 <div className="card-body" >

                     <div>
                         <span >{trans["If the customer buys"]}</span>
                         <p  style={{color:"#aaa"}}>{trans["Select the products and quantity to be available in the cart to apply the discount"]}</p>

                     </div>
                     <div className="row">
                         <div className="col-3">
                         <div className="form-group">
                                        <label >{trans["Quantify"]}</label>
                                        <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-shopping-basket"></i>
                                            </span>
                                       </div>
                                       <input type="number"
                                              onChange={e=>{
                                                  setQuantify(parseInt(e.target.value))


                                                  dataXTOY({quantify1:parseInt(e.target.value)})

                                              }}
                                              className="form-control"
                                              placeholder={trans["quantify"]} />
                                       </div>
                                        </div>
                         </div>
                         <div className="col-9 ">
                         <div className="form-group ">
                                        <label >{trans["Products from"]}</label>
                                        <div className="input-group" >
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-tshirt"></i>
                                            </span>
                                       </div>

                                            <Select
                                                maxMenuHeight={200}
                                                menuPosition={'fixed'}
                                                className="custom-select"
                                                styles={
                                                    {control: styles => ({ ...styles, borderRadius:0,fontSize:12}),}
                                                }
                                                value={options.filter(option => option.value === SelectproductOrCategory)}

                                         onChange={e=>{
                                            setSelectproductOrCategory(e.value)

                                              dataXTOY({product_or_category1:e.value})

                                            }}
                                        options={options}/>
                                       </div>
                                        </div>
                         </div>

                     </div>
                     <div className="row">
                     <div className="col-12">
                     {SelectproductOrCategory == "product"?

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



                    :
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
                                                styles={
                                                    {control: styles => ({ ...styles, borderRadius:0,fontSize:12}),}
                                                }
                                                value={Category}
                                                placeholder={trans["Choose Categories"]}
                                         onChange={item=>{

                                                setCategory(item)

                                                  dataXTOY({categories1:item})

                                            }}
                                        options={optionsCategories}/>
                                       </div>

                      }
                     </div>
                     </div>


                 <div style={{display:"flex",justifyContent:'center',alignItems:'center',marginBlock:20}}>
                 <span style={{width:"80%",background:"#eee",height:3}}></span>
                 </div>




                    <div>
                        <span >{trans["Customer gets"]}</span>
                        <p  style={{color:"#aaa"}}>{trans["Determine what the customer gets when the previous condition is met"]}</p>

                    </div>
                    <div className="row">
                        <div className="col-3">
                        <div className="form-group">
                                    <label >{trans["Quantify"]}</label>
                                    <div className="input-group">
                                    <div className="input-group-prepend">
                                    <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-shopping-basket"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                            className="form-control"
                                            onChange={e=>{
                                                setQuantify2(parseInt(e.target.value))

                                                  dataXTOY({quantify2:parseInt(e.target.value)})

                                            }}
                                            placeholder={trans["quantify"]} />
                                    </div>
                                    </div>
                        </div>
                        <div className="col-9 ">
                        <div className="form-group ">
                                    <label >{trans["Products from"]}</label>
                                    <div className="input-group">
                                    <div className="input-group-prepend">
                                    <span className="input-group-text" style={{background:"#fff"}}>
                                    <i className="las la-tshirt"></i>
                                     </span>
                                    </div>

                                        <Select
                                            maxMenuHeight={200}
                                            menuPosition={'fixed'}
                                            className="custom-select"
                                            styles={
                                                {control: styles => ({ ...styles, borderRadius:0,fontSize:12}),}
                                            }
                                            value={options.filter(option => option.value === SelectproductOrCategory2)}

                                        onChange={e=>{
                                        setSelectproductOrCategory2(e.value)

                                          dataXTOY({product_or_category2:e.value})

                                        }}
                                    options={options}/>
                                    </div>
                                    </div>
                        </div>

                    </div>
                    <div className="row">
                    <div className="col-12">
                    {SelectproductOrCategory2 == "product"?

                                    <div className="input-group">
                                    <div className="input-group-prepend">
                                    <span className="input-group-text" style={{background:"#fff"}}>
                                    <i className="las la-search"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                            className="form-control"
                                            onClick={()=>{
                                                setShowProduct2(true)
                                            }}

                                            placeholder={Products2.length > 0? trans["Products Items are Choosing "] + (Products2.length).toString():trans["Choose Products"] } />
                                    </div>



                    :
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
                                            value={Category2}

                                            styles={
                                                {control: styles => ({ ...styles, borderRadius:0,fontSize:12}),}
                                            }

                                            placeholder={trans["Choose Categories"]}
                                            onChange={item=>{

                                                   setCategory2(item)

                                                  dataXTOY({categories2:item})


                                               }}
                                    options={optionsCategories}/>
                                    </div>

                    }
                    </div>
                    </div>
                    <div className="row" style={{marginTop:20}}>
                    <div className={DiscountType == "discount"?"col-9":"col-12"} >
                         <div className="form-group">
                                        <label >{trans["Discount Type"]}</label>
                                        <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-shopping-basket"></i>
                                            </span>
                                       </div>


                                       <Select
                                                maxMenuHeight={200}
                                                menuPosition={'fixed'}
                                                className="custom-select"
                                                styles={
                                                    {control: styles => ({ ...styles, borderRadius:0,fontSize:12}),}
                                                }
                                                value={optionsDiscount.filter(option => option.value === DiscountType)}

                                         onChange={e=>{

                                            setDiscountType(e.value)

                                            dataXTOY({discount_type:e.value})

                                            }}
                                        options={optionsDiscount}/>
                                       </div>
                            </div>
                        </div>

                       {DiscountType == "discount"? <div className="col-3">
                         <div className="form-group">
                                        <label >{trans["Discount Percent"]}</label>
                                        <div className="input-group">
                                        <div className="input-group-prepend">
                                        <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-percentage"></i>
                                            </span>
                                       </div>


                                       <input type="number" className="form-control" placeholder={trans["discount"]} onChange={e=>{
                                           setDiscount(parseInt(e.target.value))

                                          dataXTOY({discount:e.target.value})
                                        }} />
                                       </div>
                            </div>
                        </div>:null
                      }
                    </div>
                </div>


            </div>

             <div>

                 <ProductModal
                 show={ShowProduct}
                 loadSearch={LoadSearchCarts}
                 saveChange={saveChangeProduct}
                 handleClose={handleCloseProduct}
                    products={Products}
                    selected_item={1}
                //  clearData={this.state.clearData}
                 />
             </div>
             <div >
                <ProductModal
                 show={ShowProduct2}
                 loadSearch={LoadSearchCarts2}
                 saveChange={saveChangeProduct2}
                 handleClose={handleCloseProduct2}
                    products={Products2}
                    selected_item={1}

                //  clearData={this.state.clearData}
                 />
             </div>
        </div>
    )
}
