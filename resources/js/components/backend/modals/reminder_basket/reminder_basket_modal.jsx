import axios from "axios";
import { Component } from "react";
import {Modal,Button} from 'react-bootstrap';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from "../../urls";
import { toast,ToastContainer } from "react-toastify";
import LoadingInline from "./LoadingInline";
import BodyReminderBasket from "./body_reminder_basket";

// import BodyModalProduct from "./body_modal_product";
// import HeaderModalProduct from "./header_modal_product";


export default class ReminderBasketModal extends Component{
constructor()
{
    super()
    this.state = {
        isLoading:true,

        loadSearch:false,
        trans:{
            "Temporary discount with reminder":"",
            "Save Changes":"",
            "shipping free":"",
            "Close":"",
            "discount basket": "",
            "grant the customer discount and define discount type is amount or percent from purches": "",
            "discount type": "",
            "amount from purches": "",
            "percent from purches": "",
            "text msg": "",
            "Choose send way and text msg": "",
            "msg sms": "",
            "email": "",
            "all": "",
            "title email":"",
            "hello {var_name} We would like to offer you a special discount {var_discount_amount} on the shopping cart But the discount ends on {var_date}, don't miss it!":"",
               "user name":"",
               "total discount":"",
            "discount expiry date": "",
            "send now": "",
            "specific time": "",
            "date send offer":"",
            "expire date": "",
            "the var is required": "",
            "discount": "",
            "the var_1 or var_2 is required": "",
            "Your basket is full of products, please complete the order": "",
            "successfully saved data": "",
            "Total Usage For All": "",
            "Total Usage For One User":""


        },
        objectGetData: false,
        ChooseUserArr:[]




    }
}

componentDidMount(){


    this.callTrans(this.state.trans);
}


    sendReminderData = () => {
  //  axios.post(Urls.static_url + "")
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
            trans: res.data,
            isLoading:false

        })
    })
    .catch(err=>{

    })
}

    getData = (data) => {

        this.setState({
            loadSearch:true
        })
        let data_done = true;
        if (data.discountBasket) {

            if (data.discounttype == "" && data.discount == 0 || data.discount == "") {

                let title_trans = this.state.trans["the var_1 or var_2 is required"];
                let title = title_trans.replace("var_1", this.state.trans["discount type"]);
                let title1 = title.replace("var_2", this.state.trans["discount"]);


                toast.error(title1, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                data_done = false;
                this.setState({
            loadSearch:false
        })

            }


        }




        if (data.channel_msg == "all" || data.channel_msg == "email") {


            if (data.title_mail == "") {
                  let title_trans = this.state.trans["the var is required"];
                let title = title_trans.replace("var", this.state.trans["title email"]);


                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                data_done = false;
                this.setState({
            loadSearch:false
        })

            }

        }



        if (data.channel_msg == "all" || data.channel_msg == "email" || data.channel_msg == "sms") {


            if (data.msg == "") {
                  let title_trans = this.state.trans["the var is required"];
                let title = title_trans.replace("var", this.state.trans["msg"]);


                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                data_done = false;
                this.setState({
            loadSearch:false
        })

            }

        }

        if (data_done) {
             let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            data["_token"] = csrf_token;
            data["users"] = this.props.ChooseUserArr
            data["total_usage_for_all"] = this.props.ChooseUserArr.length

            axios.post( Urls.static_url + "reminder_basket/saveDataReminder", data)
                .then(res => {



                    this.setState({
                        loadSearch:false
                    })
                    // setTimeout(() => {

                        this.props.saveData()
                        this.props.handleClose()

//                    }, 600);

                })
                .catch(err => {
                console.log({err});
            })
        }

        this.setState({
        objectGetData:false
    })
    }

    handleSaveChange = () => {
        this.setState({
        objectGetData:true
    })
}




render(){

            return(
                <div>
                <Modal size="lg"  show={this.props.show} onHide={this.props.handleClose} backdrop="static">

< ToastContainer />

                <div>


                <Modal.Header closeButton>
                <Modal.Title>{this.state.trans["Temporary discount with reminder"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>
                                {this.state.isLoading ?
                                    <div>
                                        <LoadingInline />
                                    </div> :
                                    <BodyReminderBasket  objectGetData={this.state.objectGetData} getData={this.getData} trans={this.state.trans} />
                                }
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


              </Modal>

                </div>
            )
        }
    }

