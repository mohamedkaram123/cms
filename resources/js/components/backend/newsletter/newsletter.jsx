import axios from "axios";
import { Component } from "react";
import { ToastContainer, toast } from 'react-toastify';
import { Urls } from "../urls";
import BodyMailModal from "./body_mail_modal";
import LoadingInline from "./LoadingInline";
import { Tab, TabList, TabPanel, Tabs } from 'react-tabs';
import MainMails from "./mails_body/main_mails/main_mails";
import ErrorConnection from "../../errors/error_connect";

export default class NewsLetter extends Component{

    constructor(){
        super();

        this.state = {
            isLoading:true,
            loadingBtn: false,
            showUserModal: false,
            index: 0,
                        errorLoad:false,

            trans:{
                        "Send Mail":"",
            "Subject":"",
            "Content":"",
            "Sender":"",
            "Save Changes":"",
            "Details":"",
            "Link":"",
            "Close":"",
            "Mail View1":"",
            "Text Btn Link":"",
            "Mail Driver":"",
            "Smtp":"",
            "Mailgun":"",
            "Mailchimp": "",
            "sent succesfully": "",
            "sent error. please check user email or provider not correct":"",
                "Choose user": "",
                "Choose": "",
                "users": "",
                "Send Mails": "",
                "Queue": "",
                "Sent Succesfully Queue Mails": "",
                "All": "",
                "Customer": "",
                "Seller": "",
                "Admin": "",
                "Users Type": "",
                "Order Delivery Status": "",

            "Pending":"",
             "Confirmed":"",
             "On Delivery":"",
             "Delivered":"",
             "paid":"",
                "unpaid": "",
                "Start Date Orders": "",
                "End Date Orders": "",
                "SMS": "",
                "Mail": "",
                "Msg Type": "",
                "Send": "",
                "Main Mails": "",
                "Sales Mails": "",
                "The Queue is turned on automatically when users exceed 30 users": "",
                "Note": "",
                "views mails": "",
                "Subject Mail": "",
                "Succesfully send Mails": "",
                "Cancel": "",
             "cancelled":""


            },
        mail_box: {
            msg_type: "mail",
            subject: "",
            text_btn: "",
            delivery_status: "",
            start_date:new Date((new Date()).setDate((new Date()).getDate()-5)).toISOString().substring(0,10),
            end_date:new Date().toISOString().substring(0,10),
            link: "",
            content: "",
            view: "emails.mail1",
            },
          mail_box2: {
            msg_type: "mail",
            subject: "",
            sender: "",
            text_btn: "",
            link: "",
            content: "",
            view: "emails.mail_design.newsletter",
            },
            RequireDataMailBox2: {
                content: "",
                subject: ""
          },
        queue:false,
        loadSearch:false,
                    users:[],




        }
    }

    componentDidMount(){


        this.callTrans(this.state.trans)
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
this.setState({
                    errorLoad:true
                })
        })
    }

    handleCloseUserModal = () => {
        this.setState({
            showUserModal:false
        })
    }






    onContentStateChange = (e) => {
      console.log(e.target.value);
          this.setState(prevState => ({
                mail_box: {                   // object that we want to update
                    ...prevState.mail_box,    // keep all other key-value pairs
                    ["content"]:e.target.value       // update the value of specific key
                }
            }))
}
    onContentStateChange2 = (e)=>{
      console.log(e.target.value);

        this.setState(prevState => ({
                mail_box2: {                   // object that we want to update
                    ...prevState.mail_box2,    // keep all other key-value pairs
                    ["content"]:e.target.value       // update the value of specific key
                }
            }))
}

    setValue = (type, e) => {

           this.setState(prevState => ({
                mail_box: {                   // object that we want to update
                    ...prevState.mail_box,    // keep all other key-value pairs
                    [type]: e.target.value      // update the value of specific key
                }
            }))
    }

        setValue2 = (type, e) => {

           this.setState(prevState => ({
                mail_box2: {                   // object that we want to update
                    ...prevState.mail_box2,    // keep all other key-value pairs
                    [type]: e.target.value      // update the value of specific key
                }
            }))
}

    handleSaveChange = () => {
        this.sendMail();
    }
selectMailView = (e)=>{

               this.setState(prevState => ({
                mail_box: {                   // object that we want to update
                    ...prevState.mail_box,    // keep all other key-value pairs
                    ["view"]: e.target.value      // update the value of specific key
                }
            }))
}

