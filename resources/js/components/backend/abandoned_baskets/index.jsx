import axios from "axios";
import { Component } from "react";
import { Link } from "react-router-dom";
import swal from "sweetalert";
import { encrypt } from "../hashes";
import ReminderBasketModal from "../modals/reminder_basket/reminder_basket_modal";
import ReminderBasketModalPublic from "../modals/reminder_basket_public/reminder_basket_modal_public";
import { Urls } from "../urls";
import LoadingInline from "./LoadingInline";
import { toast,ToastContainer } from "react-toastify";
import ErrorConnection from "../../errors/error_connect";

export default class AbamdonedBaskets extends Component {

    constructor() {
        super()
        this.state = {
            isLoading:true,
            loadingBtn: false,
            errorLoad:false,
            offset: 0,
            limit:10,
            trans:{
               "Abandoned basket reminders":"",
               "Create a new reminder":"",
               "Abandoned baskets":"",
               "created at":"",
               "number of products":"",
               "calc baskets":"",
               "user name":"",
               "Measurement Id":"",
               "Save Data":"",
               "the var is required":"",
                "Data saved successfully": "",
                "active temporary discount": "",
                "email": "",
                "sms": "",
                "send": "",
                "pending": "",
                "special users": "",
                "all users": "",
                "date send reminder": "",
                "channel": "",
                "status": "",
                "public": "",
                "not found reminders": "",
                "email and sms": "",
                "complete order": "",
                "please choose users": "",
                "error msg": "",
                "ok": "",
                "successfully saved data":""

            },
            showReminder: false,
            showReminderPublic:false,
            loadData:false,
            carts: [],
            ChooseUserArr: [],
            ChooseUser: {},
            reminders: [],
            reminderLoading:true
        }
    }

