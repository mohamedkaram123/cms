import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function LoadingFekraPayment() {
    return (
        <div>
            <SkeletonTheme color="#fff"  highlightColor="#eee" >

<div className="card">
    <div className="card-head">

        <div style={{margin:20}}>
        <Skeleton  width={250} height={15}  />

        </div>


    </div>

<div className="card-body">

  <div className="row" style={{marginBottom:20}}>
      <div className="col-6">
      <Skeleton  width={200} height={15}  />

      </div>
      <div className="col-6">
      <Skeleton  width={200} height={40}  />

      </div>


  </div>

  <div className="row" style={{marginBottom:20}}>
      <div className="col-6">
      <Skeleton  width={200} height={15}  />

      </div>
      <div className="col-6">
      <Skeleton  width={200} height={40}  />

      </div>


  </div>

  <div className="row" style={{marginBottom:20}}>
      <div className="col-6">
      <Skeleton  width={200} height={15}  />

      </div>
      <div className="col-6">
      <Skeleton  width={50} height={20} style={{borderRadius:20}} />

      </div>


  </div>

  <div className="row" style={{marginBottom:20}}>
      <div className="col-6">
      <Skeleton  width={200} height={15}  />

      </div>
      <div className="col-6">
      <Skeleton  width={50} height={20} style={{borderRadius:20}} />

      </div>


  </div>

  <div className = "form-group mb-0 text-right" >
  <Skeleton  width={80} height={40}  />

  </div>
</div>

</div>

            </SkeletonTheme>


        </div>
    )
}
