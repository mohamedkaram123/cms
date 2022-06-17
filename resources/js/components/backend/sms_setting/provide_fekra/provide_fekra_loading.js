import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function ProvideFekraLoading() {
    return (
        <div>
            <SkeletonTheme color="#fff" highlightColor="#eee" >
                        <div className="card">
                <div className="card-header">
                    <span><Skeleton width={100} height={15} /></span>
                </div>
                <div className="card-body">
                    <div className="row">
                                <div className="col-12">
                                    <div className="form-group">
                                            <label ><Skeleton width={100} height={15} /></label>
                                            <div className="input-group">

                                        <Skeleton width={500} height={40} />
                                    </div>
                                            </div>
                                    </div>
                    </div>

                    <div className="row">
                                    <div className="col-12">
                                        <div className="form-group">
                                                <label ><Skeleton width={100} height={15} /></label>
                                                <div className="input-group">

                                        <Skeleton width={500} height={40} />
                                                </div>
                                        </div>
                                     </div>
                    </div>
                   <div className="row">
                                    <div className="col-12">
                                        <div className="form-group">
                                                <label ><Skeleton width={100} height={15} /></label>
                                                <div className="input-group">

                                        <Skeleton width={500} height={40} />
                                                </div>
                                        </div>
                                     </div>
                    </div>

                <div className="row">
                    <div className="col-12">
                     <div className="d-flex flex-row-reverse">
                                        <Skeleton width={100} height={40} />

                    </div>
                    </div>
                </div>
                </div>

            </div>

         </SkeletonTheme>
        </div>
    )
}
