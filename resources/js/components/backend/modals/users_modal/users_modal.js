import { Modal ,Button} from 'react-bootstrap';
import React, { Component, useState } from 'react';
import BodyModalUser from './body_modal_users';
import HeaderModalUser from './header_modal_users';
import axios from 'axios';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from '../../urls';
import { ceil, round } from 'lodash';
import LoadingInline from './LoadingInline';
export default class UserModal extends Component{

    constructor(){
        super()
        this.increment = 0;
        this.state = {
            isLoading:true,
            optionsCountries:[],
            optionsCities:[],
            objectUser:{},
            loadSearch: false,
            scrollCheck:false,
            userId:0,
            user:{},
            trans:{
                "User":"",
                "User Name":"",
                "User Phone":"",
                "User Email":"",
                "Choose Country":"",
                "Country":"",
                "City":"",
                "Search":"",
                "Close":"",
                "Save Changes": "",
                "All": "",
                "Customer": "",
                "Seller": "",
                "Admin": "",
                "Checked All":""

            },
            checked_all:false,
            ChooseUserArr:[],
            chooseUserClass:{
                background:"#FF6900",
                color:"#fff"
            },
            rows:[]
        }
    }

    componentDidMount(){



        // if (this.state.rows == this.state.ChooseUserArr) {
        //     this.setState({
        //          checked_all:true
        //      })
        //  }
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

         axios.post(Urls.static_url+"users/getUsers",obj)
         .then(res=>{

            this.setState({
                rows:!res.data.check_number?res.data.users:this.state.rows.concat(res.data.users) ,
                loadSearch:false,
                scrollCheck:res.data.check_number
            })

             if (res.data.check_number) {
                                this.increment += 20;

             }
         })
         .catch(err=>{
         })

    }
    handleSaveChange = ()=>{
        this.props.getUsers(this.state.ChooseUserArr);
    }
    HandleOutUser = (id,item)=>{

        this.setState({
            userId:id,
            user:item,

            hoverChooseUser:{
                [id]:true
            }
        })


    }

      handleScroll = (e) => {

          const bottom = ceil(e.target.scrollHeight - e.target.scrollTop)  === e.target.clientHeight;
          if (bottom) {


              if (this.state.scrollCheck) {
                  this.handleStateChange({
                     name:"",
                    phone:"",
                    email:"",
                    country_id:"",
                  city_id: "",
                    user_type:""
              });
              }

          } else {

    }
      }


    handleAddDataUser = (UsertData)=>{

    this.setState({
        ChooseUserArr:[...this.state.ChooseUserArr,UsertData]
    })

}


handleremoveDataUser = (UsertData)=>{
    this.handleDelete(UsertData)
}


  handleDelete = UsertData => {
    const items = this.state.ChooseUserArr.filter(item => item.id !== UsertData.id);
    this.setState({ ChooseUserArr: items });
  };

    checkAllHandle = (value)=>{
        if (value) {
            this.setState({
                ChooseUserArr:this.state.rows
            })
        } else {
             this.setState({
                ChooseUserArr:[]
            })
        }
        this.setState({
            checked_all:value
        })
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
                <Modal.Title>{this.state.trans["User"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>

                <HeaderModalUser

                checkedAll={this.state.checked_all}
                 loadSearch={this.state.loadSearch}
                 onChange={this.handleStateChange}
                 trans={this.state.trans}
                 checkAllHandle={this.checkAllHandle}
                 countries={this.state.optionsCountries}  />

                <div onScroll={this.handleScroll} style={{maxHeight:400,overflow:'auto'}}>

                    { this.state.rows.map((item,i)=>(
                        <div key={i} onClick={this.HandleOutUser.bind(this,item.id,item)} style={{cursor:'pointer'}} >
                  <BodyModalUser checked_all={this.state.checked_all} handleAddDataUser={this.handleAddDataUser} ChooseUserArr={this.state.ChooseUserArr}  handleremoveDataUser={this.handleremoveDataUser}  user={item} />

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



