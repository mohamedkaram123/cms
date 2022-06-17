import axios from 'axios';
import React, { Component } from 'react'
import { Urls } from '../../../urls';
import BranchesReport from './choses_branch_report/branches_report';


export default class ProductSales extends Component {

    constructor(props){
        super(props);
        this.state = {
            isLoading:true,
            start_date:"",
            end_date:"",
            products:[],
            trans:{
                "Products":"",
                "Number Products":"",
                "Quantity Products":"",
                "Taxes Amount":"",
                "Taxes Percent":"",
                "Unit Prices":"",
                "Purchase Prices": "",
                "Product": "",
                "Product Quantity": "",
                "Abandoned Baskets": "",
                "Customer Name": "",
                "Customer Phone": "",
                "Date Add In Baskets": "",
                "Basket Product Price": "",


            }
        }
    }

componentDidMount(){
    // this.callDataProducts(this.props.start_date,this.props.end_date);
    this.callTrans(this.state.trans)
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
                trans: res.data,
                            isLoading:false

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

        axios.post(Urls.static_url+"main/report/products",data)
        .then(res=>{


            // this.convert_price(res)

            this.setState({
                products:res.data.products
            })



        })
        .catch(err=>{
            this.props.handleErrorLoad()

        })
    }



    render(){


            return (
                <div >

                    <BranchesReport data_is_reached={this.props.data_is_reached}
                                     data_is_start_load={this.props.data_is_start_load}
                                      loadDataProduct={this.props.loadDataProduct}
                                      loadDataAbanfonedBaskets={this.props.loadDataAbanfonedBaskets}
                                      startDate={this.props.start_date}
                                      endDate={this.props.end_date}
                                      state={this.state}
                                      option={this.props.option} />


                </div>
            )



    }
   }
