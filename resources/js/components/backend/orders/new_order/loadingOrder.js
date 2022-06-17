import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import Paper from "@material-ui/core/Paper";
import Table from "@material-ui/core/Table";
import TableCell from "@material-ui/core/TableCell";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
export default function LoadingOrder() {
    return (
        <div>
                        <SkeletonTheme color="#fff"  highlightColor="#eee" >

                 <div>
                    <div className="row">
                        <div className="col-12">
                        <div className="card" style={{borderRadius:0}}>
                        <div className="card-body">
                            <div className="row">

                                <div className="col-4">
                                    <span style={{color:"#aaa"}}>
                                    <Skeleton width={100} height={15} />
                                    </span>
                                </div>
                                <div className="col-4">
                                     <span style={{color:"#aaa"}}>
                                     <Skeleton width={100} height={15} />
                                    </span>
                                </div>
                                <div className="col-4">
                                    <span style={{color:"#aaa"}}>
                                    <Skeleton width={100} height={15} />
                                    </span>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-4">
                                <Skeleton width={300} height={15} />
                                </div>
                                <div className="col-4">
                                <Skeleton width={300} height={15} />
                                </div>
                                <div className="col-4">
                                <Skeleton width={100} height={15} />

                                </div>
                            </div>

                        </div>

                    </div>


                        </div>

                    </div>
                    <div className="row">
                        <div className="col-4">
                        <div className="card" style={{borderRadius:0}}>
                            <div className="card-header row" style={{display:"flex",alignItems:'center'}}>
                                    <div className="col-7">
                                        <span style={{fontSize:14}}><Skeleton width={80} height={15} /></span>
                                    </div>
                                    <div className="col-5 " >
                                    <Skeleton width={100} height={30} />

                                    </div>
                                </div>

                            <div className="card-body">
                            <Skeleton width={80} height={15} />

                            </div>
                        </div>

                        </div>
                        <div className="col-4">
                        <div className="card" style={{borderRadius:0}}>
                            <div className="card-header row" style={{display:"flex",alignItems:'center'}}>
                                    <div className="col-7">
                                        <span style={{fontSize:14}}><Skeleton width={80} height={15} /></span>
                                    </div>
                                    <div className="col-5 " >
                                    <Skeleton width={100} height={30} />

                                    </div>
                                </div>

                            <div className="card-body">
                            <Skeleton width={80} height={15} />

                            </div>
                        </div>

                        </div>
                        <div className="col-4">
                        <div className="card" style={{borderRadius:0}}>
                            <div className="card-header row" style={{display:"flex",alignItems:'center'}}>
                                    <div className="col-9">
                                        <span style={{fontSize:14}}><Skeleton width={120} height={15} /></span>
                                    </div>
                                    <div className="col-3 " >
                                    <Skeleton width={80} height={15} />

                                  </div>
                                </div>


                        </div>
                        <div className="card" style={{borderRadius:0}}>
                            <div className="card-header row" style={{display:"flex",alignItems:'center'}}>
                                    <div className="col-8">
                                        <span style={{fontSize:14}}><Skeleton width={80} height={15} /></span>
                                    </div>
                                    <div className="col-4 " >
                                    <Skeleton width={100} height={30} />

                                  </div>
                                </div>


                        </div>

                        </div>


                    </div>
                    <div className=" row">
                      <div className="col-12">
                          <div className="card">
                                <div className="card-header row">

                                    <div className="col-10">
                                    <Skeleton width={40} height={20} />

                                        <span style={{fontSize:18,marginInline:5}}><Skeleton width={100} height={15} /></span>
                                    </div>
                                    <div className="col-2"><Skeleton width={180} height={30} /></div>

                                </div>
                                <div className="card-body row">


      <div  style={{width:"100%"}}>

                                        <Paper>
                                        <Table>
                                            <TableHead style={{
                                                background:"#eee",

                                            }}>
                                            <TableRow style={{fontWeight:"bold"}}>
                                                <TableCell><Skeleton width={150} height={30} /></TableCell>
                                                <TableCell><Skeleton width={150} height={30} /></TableCell>
                                                <TableCell><Skeleton width={100} height={30} /></TableCell>
                                                <TableCell><Skeleton width={100} height={30} /></TableCell>
                                                <TableCell><Skeleton width={100} height={30} /></TableCell>
                                                <TableCell><Skeleton width={100} height={30} /></TableCell>

                                            </TableRow>
                                            </TableHead>



                                        </Table>
                                        </Paper>

                                    </div>
                                </div>
                          </div>
                      </div>
                    </div>

                    <div className="d-flex flex-row-reverse">
                        <div className="p-2">
                        <Skeleton width={120} height={30} />

                            </div>
                            </div>

                </div>
                </SkeletonTheme>

        </div>
    )
}
