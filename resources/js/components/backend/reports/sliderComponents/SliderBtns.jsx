import React,{createRef,useState,useRef} from 'react'
import Slider from 'react-slick'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import { faTruck,faCartArrowDown,faUser, faTshirt,faSearch,faWallet, faUserTag, faStreetView } from '@fortawesome/free-solid-svg-icons'

export default function SliderBtns({ trans,setindex }) {
  const customeSlider = createRef();
    const dir = document.querySelector("html").dir;
   let settings_3 = {
      dots: true,
      autoplay: false,
      autoplaySpeed: 3000,
          className: "aiz-carousel gutters-10 half-outside-arrow  ",
       slidesToShow: 4,
       slidesToScroll: 1,
             swipeToSlide: true,
       infinite: false,
       arrows: false,
           responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            initialSlide: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]


   };
     const next = ()=>{
     customeSlider.current.slickNext();
  }
 const previous = ()=>{
     customeSlider.current.slickPrev();
 }
    const [backgroundColor, setbackgroundColor] = useState({})

    const buttons = [
        {
            icon: faCartArrowDown,
            trans:trans["Sales"]
        },
        {
            icon: faTshirt,
            trans:trans["Products"]
        },
        {
            icon: faUser,
            trans:trans["Customers"]
        },
        {
            icon: faStreetView,
            trans:trans["Visits"]
        },
        {
            icon: faTruck,
            trans:trans["Orders"]
        },
        {
            icon: faSearch,
            trans:trans["Search"]
        },
        {
            icon: faTruck,
            trans:trans["Payment & Shipping"]
        }
    ]
  return (
      <div >
          <div className="d-flex flex-inline justify-content-end">
                                  <button onClick={next} type="button" className="btn btn-icon slick-arrow slick-next-momo"><i style={{color:"#333"}} className="las la-angle-right"></i></button>

                   <button onClick={previous} type="button" className="btn btn-icon slick-arrow slick-prev-momo"><i style={{color:"#333"}} className="las la-angle-left"></i></button>
          </div>

          <div className='d-flex justify-content-around' style={{ margin: "20px", justifyContent: 'center' }}>
          <Slider ref={customeSlider}  {...settings_3}>
              {
                  buttons.map((item, i) => (
                      <button  key={i} id="btn-slick" onClick={(event) => {
                          setindex(i)

                               event.currentTarget.classList.add('active-slick')


                      }} style={backgroundColor} className='   btn-slick-slide slide-item '   >
                                    <FontAwesomeIcon  icon={item.icon} style={{marginInline:10}} />
                                                                       <span>{item.trans}</span>
                                </button>


                  ))
              }
          </Slider>
          </div>
    </div>
  )
}
