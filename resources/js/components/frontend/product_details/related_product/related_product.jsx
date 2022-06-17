import axios from 'axios';
import React, { createRef, useEffect, useRef, useState } from 'react'
import { Urls } from '../../../backend/urls';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import getStyleObjectFromString from "../../../../helpers/style_price";
import { useSpring, animated ,useChain} from 'react-spring'

import "./product.css";
import Slider from "react-slick";
import {encryptLocalStorage,decryptLocalStorage} from '../../../backend/hashes';
import { useMediaQuery } from 'react-responsive'
import ThreeAddFun from '../../threeAdds/three_add_fun';
export default function RelatedProducts({detailedProduct,user,auth}) {

  const isMobile = useMediaQuery({
    query: '(max-width: 600px)'
  })
        const [sliderNumber, setsliderNumber] = useState(5)

      var settings = {

    infinite: true,
    speed: 500,
    slidesToShow:isMobile?2:sliderNumber,
          slidesToScroll: 1,
          className: "aiz-carousel gutters-10 half-outside-arrow ",
          arrows: false,


      };
    const [mouseLeaveData, setmouseLeaveData] = useState(false)
    const [isLoading, setisLoading] = useState(true)
    const [products, setproducts] = useState([])
    const [trans, settrans] = useState({
        "Related products": "",
        "Add to wishlist": "",
        "Add to compare": "",
        "Add to cart": "",
        "Item has been added to wishlist": "",
        "Please login first": "",

    })
    const [showThreeFun, setshowThreeFun] = useState({
    id:""
    })

    const [style_price, setStyle_price] = useState("")
    const [style_price_del, setStyle_price_del] = useState("")

          const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

                callTrans(trans)
               products_data()
        //   BrandsCountData();
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);

  const customeSlider = createRef();

    const products_data = () => {
                        //    setisLoading(loading)

        axios.get(Urls.url + "products/related_product?category_id="+detailedProduct.category_id+"&id="+detailedProduct.id)
            .then(res => {

                if (res.data.products.length < 5) {
                    setsliderNumber(res.data.products.length)
                }
                setproducts(res.data.products)
                setStyle_price(res.data.style_price)
                setStyle_price_del(res.data.style_price_del)


                 setisLoading(false)

            })
            .catch(err => {
        })
    }

     const  callTrans = (transes)=>{

        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data_post = {
            data: transes,
            "_token": csrf_token
        }
        axios.post(Urls.static_url + "trans_data", data_post)
            .then(res => {


                settrans(res.data)

            })
            .catch(err => {

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
        <h6 className="mb-0"><Skeleton width={80} height={15} /></h6>
    </div>
                <div className="card-body">
                    <button onClick={previous} type="button" className=" slick-arrow slick-prev-momo"><i style={{color:"#333"}} className="las la-angle-left"></i></button>
                    <button onClick={next} type="button" className=" slick-arrow slick-next-momo"><i style={{color:"#333"}} className="las la-angle-right"></i></button>
    <Slider  ref={customeSlider}  {...settings}>
                        {
                            [1,2,3,4,5,6,7,8,9,10].map((item, i) => (
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
        <h6 className="mb-0">{ trans['Related products'] }</h6>
    </div>
                <div className="card-body">
                    <button onClick={previous} type="button" className=" slick-arrow slick-prev-momo"><i style={{color:"#333"}} className="las la-angle-left"></i></button>
                    <button onClick={next} type="button" className=" slick-arrow slick-next-momo"><i style={{color:"#333"}} className="las la-angle-right"></i></button>
    <Slider  ref={customeSlider}  {...settings}>
                        {
                            products.map((item, i) => (
                                                <div key={i} className="carousel-box">
                                    <div
                                        onMouseEnter={onMouseEnter.bind(this, item.id)}
                                        onMouseLeave={onMouseEnter.bind(this, item.id)}
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
                            <div style={{position:"absolute",left:0,top:0}}>
                                                {/* <ThreeAddFun   trans={trans} showThreeFun={showThreeFun} id={item.id} /> */}
                            </div>
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
