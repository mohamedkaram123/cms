import axios from 'axios';
import React, { Component } from 'react'
import { Urls } from '../../../urls';

import BranchesReport from './choses_branch_report/branches_report';

export default class SalesReport extends Component {

    constructor(props){
        super(props);
        this.increment = 0;
        this.state = {
            isLoading:true,
            start_date:"",
            end_date: "",
            sales:[],
            prices:{
            sales:0,
            product_prices:0,
            taxes:0,
            shipping_cost:0,
            discount:0,
            sales_cash:0,
            sales_wallet:0,
            sales_elec_pay:0
            },
            percents:{
            sales:0,
            product_prices:0,
            taxes:0,
            shipping_cost:0,
            discount:0,
            sales_cash:0,
            sales_wallet:0,
            sales_elec_pay:0
            },
            data_avg_carts: [],
            avgPrice:0,
            option:"summary",

            trans:{
                "Sales":"",
                "Product Prices":"",
                "Taxes":"",
                "Discounts":"",
                "Shipping Cost":"",
                "Sales Cash After Delivery":"",
                "Sales By Wallet":"",
                "Sales By Elec Pay":"",
                "Payment Sales": "",
                "Max Price": "",
                "Min Price": "",
                "AVG Bascktes": "",
                "Product price": "",
                "Sales Products": "",
                "Number Product Sales": "",
                "Product Sales Total Prices": "",
                "Products": "",
                "Product": "",
                "Product Quantity": "",
                "Sales Coupons": "",
                "Total Coupons Discount Amount": "",
                "Total Coupons Discount Percent": "",
                "Total Coupons Usages": "",
                "Coupons Number Usage": "",
                "Number Order Sales": "",
                "order":""

            }
        }
    }

    componentDidMount() {
        this.setState({
        option:this.props.option
    })
    // this.callDataSales(this.props.start_date, this.props.end_date);

    this.callTrans(this.state.trans)

}



            componentDidUpdate(prevProps, prevState) {
                if (prevProps.start_date !== this.props.start_date) {
              this.increment = 0;

                        //   this.callDataSales(this.props.start_date, this.props.end_date);

  }

                if (prevProps.end_date !== this.props.end_date) {
                      this.increment = 0;

            //   this.callDataSales(this.props.start_date, this.props.end_date);


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
            .catch(err => {
            this.props.handleErrorLoad()
        })
    }



    render() {


            return (
                <div>
                    <BranchesReport
                        data_is_reached={this.props.data_is_reached}
                        data_is_start_load={this.props.data_is_start_load}
                        loadDataSales={this.props.loadDataSales}
                        loadDataSalesProduct={this.props.loadDataSalesProduct}
                        loadDataSalesBrands={this.props.loadDataSalesBrands}
                        loadDataSalesCategories={this.props.loadDataSalesCategories}
                        loadDataSalesCoupons={this.props.loadDataSalesCoupons}
                        startDate={this.props.start_date}
                        endDate={this.props.end_date}
                        state={this.state}
                        option={this.props.option} />
               </div>
                )
           }
   }
