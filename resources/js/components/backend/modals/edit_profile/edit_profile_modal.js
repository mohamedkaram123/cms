import axios from "axios";
import { Component } from "react";
import {Modal,Button} from 'react-bootstrap';
import BodyEditProfile from "./body_edit_profile";
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from "../../urls";
import { toast,ToastContainer } from "react-toastify";

// import BodyModalProduct from "./body_modal_product";
// import HeaderModalProduct from "./header_modal_product";


export default class EditProfileModal extends Component{
constructor()
{
    super()
    this.state = {
        isLoading:true,

        loadSearch:false,
        user_id:0,
        user_data:{},
        user:{},
        trans:{
            "Edit Profile":"",
            "the var is required":"",
            "Name":"",
            "Email":"",
            "Save Changes":"",
            "Phone":"",
            "Close": "",
            "Balance":""

        },
        UserProfile : {
            name:"",
            phone:"",
            email: "",
            balance:"0"
        }


    }
}

componentDidMount(){


    this.callTrans(this.state.trans);
    this.getDataUser(this.props.user_id)
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


getDataUser(id){


    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let data = {
        _token:csrf_token,
        user_id:id
    }

     axios.post(Urls.static_url+"user/getUser",data)
     .then(res=>{


        let data = {
            name:res.data.user.name,
            phone:res.data.user.phone,
            email:res.data.user.email,
balance:res.data.user.balance,
        }

        this.setState({
            UserProfile:data,
            isLoading:false
        })
     })
     .catch(err=>{
     })
}

setDataUser(UserProfile){

    this.setState({
        loadSearch:true
    })

    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let data = {
        user:UserProfile,
        user_id:this.state.user_id,
        _token:csrf_token
    }

     axios.post(Urls.static_url+"user/setDataUser",data)
     .then(res=>{

        this.props.setUserData(res.data.user)

        this.setState({
            loadSearch:false,
        })

        this.props.handleClose();
     })
     .catch(err=>{
     })
}

  handleSaveChange = ()=>{

    this.setState({
        loadSearch:true
    })

    let doneData = true;

      for (const [key, value] of Object.entries(this.state.UserProfile)) {
        if(value === "" || value === null){
        console.log({key,value});

            var title_trans = this.state.trans["the var is required"];
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

                doneData = false
                this.setState({
                    loadSearch:false
                })
        }else{
            if(key == "email"){
                if (! /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(value)  )
                {
                    var title_trans = this.state.trans["the var is required"];
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

                        doneData = false
                        this.setState({
                            loadSearch:false
                        })
                }
            }

        }


      }

      if(doneData){

        this.setDataUser(this.state.UserProfile);

      }
  }

  componentDidUpdate(prevProps, prevState) {
    if (prevProps.user_id !== this.state.user_id) {
        this.setState({
            user_id:this.props.user_id
        })
    }
  }

  userProfile = (type,e)=>{

    this.setState(prevState => ({
        UserProfile: {                   // object that we want to update
            ...prevState.UserProfile,    // keep all other key-value pairs
            [type]: e.target.value      // update the value of specific key
        }
    }))
  }

render(){

            return(
                <div>
                <Modal  show={this.props.show} onHide={this.props.handleClose}>

                {this.state.isLoading?
                <div>
                loading
                </div>:
                <div>

< ToastContainer />

                <Modal.Header closeButton>
                <Modal.Title>{this.state.trans["Edit Profile"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>

                 <BodyEditProfile userProfile={this.userProfile} trans={this.state.trans} user={this.state.UserProfile} />

                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={()=>{
                      this.props.handleClose()

                  }}>
                    {this.state.trans["Close"]}
                  </Button>
                  <Button onClick={this.handleSaveChange} variant="primary" >
                   { this.state.trans["Save Changes"] }{this.state.loadSearch?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                  </Button>
                </Modal.Footer>
                </div>

                }
              </Modal>

                </div>
            )
        }
    }

