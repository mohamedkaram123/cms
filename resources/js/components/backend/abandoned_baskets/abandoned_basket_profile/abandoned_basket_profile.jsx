import axios from "axios";
import { Component } from "react";
import { encrypt } from "../../hashes";
import ReminderBasketModal from "../../modals/reminder_basket/reminder_basket_modal";
import { Urls } from "../../urls";
import LoadingInline from "../LoadingInline";
import { toast,ToastContainer } from "react-toastify";
import ErrorConnection from "../../../errors/error_connect";

export default class AbandonedBasketProfile extends Component{

    constructor() {
        super()
        this.state = {
            isLoading: true,
            errorLoad: false,

            trans:{
                "Customer": "",
                "What is the abandoned basket?": "",
                "It is the basket that the customer added the products to, then forgot and did not complete the purchase. And to motivate the customer to complete the order, you can activate a special temporary discount": "",
                "Products":"",
                "Product": "",
                "Quantity": "",
                "Price": "",
                "Calc": "",
                "Tax": "",
                "Shipping Cost": "",
                "active temporary discount": "",
                "successfully saved data": "",
                "complete order":""
            },
            userLoading: true,
            user: {},
            productUserLoading: true,
            productsCart: [],
            showReminder: false,
                        ChooseUserArr: [],




        }
    }

    componentDidMount(){
//        console.log({user_id:this.props.location.state.user_id});

        this.setState({
           ChooseUserArr: [this.props.location.state.user_id]
        })
        this.userData()
        this.productsCart()
        this.callTrans(this.state.trans);

  };






