import { Modal ,Button} from 'react-bootstrap';
import React, { Component, useState } from 'react';
import BodyModalCustomer from './body_modal_customer';
import HeaderModalCustomer from './header_modal_customer';
import axios from 'axios';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from '../../urls';
import { ceil, round } from 'lodash';
import LoadingInline from './LoadingInline';
export default class CustomerModal extends Component{

    constructor(){
        super()
        this.increment = 0;
        this.state = {
            isLoading:true,
            optionsCountries:[],
            optionsCities:[],
            objectCustomer:{},
            loadSearch:false,
            customerId:0,
            customer:{},
            trans:{
                "Customer":"",
                "Customer Name":"",
                "Customer Phone":"",
                "Customer Email":"",
                "Choose Country":"",
                "Country":"",
                "City":"",
                "Search":"",
                "Close":"",
                "Save Changes":""

            },
            hoverChooseCustomer:{},
            chooseCustomerClass:{
                background:"#FF6900",
                color:"#fff"
            },
            rows:[]
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


    handleStateChange = (obj)=>{
        this.setState({
            loadSearch:true
        })
        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        obj["_token"] = csrf_token;
        obj["pagination"] = this.increment;

         axios.post(Urls.static_url+"customers/getCustomers",obj)
         .then(res=>{

            this.setState({
                rows:this.state.rows.concat(res.data.customers) ,
                loadSearch:false

            })
               this.increment += 20;
         })
         .catch(err=>{
         })

    }
    handleSaveChange = ()=>{
        this.props.getCustomer(this.state.customer);
        this.props.handleClose()
    }
    HandleOutUser = (id,item)=>{

        this.setState({
            customerId:id,
            customer:item,

            hoverChooseCustomer:{
                [id]:true
            }
        })


    }

      handleScroll = (e) => {

          const bottom = ceil(e.target.scrollHeight - e.target.scrollTop)  === e.target.clientHeight;
          if (bottom) {
              this.handleStateChange({
                     name:"",
                    phone:"",
                    email:"",
                    country_id:"",
                    city_id:""
              });
          } else {

    }
  }
    render(){

            return(
              <div>
                  <Modal size="lg" show={this.props.show} onHide={this.props.handleClose}>

{this.state.isLoading?
<div>
<SkeletonTheme color="#fff"  highlightColor="#eee" >

                <Modal.Header closeButton>
                <Modal.Title> <Skeleton  width={80} height={20}  /></Modal.Title>

                </Modal.Header>
                <Modal.Body>
                <div className="container">

              <div className="row" style={{margin:10}}>
                  <div className="col-4">
                  <Skeleton  width={150} height={35}  />


                  </div>

                  <div className="col-4">
                  <Skeleton  width={150} height={35}  />


                  </div>

                  <div className="col-4">
                  <Skeleton  width={150} height={35}  />

                  </div>
              </div>
              <div className="row" style={{margin:10}}>
                 <div className="col-4">
                 <Skeleton  width={150} height={35}  />


                 </div>
                 <div className="col-4">
                 <Skeleton  width={150} height={35}  />


                 </div>
              </div>
              <div className="row" style={{margin:10}}>

                <div className="col-2 offset-10">
                <Skeleton  width={100} height={35}  />
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
                <Modal.Title>{this.state.trans["Customer"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>

                <HeaderModalCustomer

                 loadSearch={this.state.loadSearch}
                 onChange={this.handleStateChange}
                 trans={this.state.trans}
                 countries={this.state.optionsCountries}  />

                <div onScroll={this.handleScroll} style={{maxHeight:400,overflow:'auto'}}>

                    { this.state.rows.map((item,i)=>(
                        <div key={i} onClick={this.HandleOutUser.bind(this,item.id,item)} style={{cursor:'pointer'}} >
                  <BodyModalCustomer objectChoose={this.state.hoverChooseCustomer} classChooseCustomer={this.state.chooseCustomerClass}  customer={item} />

                        </div>

                    ))}

                    {this.state.loadSearch?<LoadingInline />:null}


                </div>

                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={this.props.handleClose}>

                    {this.state.trans["Close"]}
                  </Button>
                  <Button variant="primary" onClick={this.handleSaveChange}>
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



