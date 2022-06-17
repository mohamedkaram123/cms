import axios from "axios";
import RenderStart from "../../../../helpers/render_start";
import { Urls } from "../../../backend/urls";
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import getStyleObjectFromString from "../../../../helpers/style_price";
const { Component } = require("react");

export default class TopSelling extends Component {

    constructor() {
        super()

        this.inc = 0;
        this.state = {
            isLoading: true,
            trans: {
                "Top Selling Products": ""
            },
            style_price: "",
                        style_price_del:"",

            top_six_products:[]
        }

    }
    componentDidMount() {

        this.callTrans(this.state.trans)

        this.top_six_products();
    }

    callTrans(transes) {

        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data_post = {
            data: transes,
            "_token": csrf_token
        }
        axios.post(Urls.static_url + "trans_data", data_post)
            .then(res => {


                this.setState({
                    trans: res.data,
                })

            })
            .catch(err => {

            })
    }


    top_six_products() {

        axios.get(Urls.url + "products/top_six_products?user_id="+this.props.detailedProduct.user_id)
            .then(res => {
                      this.setState({
                          top_six_products: res.data.products,
                          style_price: res.data.style_price,
                          style_price_del:res.data.style_price_del,
                     isLoading: false
                      })


            })
            .catch(err => {
            console.log({err});
        })

   }

    render() {

        if (this.state.isLoading) {
            return (
                  <div>
                                         <SkeletonTheme color="#fff"  highlightColor="#eee" >

                    <div className="bg-white rounded shadow-sm mb-3">
                        <div className="p-3 border-bottom fs-16 fw-600">
                                                                <Skeleton width="30%" height="2%" />
                        </div>
                        <div className="p-3">
                            <ul className="list-group list-group-flush">

                                {[1,2,3,4,5,6].map((item, i) => {
                                    return (
                                          <li key={i} className="py-3 px-0 list-group-item border-light">
                                    <div className="row gutters-10 align-items-center">
                                        <div className="col-5">
                                            <a href="{{ route('product', $top_product->slug) }}" className="d-block text-reset">
                                                        <Skeleton width="80%" height={80} />
                                            </a>
                                        </div>
                                        <div className="col-7 text-left">
                                                    <h4 className="fs-13 text-truncate-2">
                                                 <Skeleton width="70%" height="1%" />
                                                {/* <a href="{{ route('product', $top_product->slug) }}" className="d-block text-reset">{item.name}</a> */}
                                            </h4>
                                            <div className="rating rating-sm mt-1">
                                                <Skeleton width="50%" height="1%" />
                                                 {/* <RenderStart rating={item.rating} /> */}
                                            </div>
                                            <div className="mt-2">
                                                <Skeleton width="30%" height="3%" />
                                                {/* <span className="fs-17 fw-600 text-primary">{item.price}</span> */}
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                    )
                                })}
                                {/* @foreach (filter_products(\App\Product::where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)

                              <li className="py-3 px-0 list-group-item border-light">
                                    <div className="row gutters-10 align-items-center">
                                        <div className="col-5">
                                            <a href="{{ route('product', $top_product->slug) }}" className="d-block text-reset">
                                                <img
                                                    className="img-fit lazyload h-xxl-110px h-xl-80px h-120px"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($top_product->thumbnail_img) }}"
                                                    alt="{{ $top_product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </a>
                                        </div>
                                        <div className="col-7 text-left">
                                            <h4 className="fs-13 text-truncate-2">
                                                <a href="{{ route('product', $top_product->slug) }}" className="d-block text-reset">{{ $top_product->getTranslation('name') }}</a>
                                            </h4>
                                            <div className="rating rating-sm mt-1">
                                                {{ renderStarRating($top_product->rating) }}
                                            </div>
                                            <div className="mt-2">
                                                <span className="fs-17 fw-600 text-primary">{{ home_discounted_base_price($top_product->id) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach */}
                            </ul>
                        </div>
                        </div>
                        </SkeletonTheme>
              </div>
            )
        } else {
            return (
                <div>
                    <div className="bg-white rounded shadow-sm mb-3">
                        <div className="p-3 border-bottom fs-16 fw-600">
                            { this.state.trans['Top Selling Products']}
                        </div>
                        <div className="p-3">
                            <ul className="list-group list-group-flush">

                                {this.state.top_six_products.map((item, i) => {
                                    return (
                                          <li key={i} className="py-3 px-0 list-group-item border-light">
                                    <div className="row gutters-10 align-items-center">
                                        <div className="col-5">
                                            <a href="{{ route('product', $top_product->slug) }}" className="d-block text-reset">
                                                <img
                                                    className="img-fit lazyload h-xxl-110px h-xl-80px h-120px"
                                                    src={Urls.public_url + "assets/img/placeholder.jpg'"}
                                                    data-src={item.photo}
                                                    alt={item.name}
                                                />
                                            </a>
                                        </div>
                                        <div className="col-7 text-left">
                                            <h4 className="fs-13 text-truncate-2">
                                                <a href="{{ route('product', $top_product->slug) }}" className="d-block text-reset">{item.name}</a>
                                            </h4>
                                            <div className="rating rating-sm mt-1">
                                                 <RenderStart rating={item.rating} />
                                            </div>
                                            <div className="mt-2">
                                                <span className="fw-600 text-primary" style={getStyleObjectFromString(this.state.style_price)} >{item.price}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                    )
                                })}
                                {/* @foreach (filter_products(\App\Product::where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)

                              <li className="py-3 px-0 list-group-item border-light">
                                    <div className="row gutters-10 align-items-center">
                                        <div className="col-5">
                                            <a href="{{ route('product', $top_product->slug) }}" className="d-block text-reset">
                                                <img
                                                    className="img-fit lazyload h-xxl-110px h-xl-80px h-120px"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($top_product->thumbnail_img) }}"
                                                    alt="{{ $top_product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </a>
                                        </div>
                                        <div className="col-7 text-left">
                                            <h4 className="fs-13 text-truncate-2">
                                                <a href="{{ route('product', $top_product->slug) }}" className="d-block text-reset">{{ $top_product->getTranslation('name') }}</a>
                                            </h4>
                                            <div className="rating rating-sm mt-1">
                                                {{ renderStarRating($top_product->rating) }}
                                            </div>
                                            <div className="mt-2">
                                                <span className="fs-17 fw-600 text-primary">{{ home_discounted_base_price($top_product->id) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach */}
                            </ul>
                        </div>
                    </div>
              </div>
            )
        }
    }

}
