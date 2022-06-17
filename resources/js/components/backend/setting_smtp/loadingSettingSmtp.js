import React from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Tab, TabList, TabPanel, Tabs } from 'react-tabs'

export default function LoadingSettingSmtp() {
    return (
        <div>
                                    <SkeletonTheme color="#fff"  highlightColor="#eee" >

                    <div className="card">

<Tabs   >
<div className="card-header">


        <TabList>
     <Tab  ><Skeleton  width={20} height={15} style={{marginInline:20}} /> <Skeleton  width={80} height={15} /></Tab>
      <Tab   ><Skeleton  width={20} height={15} style={{marginInline:20}} /> <Skeleton  width={80} height={15} /></Tab>
      <Tab  ><Skeleton  width={20} height={15} style={{marginInline:20}} /> <Skeleton  width={80} height={15} /></Tab>

    </TabList>

        </div>

        <div className="card-body">
        <TabPanel>



        <div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label"><Skeleton  width={80} height={15} /></label>
                            </div>
                            <div className="col-md-9">
                            <Skeleton  width={400} height={40} />
                                                </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label"><Skeleton  width={80} height={15} /></label>
                            </div>
                            <div className="col-md-9">
                            <Skeleton  width={400} height={40} />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label"><Skeleton  width={80} height={15} /></label>
                            </div>
                            <div className="col-md-9">
                            <Skeleton  width={400} height={40} />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label"><Skeleton  width={80} height={15} /></label>
                            </div>
                            <div className="col-md-9">
                            <Skeleton  width={400} height={40} />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label"><Skeleton  width={80} height={15} /></label>
                            </div>
                            <div className="col-md-9">
                            <Skeleton  width={400} height={40} />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label"><Skeleton  width={80} height={15} /></label>
                            </div>
                            <div className="col-md-9">
                            <Skeleton  width={400} height={40} />
                            </div>
                        </div>
                        <div className="form-group row">

                            <div className="col-md-3">
                                <label className="col-from-label"><Skeleton  width={80} height={15} /></label>
                            </div>
                            <div className="col-md-9">
                            <Skeleton  width={400} height={40} />
                            </div>
                        </div>



        </div>


    </TabPanel>

    <TabPanel>



    </TabPanel>
    <TabPanel>



    </TabPanel>

        </div>

        <div className="card-footer text-right">
            <div className="form-group mb-0 ">
            <Skeleton  width={150} height={40} />
            </div>
        </div>

  </Tabs>
    </div>
</SkeletonTheme>

        </div>
    )
}
