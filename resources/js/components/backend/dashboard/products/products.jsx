import axios from 'axios';
import React, { createRef, useEffect, useRef, useState } from 'react'
import { Urls } from '../../urls';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

import "./product.css";
import Slider from "react-slick";
import {encryptLocalStorage,decryptLocalStorage} from '../../hashes';
import { useMediaQuery } from 'react-responsive'
import getStyleObjectFromString from "../../../../helpers/style_price";
import ThreeAddFun from '../../../frontend/threeAdds/three_add_fun';
export default function Products({trans,start_date,end_date,status_date,handleErrorLoad}) {

  const isMobile = useMediaQuery({
    query: '(max-width: 600px)'
  })
      var settings = {

    infinite: true,
    speed: 500,
    slidesToShow:isMobile?2:6,
          slidesToScroll: 1,
          className: "aiz-carousel gutters-10 half-outside-arrow ",
    arrows: false,


  };
    const [isLoading, setisLoading] = useState(true)
    const [products, setproducts] = useState([])
    const [style_price, setStyle_price] = useState("")
    const [style_price_del, setStyle_price_del] = useState("")
    const [showThreeFun, setshowThreeFun] = useState({
    id:""
    })


          const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic




    products_data();

        //   BrandsCountData();
        mounted.current = true;
      } else {

          if (status_date == "products" || status_date == "all") {
                            products_data();

          }


        // do componentDidUpdate logic
      }
    }, [start_date,end_date]);

  const customeSlider = createRef();

    const products_data = () => {
                        //    setisLoading(loading)

        axios.get(Urls.static_url + "get_top_products?start_date="+start_date+"&end_date="+end_date)
            .then(res => {

                setproducts(res.data.products)

             //   let productsData = encrypt(JSON.stringify(res.data.products))

                // encryptLocalStorage(res.data.products, "products")
                                setStyle_price(res.data.style_price)
                setStyle_price_del(res.data.style_price_del)


                 setisLoading(false)

            })
            .catch(err => {
                handleErrorLoad()
        })
       }

 const next = ()=>{
     customeSlider.current.slickNext();
  }
 const previous = ()=>{
     customeSlider.current.slickPrev();
  }
    const onMouseEnter = (id,e) => {

        if (showThreeFun.id == id) {


        setshowThreeFun({ id: "" });

        } else {

            setshowThreeFun({ id });


        }

    }

    if (isLoading) {
        return (

            <div>
                                 <SkeletonTheme color="#fff" highlightColor="#eee" >

            <div  className="card">
    <div className="card-header">
        <h6 className="mb-0">{ trans['Top 12 Products'] }</h6>
    </div>
                <div className="card-body">
                    <button onClick={previous} type="button" className=" slick-arrow slick-prev-momo"><i style={{color:"#333"}} className="las la-angle-left"></i></button>
                    <button onClick={next} type="button" className=" slick-arrow slick-next-momo"><i style={{color:"#333"}} className="las la-angle-right"></i></button>
    <Slider  ref={customeSlider}  {...settings}>
                        {
                            [1,2,3,4,5,6,7,8,9,10,11,12].map((item, i) => (
                                                <div key={i} className="carousel-box">
                    <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        <div className="position-relative">
                            <Skeleton width={200} height={200} />
                        </div>
                        <div className="p-md-3 p-2 text-left">
                            <div className="fs-15">

                            <Skeleton width={80} height={15} />

                            <Skeleton width={80} height={15} />
                            </div>
                            <div className="rating rating-sm mt-1">
                                {/* {{ renderStarRating($product->rating) }} */}
                            </div>
                            <h3 className="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                            <Skeleton width={80} height={15} />
                            </h3>
                        </div>
                    </div>
                </div>
                            ))
         }

        </Slider>
    </div>
</div>

</SkeletonTheme>
        </div>

        )
    }
    return (
        <div>
            <div  className="card">
    <div className="card-header">
        <h6 className="mb-0">{ trans['Top 12 Products'] }</h6>
    </div>
                <div className="card-body">
                    <button onClick={previous} type="button" className=" slick-arrow slick-prev-momo"><i style={{color:"#333"}} className="las la-angle-left"></i></button>
                    <button onClick={next} type="button" className=" slick-arrow slick-next-momo"><i style={{color:"#333"}} className="las la-angle-right"></i></button>
    <Slider  ref={customeSlider}  {...settings}>
                        {
                            products.map((item, i) => (
                                                <div key={i} className="carousel-box">
                                    <div

                                        // onMouseEnter={onMouseEnter.bind(this, item.id)}
                                        // onMouseLeave={onMouseEnter.bind(this, item.id)}
                                        className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        <div className="position-relative">
                            <a href={item.slug} className="d-block">
                                <img
                                    className="img-fit lazyload mx-auto h-210px"
                                    // src={Urls.public_url + "assets/img/placeholder.jpg" }
                                    src={item.thumbnail_img}
                                    alt={item.name}
                                />
                            </a>
                             {/* <div style={{position:"absolute",left:0,top:0}}>
                                                <ThreeAddFun  trans={trans} showThreeFun={showThreeFun} id={item.id} />
                            </div> */}
                        </div>

                         <div className="p-md-3 p-2 text-left">
                            <div className="fs-15">

                                    <del className="fw-600 opacity-50 mr-1" style={getStyleObjectFromString(style_price_del)}>{ item.home_base_price}</del>

                                <span className="fw-700 text-primary" style={getStyleObjectFromString(style_price)}>{ item.home_discounted_base_price}</span>
                            </div>
                            <div className="rating rating-sm mt-1">
                                {/* {{ renderStarRating($product->rating) }} */}
                            </div>
                            <h3 className="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                <a href={item.slug}  className="d-block text-reset">{item.name}</a>
                            </h3>
                        </div>
                                    </div>

                </div>
                            ))
         }

        </Slider>
    </div>
</div>


        </div>
    )
}
