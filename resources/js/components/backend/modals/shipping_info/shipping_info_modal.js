import { Modal ,Button} from 'react-bootstrap';
import React, { Component, useState } from 'react';
import BodyModalShippingInfo from './body_modal_shipping_info';

import axios from 'axios';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from '../../urls';

export default class ShippingInfoModal extends Component{

    constructor(){
        super()
        this.state = {
            isLoading:true,
            optionsCountries:[],
            optionsCities:[],
            shippingInfoData:{},
            objectGetData:false,
            trans:{
                "Address":"",
                "please,write your address*":"",
                "Phone":"",
                "please,write your phone number*":"",
                "Postal Code":"",
                "Country":"",
                "City":"",
                "please,write your postal code*":"",
                "Country*":"",
                "City*":"",
                "Close":"",
                "Save Changes":"",
                "Shipping Data":""

            },

        }
    }

    componentDidMount(){


        this.callTrans(this.state.trans);
        this.getCountries();
    }

    callTrans = (transes)=>{

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{

            this.setState({
                trans:res.data,
            })
        })
        .catch(err=>{

        })
    }

    getCountries = ()=>{
        axios.get(Urls.static_url+'all_countries')
        .then(res=>{
            this.setState({
                optionsCountries:res.data.countries,
                isLoading:false

            })

        })
        .catch(err=>{

        })
    }
    handleSaveChange = (data)=>{
       this.props.changeShippingInfo(data)
    }
    render(){

            return(
              <div>
                  <Modal  show={this.props.show} onHide={this.props.handleClose}>

{this.state.isLoading?
<div>
<SkeletonTheme color="#fff"  highlightColor="#eee" >

                <Modal.Header closeButton>
                <Modal.Title> <Skeleton  width={100} height={25}  /></Modal.Title>

                </Modal.Header>
                <Modal.Body>
                <div className="container">
                <div className="row" style={{margin:10}}>

                        <div className="col-3">
                        <Skeleton  width={80} height={20}  />
                        </div>
                        <div className="col-9">
                        <Skeleton  width={200} height={30}  />
                        </div>

                </div>

                <div className="row" style={{margin:10}}>

                       <div className="col-3">
                       <Skeleton  width={80} height={20}  />
                       </div>
                       <div className="col-9">
                       <Skeleton  width={200} height={30}  />

                       </div>

               </div>

                <div className="row" style={{margin:10}}>

                       <div className="col-3">
                       <Skeleton  width={80} height={20}  />
                       </div>
                       <div className="col-9">
                       <Skeleton  width={200} height={30}  />

                       </div>

               </div>
               <div className="row" style={{margin:10}}>

                       <div className="col-3">
                       <Skeleton  width={80} height={20}  />
                       </div>
                       <div className="col-9">
                       <Skeleton  width={200} height={30}  />

                       </div>

               </div>

               <div className="row" style={{margin:10}}>

                       <div className="col-3">
                       <Skeleton  width={80} height={20}  />
                       </div>
                       <div className="col-9">
                       <Skeleton  width={200} height={30}  />
                       </div>

               </div>

            </div>

                </Modal.Body>
                <Modal.Footer>
                <Skeleton  width={80} height={35}  />

                <Skeleton  width={150} height={35}  />
                </Modal.Footer>
                </SkeletonTheme>



                 </div>:

                <div>

                <Modal.Header closeButton>
                <Modal.Title>{this.state.trans["Shipping Data"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>



                    <BodyModalShippingInfo objShippingInfo={this.props.objShippingInfo} getShippingData={this.handleSaveChange} objectGetData={this.state.objectGetData} trans={this.state.trans} countries={this.state.optionsCountries} />


                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={this.props.handleClose}>

                    {this.state.trans["Close"]}
                  </Button>
                  <Button variant="primary" onClick={()=>{

                      if(this.state.objectGetData){
                        this.setState({
                            objectGetData:false
                          })
                      }else{
                        this.setState({
                            objectGetData:true
                          })
                      }

                  }}>
                    {this.state.trans["Save Changes"]}
                  </Button>
                </Modal.Footer>
                </div>
                }
              </Modal>
              </div>
                    );

        }
    }



