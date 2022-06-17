import axios from "axios";
import { Component } from "react"
import { withRouter } from "react-router-dom";
import { Urls } from "../../urls";
import './profile.css';
import BodyProducts from '../body_products';
import EditProfileModal  from '../../modals/edit_profile/edit_profile_modal';
import SellerProfileLoading from "./seller_profile_loading";
 class SellerProfile extends Component{

    constructor(){
        super();

        this.state = {
            isLoading:true,
            seller:{},
            sellersOrders:[],
            showUserModal:false,
            avatar:"",
            defult_avatar:Urls.public_url + "assets/img/avatar-place.png",
            load_avatar:false,
            trans:{
                "Wallet":"",
                "User Id":"",
                "Name":"",
                "Phone":"",
                "Email":"",
                "No Products for this seller":"",
                "Product Name":"",
                "Price":"",
                "Discount Price":"",
                "Total Price":"",
                "About":"",
                "Products":"",
                "Edit Profile":"",
                "Change Photo":""

            }
        }
    }
    componentDidMount(){
        this.setState({
            seller:this.props.location.state.seller,
            avatar:this.props.location.state.seller.avatar == null?"":Urls.url+this.props.location.state.seller.avatar

        })
        this.callTrans(this.state.trans)
    //    this.getDataProducts(this.state.seller.id)

    }

    componentDidUpdate(prevProps, prevState) {
        if (prevState.seller !== this.state.seller) {
            this.getDataProducts(this.state.seller.id)
        }
      }

    getDataProducts = (id)=>{


        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            id,
            _token:csrf_token
        }

         axios.post(Urls.static_url+"products/getProductsSeller",data)
         .then(res=>{

            this.setState({
                sellersOrders:res.data.products,
                isLoading:false

            })
         })
         .catch(err=>{
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
                seller: {                   // object that we want to update
                    ...prevState.seller,    // keep all other key-value pairs
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
        data.append("user_id",this.state.seller.id)
        data.append("photo",event.target.files[0]);


        if(event.target.files[0] !== undefined){
            axios.post(Urls.static_url+"user/setAvatarUser",data)
            .then(res=>{

               this.setState({
                   avatar:Urls.url + res.data.avatar,
                   load_avatar:false
               })
            })
            .catch(err=>{
            })
        }else{
            this.setState({
                load_avatar:false
            })
        }

    }

    render(){

        if(this.state.isLoading){
            return(
                <div>
                    <SellerProfileLoading />
                </div>
            )
        }else{
            return(
                <div>
                   <div className="container emp-profile">

                    <div className="row">
                        <div className="col-4">
                            <div className="profile-img">
                                <img src={this.state.avatar == null || this.state.avatar == ""?this.state.defult_avatar:this.state.avatar } style={{width:270,height:250}}  alt=""/>
                                <div className="file btn btn-lg btn-primary">
                                    {this.state.trans["Change Photo"]}
                                    <input type="file" onChange={this.getAvatarUser} name="file"/>
                                    {this.state.load_avatar?<img style={{marginInline:10,width:15,height:15}} src={ Urls.public_url + "assets/img/loading.gif"}  />:null}

                                </div>
                            </div>
                        </div>
                        <div className="col-6">
                            <div className="profile-head">
                                        <h5>
                                            {this.state.seller.name}
                                        </h5>
                                        <h6>
                                        {this.state.seller.email}
                                        </h6>
                                        <p className="proile-rating">{this.state.trans["Wallet"]} : <span>{this.state.seller.balance}</span></p>
                                <ul className="nav nav-tabs" id="myTab" role="tablist">
                                    <li className="nav-item">
                                        <a className="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{this.state.trans["About"]}</a>
                                    </li>
                                    <li className="nav-item">
                                        <a className="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{this.state.trans["Products"]}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div className="col-2">

                            <button onClick={this.editProfile}  className="profile-edit-btn">{this.state.trans["Edit Profile"]}</button>
                        </div>
                    </div>
                    <div className="row">

                        <div className="col-8 offset-4">
                            <div className="tab-content profile-tab" id="myTabContent">
                                <div className="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["User Id"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.seller.id}</p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["Name"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.seller.name}</p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["Email"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.seller.email}</p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["Phone"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.seller.phone}</p>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-6">
                                                    <label>{this.state.trans["Wallet"]}</label>
                                                </div>
                                                <div className="col-6">
                                                    <p>{this.state.seller.balance}</p>
                                                </div>
                                            </div>
                                </div>
                                <div className="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div>
                  {this.state.sellersOrders.length != 0 ?
                  <div>
                        <div style={{maxHeight:300,overflow:"auto",padding:20}} >
                   {


                             this.state.sellersOrders.map((item , i)=>(
                            <div  key={item.id} className="d-flex flex-column">
                                <BodyProducts product={item} trans={this.state.trans} />
                                 {(this.state.sellersOrders.length -1 ) != i?<div style={{display:"flex",justifyContent:"center",alignItems:"center",marginBlock:20}}><span style={{width:"90%",height:2,background:"#aaa"}}></span></div>: null }
                            </div>

                        ))
                   }
             </div>



                  </div>:<div>
                      <span >{this.state.trans["No Products for this seller"]}</span>
                  </div>
                  }

             </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div>
                <EditProfileModal setUserData={this.setUserData} handleClose={this.handleCloseUserModal} show={this.state.showUserModal} user_id={this.state.seller.id}  />
            </div>
                </div>
            )
        }

    }
}

export default withRouter(SellerProfile);
