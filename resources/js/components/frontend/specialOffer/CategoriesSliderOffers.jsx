import React,{useState,useRef,useEffect,createRef} from 'react';
import LoadingInline from '../../../helpers/LoadingInline';
import axios from 'axios';
import { Urls } from '../../backend/urls';
import { useMediaQuery } from 'react-responsive'
import Slider from "react-slick";
import Offer_cat from './show_offers_cat/offer_cat';


export default function CategoriesSliderOffers() {
  const customeSlider = createRef();
  const isMobile = useMediaQuery({
    query: '(max-width: 600px)'
  })
        const [sliderNumber, setsliderNumber] = useState(2)

            const [trans, settrans] = useState({
                "Offer Categories":""
            })
            const [cat_offers_data, setcat_offers_data] = useState([])

       const mounted = useRef(false);
            useEffect(() => {
            if (!mounted.current) {


                callTrans(trans)
                cat_offers()
            mounted.current = true;
            } else {


            }
            }, []);

      var settings = {

    infinite: true,
    speed: 500,
    slidesToShow:isMobile?1:(cat_offers_data.length < 2 ?1:sliderNumber),
          slidesToScroll: 1,
          className: "aiz-carousel gutters-10 half-outside-arrow ",
          arrows: false,


      };


 const next = ()=>{
     customeSlider.current.slickNext();
  }
 const previous = ()=>{
     customeSlider.current.slickPrev();
  }
            const [isLoading, setisLoading] = useState(true)

            const  callTrans = (transes)=>{
                let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                  let data_post = {
                 data: transes,
                '_token': csrf_token
                         }

                 axios.post(Urls.static_url + 'trans_data', data_post)
                 .then(res => {
                   settrans(res.data)
                //    setisLoading(false)
                  })
                  .catch(err => {
                   })
            }

            const cat_offers = () => {

                axios.get(Urls.url + "get/categories/offer")
                 .then((res) => {
                     setcat_offers_data(res.data.cat_offers)
                    setisLoading(false)
                }).catch((err) => {

                });
            };




        if (isLoading) {

             return <LoadingInline />

        } else {
            if (cat_offers_data.length != 0) {
                    return (
                   <div>
                        <div  className="card" >
                <div className="card-header">
                    <h6 className="mb-0">{ trans['Offer Categories'] }</h6>
                </div>
                            <div className="card-body" >
                                <button onClick={previous} type="button" className=" slick-arrow slick-prev-momo"><i style={{color:"#333"}} className="las la-angle-left"></i></button>
                                <button onClick={next} type="button" className=" slick-arrow slick-next-momo"><i style={{color:"#333"}} className="las la-angle-right"></i></button>
                                    <Slider ref={customeSlider}  {...settings}>
                                        {
                                            cat_offers_data.map((item,i) => (
                                                <div key={i}>
                                                    <Offer_cat item={item} />
                                                </div>
                                            ))
                                        }
                                    </Slider>
                                </div>
                            </div>
                   </div>
             )
            } else {
                return null
            }


        }


       }
