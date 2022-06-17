import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function LoadingFirebase() {
    return (
        <div>
                                    <SkeletonTheme color="#fff"  highlightColor="#eee" >

                    <div style={{display:"flex",justifyContent:"center",alignItems:"center"}}>
                        <div className="card w-50">
                            <div className="card-header">
                                <div className="card-title">
                                    <Skeleton width={80} height={15} />
                                </div>
                            </div>
                            <div className="card-body">
                                <div className="row">
                                    <div className="col-12">
                                    <div className="form-group">
                                            <label ><Skeleton width={80} height={15} /></label>
                                            <div className="input-group">
                                            <Skeleton width={500} height={40} />
                                            </div>
                                            </div>
                                    </div>

                                </div>

                                <div className="row">
                                <div className="col-12">
                                    <div className="form-group">
                                            <label ><Skeleton width={80} height={15} /></label>
                                            <div className="input-group">
                                            <Skeleton width={500} height={40} />
                                            </div>
                                            </div>
                                    </div>
                                </div>

                                <div className="row">
                                <div className="col-12">
                                    <div className="form-group">
                                            <label ><Skeleton width={80} height={15} /></label>
                                            <div className="input-group">
                                            <Skeleton width={500} height={40} />
                                            </div>
                                            </div>
                                    </div>
                                </div>


                                <div className="row">
                                <div className="col-12">
                                    <div className="form-group">
                                            <label ><Skeleton width={80} height={15} /></label>
                                            <div className="input-group">
                                            <Skeleton width={500} height={40} />
                                            </div>
                                            </div>
                                    </div>
                                </div>

                                <div className="d-flex flex-row-reverse">
                                    <div className="p-2">
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
