import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function LoadingTable() {
    return (
        <div>
           <SkeletonTheme color="#fff"  highlightColor="#eee" >

                <div style={{  width: "100%",overflow:'auto'}} >
                            <div className="card">
            <div  className="card-header">

                 <h1> <i ><Skeleton width={40}  /></i> <Skeleton width={300}  /></h1>

            <div className="d-flex">

               <div className="p-2">
                   <div className="d-flex flex-column">
                 <Skeleton width={60} height={15} />
               <Skeleton width={200} height={40} />
                   </div>


               </div>

              <div className="p-2">
              <label className="aiz-switch aiz-switch-success mb-0">
                  <Skeleton width={40} height={20} style={{borderEndEndRadius:20,borderEndStartRadius:20,borderStartEndRadius:20,borderStartStartRadius:20}}  /></label>

              </div>
           </div>

            </div>
            <div  className="card-body">
                    <table className="table table-striped ">
                        <thead style={{marginBottom:60}} className="thead-light">

                            <tr>
                                         <th>
                                            <div className="d-flex flex-column">
                                                <Skeleton width="30%" height={15} />
                                                 <Skeleton width={100} height={30} />
                                            </div>
                                           </th>

                                        <th>
                                            <div className="d-flex flex-column">
                                                <Skeleton width="30%" height={15} />
                                                 <Skeleton width={100} height={30} />
                                            </div>
                                           </th>

                                        <th>
                                            <div className="d-flex flex-column">
                                                <Skeleton width="30%" height={15} />
                                                 <Skeleton width={100} height={30} />
                                            </div>
                                           </th>

                                        <th>
                                            <div className="d-flex flex-column">
                                                <Skeleton width="30%" height={15} />
                                                 <Skeleton width={100} height={30} />
                                            </div>
                                           </th>
                                        <th>
                                            <div className="d-flex flex-column">
                                                <Skeleton width="30%" height={15} />
                                                 <Skeleton width={100} height={30} />
                                            </div>
                                           </th>
                                        <th>
                                            <div className="d-flex flex-column">
                                                <Skeleton width="30%" height={15} />
                                                <Skeleton width={150} height={30} />
                                            </div>
                                            </th>
                                        <th>
                                        <div className="d-flex flex-column">
                                                <Skeleton width="30%" height={15} />
                                                <Skeleton width={150} height={30} />
                                        </div>
                                        </th>


                            </tr>

                        </thead>
                        <tbody >

                            {
                                [1,2,3,4,5,6,7,8,9,10,11].map(item=>{
                                    return(

                                        <tr style={{height:100}} key={Math.random()}>
                                        <th><Skeleton width="30%" height={15}  /> </th>
                                        <th>
                                        <Skeleton width="100%" height={15} />

                                        </th>
                                        <th><Skeleton width="100%" height={15} /> </th>
                                        <th><Skeleton width="100%" height={15} /> </th>
                                        <th><Skeleton width="100%" height={15} /> </th>
                                        <th><Skeleton width="80%" height={15} /> </th>
                                        <th><Skeleton width="80%" height={15} /> </th>


                                    </tr>
                                    )
                                })
                            }

                        </tbody>


                    </table>

                    <div className="row" style={{marginBottom:20}}>

                    <div style={{width:100,marginInline:10}}>

                    <span>

                        <Skeleton className="form-control" />
                    </span>

                    </div>

                    <div style={{width:100,marginInline:10}}>

                    <span>
                    <Skeleton className="form-control" />
                    </span>

                    </div>

                    <div style={{width:100,marginInline:10}}>

                    <span>
                    <Skeleton className="form-control" />
                    </span>

                    </div>

                    <div style={{width:100,marginInline:10}}>

                    <span>
                    <Skeleton className="form-control" />
                    </span>

                    </div>

                    <div style={{width:100,marginInline:10}}>

                    <span>
                    <Skeleton className="form-control" />
                    </span>

                    </div>

                    <div style={{width:100,marginInline:10}}>

                    <span>
                    <Skeleton className="form-control" />
                    </span>

                    </div>

                    <div style={{width:100,marginInline:10}}>

                    <span>
                    <Skeleton className="form-control" />
                    </span>

                    </div>

                    <div style={{width:150,marginInline:10}}>

                    <span>
                    <Skeleton className="form-control" />
                    </span>

                    </div>

                    <div style={{width:150,marginInline:10}}>

                    <span>
                    <Skeleton className="form-control" />
                    </span>

                    </div>
                    </div>




                    <div className="pagination">

         <Skeleton  style={{marginInline:10}} width={30} height={25} />  {' '}
         <Skeleton style={{marginInline:10}} width={30} height={25} />  {' '}
         <Skeleton style={{marginInline:10}} width={30} height={25} />  {' '}
         <Skeleton style={{marginInline:10}} width={30} height={25} />  {' '}

        <span>
           {' '}
          <strong>

          </strong>{' '}
        </span>
        <span>
        <Skeleton style={{marginInline:10}} width={150} height={25} />  {' '}

        </span>{' '}
        <Skeleton width={80} height={25} />  {' '}

        <span style={{marginInline:10,fontSize:14}}> </span>



      </div>

            </div>

        </div>

                </div>

            </SkeletonTheme>
         </div>
    )
}
