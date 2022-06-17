import axios from 'axios';
import React, { Component } from 'react'
import { decryptLocalStorage, encryptLocalStorage } from '../../../hashes';
import { Urls } from '../../../urls';
import LoadingInline from '../../LoadingInline';
import CustomerSales from './charts/customer_sales';
import ReviewCustomers from './charts/review_customers';

export default class CustomerReport extends Component {

    constructor(props){
        super(props);
        this.state = {
            isLoading:true,
            start_date:"",
            end_date:"",
            reviews: [],
            customers_sales: 0,
           customers_not_sales:0,
            trans:{
                "Customers":"",
                "Customer Numbers Activies":"",
                "Customer Numbers Not Activies":"",
                "Customer Orders":"",
                "Customer Purchases": "",
                "customer purches": "",
                "customer not purches": "",
                "highest paying customers": "",
                "Customer Sales": "",
                "Customer Review":""


            }
        }
    }

    componentDidMount() {


    this.callDataProducts(this.props.start_date,this.props.end_date);
        this.callTrans(this.state.trans)
        this.loadLocalStorage();

}

    loadLocalStorage = () => {
               if (decryptLocalStorage("report_customers") !== null) {

                                 let data = decryptLocalStorage("report_customers");

                                  this.setState({
                                        reviews: data.reviews,
                                        customers_sales: data.customers_sales,
                                        customers_not_sales: data.customers_not_sales,
                                        customers_sales_price:data.customers_sales_price,
                                        isLoading:false
                                    })
                    }
    }

// UNSAFE_componentWillReceiveProps(){


//      this.callDataProducts(this.props.start_date,this.props.end_date);
// }

    componentDidUpdate(prevProps, prevState) {
  if (prevProps.start_date !== this.props.start_date) {
       this.callDataProducts(this.props.start_date,this.props.end_date);
  }

          if (prevProps.end_date !== this.props.end_date) {
       this.callDataProducts(this.props.start_date,this.props.end_date);
  }
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
                trans:res.data
            })
        })
        .catch(err=>{
            this.props.handleErrorLoad()

        })
    }

    callDataProducts(startDate,endDate){

        this.setState({
            isLoading:true
        })
        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+"main/report/customers",data)
        .then(res=>{


  encryptLocalStorage(res.data,"report_customers")
            this.setState({
                reviews: res.data.reviews,
                customers_sales: res.data.customers_sales,
                customers_not_sales: res.data.customers_not_sales,
                customers_sales_price:res.data.customers_sales_price,
                isLoading:false
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

                        <span>{this.state.trans["Customer Review"]}</span>

                    </div>
                    <div style={{direction:"ltr"}} className="card-body">

                                <ReviewCustomers data_char={this.state.reviews}  />

                    </div>
                </div>
            </div>

       <div className="col-md-6 col-12">
       <div className="card" style={{ boxShadow: "5px 5px 5px #eee" }} >

                    <div className="card-header" style={{ background: "#eee" }}>

                        <span>{this.state.trans["Customer Sales"]}</span>

                    </div>
                    <div style={{direction:"ltr"}} className="card-body">

                                <CustomerSales trans={this.state.trans} customers_sales={this.state.customers_sales} customers_not_sales={this.state.customers_not_sales}  />

                    </div>
                </div>
            </div>
       <div className="col-12">

       </div>



                    </div>

                    <div className="row">
                                  <div className="col-12">
                  <div className="card " style={{boxShadow: "5px 5px 5px #eee"}}>

            <div className="card-header" style={{background:"#eee", }}>

               <span>{this.state.trans["highest paying customers"]}</span>

            </div>
            <div className="card-body">

                    {
                        this.state.customers_sales_price.map((item, i) => (
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
                                    <a href="#">{ item.total_price}</a>
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
