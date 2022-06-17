import axios from "axios";
import { Component } from "react";
import { Urls } from "../urls";
import TotalCustomer from "./boxes/total_customer";
import TotalOrders from "./boxes/total_orders";
import TotalCategories from "./boxes/total_categories";
import TotalBrands from "./boxes/total_brands";
import ProductChart from "./charts/products_charts";
import SellerChart from "./charts/sellers_charts";
import Number_of_Sales from "./charts/number_of_sales";
import Number_of_Stock_Products from "./charts/number_of_stock_products";
import Products from "./products/products";
import "react-datepicker/dist/react-datepicker.css";
import LoadingInline from "./LoadingInline";
import ErrorConnection from "../../errors/error_connect";

export default class Dashboard extends Component{

    constructor(){
        super();

        this.state = {
            isLoading: true,
            errorLoad:false,
            trans:{
                "Total": "",
                "Customer": "",
                "Orders": "",
                "Product category": "",
                "Product brand": "",
                "Products": "",
                "Sellers": "",
                "Category wise product sale": "",
                "Category wise product stock": "",
                "Top 12 Products": "",
                "All": "",
                "Number of sales products": "",
                "Number of stock products":""
            },
            products: [],
            status_date:"all",
                     start_date:new Date().setDate((new Date()).getDate()-120),
            end_date:new Date(),


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

    handleErrorLoad() {
          this.setState({
                errorLoad:true
            })
}

  convertDate(date_covert){
        let date = new Date(date_covert);
            date = date.getUTCFullYear() + '-' +
         ('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
         ('00' + date.getUTCDate()).slice(-2) + ' ' +
         ('00' + date.getUTCHours()).slice(-2) + ':' +
         ('00' + date.getUTCMinutes()).slice(-2) + ':' +
         ('00' + date.getUTCSeconds()).slice(-2);
         return date;
         }

    render() {
        if (!this.state.errorLoad) {
                  if(this.state.isLoading){
            return(
                <div style={{display:"flex",justifyContent:'center',alignItems:'center'}}>

                    <LoadingInline />

                </div>
            )
        }else{
            return(
                <div >


                    <div className="row">
                        <div className="col-12 col-md-6 ">
                            <div className="row">
                                <div className="col-12 col-md-6" style={{marginBlock:10}}>
                                      <TotalCustomer handleErrorLoad={this.handleErrorLoad} trans={this.state.trans} />
                                </div>
                                 <div className="col-12 col-md-6" style={{marginBlock:10}}>
                                      <TotalOrders handleErrorLoad={this.handleErrorLoad} trans={this.state.trans} />
                                </div>
                                 <div className="col-12 col-md-6" >
                                      <TotalCategories handleErrorLoad={this.handleErrorLoad} trans={this.state.trans} />
                                </div>
                                <div className="col-12 col-md-6" >
                                      <TotalBrands handleErrorLoad={this.handleErrorLoad} trans={this.state.trans} />
                                </div>

                            </div>
                        </div>
                          <div className="col-12 col-md-6">
                            <div className="row gutters-10">
                                <div className="col-12 col-md-12">
                                    <ProductChart handleErrorLoad={this.handleErrorLoad} trans={this.state.trans} />
                                </div>
                                <div className="col-12 col-md-6 d-none">
                                     <SellerChart trans={this.state.trans} />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="row">
                        <div className="col-12 col-md-6">
                            <Number_of_Sales handleErrorLoad={this.handleErrorLoad} start_date={this.convertDate(this.state.start_date)} end_date={this.convertDate(this.state.end_date)} status_date={this.state.status_date} trans={this.state.trans} />
                        </div>
                        <div className="col-12 col-md-6">
                            <Number_of_Stock_Products handleErrorLoad={this.handleErrorLoad} start_date={this.convertDate(this.state.start_date)} end_date={this.convertDate(this.state.end_date)} status_date={this.state.status_date} trans={this.state.trans} />
                        </div>

                    </div>

                        <Products handleErrorLoad={this.handleErrorLoad} start_date={this.convertDate(this.state.start_date)} end_date={this.convertDate(this.state.end_date)} status_date={this.state.status_date}  trans={this.state.trans} />

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
