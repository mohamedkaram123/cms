import axios from "axios";
import { Component } from "react";
import CustomerModal from '../../modals/customer_modal/customer_modal';
import ProductModal from "../../modals/product_modal/product_modal";
import PaymentModal from "./payment_modal/paymentModal";
import ShippingInfoModal from "../../modals/shipping_info/shipping_info_modal";

import {

    Link
  } from "react-router-dom";
import CartsNestedTable from "./carts/carts_nested_table";
import Paper from "@material-ui/core/Paper";
import Table from "@material-ui/core/Table";
import TableCell from "@material-ui/core/TableCell";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
import LoadingOrder from "./loadingOrder";
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Switch from '@material-ui/core/Switch';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { Urls } from "../../urls";
export default class NewOrder extends Component {

    constructor(){
        super();

    this.state = {
        isLoading:true,
        showCustomer:false,
        showPayment:false,
        showProduct:false,
        showShippingInfo:false,
        disableButton:false,
        backgroundCustomer:'url(' +Urls.public_url+ 'assets/img/customer.png)',
        backgroundPayment:'url(' +Urls.public_url+ 'assets/img/payment.png)',

        loadSearchCarts:false,
        clearData:false,
        sellers:[],
        customer:{},
        order_number:Math.floor(Math.floor(10000000 + Math.random() * 90000000)) +"-"+Math.floor(Math.floor(10000000 + Math.random() * 90000000)),
        order_Date:new Date().toUTCString(),
        hoverChooseCart:{},
        cart:{},
        customerExist:false,
        paymentExist:false,
        paymentImg:Urls.public_url + "assets/img/cards/cod.png",
        checkedFreeShipping:true,
        shippingData:null,
        payment:"cash_on_delivery",
        chooseCart:{
            background:"#FF6900",
            color:"#fff"
        },
        trans:{
           "Edit Order":"",
           "Order Date":"",
           "Order Status":"",
           "Customer":"",
           "Edit":"",
           "Product":"",
           "Add New Product":"",
           "weight":"",
           "Price":"",
           "Quantity":"",
           "Calc":"",
           "Calc Basckt":"",
           "Shipping Cost":"",
           "Coupons":"",
           "Add Coupon":"",
           "Total":"",
           "Payment Method":"",
           "Fawry":"",
           "Cash on Delivery":"",
           "TapPayment":"",
           "Products":"",
           "Seller Name":"",
           "Seller Phone":"",
           "Expend":"",
           "Product Name":"",
           "Product Price":"",
           "Product Color":"",
           "Phone":"",
           "Name":"",
           "No Number Phone":"",
           "Free Shipping":"",
           "pendding":"",
           "Create Order":"",
           "please check var is empty":"",
           "please check customer is empty":"",
           "Edit Shipping":""
        }
    }
    }

    componentDidMount(){

        this.setState({
            sellers:this.props.sellers
        })

        this.callTrans(this.state.trans);
    }

