import React from 'react'

export default function NumberShow({ price, percent }) {

    if (percent < 0) {
          return (
              <div className="d-flex flex-row">
                  <div className="p-2 col-7" >
                  <span >{price}</span>

                  </div>
                  <div className="p-2 col-5" >
                <i style={{fontSize:14,marginInline:5,color:"#B50000"}} className="las la-angle-down"></i>
                  <span style={{color:"#B50000",fontWeight:"bold"}}>{ `${Math.abs(percent)} %` } </span>
                  </div>
        </div>
    )
    } else if (percent > 0) {
            return (
              <div className="d-flex flex-row">
                   <div className="p-2 col-7" >
                  <span >{price}</span>

                  </div>
                  <div className="p-2 col-5">
                                         <i style={{fontSize:14,marginInline:5,color:"#007C1D"}} className="las la-angle-up"></i>
                           <span style={{color:"#007C1D",fontWeight:"bold"}}>{ `${percent} %` } </span>

                  </div>
                </div>
            )
    } else {
            return (
              <div className="d-flex flex-row">
                      <div className="p-2 col-7">
                  <span >{price}</span>

                  </div>
                    <div className="p-2 col-5">
                                           <i style={{fontSize:14,marginInline:5}} className="las la-arrows-alt-h"></i>
                                 <span style={{fontWeight:"bold"}}>{ `${percent} %` } </span>

                  </div>

              </div>
    )
    }


}
