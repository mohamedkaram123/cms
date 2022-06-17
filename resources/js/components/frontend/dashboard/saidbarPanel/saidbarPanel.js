import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton';
import RenderStart from '../../../../helpers/render_start';
import { Urls } from '../../../backend/urls';

export default function SaidBarPanel() {

        const [isLoading, setisLoading] = useState(true)
    const [saidbarPanel, setsaidbarPanel] = useState({
        avatar_original: "",
        name: "",
        user_type: "",
        verification_status: 0,
        vendor_system_activation: 0,
        grand_total_first:0,
        grand_total: 0,
        grand_total_last:0

    })
    const [trans, settrans] = useState({
        "Be A Seller": "",
        "Sold Amount": "",
        "Your sold amount (current month)": "",
        "Total Sold": "",
        "Last Month Sold":""
    })


          const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

                callTrans(trans)
               saidBarData()

        //   BrandsCountData();
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);


    const saidBarData = () => {
                        //    setisLoading(loading)

        axios.get(Urls.url + "dashboard/saidbarpanel")
            .then(res => {

                setsaidbarPanel(res.data)

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

    if (isLoading) {
        return (
                   <div>
                <SkeletonTheme color="#fff" highlightColor="#eee" >
                        <div style={{width:300}} className="aiz-user-sidenav-wrap pt-4 position-relative z-1 shadow-sm">
    <div className="absolute-top-right d-xl-none">
        <button className="btn btn-sm p-2" data-toggle="className-toggle" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
            <i className="las la-times la-2x"></i>
        </button>
    </div>
    <div className="absolute-top-left d-xl-none">
        <a className="btn btn-sm p-2" href="{{ route('logout') }}">
            <i className="las la-sign-out-alt la-2x"></i>
        </a>
    </div>
    <div className="aiz-user-sidenav rounded overflow-hidden  c-scrollbar-light">
        <div className="px-4 text-center mb-4">
                          <Skeleton width="40%" height={80} style={{borderRadius:50}} />

                              <h4 className="h5 fw-600"><Skeleton width="50%" height="1%"  />
                                    <span className="ml-2">
                                                 <i className="las la-check-circle" style={{color:"green"}}></i>


                    </span>
                </h4>

        </div>

                  <div>
                  <hr />
             <h4 className="h5 fw-600 text-center"><Skeleton width="50%" height="1%"  /></h4>
              <div className="widget-balance pb-3 pt-1">
            <div className="text-center">
                <div className="heading-4 strong-700 mb-4">
                    {/* @php
                        $orderTotal = \DB::table('orders')
                        ->where('seller_id', Auth::user()->id)
                        ->where("payment_status", 'paid')
                        ->where('created_at', '>=', $days_ago_30)
                        ->select(DB::raw("SUM(orders.grand_total) as grand_total"))
                        ->get();
                        //$orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', $days_ago_30)->get();
                        //$total = 0;
                        //foreach ($orderDetails as $key => $orderDetail) {
                            //if($orderDetail->order != null && $orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                //$total += $orderDetail->price;
                            //}
                        //}
                    @endphp */}
                    <small className="d-block fs-12 mb-2"><Skeleton width="90%" height="1%"  /> </small>
                    <span className="btn btn-primary fw-600 fs-18"><Skeleton width="50%" height="1%"  /> </span>
                </div>
                <table className="table table-borderless">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                        {/* @php
                            $orderTotal = \DB::table('orders')
                            ->where('seller_id', Auth::user()->id)
                            ->where("payment_status", 'paid')
                            ->select(DB::raw("SUM(orders.grand_total) as grand_total"))
                        ->get();
                        @endphp */}
                        <td className="p-1" width="60%">
                            <Skeleton width="100%" height="1%"  />:
                        </td>
                        <td className="p-1 fw-600" width="40%">
                            <Skeleton width="100%" height="1%"  />
                        </td>
                    </tr>
                    <tr>
                        {/* @php
                            $orderTotal = \DB::table('orders')
                            ->where('seller_id', Auth::user()->id)
                            ->where("payment_status", 'paid')
                            ->where('created_at', '>=', $days_ago_60)
                            ->where('created_at', '<=', $days_ago_30)
                            ->select(DB::raw("SUM(orders.grand_total) as grand_total"))
                        ->get();
                        @endphp */}
                        <td className="p-1" width="60%">
                            <Skeleton width="100%" height="1%"  />:
                        </td>
                        <td className="p-1 fw-600" width="40%">
                           <Skeleton width="100%" height="1%"  />
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>

        </div>
        </div>



    </div>
</div>

                    <div className="text-center border rounded p-2 mt-3">
                                <div className="rating">
                                    <Skeleton width="50%" height="1%" />
                                </div>
                                <div className="opacity-60 fs-12"><Skeleton width="70%" height="2%" /></div>
                            </div>
                        </SkeletonTheme>
              </div>

        )
    } else {
        return (
    <div className="aiz-user-sidenav-wrap pt-4 position-relative z-1 shadow-sm">
    <div className="absolute-top-right d-xl-none">
        <button className="btn btn-sm p-2" data-toggle="className-toggle" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
            <i className="las la-times la-2x"></i>
        </button>
    </div>
    <div className="absolute-top-left d-xl-none">
        <a className="btn btn-sm p-2" href="{{ route('logout') }}">
            <i className="las la-sign-out-alt la-2x"></i>
        </a>
    </div>
    <div className="aiz-user-sidenav rounded overflow-hidden  c-scrollbar-light">
        <div className="px-4 text-center mb-4">
            <span className="avatar avatar-md mb-3">
                            {saidbarPanel.avatar_original != null ?
                                (<img src={Urls.public_url + saidbarPanel.avatar_original} />) :
                                (<img src={Urls.public_url + "assets/img/avatar-place.png"} />)
                }
                {/* @if (Auth::user()->avatar_original != null)

                @else
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" className="image rounded-circle" onError="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @endif */}
            </span>

                        {saidbarPanel.user_type == "customer" ? (
                            <h4 className="h5 fw-600">{ saidbarPanel.name }</h4>
                        ) : (
                              <h4 className="h5 fw-600">{saidbarPanel.name}
                                    <span className="ml-2">
                                        {saidbarPanel.verification_status == 1 ? (
                                                 <i className="las la-check-circle" style={{color:"green"}}></i>

                                        ) : (
                                            <i className="las la-times-circle" style={{color:"red"}}></i>

                                        )

                                        }

                    </span>
                </h4>
                        )

                        }
            {/* @if(Auth::user()->user_type == 'customer')
                <h4 className="h5 fw-600">{{ Auth::user()->name }}</h4>
            @else
                <h4 className="h5 fw-600">{{ Auth::user()->name }}
                    <span className="ml-2">
                        @if(Auth::user()->seller->verification_status == 1)
                            <i className="las la-check-circle" style="color:green"></i>
                        @else
                            <i className="las la-times-circle" style="color:red"></i>
                        @endif
                    </span>
                </h4>
            @endif */}
        </div>

            {
                saidbarPanel.vendor_system_activation == 1 && saidbarPanel.user_type == "customer"?(
                    <div>
                <a href="{{ route('shops.create') }}" className="btn btn-block btn-soft-primary rounded-0">
                    { trans['Be A Seller'] }
                </a>
            </div>
                ):(null)
            }
        {/* @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1 && Auth::user()->user_type == 'customer')
            <div>
                <a href="{{ route('shops.create') }}" className="btn btn-block btn-soft-primary rounded-0">
                    </i>{{ translate('Be A Seller') }}
                </a>
            </div>
        @endif */}
          {
              saidbarPanel.user_type == "seller"?(
                  <div>
                  <hr />
             <h4 className="h5 fw-600 text-center">{trans['Sold Amount']}</h4>
              <div className="widget-balance pb-3 pt-1">
            <div className="text-center">
                <div className="heading-4 strong-700 mb-4">
                    {/* @php
                        $orderTotal = \DB::table('orders')
                        ->where('seller_id', Auth::user()->id)
                        ->where("payment_status", 'paid')
                        ->where('created_at', '>=', $days_ago_30)
                        ->select(DB::raw("SUM(orders.grand_total) as grand_total"))
                        ->get();
                        //$orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', $days_ago_30)->get();
                        //$total = 0;
                        //foreach ($orderDetails as $key => $orderDetail) {
                            //if($orderDetail->order != null && $orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                //$total += $orderDetail->price;
                            //}
                        //}
                    @endphp */}
                    <small className="d-block fs-12 mb-2">{ trans['Your sold amount (current month)']}</small>
                    <span className="btn btn-primary fw-600 fs-18">{saidbarPanel.grand_total_first}</span>
                </div>
                <table className="table table-borderless">
                    <thead>

                    </thead>
                    <tbody>
                        <tr>
                        {/* @php
                            $orderTotal = \DB::table('orders')
                            ->where('seller_id', Auth::user()->id)
                            ->where("payment_status", 'paid')
                            ->select(DB::raw("SUM(orders.grand_total) as grand_total"))
                        ->get();
                        @endphp */}
                        <td className="p-1" width="60%">
                            { trans['Total Sold']}:
                        </td>
                        <td className="p-1 fw-600" width="40%">
                            {saidbarPanel.grand_total}
                        </td>
                    </tr>
                    <tr>
                        {/* @php
                            $orderTotal = \DB::table('orders')
                            ->where('seller_id', Auth::user()->id)
                            ->where("payment_status", 'paid')
                            ->where('created_at', '>=', $days_ago_60)
                            ->where('created_at', '<=', $days_ago_30)
                            ->select(DB::raw("SUM(orders.grand_total) as grand_total"))
                        ->get();
                        @endphp */}
                        <td className="p-1" width="60%">
                            { trans['Last Month Sold']}:
                        </td>
                        <td className="p-1 fw-600" width="40%">
                           {saidbarPanel.grand_total_last}
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>

        </div>
        </div>

              ):(null)
          }


    </div>
</div>

            )
    }

}