    callTrans(transes){

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{

            this.setState({
                trans:res.data,
                isLoading:false
            })
        })
        .catch(err=>{

        })
    }

    handleCloseCustomer = ()=>{
        this.setState({
            showCustomer:false
        })
    }

    handleCustomer = (customer)=>{
       this.setState({
        customer:customer,
        customerExist:true
       })
    }
    handleClosePayment = ()=>{
        this.setState({
            showPayment:false
        })
    }
    paymenyValue = (val,img)=>{

        this.setState({
            paymentExist:true,
            paymentImg:img,
            payment:val

        })
    }
    handleCloseProduct = ()=>{
        this.setState({
            showProduct:false,
            clearData:false
        })
    }

    handleCloseShippingInfo = ()=>{
        this.setState({
            showShippingInfo:false,
        })
    }

    saveChangeProduct  = (obj)=>{

        if(Object.keys(this.state.customer).length != 0){
            if(obj.length != 0){
                this.setState({
                    loadSearchCarts:true
                })

                let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let  data_post = {
                    products:obj,
                    customer_id:this.state.customer.id,
                      "_token": csrf_token
                  }

                axios.post(Urls.static_url+"cart/add_carts",data_post)
                .then(res=>{



                    this.setState({
                        sellers:res.data.carts,
                        loadSearchCarts:false,
                        clearData:true,
                        hoverChooseCart:{},
                        cart:{}
                    })
                    // console.log(res.data.carts);
                    // let sellersdata = this.state.sellers.concat(res.data.carts)
                    // this.setState({
                    //     sellers:sellersdata
                    // })

                    this.handleCloseProduct()

                })
                .catch(err=>{
                })

            }

        }else{
            var title_trans = this.state.trans["please check customer is empty"];

                toast.error(title_trans, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                    });
        }


    }

    handlecheckedFreeShipping = (val)=>{

     if(this.state.checkedFreeShipping){
         this.setState({
            checkedFreeShipping:false
         })
     }else{
        this.setState({
            checkedFreeShipping:true
         })
     }
    }

    HandleOutUser = (item)=>{

        this.setState({

            cart:item,
            hoverChooseCart:{
                [item.id]:true
            }
        })


    }
    changeShippingInfo = (data)=>{


        this.setState({

            shippingData:data,
            showShippingInfo:false
        })
    }


    render(){
        if(this.state.isLoading){
            return(

                <div>
                 <LoadingOrder />
                </div>
            )
        }else{
            return(

                <div>

                  <ToastContainer />

                    <div className="row">
                        <div className="col-12">
                        <div className="card" style={{borderRadius:0}}>
                        <div className="card-body">


                            <div className="row">

                                <div className="col-4">
                                    <span style={{color:"#aaa"}}>
                                        {this.state.trans["Edit Order"]}
                                    </span>
                                </div>
                                <div className="col-4">
                                     <span style={{color:"#aaa"}}>
                                        {this.state.trans["Order Date"]}
                                    </span>
                                </div>
                                <div className="col-4">
                                    <span style={{color:"#aaa"}}>
                                        {this.state.trans["Order Status"]}
                                    </span>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-4">
                                    {this.state.order_number}
                                </div>
                                <div className="col-4">
                                    {this.state.order_Date}
                                </div>
                                <div className="col-4">
                                {this.state.trans["pendding"]}
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
                                    <div className="col-9">
                                        <span style={{fontSize:14}}>{this.state.trans["Customer"]}</span>
                                    </div>
                                    <div className="col-3 " >
                                        <button onClick={()=>{
                                            this.setState({
                                                showCustomer:true
                                            })

                                        }} className="btn btn-primary" style={{padding:5,paddingInline:10}} >{this.state.trans["Edit"]}</button>
                                    </div>
                                </div>

                            <div className="card-body" style={{
                                height:150,
                                backgroundImage:this.state.backgroundCustomer,
                                backgroundPosition: 'center',
                                backgroundSize:'100px 100px',
                                backgroundRepeat: 'no-repeat',
                                padding:0

                            }}>
                                {this.state.customerExist?<div className="d-flex flex-column" style={{display:'flex',justifyContent:'center',alignItems:'center'}}>

                                    <div className="p-2">
                                        <img src={ Urls.public_url + "assets/img/avatar-place.png"} style={{
                                            width:60,
                                            height:60,
                                            borderRadius:20
                                        }} />

                                    </div>
                                    <div className="p-2 d-flex flex-column">
                                    <span  className="p-2">{this.state.trans["Name"]} : {this.state.customer.name}</span>
                                    <span  className="p-2">{this.state.trans["Phone"]} : {this.state.customer.phone != null?this.state.customer.phone:this.state.trans["No Number Phone"]}</span>

                                    </div>

                                    </div>
                                    :null}
                            </div>
                        </div>

                        </div>
                        <div className="col-4">
                        <div className="card" style={{borderRadius:0}}>
                            <div className="card-header row" style={{display:"flex",alignItems:'center'}}>
                                    <div className="col-9">
                                        <span style={{fontSize:14}}>{this.state.trans["Payment Method"]}</span>
                                    </div>
                                    <div className="col-3 " >
                                        <button onClick={()=>{
                                            this.setState({
                                                showPayment:true
                                            })
                                        }} className="btn btn-primary" style={{padding:5,paddingInline:10,justifySelf:"flex-end"}} >{this.state.trans["Edit"]}</button>
                                    </div>
                                </div>

                            <div className="card-body" style={{
                                height:150,
                                backgroundImage:this.state.backgroundPayment,
                                backgroundPosition: 'center',
                                backgroundSize:'100px 100px',
                                backgroundRepeat: 'no-repeat',

                            }}>
                                <div style={{display:"flex",justifyContent:'center',alignItems:'center'}}>

                                    <img src={this.state.paymentImg} style={{
                                    width:180,
                                    height:120
                                }} />

                                </div>


                            </div>
                        </div>

                        </div>
                        <div className="col-4">
                        <div className="card" style={{borderRadius:0}}>
                            <div className="card-header row" style={{display:"flex",alignItems:'center'}}>
                                    <div className="col-9">
                                        <span style={{fontSize:14}}>{this.state.trans["Free Shipping"]}</span>
                                    </div>
                                    <div className="col-3 " >
                                    <FormControlLabel
                                        control={
                                        <Switch
                                            checked={this.state.checkedFreeShipping}
                                            onChange={this.handlecheckedFreeShipping}
                                            name="checkedB"
                                            color="primary"
                                        />
                                        }
                                        label=""
                                    />
                                  </div>
                                </div>


                        </div>
                        <div className="card" style={{borderRadius:0}}>
                            <div className="card-header row" style={{display:"flex",alignItems:'center'}}>
                                    <div className="col-8">
                                        <span style={{fontSize:14}}>{this.state.trans["Edit Shipping"]}</span>
                                    </div>
                                    <div className="col-4 " >
                                   <button onClick={()=>{
                                         this.setState({
                                            showShippingInfo:true,
                                        })
                                   }} className="btn btn-primary" >
                                   <i className="las la-shipping-fast"></i> {this.state.trans["Edit"]}
                                   </button>
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
                                        <i style={{fontSize:18}} className="las la-tshirt"></i>
                                        <span style={{fontSize:18,marginInline:5}}>{this.state.trans["Carts"]}</span>
                                    </div>
                                    <div className="col-2">
                                        <button onClick={()=>{
                                            this.setState({
                                                showProduct:true
                                            })
                                        }} className="btn btn-primary" style={{padding:5,paddingInline:10}}>{this.state.trans["Add New Product"]}</button>
                                    </div>

                                </div>
                                <div className="card-body row">


                                   <div  style={{width:"100%"}}>

                                        <Paper>
                                        <Table>
                                            <TableHead style={{
                                                background:"#eee",

                                            }}>
                                            <TableRow style={{fontWeight:"bold"}}>
                                                <TableCell>{this.state.trans["Seller Name"]}</TableCell>
                                                <TableCell>{this.state.trans["Seller Phone"]}</TableCell>
                                                <TableCell>{this.state.trans["Quantity"]}</TableCell>
                                                <TableCell>{this.state.trans["Price"]}</TableCell>
                                                <TableCell>{this.state.trans["Expend"]}</TableCell>
                                                <TableCell>{this.state.trans["Buy"]}</TableCell>

                                            </TableRow>
                                            </TableHead>

                                                {this.state.sellers.map(item=>(

                                                <CartsNestedTable key={item.id} HandleOutUser={this.HandleOutUser} chooseCart={this.state.chooseCart} objectChoose={this.state.hoverChooseCart} trans={this.state.trans}  item={item} />
                                                )) }

                                        </Table>
                                        </Paper>

                                    </div>
                                </div>
                          </div>
                      </div>
                    </div>
                    <div className="d-flex flex-row-reverse">
                        <div className="p-2">
                            <button disabled={this.state.disableButton} onClick={()=>{

                                this.setState({
                                    disableButton:true
                                })
                                let dataObj  = {
                                    customer:this.state.customer,
                                    cart:this.state.cart,
                                    shippingData:this.state.shippingData == null?{}:this.state.shippingData,

                                };
                                let check = false;

                                Object.keys(dataObj).map((key,item)=>{

                                    if(Object.keys(dataObj[key]).length === 0 ){
                                        check = false;

                                    var title_trans = this.state.trans["please check var is empty"];
                                    var title = title_trans.replace("var", key.toString());

                                        toast.error(title, {
                                            position: "top-right",
                                            autoClose: 5000,
                                            hideProgressBar: false,
                                            closeOnClick: true,
                                            pauseOnHover: true,
                                            draggable: true,
                                            progress: undefined,
                                            });
                                    }
                                })

                                if(Object.keys(this.state.customer).length != 0 && Object.keys(this.state.cart).length != 0 && this.state.shippingData != null ){

                                    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');



                                  this.state.shippingData.email = this.state.customer.email;
                                  this.state.shippingData.name = this.state.customer.name;

                                let dataOrder  = {
                                    customer:this.state.customer,
                                    cart:this.state.cart,
                                    shippingData:this.state.shippingData,
                                    order_number:this.state.order_number,
                                    order_date:this.state.order_Date,
                                    free_shipping:this.state.checkedFreeShipping,
                                    payment_option:this.state.payment,
                                    "_token": csrf_token

                                };
                                axios.post(Urls.static_url+"checkout/createCeckoutOrder",dataOrder)
                                .then(res=>{
                                    location.href = res.data.url
                                })
                                .catch(err=>{
                                })

                                }


                            }} className="btn  btn-primary">
                            <i className="las la-store"></i> {this.state.trans["Create Order"]} {this.state.disableButton?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                            </button>
                        </div>
                    </div>


                    {this.state.showCustomer?
                     <div className="card">
                     <CustomerModal
                     getCustomer={this.handleCustomer}
                     show={this.state.showCustomer}
                     handleClose={this.handleCloseCustomer}
                     trans={this.state.trans} /></div>
                     :null}
                     <div className="card">
                         <PaymentModal paymenyValue={this.paymenyValue } show={this.state.showPayment} trans={this.state.trans} handleClose={this.handleClosePayment} />

                     </div>
                     {this.state.showProduct?
                     <div className="card">
                         <ProductModal
                         loadSearch={this.state.loadSearchCarts}
                         saveChange={this.saveChangeProduct}
                         show={this.state.showProduct}
                         handleClose={this.handleCloseProduct}
                         clearData={this.state.clearData}
                         />
                     </div>:null}

                     {this.state.showShippingInfo?
                     <div className="card">
                         <ShippingInfoModal
                         changeShippingInfo={this.changeShippingInfo}
                         show={this.state.showShippingInfo}
                         handleClose={this.handleCloseShippingInfo}
                         objShippingInfo={this.state.shippingData}
                         />
                     </div>:null}
                </div>
            )
        }

    }

}
