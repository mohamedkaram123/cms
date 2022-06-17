import axios from 'axios';
import React, { Component } from 'react'
import { decryptLocalStorage, encryptLocalStorage } from '../../../hashes';
import { Urls } from '../../../urls';
import LoadingInline from '../../LoadingInline';
import DaysWeekOrders from './charts/days_of_week_orders';
import SliderChart from './charts/hours_orders';

export default class OrderReport extends Component {

    constructor(props){
        super(props);
        this.state = {
            isLoading:true,
            start_date:"",
            end_date:"",
            data_char: [],
            data_char_hours: [],
            users:[],
            trans:{
                "Orders":"",
                "Orders Status Deliver":"",
                "Orders Pending":"",
                "Orders Confirmed":"",
                "Orders On Delivery":"",
                "Orders Delivered":"",
                "Orders Payment Status":"",
                "Orders Paid":"",
                "Orders UnPaid":"",
                "Orders Paid Prices":"",
                "Orders UnPaid Prices": "",
                "Most Wanted Days": "",
                "Most Orders Customers":""
            }
        }
    }

componentDidMount(){
    this.callDataSales(this.props.start_date,this.props.end_date);
    this.callTrans(this.state.trans)
    this.loadLocalStorage()
}


    loadLocalStorage = () => {
               if (decryptLocalStorage("report_orders") !== null) {

                                 let data = decryptLocalStorage("report_orders");

                                  this.setState({
                                              data_char: data.dates,
                                                data_char_hours: data.dates_orders_hours,
                                                users:data.users,
                                        isLoading:false
                                    })
                    }
    }



    componentDidUpdate(prevProps, prevState) {
  if (prevProps.start_date !== this.props.start_date) {
       this.callDataSales(this.props.start_date,this.props.end_date);
  }

          if (prevProps.end_date !== this.props.end_date) {
       this.callDataSales(this.props.start_date,this.props.end_date);
  }
}

    callTrans(transes){

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url +"trans_data",data_post)
        .then(res=>{

            this.setState({
                trans:res.data
            })
        })
        .catch(err=>{
            this.props.handleErrorLoad()

        })
    }

    callDataSales(startDate,endDate){

        this.setState({
            isLoading:true
        })
        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url + "main/report/orders",data)
        .then(res=>{


            // this.convert_price(res)
  encryptLocalStorage(res.data,"report_orders")

            this.setState({
                data_char: res.data.dates,
                data_char_hours: res.data.dates_orders_hours,
                users:res.data.users,
                isLoading:false,

            })



        })
        .catch(err=>{
            this.props.handleErrorLoad()

        })
    }



    render(){

        if(this.state.isLoading){
            return(
                <div>
                    <LoadingInline />
                </div>
            )
        }else{
            return (
                <div>
                    <div className="row" style={{ justifyContent: "space-around" }}>


                        <div className="col-md-6 col-12">
                       <div className="card" style={{ boxShadow: "5px 5px 5px #eee" }} >

                                    <div className="card-header" style={{ background: "#eee" }}>

                                        <span>{this.state.trans["Most Wanted Days"]}</span>

                                    </div>
                                    <div style={{direction:"ltr"}} className="card-body">

                                                <SliderChart trans={this.state.trans} data_char_hours={this.state.data_char_hours}  />

                                    </div>
                                </div>
                            </div>


                        <div className="col-md-6 col-12">
                       <div className="card" style={{ boxShadow: "5px 5px 5px #eee" }} >

                                    <div className="card-header" style={{ background: "#eee" }}>

                                        <span>{this.state.trans["Most Wanted Days"]}</span>

                                    </div>
                                    <div style={{direction:"ltr"}} className="card-body">

                                                <DaysWeekOrders trans={this.state.trans} data_chart={this.state.data_char}  />

                                    </div>
                                </div>
                            </div>

                    </div>
 <div className="row">
                                  <div className="col-12">
                  <div className="card " style={{boxShadow: "5px 5px 5px #eee"}}>

            <div className="card-header" style={{background:"#eee", }}>

               <span>{this.state.trans["Most Orders Customers"]}</span>

            </div>
            <div className="card-body">

                    {
                        this.state.users.map((item, i) => (
                    <div className="row" key={i}>
                        <div className="col-8">
                            <div className="d-flex flex-row">
                                <div className="p-2">
                                       <img src={ Urls.public_url + "assets/img/customer_avatar.png"} style={{width:50,height:50}} />
                                </div>
                                <div className="p-2">
                                            <a href="#">{ item.name}</a>
                                </div>
                            </div>
                        </div>
                        <div className="col-4">
                                    <a href="#">{ item.orders_count}</a>
                        </div>
                    </div>
                        ))
                    }

            </div>
        </div>



              </div>



                    </div>

                 </div>
                )

        }

    }
   }