    componentDidMount(){
        // console.log({rtl:});

        this.callTrans(this.state.trans);
        this.getAbandonedBaskets();
        this.getAllReminders()
        let lastScroll = 0
        window.onscroll =  (e)=>{
            //   console.log(e);
      let currentScroll = document.documentElement.scrollTop || document.body.scrollTop; // Get Current Scroll Value

      if ($(window).scrollTop() + $(window).height() == $(document).height()){

          this.setState({
              loadData:true
          })
          let limit = this.state.limit;
          let offset = this.state.offset;

          offset += limit;
          this.setState({
              offset
          })
        this.getAbandonedBaskets()



      }else{
        lastScroll = currentScroll;
      }
  };




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

                    // orders:this.props.orders,
            })
        })
        .catch(err=>{
      this.setState({
                errorLoad:true
            })
        })
        }



    getAbandonedBaskets() {

        axios.get(Urls.static_url+`abandoned/all_baskets?offset=${this.state.offset}&limit=${this.state.limit}`)
        .then(res=>{


            this.setState({
                carts: this.state.carts.concat(res.data.carts),
                              loadData:false,

                    // orders:this.props.orders,
            })
        })
        .catch(err=>{
      this.setState({
                errorLoad:true
            })
        })
    }



    saveData = () => {
        this.getAllReminders();
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

    saveDataReminderPublic = () => {
        this.getAllReminders();

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

        getAllReminders() {
            this.setState({
                reminderLoading:true
            })

        axios.get(Urls.static_url+"reminder_basket/reminders")
        .then(res=>{


            this.setState({
                reminders: res.data.reminders,

                    // orders:this.props.orders,
                reminderLoading:false
            })
        })
        .catch(err=>{

        })
    }



    handleCloseReminder = () => {
        this.setState({
        showReminder:false
    })
    }

    handleCloseReminderPublic = () => {
        this.setState({
        showReminderPublic:false
    })
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

// swal({
//   title: "Good job!",
//   text: "You clicked the button!",
//   icon: "success",
//   button: "Aww yiss!",
// });
    render() {
        if (!this.state.errorLoad) {
            if (this.state.isLoading) {

                return (
                    <LoadingInline />
                )
            } else {
                return (<div   >
                    <ToastContainer />
                    {/* <div className="row" style={{marginBlock:20}}>
                    <div className="col-4">
                      <button onClick={() => {
                            this.setState({
        showReminderPublic:true
    })
                        }} className="btn btn-primary">{this.state.trans["Create a new reminder"]}</button>
                     </div>
                </div> */}
                    <div className="row">
                        <div className="col-12">
                            <div className="card">
                                <div className="card-header">
                                    <h6>{this.state.trans["Abandoned basket reminders"]}</h6>
                                </div>
                                <div style={{ maxHeight: 200, overflow: "auto" }} className="card-body">
                                    {this.state.reminderLoading ? (
                                        <div className="d-flex" style={{ justifyContent: "center", alignItems: "center" }}>
                                            <LoadingInline />
                                        </div>
                                    ) : (


                                        <div>
                                            {this.state.reminders.length != 0 ? (
                                                <table className="table" >
                                                    <thead className="table-light">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">{this.state.trans["date send reminder"]}</th>
                                                            <th scope="col">{this.state.trans["channel"]}</th>
                                                            <th scope="col">{this.state.trans["status"]}</th>
                                                            <th scope="col">{this.state.trans["public"]}</th>
                                                            <th scope="col">{this.state.trans["created at"]}</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody >

                                                        {
                                                            this.state.reminders.map((item, i) => {
                                                                return (
                                                                    <tr key={i}>
                                                                        <td>{i + 1}</td>
                                                                        <td>{item.date_send_reminder}</td>
                                                                        <td>{item.channel_msg == "all" ? this.state.trans["email and sms"] : this.state.trans[item.channel_msg]}</td>
                                                                        <td>{this.state.trans[item.status]}</td>
                                                                        <td>{item.public == "0" ? this.state.trans["special users"] : this.state.trans["all users"]}</td>
                                                                        <td>{item.created_at}</td>
                                                                    </tr>
                                                                )
                                                            })
                                                        }

                                                    </tbody>
                                                </table>

                                            ) : (
                                                <span>{this.state.trans["not found reminders"]}</span>
                                            )
                                            }

                                        </div>

                                    )}

                                </div>

                            </div>

                        </div>
                    </div>
                    <div className="row">
                        <div className="col-12">
                            <div className="card">
                                <div className="card-header">
                                    <div className="d-flex flex-row" style={{ alignItems: "center", width: "100%", justifyContent: "space-between" }} >

                                        <div className="p-2">
                                            <div className="form-check">

                                                <h6>{this.state.trans["Abandoned baskets"]}</h6>
                                            </div>
                                        </div>

                                        <div className="p-2">
                                            <button onClick={() => {

                                                if (this.state.ChooseUserArr.length != 0) {
                                                    this.setState({
                                                        showReminder: true
                                                    })
                                                } else {
                                                    swal({
                                                        title: this.state.trans["error msg"],
                                                        text: this.state.trans["please choose users"],
                                                        icon: "error",
                                                        button: this.state.trans["ok"],
                                                    });
                                                }

                                            }} className="btn btn-primary ">
                                                <i className="las la-clock"></i>
                                                {this.state.trans["active temporary discount"]}
                                            </button>
                                        </div>

                                    </div>


                                </div>
                                <div className="card-body table-responsive" >

                                    <table className="table" >
                                        <thead className="table-light">
                                            <tr>
                                                <th scope="col">
                                                    <input onChange={e => {
                                                        if (e.target.checked) {
                                                            this.state.carts.forEach(element => {
                                                                this.setState(prevState => ({
                                                                    ChooseUser: {                   // object that we want to update
                                                                        ...prevState.ChooseUser,    // keep all other key-value pairs
                                                                        [element.id]: true    // update the value of specific key
                                                                    }
                                                                }))
                                                            });

                                                            this.setState({
                                                                ChooseUserArr: this.state.carts
                                                            })
                                                        } else {
                                                            this.state.carts.forEach(element => {
                                                                this.setState(prevState => ({
                                                                    ChooseUser: {                   // object that we want to update
                                                                        ...prevState.ChooseUser,    // keep all other key-value pairs
                                                                        [element.id]: false    // update the value of specific key
                                                                    }
                                                                }))
                                                            });

                                                            this.setState({
                                                                ChooseUserArr: []
                                                            })
                                                        }
                                                    }} type="checkbox" id="flexCheckDefault" />

                                                </th>
                                                <th scope="col">{this.state.trans["user name"]}</th>
                                                <th scope="col">{this.state.trans["created at"]}</th>
                                                <th scope="col">{this.state.trans["number of products"]}</th>
                                                <th scope="col">{this.state.trans["calc baskets"]}</th>
                                                <th scope="col">{this.state.trans["complete order"]}</th>

                                            </tr>
                                        </thead>
                                        <tbody >

                                            {
                                                this.state.carts.map((item, i) => {
                                                    return (
                                                        <tr key={i}>
                                                            <td>
                                                                <input onChange={e => {
                                                                    if (e.target.checked) {
                                                                        this.setState(prevState => ({
                                                                            ChooseUser: {                   // object that we want to update
                                                                                ...prevState.ChooseUser,    // keep all other key-value pairs
                                                                                [item.id]: true    // update the value of specific key
                                                                            }
                                                                        }))
                                                                        this.handleAddDataUser(item)
                                                                    } else {
                                                                        this.setState(prevState => ({
                                                                            ChooseUser: {                   // object that we want to update
                                                                                ...prevState.ChooseUser,    // keep all other key-value pairs
                                                                                [item.id]: false    // update the value of specific key
                                                                            }
                                                                        }))
                                                                        this.handleremoveDataUser(item)
                                                                    }
                                                                }} type="checkbox" checked={this.state.ChooseUser[item.id] == null ? false : this.state.ChooseUser[item.id]} id="flexCheckDefault" />
                                                            </td>
                                                            <th scope="row">
                                                                <div className="d-flex flex-row" >

                                                                    <div className="p-2">
                                                                        <img src={Urls.public_url + "assets/img/customer_avatar.png"} style={{ width: 30, height: 30 }} />
                                                                    </div>
                                                                    <div className="p-2">
                                                                        <span><Link to={{
                                                                            pathname: Urls.static_url + `abandoned/baskets/profile`,
                                                                            state: {
                                                                                user_id: item.id
                                                                            }
                                                                        }}  >{item.name}</Link></span>

                                                                    </div>

                                                                </div>

                                                            </th>
                                                            <td>{item.created_at}</td>
                                                            <td>{item.quantity}</td>
                                                            <td ><span className="custom-price fw-700 text-primary ">{item.prices} </span></td>
                                                            <td><a href={Urls.static_url + `customer/login_complete_order/${encrypt((item.id).toString())}`} className="btn btn-primary">{this.state.trans["complete order"]}</a></td>
                                                        </tr>
                                                    )
                                                })
                                            }

                                        </tbody>
                                    </table>
                                    {this.state.loadData ? <LoadingInline /> : null}
                                </div>

                            </div>


                        </div>

                        <div>
                            <ReminderBasketModal saveData={this.saveData} ChooseUserArr={this.state.ChooseUserArr} show={this.state.showReminder} handleClose={this.handleCloseReminder} />
                        </div>

                        <div>
                            <ReminderBasketModalPublic saveData={this.saveDataReminderPublic} show={this.state.showReminderPublic} handleClose={this.handleCloseReminderPublic} />
                        </div>
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
