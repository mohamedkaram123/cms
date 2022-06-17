import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton';
import RenderStart from '../../../../helpers/render_start';
import { Urls } from '../../../backend/urls';

export default function RatingShop({detailedProduct}) {

        const [isLoading, setisLoading] = useState(true)
    const [ratingAndTotal, setratingAndTotal] = useState({
        total: 0,
        rating:0
    })
    const [trans, settrans] = useState({
        "customer reviews": "",
        "Not Found Rate":""
    })


          const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

                callTrans(trans)
               ratingShopData()
        //   BrandsCountData();
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);


    const ratingShopData = () => {
                        //    setisLoading(loading)

        axios.get(Urls.url + "products/getRattingShop?user_id="+detailedProduct.user_id)
            .then(res => {

                setratingAndTotal(res.data)


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
        <div>

                            <div className="text-center border rounded p-2 mt-3">
                                <div className="rating">
                                    {/* @if ($total > 0)

                                        {{ renderStarRating($rating/$total) }}
                                    @else
                                        {{ renderStarRating(0) }}
                                    @endif */}
                                  {ratingAndTotal.total > 0?<RenderStart rating={ratingAndTotal.rating / ratingAndTotal.total } />:<RenderStart rating={0 } />}
                                </div>
                                <div className="opacity-60 fs-12">{ ratingAndTotal.total == 0 ?trans["Not Found Rate"]:trans['customer reviews'] } </div>
                            </div>
                        </div>
    )
    }

}
