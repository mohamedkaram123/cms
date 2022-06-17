import axios from 'axios';
import React, { useEffect, useRef, useState } from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton';
import { Urls } from '../../../backend/urls';

export default function Boxes() {


        const [isLoading, setisLoading] = useState(true)
    const [boxData, setboxData] = useState({
        products_count: 0,
        order_details_count: 0,
                order_details_total:0

    })
    const [trans, settrans] = useState({
        "Successful orders": "",
        "Total earnings": "",
        "Products": "",
        "Total sale":""

    })


          const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic

                callTrans(trans)
               boxesData()
        //   BrandsCountData();
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);


    const boxesData = () => {
                        //    setisLoading(loading)

        axios.get(Urls.url + "dashboard/boxes")
            .then(res => {

                setboxData(res.data)


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
                                <div style={{marginBottom:20}} className="row gutters-10">

          <div className="col-md-3" >
         <Skeleton width="100%" height={150} />

                        </div>
          <div className="col-md-3" >
         <Skeleton width="100%" height={150} />

                        </div>
         <div className="col-md-3" >
         <Skeleton width="100%" height={150} />

        </div>
        <div className="col-md-3" >
         <Skeleton width="100%" height={150} />

        </div>
    </div>

                        </SkeletonTheme>
              </div>

        )
    } else {
        return (
                <div className="row gutters-10">
        <div className="col-md-3">
            <div className="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
              <div className="px-3 pt-3">
                <div className="h3 fw-700">
                  {boxData.products_count}
                </div>
                <div className="opacity-50">{ trans['Products']}</div>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                  <path fill="rgba(255,255,255,0.3)" fillOpacity="1" d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
              </svg>
            </div>
        </div>

        <div className="col-md-3">
            <div className="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                <div className="px-3 pt-3">
                    <div className="h3 fw-700">
                      {boxData.order_details_count}
                    </div>
                    <div className="opacity-50">{ trans['Total sale']}</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path fill="rgba(255,255,255,0.3)" fillOpacity="1" d="M0,192L30,208C60,224,120,256,180,245.3C240,235,300,181,360,144C420,107,480,85,540,96C600,107,660,149,720,154.7C780,160,840,128,900,117.3C960,107,1020,117,1080,112C1140,107,1200,85,1260,74.7C1320,64,1380,64,1410,64L1440,64L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
                </svg>
            </div>
        </div>

        <div className="col-md-3">
            <div className="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                <div className="px-3 pt-3">

                    <div className="h3 fw-700">{boxData.order_details_total}</div>
                    <div className="opacity-50">{ trans['Total earnings'] }</div>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                      <path fill="rgba(255,255,255,0.3)" fillOpacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                  </svg>
            </div>
        </div>

        <div className="col-md-3">
            <div className="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
              <div className="px-3 pt-3">

                  <div className="h3 fw-700">
                      {boxData.order_details_count}
                  </div>
                  <div className="opacity-50">{ trans['Successful orders']}</div>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                  <path fill="rgba(255,255,255,0.3)" fillOpacity="1" d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
              </svg>
            </div>
        </div>
    </div>
        )
    }

}
