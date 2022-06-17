import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function BodyModalMailLoading() {
    return (

                   <div>
  <SkeletonTheme color="#fff"  highlightColor="#eee" >
            <div className="row">
                <div className="col-6">
                    <div className="form-group">
                                <label className="col-from-label"><Skeleton width={80} height={15} /></label>
                                <Skeleton width={250} height={40} />

                    </div>
                </div>

                <div className="col-6">
                    <div className="form-group">
                                 <label className="col-from-label"><Skeleton width={80} height={15} /></label>
                            <Skeleton width={250} height={40} />
                        </div>
                </div>

            </div>

            <div className="row">

            <div className="col-6">
                    <div className="form-group">
                                 <label className="col-from-label"><Skeleton width={80} height={15} /></label>
                            <Skeleton width={250} height={40} />
                        </div>
                </div>


                <div className="col-6">
                    <div className="form-group">
                                 <label className="col-from-label"><Skeleton width={80} height={15} /></label>
                            <Skeleton width={250} height={40} />
                        </div>
                </div>
            </div>



            <div className="row">
                <div className="col-12">
                    <div className="form-group">
                              <label className="col-from-label"><Skeleton width={80} height={15} /></label>
                            <Skeleton width={250} height={40} />
                            </div>
                </div>
            </div>


            <div className="row">
                <div className="col-12">
                    <div className="form-group">
                                <label className="col-from-label"><Skeleton width={80} height={15} /></label>
                                                        <Skeleton width={500} height={400} />

                        </div>
                </div>
            </div>

            <div className="row">
            <div className="col-6 ">
                            <Skeleton width={250} height={300} />
                        </div>
                </div>
                </SkeletonTheme>
        </div>


    )
}