selectMailView2 = (e)=>{

    console.log({e:e.target.value});
               this.setState(prevState => ({
                mail_box2: {                   // object that we want to update
                    ...prevState.mail_box2,    // keep all other key-value pairs
                    ["view"]: e.target.value      // update the value of specific key
                }
            }))
}
    sendMail = () => {
        this.setState({
            loadSearch:true
        })

        //  console.log({box_mail:this.state.mail_box,users:this.state.users});
    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let  data_post = {
        data: this.state.mail_box,
        users: this.state.users,
        queue:this.state.queue,
          "_token": csrf_token
    }
        console.log({data_post});
    axios.post(Urls.static_url+"sendMails",data_post)
    .then(res=>{


        if (res.data.status == 1) {
                    if (res.data.send_type == "queue") {

            var title_trans = this.state.trans["Sent Succesfully Queue Mails"];


            toast.success(title_trans, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
            this.setState({
                loadSearch: false
            })
        }else{
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

                this.setState({
            loadSearch:false
        })
        }

        } else {
              let title_trans = res.data.error_msg;


            toast.error(title_trans, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
              this.setState({
            loadSearch:false
        })
        }

    })
        .catch(err => {
            var title_trans = this.state.trans["sent error. please check user email or provider not correct"];


            toast.error(title_trans, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
              this.setState({
            loadSearch:false
        })

        })

        if (this.state.queue) {
var title_trans = this.state.trans["Sent Succesfully Queue Mails"];


            toast.success(title_trans, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
            this.setState({
                loadSearch: false
            })
        }
}

    sendMainMail = () => {
               this.setState({
            loadSearch:true
               })

           let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let  data_post = {
        data: this.state.mail_box2,

          "_token": csrf_token
    }
        console.log({data_post});
        axios.post(Urls.static_url + "sendMainMails", data_post)
            .then(res => {

                if (res.data.status == 0) {
                           for (const [key, value] of Object.entries(this.state.RequireDataMailBox2)) {
                  this.setState(prevState => ({
                RequireDataMailBox2: {                   // object that we want to update
                    ...prevState.RequireDataMailBox2,    // keep all other key-value pairs
                   [key]: (key in res.data.msg)?res.data.msg[key][0]:""      }
                  }))


            this.setState({
                loadSearch:false
            })
                                   window.scrollTo(0, 0);


                    }
                } else {
                    var title_trans = this.state.trans["Succesfully send Mails"];


            toast.success(title_trans, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
                               this.setState({
                loadSearch:false
            })
                }
            })
            .catch(err => {
                this.setState({
                    errorLoad:true
                })
        })


    }
    getUsers = (users) => {
        this.setState({
        users
        })
        this.handleCloseUserModal()
}
    render() {
     if(!this.state.errorLoad){
        if(this.state.isLoading){
            return(
                <div>
                    <LoadingInline />
                </div>
            )
        }else{
            return(
                <div>

                    < ToastContainer />
                    <Tabs onSelect={index => {
                            this.setState({
                                index
                            })
                       }} >
                            <div className="card">


                                                <div className="card-header" >


                                                        <TabList >


                                                                    <Tab >

                                                                        <span >
                                                                            {this.state.trans["Main Mails"]}
                                                                        </span>
                                                                    </Tab>



                                                                    <Tab >

                                                                        <span >
                                                                            {this.state.trans["Sales Mails"]}
                                                                        </span>
                                                                    </Tab>






                                                    </TabList>

                                                        </div>

                        <div className="card-body">
                                <div className="alert" style={{ color: "#004085", backgroundColor: "#cce5ff", borderColor: "#b8daff", marginBottom: 0, marginTop: 10 }}>
                                         <div className="d-flex flex-column">
                                             <div className="d-flex flex-row" style={{alignItems:"center"}}>
                                               <strong style={{marginInline:10}}>{this.state.trans["Note"]}</strong>
                                             <span> {this.state.trans['The Queue is turned on automatically when users exceed 30 users']}.</span>

                                             </div>

                                         </div>

                                    </div>



                            <div className="card-body">
                        <TabPanel>


                                        <MainMails trans={this.state.trans}
                                            mail_box={this.state.mail_box2}
                                            setValue={this.setValue2}
                                            selectMailView={this.selectMailView2}
                                            onContentStateChange={this.onContentStateChange2}
                                            required_mail_box={this.state.RequireDataMailBox2}

                                        />

                    </TabPanel>
                    <TabPanel>

                          <BodyMailModal
                                                                mail_box={this.state.mail_box}
                                                                selectMailView={this.selectMailView}
                                                                trans={this.state.trans}
                                                                setValue={this.setValue}
                                                                onContentStateChange={this.onContentStateChange} />
                    </TabPanel>
                        </div>
                                  <div style={{margin:20}} className="d-flex flex-row-reverse">
                            <button disabled={this.state.loadSearch} onClick={this.state.index == 0?this.sendMainMail:this.sendMail} className="btn btn-light">
                                {this.state.trans["Send"]}
                                {this.state.loadSearch?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }

                            </button>


                            </div>
                             </div>
                                    </div>
</Tabs>




                         {/* <UserModal show={this.state.showUserModal} getUsers={this.getUsers} handleClose={this.handleCloseUserModal} /> */}
                      </div>
                )
        }
   }else {
                return (
                      <ErrorConnection />
                )
       }
    }

}