        callTrans(transes){

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{

            this.setState({
                trans: res.data,
                isLoading:false
                    // orders:this.props.orders,
            })
        })
        .catch(err=>{
            this.setState({
                errorLoad:true
            })
        })
        }

    userData(){
        axios.get(Urls.static_url + `customer/customerData/${encrypt((this.props.location.state.user_id).toString())}`)
            .then(res => {
                this.setState({
                    user: res.data.user,
                    userLoading:false
                })
            })
            .catch(err => {
               this.setState({
                errorLoad:true
            })
        })

    }

    productsCart() {


        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             user_id:this.props.location.state.user_id,
              "_token": csrf_token
          }
        axios.post(Urls.static_url + 'abandoned/products_user',data_post)
            .then(res => {
                this.setState({
                    productsCart: res.data.products,
                    productUserLoading:false
                })
            })
            .catch(err => {
            console.log({err});
        })

    }



    saveData = () => {
       // this.getAllReminders();
                        toast.success(this.state.trans["successfully saved data"], {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });

    }


    handleCloseReminder = () => {
        this.setState({
        showReminder:false
    })
    }
    render() {

        if (!this.state.errorLoad) {

        if (this.state.isLoading) {
            return (
              <LoadingInline />
            )
        }else
        return (
            <div>
                <ToastContainer />

                <div className="row">
                  <div className="col-12">
                            <div className="card">
                        <div className="card-body">
                            <div className="d-flex flex-row">
                                <div className="p-2">
                                    <i className="las la-shopping-basket" style={{fontSize:64,color:"#aaa"}}></i>
                                </div>
                                <div className="p-2 d-flex flex-column">
                                   <h4>{this.state.trans["What is the abandoned basket?"]}</h4>
                                   <p style={{color:"#aaa"}}>{ this.state.trans["It is the basket that the customer added the products to, then forgot and did not complete the purchase. And to motivate the customer to complete the order, you can activate a special temporary discount"]}</p>

                            </div>
                            </div>

                        </div>
                    </div>

                  </div>
                </div>
                <div className="row">
                    <div className="col-12">
                             <div className="card">
                        <div className="card-header">
                                <div className="d-flex flex-row" style={{ justifyContent: "space-between" }} >
                                    <div className="p-2">
                                      <h6>{this.state.trans["Customer"]}</h6>

                                    </div>

                                {/* <button></button> */}
                            </div>
                        </div>
                        <div className="card-body">
                            {this.state.userLoading ? (
                                <div className="d-flex" style={{justifyContent:"center",alignItems:"center"}}>
                                     <LoadingInline />
                                </div>
                                ) :
                                (
                                <div className="d-flex flex-row" style={{color:"#aaa"}}>
                                        <div className="p-2">
                                            <img src={Urls.public_url + "assets/img/customer_avatar.png"} style={{width:80,height:80}} />
                                        </div>
                                            <div className="p-2 d-flex flex-column">
                                                <div>
                                                    <h6>{this.state.user.name }</h6>
                                                </div>
                                                <div className="d-flex flex-row" style={{justifyContent:"center",alignItems:"center"}}>
                                                    <a href="#">{this.state.user.phone == "" || this.state.user.phone == null?"##########":this.state.user.phone}</a>
                                                    <button onClick={()=>{
                                                window.open('tel:'+this.state.user.phone);

                                            }} className="btn btn-icon"><i style={{fontSize:22,color:"#fd7e14"}} className="las la-phone-volume"></i></button>
                                                </div>
                                                <div className="d-flex flex-row">
                                                    <button onClick={()=>{

            window.location.href = "https://api.whatsapp.com/send?phone="+this.state.user.phone+"&text=اهلا بك في cms";


            }} className="btn btn-icon"><i style={{fontSize:22,color:"#28a745"}} className="lab la-whatsapp"></i></button>
        <button onClick={()=>{

            window.location.href = "https://demo.fekraerp.online/telegram/messageUser/chat/view?phone="+this.state.user.phone+"&bot_id=1747066964";


        }} className="btn btn-icon"><i style={{fontSize:22,color:"#007bff"}} className="lab la-telegram-plane"></i></button>
                                                    {/* <span>{user.name }</span> */}
                                                </div>
                                        </div>
                                </div>
                                )
                            }

                        </div>
                    </div>

                    </div>
                </div>
                <div className="row">
                    <div className="col-12">
                        <div className="card">
                            <div className="card-header">
                                <div className="d-flex flex-row" style={{ justifyContent: "space-between",width:"100%" }}>
                                    <div className="p-2">
                                        <h4>{this.state.trans["Products"]}</h4>
                                    </div>

                                     <div className="p-2">
                                         <button onClick={() => {


                                              this.setState({
                                              showReminder:true
                                          })


                                      }} className="btn btn-primary ">
                                          <i className="las la-clock"></i>
                                           {this.state.trans["active temporary discount"]}
                                      </button>
                                    </div>
                                </div>
                                </div>
                                <div className="card-body table-responsive">
                                    {this.state.productUserLoading ? (
                                        <div className="d-flex" style={{ justifyContent: "center", alignItems: "center" }}>
                                            <LoadingInline />
                                        </div>
                                    ) :
                                        (
                                <table className="table" >
                                    <thead className="table-light">
                                            <tr>
                                               <th scope="col">{ this.state.trans["Product"]}</th>
                                                <th scope="col">{ this.state.trans["Quantity"]}</th>
                                                        <th scope="col">{this.state.trans["Price"]}</th>
                                                          <th scope="col">{ this.state.trans["Tax"]}</th>
                                                <th scope="col">{ this.state.trans["Shipping Cost"]}</th>

                                                <th scope="col">{ this.state.trans["Calc"]}</th>

                                            </tr>
                                    </thead>
                                    <tbody >

                                              {
                                                  this.state.productsCart.map((item, i) => {
                                                      return (
                                                          <tr key={i}>

                                                              <td >
                                                                  <div className="d-flex flex-row" style={{alignItems:"center"}}>
                                                                      <div className="p-2">
                                                                          <img style={{ width: 40,height:40}} src={Urls.public_url + item.file_name} />
                                                                      </div>
                                                                      <div className="p-2">
                                                                          <a href={Urls.url + "product/" + item.slug}>{item.name}</a>
                                                                      </div>

                                                                  </div>
                                                                  </td>
                                                              <td>{ item.quantity}</td>
                                                              <td>{item.price}</td>
                                                              <td>{item.tax}</td>
                                                              <td>{item.shipping_cost}</td>
                                                              <td>{item.total_price}</td>

                                                </tr>
                                                      )
                                                  })
                                              }

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                              </table>

                                        )}
                                </div>


                            </div>
                        </div>
                </div>

                <div className="row">
                    <div className="col-12">
                        <a href={Urls.static_url + `customer/login_complete_order/${encrypt((this.props.location.state.user_id).toString())}`} style={{marginBlock:20}} className="btn btn-primary form-control">{ this.state.trans["complete order"]}</a>
                    </div>
                </div>

                <div>
                      <ReminderBasketModal saveData={this.saveData} ChooseUserArr={this.state.ChooseUserArr} show={this.state.showReminder} handleClose={this.handleCloseReminder} />
                  </div>

                </div>

        )
        } else {
            return (
                <ErrorConnection />
            )
        }

    }
}

