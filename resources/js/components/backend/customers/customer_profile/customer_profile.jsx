import axios from "axios";
import { Component } from "react"
import { withRouter } from "react-router-dom";
import { Urls } from "../../urls";
import './profile.css';
import BodyOrders from '../body_orders';
import MailModal from "../../modals/mail_modal/mail_modal";
import SmsModal from "../../modals/sms_model/sms_model";
// import BodyProducts from '../body_products';
import EditProfileModal  from '../../modals/edit_profile/edit_profile_modal';
import { toast,ToastContainer } from "react-toastify";
import CustomerProfileLoading from "./customer_profile_loading";
import MediaQuery from 'react-responsive'
import ErrorConnection from "../../../errors/error_connect";


 class CustomerProfile extends Component{

    constructor(){
        super();

        this.state = {
            isLoading:true,
            customer:{},
            customersOrders:[],
            showUserModal: false,
            errorLoad:false,
            avatar:"",
            defult_avatar:Urls.public_url + "assets/img/avatar-place.png",
            load_avatar:false,
            total_price:0,
            showMailModal: false,
            showSmsModal:false,

            trans:{
                "Wallet":"",
                "User Id":"",
                "Name":"",
                "Phone":"",
                "Email":"",
                "No Orders for this customer":"",
                "Product Name":"",
                "Price":"",
                "Discount Price":"",
                "Total Price":"",
                "About":"",
                "Orders":"",
                "Edit Profile":"",
                "Change Photo":"",
                "Order Id":"",
                "Delivery Status":"",
                "Payment Status":"",
                "Grand Total":"",
                "Code": "",
                "sent succesfully": "",
                "order code": "",
                "order created at": "",
                "review this is order": "",
                "show msg add card":""

            }
        }
    }
    componentDidMount(){
        this.setState({
            customer: this.props.customer,
            avatar:this.props.customer.avatar == null?"":Urls.url+this.props.customer.avatar

        })
        console.log({customer:this.props});
        this.callTrans(this.state.trans)
    //    this.getDataProducts(this.state.customer.id)

    }

    componentDidUpdate(prevProps, prevState) {
        if (prevState.customer !== this.state.customer) {
            this.customerOrders(this.state.customer.id)
        }
      }



    customerOrders(id){
        axios.get(Urls.static_url + "customers/customerOrders/"+id)
        .then(res=>{
            this.setState({
                customersOrders:res.data.orders,
                total_price:res.data.totalPrice,
                isLoading:false

            })
        })
            .catch(err => {
                  this.setState({
                errorLoad:true
            })
        })
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


            })
        })
        .catch(err=>{
      this.setState({
                errorLoad:true
            })
        })
    }

    editProfile = ()=>{
        this.setState({
            showUserModal:true
        })
    }

    handleCloseUserModal = ()=>{
        this.setState({
            showUserModal:false
        })
    }

    setUserData = (user)=>{
        for (const [key, value] of Object.entries(user)) {
            this.setState(prevState => ({
                customer: {                   // object that we want to update
                    ...prevState.customer,    // keep all other key-value pairs
                    [key]: value      // update the value of specific key
                }
            }))
        }
    }


    getAvatarUser = (event)=>{


        this.setState({
            load_avatar:true
        })
        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        let data = new FormData();
        data.append("_token",csrf_token);
        data.append("user_id",this.state.customer.id)
        data.append("photo",event.target.files[0]);


        if(event.target.files[0] !== undefined){
            axios.post(Urls.static_url+"user/setAvatarUser",data)
            .then(res=>{

               this.setState({
                   avatar:Urls.url + res.data.avatar,
                   load_avatar:false
               })
            })
                .catch(err => {

            })
        }else{
            this.setState({
                load_avatar:false
            })
        }

    }

    showMailModal = ()=>{
        this.setState({
            showMailModal:true
        })
    }

    closeMailModal = ()=>{
        this.setState({
            showMailModal:false
        })


                this.setState({
            loadSearch:false
        })
    }

         showSmsModal = () => {
        this.setState({
            showSmsModal:true
        })
     }

     closeSmsModal = () => {
         this.setState({
             showSmsModal: false
         })
     }
     sendMailToast = () => {
                var title_trans = this.state.trans["sent succesfully"];


            toast.success(title_trans, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
     }

     sendSmsToast = () => {
                var title_trans = this.state.trans["sent succesfully"];


            toast.success(title_trans, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
     }

     render() {

         if (!this.state.errorLoad) {
                   if(this.state.isLoading){
            return(
                <div>
                <CustomerProfileLoading />
                </div>
            )
        }else{
            return(
                <div>
                    <ToastContainer/>
                   <div className="container emp-profile">


                        <div className="row" >


                                                                <MediaQuery maxWidth={800}>

                            {/* <div className="d-flex flex-row" style={{justifyContent:"space-around",margin:60}}>
                                            <span style={{fontSize:14,marginInline:10}}>{ this.state.trans["show msg add card"]}</span>

                                 <label className="aiz-switch aiz-switch-success mb-0">
                                            <input onChange={e => {
                                                  let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                                        let  data_post = {
                                                            id: this.state.customer.id,
                                                             msg:e.target.checked,
                                                            "_token": csrf_token
                                                        }
                                                axios.post(Urls.static_url + "customer/msg_add_cart", data_post)
                                                    .then(() => {
                                                      var title_trans = this.state.trans["sent succesfully"];


                                                                    toast.success(title_trans, {
                                                                        position: "top-right",
                                                                        autoClose: 5000,
                                                                        hideProgressBar: false,
                                                                        closeOnClick: true,
                                                                        pauseOnHover: true,
                                                                        draggable: true,
                                                                        progress: undefined,
                                                                    });
                                                      })


                                            }} defaultChecked={this.state.fawry_sandbox == 1?true:false}    type="checkbox" />
                                                        <span className="slider round"></span>
                                    </label>
                                    </div> */}
                                            </MediaQuery>

                                    <MediaQuery maxWidth={800}>

                                  <div className="col-12" style={{margin:60}} >

                                 <button onClick={this.editProfile}  className="profile-edit-btn">{this.state.trans["Edit Profile"]}</button>
                             </div>
                            </MediaQuery>

                        <div className="col-md-4 col-12">
                            <div className="profile-img">
                                <img src={this.state.avatar == null || this.state.avatar == ""?this.state.defult_avatar:this.state.avatar } style={{width:200,height:180}}  alt=""/>
                                <div className="file btn btn-lg btn-primary">
                                    {this.state.trans["Change Photo"]}
                                    <input type="file" onChange={this.getAvatarUser} name="file"/>
                                    {this.state.load_avatar?<img style={{marginInline:10,width:15,height:15}} src={ Urls.public_url + "assets/img/loading.gif"}  />:null}

                                </div>

                            </div>

                                    {/* <div className="d-flex flex-row" style={{justifyContent:"space-around"}}>
                      <button onClick={this.showMailModal} className="btn btn-icon btn-light"><i className="las la-at"></i></button>

                        <button onClick={this.showSmsModal} className="btn btn-icon btn-success"><i className="las la-envelope-open-text"></i></button>

                                    </div> */}

                        </div>


                        <div className="col-md-5 col-12">
                            <div className="profile-head">
                                        <h5>
                                            {this.state.customer.name}
                                        </h5>
                                        <h6>
                                        {this.state.customer.email}
                                        </h6>
                                        <p className="proile-rating">{this.state.trans["Wallet"]} : <span>{this.state.customer.balance}</span></p>
                                <ul className="nav nav-tabs" id="myTab" role="tablist">
                                    <li className="nav-item">
                                        <a className="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{this.state.trans["About"]}</a>
                                    </li>
                                    <li className="nav-item">
                                        <a className="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{this.state.trans["Orders"]}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                           <MediaQuery minWidth={800}>
                                <div className="col-md-3 col-12">
                                    <div className="d-flex flex-row" style={{justifyContent:"space-around"}}>

                                 {/* <label className="aiz-switch aiz-switch-success mb-0">
                                            <span style={{fontSize:14}}>{ this.state.trans["show msg add card"]}</span>
                                            <input onChange={e => {
                                                  let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                                        let  data_post = {
                                                            id: this.state.customer.id,
                                                             msg:e.target.checked,
                                                            "_token": csrf_token
                                                        }
                                                axios.post(Urls.static_url + "customer/msg_add_cart", data_post)
                                                    .then(() => {
                                                      var title_trans = this.state.trans["sent succesfully"];


                                                                    toast.success(title_trans, {
                                                                        position: "top-right",
                                                                        autoClose: 5000,
                                                                        hideProgressBar: false,
                                                                        closeOnClick: true,
                                                                        pauseOnHover: true,
                                                                        draggable: true,
                                                                        progress: undefined,
                                                                    });
                                                      })


                                            }} defaultChecked={this.state.fawry_sandbox == 1?true:false}    type="checkbox" />
                                                        <span className="slider round"></span>
                                                    </label> */}
                                 <button onClick={this.editProfile}  className="profile-edit-btn">{this.state.trans["Edit Profile"]}</button>
                               </div>
                             </div>
                            </MediaQuery>

                    </div>

                    <div className="row">

                        <div className="col-md-8 offset-md-4 col-12">
                            <div className="tab-content profile-tab" id="myTabContent">
                                <div className="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["User Id"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.customer.id}</p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["Name"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.customer.name}</p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["Email"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.customer.email}</p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["Phone"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.customer.phone}</p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["Wallet"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.customer.balance}</p>
                                                </div>
                                            </div>
                                </div>
                                <div className="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <div>
                  {this.state.customersOrders.length != 0 ?
                  <div>
                        <div style={{maxHeight:300,overflow:"auto",padding:10}} >
                   {


                  this.state.customersOrders.map((item , i)=>(
                            <div key={i}  style={{display:"flex",justifyContent:"center"}}  className="d-flex flex-column">
                                <BodyOrders item={item} trans={this.state.trans} />
                            </div>

                        ))
                   }
             </div>


             {/* <div className="d-flex flex-row-reverse" style={{marginTop:10}}>
             <h3 >{this.state.trans["Total Price"]} : {this.state.total_price}</h3>

             </div> */}
                  </div>:<div>
                      <span>{this.state.trans["No Orders for this customer"]}</span>
                  </div>
                  }

             </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {/* <div className="row">

                    </div> */}
            </div>
            <div>
                <EditProfileModal setUserData={this.setUserData} handleClose={this.handleCloseUserModal} show={this.state.showUserModal} user_id={this.state.customer.id}  />
            </div>
            <div>
                <MailModal sendMailToast={this.sendMailToast} user_id={this.state.customer.id}  show={this.state.showMailModal} handleClose={this.closeMailModal}  />
            </div>

            <div>
                <SmsModal sendSmsToast={this.sendSmsToast}  user_id={this.state.customer.id}  show={this.state.showSmsModal} handleClose={this.closeSmsModal}  />
            </div>
                </div>
            )
        }
         } else {
                return (
                      <ErrorConnection />
                )
         }



    }
}

export default CustomerProfile;
