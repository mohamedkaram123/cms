import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function LoadingTable() {
    return (
        <div>
            <SkeletonTheme color="#fff"  highlightColor="#eee" >


        <div className="card">
                <div  className="card-header">


                <h1><Skeleton width={40} height={40} /> <Skeleton width={80} height={15} /></h1>
           <div className="d-flex flex-row" style={{alignItems:"flex-end"}}>

               <div className="p-2">
               <Skeleton width={300} height={40} />

               </div>


                        <div className="p-2">
                          <Skeleton width={300} height={40} />
                        </div>

                         <div className="p-2" style={{alignSelf:"flex-start"}}>
                          <Skeleton width={40} height={20} style={{borderRadius:10}} />

                        </div>
           </div>

            </div>

        </div>

            </SkeletonTheme>
        </div>
    )
}
