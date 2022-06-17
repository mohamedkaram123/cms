import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function LoadListProducts2() {
    return (
        <div class="col mb-3">
                  <SkeletonTheme color="#fff"  highlightColor="#eee" >

                <div class="aiz-card-box h-100 d-flex flex-md-row flex-column border border-light rounded shadow-sm shadow-md has-transition bg-white">
                                        <div className="position-relative">

                                            <Skeleton width={210} height={200} />
                                        </div>
                                        <div className="p-md-3 p-2 text-left">
                                            <h3 className="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                                <div className="d-flex flex-column">
                                                    <Skeleton width={400} height={15} />
                                                    <Skeleton width={400} height={15} />
                                                </div>

                                            </h3>
                                        </div>
                                    </div>
                                                </SkeletonTheme>

            </div>
  )
}
