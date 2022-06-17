import { Modal ,Button} from 'react-bootstrap';
import React, { Component, useState } from 'react';
// import BodyModalShippingInfo from './body_modal_shipping_info';
import Select from 'react-select';
import { ToastContainer, toast } from 'react-toastify';

import axios from 'axios';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from '../../urls';

export default class PricesModal extends Component{

    constructor(){
        super()
        this.state = {
            isLoading:true,
            optionsCurrencies:[],
            price: 0.00,
            optionCurrency: 0,
            btnLoading:false,

            trans:{
                "Currency":"",
                "Price":"",
                "Close":"",
                "Save Changes":"",
                "Prices System":""

            },

        }
    }

    componentDidMount(){


        this.callTrans(this.state.trans);
        this.getCurrencies();
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

    getCurrencies = ()=>{
        axios.get(Urls.static_url+'price_system/all_curruncies')
        .then(res=>{
            this.setState({
                optionsCurrencies:res.data.all_curruncies,
                isLoading:false

            })

        })
        .catch(err=>{

        })
    }
    handleSaveChange = () => {

        if (this.state.price <= 0) {
                   var title_trans = this.state.trans["the price is required"];


                toast.error(title_trans, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                    });


        } else {
                    this.setState({
            btnLoading:true
        })
        this.setPrice();
        }


    }


    setPrice = () => {


          let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
            price: this.state.price,
            currency_id:this.state.optionCurrency,
              "_token": csrf_token
        }
                axios.post(Urls.static_url+'price_system/set_price',data_post)
        .then(res=>{
            this.props.setPriceId(res.data.price)
          this.setState({
            btnLoading:false
        })
        })
        .catch(err=>{

        })

    }
    render(){

            return(
              <div>
                    <Modal show={this.props.show} onHide={this.props.handleClose}>
                        <ToastContainer/>

            {this.state.isLoading?
            <div>
            <SkeletonTheme color="#fff"  highlightColor="#eee" >

                <Modal.Header closeButton>
                <Modal.Title> <Skeleton  width={100} height={25}  /></Modal.Title>

                </Modal.Header>
                <Modal.Body>

                <div className="container">
                         <div className="row" style={{margin:10}}>


                    <div className="col-6">
                        <div className="form-group">
                              <label><Skeleton  width={80} height={15}  /></label>

                              <Skeleton  width={300} height={40}  />
                       </div>
                 </div>

                 <div className="col-6">
                      <div className="form-group">
                            <label><Skeleton  width={80} height={15}  /></label>
                                   <Skeleton  width={300} height={40}  />

                      </div>
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
                <Modal.Title>{this.state.trans["Prices System"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>

                <div className="container">
                         <div className="row" style={{margin:10}}>


                    <div className="col-6">
                        <div className="form-group">
                              <label>{this.state.trans["Currency"]}</label>

                                    <Select


                                value={this.state.optionsCurrencies.filter(option => option.value == this.state.optionCurrency )}

                                    maxMenuHeight={200}
                                    menuPosition={'fixed'}

                                onChange={e=>{
                                    this.setState({
                                        optionCurrency:e.value
                                                })

                                                }}
                                    options={this.state.optionsCurrencies}/>
                       </div>
                 </div>

                 <div className="col-6">
                      <div className="form-group">
                           <label>{this.state.trans["Price"]}</label>
                                                    <input type="number" className="form-control" onChange={(e) => {
                                                        this.setState({
                                                            price:e.target.value
                                                        })
                           }} />

                      </div>
                 </div>

               </div>
                </div>




                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={this.props.handleClose}>

                    {this.state.trans["Close"]}
                  </Button>
                  <Button onClick={this.handleSaveChange} disabled={this.state.btnLoading} variant="primary" >
                                        {this.state.trans["Save Changes"]}
                                        {this.state.btnLoading?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                  </Button>
                </Modal.Footer>
                </div>
                }
              </Modal>
              </div>
                    );

        }
    }



