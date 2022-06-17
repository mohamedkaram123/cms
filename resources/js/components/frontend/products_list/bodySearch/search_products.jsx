import React, { useState,useRef ,useEffect} from 'react'
import LoadingCircle from '../../../../helpers/LoadingCircle'
import $ from 'jquery'
import { Collapse,Card,Button } from 'react-bootstrap';
import Attribute from './attribute';
import { CirclePicker } from 'react-color';
import { createTheme , Slider, ThemeProvider } from '@material-ui/core';
import { round } from 'lodash';
import LoadListProducts from './loadListProducts';
import LoadListProducts2 from './loadListProducts2';
var select_colors_data = []
export default function SearchProducts({trans,categories,products,rangePrice,brands,colors,attributes,check_attr,loading}) {
    const [product_list, setproduct_list] = useState(2)
    const [open, setOpen] = useState(false);
      const [openColor, setOpenColor] = useState(false);
const [colorvalue, setcolorvalue] = useState("")
    const [openBrand, setOpenBrand] = useState(false);
    const [openPrice, setOpenPrice] = useState(false);
    const [price_value, setprice_value] = useState(rangePrice)

    const [selected_colors, setselected_colors] = useState([])
// const [loading, setloading] = useState(false)


   const mounted = useRef(false)
        useEffect(() => {


            if (!mounted.current) {

                $(".attr_collaspe").click(function () {
                    $(this).children(".las").toggleClass("la-angle-down")
                $(this).children(".las").toggleClass("la-angle-up")
                })

            mounted.current = true;
        }


        }, [])

function valuetext(value) {
  return `${value}`;
}

    const AmountSlider = createTheme({
    overrides: {
      MuiSlider: {
        root: {
          color: "#007aff",
          height: 8
        },
        thumb: {
          height: 24,
          width: 24,
          backgroundColor: "#fff",
          border: "5px solid currentColor",
          marginTop: -8,
          marginLeft: -12,
          "&:focus,&:hover,&$active": {
            boxShadow: "inherit"
          }
        },
        active: {},
        valueLabel: {
          left: "calc(-50% + 14px)",
          top: -22,
          "& *": {
            background: "transparent",
            color: "#000"
          }
        },
        track: {
          height: 8,
          borderRadius: 4
        },
        rail: {
          height: 8,
          borderRadius: 4
        }
      }
    }
  });
    return (
        <div className="d-flex flex-column" style={{marginTop:20}}>
            {loading ? <LoadingCircle size={40} /> : null}

            <div className="d-flex flex-row" style={{marginTop:30}}>
                <div className="col-md-8 col-12">
                    <div className="col-12">
                                    <div className="d-flex flex-md-row flex-column" style={{ justifyContent: "space-between" }}>
                            <div className="d-flex flex-row" style={{alignItems:"center"}}>
                                <i class="las la-sort-numeric-down"></i>
                                <span className=' mx-1'>{trans["Sort by"]}</span>
                                <div className="dropdown mx-1">
                                    <a className="text-reset dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {trans["please choice"]}
                                    </a>
                                    <div className="dropdown-menu mx-1" aria-labelledby="dropdownMenuButton">
                                        <a onClick={()=>{check_attr("order_by","asc")}} className="dropdown-item" href="#">{ trans["From the lowest price to the highest"]}</a>
                                        <a onClick={()=>{check_attr("order_by","desc")}} className="dropdown-item" href="#">{trans["From the highest price to the lowest"] }</a>
                                    </div>
                                    </div>
                            </div>
                            <a onClick={() => {
                                setproduct_list(product_list == 1?2:1)
                            }} className='text-reset'>
                                {
                                    product_list == 1 ? <div className="d-flex flex-row mb-2" style={{ alignItems: "center", cursor: "pointer" }}>
                                        <i style={{fontSize:20,marginInline:10}} className="las la-th"></i>
                                        <span style={{fontSize:20,marginInline:10}}>{trans["reticle display"]}</span>

                                    </div> :
                                        <div className="d-flex flex-row mb-2" style={{ alignItems: "center", cursor: "pointer" }}>
                                            <i style={{fontSize:20,marginInline:10}} className="las la-list"></i>
                                            <span style={{fontSize:20,marginInline:10}}>{trans["List view"]}</span>

                                    </div>

                                }
                            </a>
                       </div>
                    </div>
                    {product_list == 2 ?
                        <div class="row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2">
                        {loading ? <>
                            {[1, 1, 1, 1, 1, 1, 1, 1,1, 1, 1, 1, 1].map((item, i) => {
                               return <LoadListProducts key={i} />
                           })}
                        </> : <>
                        {

                            products.map((item, i) => {
                                return (
                                   <div key={i} class="col mb-3">
                                            <div class="aiz-card-box h-100 border border-light rounded shadow-sm shadow-md has-transition bg-white">
                                        <div className="position-relative">
                                            <a href={item.slug} className="d-block">
                                                <img
                                                    className="img-fit lazyload mx-auto h-210px"
                                                    src={item.thumbnail_img}
                                                    alt={item.name}

                                                />
                                            </a>
                                        </div>
                                        <div className="p-md-3 p-2 text-left">
                                            <h3 className="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href={item.slug}  className="d-block text-reset">{item.name}</a>
                                            </h3>
                                        </div>
                                    </div>
                               </div>
                                )
                            })
                    }
                        </>}

                </div> :
                <div class="column  gutters-5 column-cols-xxl-4 column-cols-xl-3 column-cols-lg-4 column-cols-md-3 column-cols-2">
                        {loading ? <>
                            {[1, 1, 1, 1, 1, 1, 1, 1,1, 1, 1, 1, 1].map((item, i) => {
                               return <LoadListProducts2 key={i} />
                           })}
                        </> : <>
                        {

                            products.map((item, i) => {
                                return (
                                   <div key={i} class="col mb-3">
                                            <div class="aiz-card-box d-flex flex-md-row flex-column h-100 border border-light rounded shadow-sm shadow-md has-transition bg-white">
                                        <div className="position-relative w-md-25 w-100" >
                                            <a href={item.slug} className="d-block">
                                                <img
                                                    className="img-fit lazyload mx-auto h-210px"
                                                    src={item.thumbnail_img}
                                                    alt={item.name}
                                                    style={{objectFit:"contain"}}
                                                />
                                            </a>
                                        </div>
                                        <div className="p-md-3 p-2 text-left w-md-75 w-100"  >
                                            <h3 className="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <a href={item.slug}  className="d-block text-reset">{item.name}</a>
                                            </h3>
                                        </div>
                                    </div>
                               </div>
                                )
                            })
                    }
                        </>}

                </div> }
            </div>
            <div className="col-md-4 col-12">
                <ul className="list-group box-subCat ">
                    <li className="list-group-item " >
                        <span style={{ fontSize: 24 }}>{trans["filter results"]}</span>
                    </li>
                    <li className="list-group-item"  >
                        <div style={ {cursor:"pointer"}}
                                                className="fs-15 attr_collaspe p-3 fw-600 border-bottom "
                            onClick={() => setOpen(!open)}
                            aria-controls="example-collapse-text"
                            aria-expanded={open}
                        >

                            {trans["categories"]}
                              <i style={{marginInline:10}} className="las la-angle-down "></i>
                        </div>
                        <Collapse in={open} >
                            <div id="example-collapse-text"  >
                                <div style={{ marginInlineStart: 20 }} className="form-check d-flex flex-column mt-4">
                                    {
                                        categories.map((item, i) => {
                                            return (
                                                <label key={i} className=" mt-4">
                                                    <input onChange={()=>{check_attr("category_id",item.id)}} className='form-check-input checked-data-search' type="checkbox" value="" />
                                                    <span style={{ fontSize: 14, marginInline: 10 ,wordWrap:"break-word"}}>{ item.name}</span>
                                                </label>
                                            )
                                        })
                                    }

                                </div>

                            </div>
                        </Collapse>
                    </li>
                    <li className="list-group-item" >
                        <div style={ {cursor:"pointer"}}
                                                className="fs-15 attr_collaspe p-3 fw-600 border-bottom "
                            onClick={() => setOpenPrice(!openPrice)}
                            aria-controls="open-collapse-text"
                            aria-expanded={openPrice}
                        >

                            {trans["prices"]}
                              <i style={{marginInline:10}} className="las la-angle-down "></i>
                        </div>
                        <Collapse in={openPrice} >
                                <div id="example-collapse-text " style={{textAlign:"center"}} >


                                    <ThemeProvider theme={AmountSlider}>

                                        <Slider
                                            style={{width:"80%"}}
                                                className='mt-4'
                                                valueLabelDisplay="on"
                                                defaultValue={10000}
                                                value={price_value}
                                            onChange={(e, val) => {
                                                setprice_value(val)

                                            }}
                                            onChangeCommitted={(e, val) => {
                                                 check_attr("price", val)

                                            }}
                                                step={round(price_value[1]/1000)}
                                                min={0}
                                                max={ rangePrice[1]}
                                                />
                                            </ThemeProvider>
                                </div>
                        </Collapse>
                        </li>
                    <li className="list-group-item"  >
                        <div style={ {cursor:"pointer"}}
                                                className="fs-15 attr_collaspe p-3 fw-600 border-bottom "
                            onClick={() => setOpenBrand(!openBrand)}
                            aria-controls="example-collapse-text"
                            aria-expanded={openBrand}
                        >

                            {trans["brands"]}
                              <i style={{marginInline:10}} className="las la-angle-down "></i>
                        </div>
                        <Collapse in={openBrand} >
                            <div id="example-collapse-text"  >
                                <div style={{ marginInlineStart: 20 }} className="form-check d-flex flex-column mt-4">
                                    {
                                        brands.map((item, i) => {
                                            return (
                                                <label key={i} className=" mt-4">
                                                    <input onChange={()=>{check_attr("brand_id",item.id)}} className='form-check-input checked-data-search' type="checkbox" value="" />
                                                    <span style={{ fontSize: 14, marginInline: 10 ,wordWrap:"break-word"}}>{ item.name}</span>
                                                </label>
                                            )
                                        })
                                    }

                                </div>

                            </div>
                        </Collapse>
                        </li>

                            {
                                    attributes.map((item, i) => {
                                        return (
                                       <Attribute check_attr={check_attr} key={i} attr={item} trans={trans} />
                                    )
                                })
                        }
                        {colors.length > 0? <li className="list-group-item" >
                        <div style={ {cursor:"pointer"}}
                                                className="fs-15 attr_collaspe p-3 fw-600 border-bottom "
                            onClick={() => setOpenColor(!openColor)}
                            aria-controls="open-collapse-text"
                            aria-expanded={openColor}
                        >

                            {trans["colors"]}
                              <i style={{marginInline:10}} className="las la-angle-down "></i>
                        </div>
                        <Collapse in={openColor} >
                                <div id="example-collapse-text"  >
                                    <div className="d-flex flex-row mt-4">
                                         {selected_colors.map((color,i) => {
                                        return <div key={i} style={{ width: 70, height: 30,marginInline:10,backgroundColor:color }}>

                                        </div>
                                    })}
                                    </div>

                                    <CirclePicker className='mt-4' color={colorvalue} colors={colors} onChange={(color, e) => {
                                        var hex_color = color.hex;
                                        if (selected_colors.includes(hex_color)) {
                                            setselected_colors(selected_colors.filter(item => item !== hex_color));
                                         //  select_colors_data= select_colors_data.filter(item => item !== hex_color)

                                        } else {
                                            setselected_colors([...selected_colors, hex_color]);
                                          //  select_colors_data = [...selected_colors, hex_color]
                                        }
                                     //   console.log({select_colors_data});

                                        setcolorvalue(hex_color)
                                        check_attr("colors",hex_color)
                               }} />

                            </div>
                        </Collapse>
                        </li>:null}

                </ul>
            </div>
           </div>
        </div>
    )



}
