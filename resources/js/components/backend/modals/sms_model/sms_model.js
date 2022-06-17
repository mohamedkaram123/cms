import axios from "axios";
import { Component } from "react";
import {Modal,Button} from 'react-bootstrap';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from "../../urls";
import { toast,ToastContainer } from "react-toastify";
import BodySmsModal from "./body_sms_modal";
// import BodyModalProduct from "./body_modal_product";
// import HeaderModalProduct from "./header_modal_product";
import BodyModalMailLoading from "./body_modal_mail_loading";

export default class SmsModal extends Component{
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
            "Sms Provider": "",
            "SMS Fekra": "",
            "Content": "",
            "Save Changes": "",
            "Close": "",
            "Send SMS": "",
            "Count": "",
            "Parts": "",
            "Enter Count":"",
            "sent error. please check user phone or provider not correct":""

        },
        sms_box: {
            "sms_content": "",
            "sms_provider":"provider_fekra"
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
            trans: res.data,
            isLoading:false

        })
    })
    .catch(err=>{

    })
}

    onContentStateChange = (value,type) => {



          this.setState(prevState => ({
                sms_box: {                   // object that we want to update
                    ...prevState.sms_box,    // keep all other key-value pairs
                    [type]:value       // update the value of specific key
                }
            }))
}

setValue = (type,e)=>{
       this.setState(prevState => ({
                sms_box: {                   // object that we want to update
                    ...prevState.sms_box,    // keep all other key-value pairs
                    [type]:e.target.value       // update the value of specific key
                }
            }))
}

    handleSaveChange = () => {
        this.sendSms();
    }



    sendSms = () => {
        this.setState({
            loadSearch:true
        })

    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let  data_post = {
        data: this.state.sms_box,
        user_id:this.props.user_id,
          "_token": csrf_token
      }
    axios.post(Urls.static_url+"send_sms",data_post)
    .then(res=>{

      if(res.data.status){
                this.setState({
            loadSearch:false
      })
                   this.props.sendSmsToast()

            this.props.handleClose()
      }else{
                  var title_trans = this.state.trans["sent error. please check user phone or provider not correct"];


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
            // this.props.sendSmsToast()
            // this.props.handleClose()

    })
        .catch(err => {
            var title_trans = this.state.trans["sent error. please check user phone or provider not correct"];


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
                <Modal   show={this.props.show} onHide={this.props.handleClose}>

                {this.state.isLoading?
                            <div>
                                     <Modal.Header closeButton>
                <Modal.Title><Skeleton width={80} height={15} /></Modal.Title>

                </Modal.Header>
                <Modal.Body  >

                                    <div>
                                        laoding
                                    </div>
                                    {/* <BodyModalMailLoading /> */}

                </Modal.Body>
                <Modal.Footer>
                    <Skeleton  width={80} height={35}  />

                  <Skeleton  width={150} height={35}  />
                </Modal.Footer>
                </div>:
                <div>

< ToastContainer />

                <Modal.Header closeButton>
                <Modal.Title>{this.state.trans["Send SMS"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body >

                                    <BodySmsModal
                                        trans={this.state.trans}
                                        setValue={this.setValue}
                                        onContentStateChange={this.onContentStateChange} />

                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={()=>{
                      this.props.handleClose()

                  }}>
                    {this.state.trans["Close"]}
                  </Button>
                  <Button disabled={this.state.loadSearch} onClick={this.handleSaveChange} variant="primary" >
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

