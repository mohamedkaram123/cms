import axios from 'axios'
import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../urls'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function TotalCategories({ trans,handleErrorLoad }) {

    const [isLoading, setisLoading] = useState(true)
    const [CategoriesCount, setCategoriesCount] = useState(0)

        const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic
            //     if (localStorage.getItem("total_categories") !== null) {

            //   let bardsCount = localStorage.getItem("total_categories");
            //   setCategoriesCount(parseInt(bardsCount))
            //           setisLoading(false)
            //         }
          CategoriesCountData();
        mounted.current = true;
      } else {



        // do componentDidUpdate logic
      }
    }, []);

    const CategoriesCountData = () => {
        axios.get(Urls.static_url + "total_categories")
            .then(res => {

                setCategoriesCount(res.data.total_categories)
                               //  localStorage.setItem('total_categories', res.data.total_categories);

                setisLoading(false)

            })
            .catch(err => {
            handleErrorLoad()
        })
    }


    if (isLoading) {
        return (
            <div>

                  <SkeletonTheme color="#fff"  highlightColor="#eee" >

                    <Skeleton width={300} height={170} />

                    </SkeletonTheme>
            </div>
        )
    } else {
            return (
        <div>

                <div className="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                    <div className="px-3 pt-3">
                        <div className="opacity-50">
                            <span className="fs-12 d-block">{ trans['Total'] }</span>
                            { trans['Product category'] }
                        </div>
                        <div className="h3 fw-700 mb-3">{CategoriesCount}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fillOpacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
        </div>
    )
    }


}

