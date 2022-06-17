import axios from "axios";
import { Component } from "react";
import {Modal,Button} from 'react-bootstrap';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from "../../urls";
import { toast,ToastContainer } from "react-toastify";
import BodyMailModal from "./body_mail_modal";
// import BodyModalProduct from "./body_modal_product";
// import HeaderModalProduct from "./header_modal_product";
import BodyModalMailLoading from "./body_modal_mail_loading";

export default class MailModal extends Component{
constructor()
{
    super()
    this.state = {
        isLoading:false,

        loadSearch:false,
        user_id:0,
        user_data:{},
        user:{},
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
            "sent error please check user email or provider not correct":""

        },
        mail_box: {
            mail_driver: "smtp",
            subject: "",
            sender: "",
            text_btn: "",
            link: "",
            content: "",
            view:"emails.mail1"
        }


    }
}

componentDidMount(){



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

        })
    })
    .catch(err=>{

    })
}

onContentStateChange = (value)=>{
          this.setState(prevState => ({
                mail_box: {                   // object that we want to update
                    ...prevState.mail_box,    // keep all other key-value pairs
                    ["content"]:value.blocks[0].text       // update the value of specific key
                }
            }))
}

setValue = (type,e)=>{
           this.setState(prevState => ({
                mail_box: {                   // object that we want to update
                    ...prevState.mail_box,    // keep all other key-value pairs
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


    sendMail = () => {
        this.setState({
            loadSearch:true
        })

    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let  data_post = {
        data: this.state.mail_box,
        user_id:this.props.user_id,
          "_token": csrf_token
      }
    axios.post(Urls.static_url+"sendMail",data_post)
    .then(res=>{



            this.props.sendMailToast()
            this.props.handleClose()

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
}


render(){

            return(
                <div>
                <Modal size="lg"   show={this.props.show} onHide={this.props.handleClose}>

                {this.state.isLoading?
                            <div>
                                     <Modal.Header closeButton>
                <Modal.Title><Skeleton width={80} height={15} /></Modal.Title>

                </Modal.Header>
                <Modal.Body className="modal_mail" >

                                    <BodyModalMailLoading />

                </Modal.Body>
                <Modal.Footer>
                    <Skeleton  width={80} height={35}  />

                  <Skeleton  width={150} height={35}  />
                </Modal.Footer>
                </div>:
                <div>

< ToastContainer />

                <Modal.Header closeButton>
                <Modal.Title>{this.state.trans["Send Mail"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body className="modal_mail">

                  <BodyMailModal mail_box={this.state.mail_box} selectMailView={this.selectMailView} trans={this.state.trans} setValue={this.setValue} onContentStateChange={this.onContentStateChange} />

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

