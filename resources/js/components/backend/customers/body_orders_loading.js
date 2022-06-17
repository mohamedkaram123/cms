import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function BodyOrdersLoading() {
    return (
        <div>
                        <SkeletonTheme color="#fff"  highlightColor="#eee" >

            <div className="d-flex flex-column">

            <div className="p-2" style={{display:"flex",justifyContent:"center",alignItems:"center"}}>
                        <span><Skeleton width={80} height={15} /></span>
                    </div>
                <div className="d-flex flex-row">
                    <div className="p-2">
                        <span><Skeleton width={80} height={15} /> : <Skeleton width={80} height={15} /></span>
                    </div>
                    <div className="p-2">
                        <span><Skeleton width={80} height={15} /> : <Skeleton width={80} height={15} /></span>
                    </div>
                </div>
                <div className="d-flex flex-row">
                    <div className="p-2">
                        <span><Skeleton width={80} height={15} /> : <Skeleton width={80} height={15} /></span>
                    </div>
                    <div className="p-2">
                        <span><Skeleton width={80} height={15} /> : <Skeleton width={80} height={15} /></span>
                    </div>
                </div>
            </div>
            </SkeletonTheme>
        </div>

    )
}
