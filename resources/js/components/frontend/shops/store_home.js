import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton';
import RenderStart from '../../../helpers/render_start';
import { Urls } from '../../backend/urls';

export default function StoreHome({user_id,type}) {

    const [isLoading, setisLoading] = useState(true)
    const [products, setProducts] = useState([])
    const [trans, settrans] = useState({
        "customer reviews": ""
    })


    const mounted = useRef(false);
    useEffect(() => {
        if (!mounted.current) {
            // do componentDidMount logic

            // callTrans(trans)
            ShopData()
                //   BrandsCountData();
            mounted.current = true;
        } else {


            // do componentDidUpdate logic
        }
    }, []);


    const ShopData = () => {
        //    setisLoading(loading)

        axios.get(Urls.url + `shop_data/store_home?user_id=${user_id}&&type=${type}`)
            .then(res => {

                setProducts(res.data.products)


                setisLoading(false)

            })
            .catch(err => {})
    }

    // const callTrans = (transes) => {

    //     let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    //     let data_post = {
    //         data: transes,
    //         "_token": csrf_token
    //     }
    //     axios.post(Urls.static_url + "trans_data", data_post)
    //         .then(res => {


    //             settrans(res.data)

    //         })
    //         .catch(err => {

    //         })
    // }

    if (isLoading) {
        return (
            <div>
                                                                 <SkeletonTheme color="#fff" highlightColor="#eee" >

            <div className="row gutters-5 row-cols-xxl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">

            {
                [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1].map((item, i) => {
                   return (
                                  <div key={i} className="col mb-3">
                                          <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        <div className="position-relative">
                            <Skeleton width={270} height={200} />
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
                            )
                })}
                </div>
                                        </SkeletonTheme>

                </div>

        )
    } else {
        return (
            <div className="row gutters-5 row-cols-xxl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">
            {
                products.map((item, i) => {
                   return (
                                  <div key={i} className="col mb-3">
                        <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md h-100 has-transition bg-white">
                            <div className="position-relative">
                                <a href={Urls.url + `product/${item.slug}`} className="d-block">
                                    <img
                                        className="img-fit lazyload mx-auto h-160px h-sm-200px h-md-220px h-xl-270px"
                                        src={ Urls.public_url + 'assets/img/placeholder.jpg'}
                                        data-src={item.photo}
                                        alt={item.name}
                                    />
                                </a>
                                {/* <div className="absolute-top-right aiz-p-hov-icon">
                                    <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                                        <i className="la la-heart-o"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                                        <i className="las la-sync"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left">
                                        <i className="las la-shopping-cart"></i>
                                    </a>
                                </div> */}
                            </div>
                            <div className="p-md-3 p-2 text-left">
                                <div className="fs-15">
                                    {item.is_del?<del className="fw-600 opacity-50 mr-1">{ item.home_base_price}</del>:null}
                                    {/* @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                        <del className="fw-600 opacity-50 mr-1">{{ home_base_price($product->id) }}</del>
                                    @endif */}
                                    <span className="fw-700 text-primary">{item.price}</span>
                                </div>
                                <div className="rating rating-sm mt-1">
                                    { <RenderStart rating={item.rating} /> }
                                </div>
                                <h3 className="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                    <a href="{{ route('product', $product->slug) }}" className="d-block text-reset">{item.name}</a>
                                </h3>


                            </div>
                        </div>
                    </div>
                            )
                     } )}
                            </div>
    )
    }

}
