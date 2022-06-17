import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton';
import { Urls } from '../../../backend/urls';

export default function Categories() {


        const [isLoading, setisLoading] = useState(true)
    const [Categories, setCategories] = useState([])
    const [trans, settrans] = useState({
        "Configure Now": "",
        "Configure your payment method": "",
        "Payment": "",
        "Go to setting": "",
        "Manage & organize your shop": "",
        "Shop": "",
        "Add New Product": "",
        "Product": "",
        "Category": "",
        "Products": "",
        "show products":""

    })


          const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

                callTrans(trans)
               categoriesData()
        //   BrandsCountData();
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);


    const categoriesData = () => {
                        //    setisLoading(loading)

        axios.get(Urls.url + "dashboard/categories")
            .then(res => {
                setCategories(res.data.categories)
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
                                  <div className="row">
      <div className="col-md-8">
          <div className="card">
              <div className="card-header">
                     <div className="card-header d-flex flex-row" style={{ justifyContent: "space-between" }}>
                  <Skeleton width="50%" height={10} />

                  <Skeleton width="50%" height={10} />

              </div>
              </div>
    		          <div className="card-body">
                <table className="table aiz-table mb-0">
                  <thead>
                      <tr>
                          <th><Skeleton width="50%" height="1%" /></th>
                          <th><Skeleton width="50%" height="1%" /></th>
                      </tr>
                  </thead>
                  <tbody>

                                    {[1,2,3,4,5,6].map((item, i) => {

                                        return (
                                            <tr key={i}>
                              <td><Skeleton width="80%" height="1%" /></td>
                              <td><Skeleton width="50%" height="1%" /></td>
                                           </tr>
                                        )

                           })

                           }
                </tbody>
                </table>
                <br />
                <div className="text-center">
                    <Skeleton width="30%" height={50} />
                </div>
              </div>
          </div>
      </div>
      <div className="col-md-4">

          <div className="bg-white mt-4 p-4 text-center">
              <div className="h5 fw-600">{ trans['Shop']}</div>
              <p><Skeleton width="50%" height="1%" /></p>
              <a href="{{ route('shops.index') }}" className="btn btn-soft-primary"><Skeleton width="50%" height="1%" /></a>
          </div>
          <div className="bg-white mt-4 p-4 text-center">
              <div className="h5 fw-600"><Skeleton width="50%" height="1%" /></div>
              <p><Skeleton width="50%" height="1%" /></p>
              <a href="{{ route('profile') }}" className="btn btn-soft-primary"><Skeleton width="50%" height="1%" /></a>
          </div>
      </div>
    </div>

                        </SkeletonTheme>
              </div>

        )
    } else {
        return (
            <div className="row">
      <div className="col-md-8">
          <div className="card">
                        <div className="card-header d-flex flex-row" style={{ justifyContent: "space-between" }}>
                                                  <h6 className="mb-0">{ trans['Products'] }</h6>

                                  <a href={Urls.url + "seller/product/upload"} className="btn btn-primary d-inline-block">{ trans['Add New Product']}</a>

              </div>
    		          <div className="card-body">
                <table className="table  mb-0">
                  <thead>
                      <tr>
                          <th>{ trans['Category']}</th>
                          <th>{ trans['Product']}</th>
                      </tr>
                  </thead>
                  <tbody>

                                    {Categories.map((item, i) => {

                                        return (
                                            <tr key={i}>
                              <td>{ item.name }</td>
                              <td>{ item.count }</td>
                                           </tr>
                                        )

                           })

                           }
                </tbody>
                </table>
                <br />
                <div className="text-center">
                    <a href={Urls.url + "seller/products"} className="btn btn-primary d-inline-block">{ trans['show products']}</a>
                </div>
              </div>
          </div>
      </div>
      <div className="col-md-4">
          {/* @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)

              <div className="card">
                  <div className="card-header">
                      <h6 className="mb-0">{{ trans('Purchased Package') }}</h6>
                  </div>
                  @php
                      $seller_package = \App\SellerPackage::find(Auth::user()->seller->seller_package_id);
                  @endphp
                  <div className="card-body text-center">
                      @if($seller_package != null)
                        <img src="{{ uploaded_asset($seller_package->logo) }}" className="img-fluid mb-4 h-110px">
                        <p className="mb-1 text-muted">{{ trans('Product Upload Remaining') }}: {{ Auth::user()->seller->remaining_uploads }} {{ trans('Times')}}</p>
                        <p className="text-muted mb-1">{{ trans('Digital Product Upload Remaining') }}: {{ Auth::user()->seller->remaining_digital_uploads }} {{ trans('Times')}}</p>
                        <p className="text-muted mb-4">{{ trans('Package Expires at') }}: {{ Auth::user()->seller->invalid_at }}</p>
                        <h6 className="fw-600 mb-3 text-primary">{{ trans('Current Package') }}: {{ $seller_package->name }}</h6>
                      @else
                          <h6 className="fw-600 mb-3 text-primary">{{trans('Package Not Found')}}</h6>
                      @endif
                      <div className="text-center">
                          <a href="{{ route('seller_packages_list') }}" className="btn btn-soft-primary">{{ trans('Upgrade Package')}}</a>
                      </div>
                  </div>
              </div>
          @endif */}
          <div className="bg-white mt-4 p-4 text-center">
              <div className="h5 fw-600">{ trans['Shop']}</div>
              <p>{ trans['Manage & organize your shop']}</p>
              <a href={Urls.url + "shops"} className="btn btn-soft-primary">{ trans['Go to setting']}</a>
          </div>
          <div className="bg-white mt-4 p-4 text-center">
              <div className="h5 fw-600">{ trans['Payment']}</div>
              <p>{ trans['Configure your payment method']}</p>
              <a href={Urls.url + "profile"} className="btn btn-soft-primary">{ trans['Configure Now']}</a>
          </div>
      </div>
    </div>

            )
    }

}
