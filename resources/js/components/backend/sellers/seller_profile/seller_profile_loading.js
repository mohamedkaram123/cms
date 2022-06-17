import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function SellerProfileLoading() {
    return (
        <div>
                        <SkeletonTheme color="#fff"  highlightColor="#eee" >

                            <div>
                   <div className="container emp-profile">

                    <div className="row">
                        <div className="col-4">
                            <div className="profile-img">
                           <Skeleton width={250} height={270} />

                            </div>
                        <div>
                      <  Skeleton width={40} height={40} />
                        </div>

                        </div>


                        <div className="col-6">
                            <div className="profile-head">
                                        <h5>
                                           <  Skeleton width={90} height={20} />
                                        </h5>
                                        <h6>
                                           <  Skeleton width={90} height={15} />
                                        </h6>
                                        <p className="proile-rating"><  Skeleton width={50} height={15} /> <  Skeleton width={20} height={15} /> <span><  Skeleton width={30} height={15} /></span></p>
                                <ul className="nav nav-tabs" id="myTab" role="tablist">
                                    <li className="nav-item">
                                        <a className="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><Skeleton width={80} height={15} /></a>
                                    </li>
                                    <li className="nav-item">
                                        <a className="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><Skeleton width={80} height={15} /></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div className="col-2">

                            <Skeleton width={80} height={25} />
                        </div>
                    </div>
                    <div className="row">

                        <div className="col-8 offset-4">
                            <div className="tab-content profile-tab" id="myTabContent">
                                <div className="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div className="row">
                                                <div className="col-6">
                                                    <label><Skeleton width={60} height={15} /></label>
                                                </div>
                                                <div className="col-6">
                                                    <p><Skeleton width={20} height={15} /></p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label><Skeleton width={60} height={15} /></label>
                                                </div>
                                                <div className="col-6">
                                                    <p><Skeleton width={80} height={15} /></p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label><Skeleton width={50} height={15} /></label>
                                                </div>
                                                <div className="col-6">
                                                    <p><Skeleton width={80} height={15} /></p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label><Skeleton width={50} height={15} /></label>
                                                </div>
                                                <div className="col-6">
                                                    <p><Skeleton width={80} height={15} /></p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label><Skeleton width={50} height={15} /></label>
                                                </div>
                                                <div className="col-6">
                                                    <p><Skeleton width={20} height={15} /></p>
                                                </div>
                                            </div>
                                </div>
                                <div className="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                {/* <div>
                  {this.state.customersOrders.length != 0 ?
                  <div>
                        <div style={{maxHeight:300,overflow:"auto",padding:20}} >
                   {


                  this.state.customersOrders.map((item , i)=>(
                            <div style={{display:"flex",justifyContent:"center",alignItems:"center"}} key={item.id} className="d-flex flex-column">
                                <BodyOrders item={item} trans={this.state.trans} />
                                 {(this.state.customersOrders.length -1 ) != i?<span style={{width:400,height:2,background:"#aaa",}}></span>: null }
                            </div>

                        ))
                   }
             </div>


             <div className="d-flex flex-row-reverse" style={{marginTop:10}}>
             <h3 >{this.state.trans["Total Price"]} : {this.state.total_price}</h3>

             </div>
                  </div>:<div>
                      <span>{this.state.trans["No Orders for this customer"]}</span>
                  </div>
                  }

             </div> */}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row">

                    </div>
            </div>

                </div>
                </SkeletonTheme>

        </div>
    )
}
