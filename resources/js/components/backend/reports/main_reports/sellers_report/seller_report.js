import axios from 'axios';
import { ajax } from 'jquery';
import React, { Component } from 'react'
import { Urls } from '../../../urls';
import LoadingInline from '../../LoadingInline';

export default class SellerReport extends Component {

    constructor(props){
        super(props);
        this.state = {
            isLoading:true,
            start_date:"",
            end_date:"",
            sellers:{
                sellers_active:0,
                sellers_not_active:0,
                sellers_orders:0
                  },
            seller_price:{
                seller_prices:0,


            },
            trans:{
                "Sellers":"",
                "Seller Numbers Activies":"",
                "Seller Numbers Not Activies":"",
                "Seller Orders":"",
                "Seller Purchases":"",


            }
        }
    }

componentDidMount(){
    this.callDataProducts(this.props.start_date,this.props.end_date);
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
convert_price(prices){


    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let  data_post = {
        prices,
          "_token": csrf_token
      }
        axios.post(Urls.static_url+"convert_price",data_post)
        .then(res=>{

            this.setState({
                seller_price: res.data,
                isLoading:false

            })
        })
        .catch(err=>{

        })

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

        axios.post(Urls.static_url+"main/report/sellers",data)
        .then(res=>{



            this.setState({
                sellers:{
                    sellers_active:res.data.sellers_active,
                    sellers_orders:res.data.sellers_orders,
                    sellers_not_active:res.data.sellers_not_active,
                },
                seller_price: {                   // object that we want to update
                    seller_prices:res.data.seller_prices ,


                },
            })
            this.convert_price(this.state.seller_price)



        })
        .catch(err=>{

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
                <div  className="d-flex" style={{justifyContent:"space-around"}}>

        <div className="card " style={{width:'30%'}}>

            <div className="card-header" style={{background:"#eee"}}>

               <span>{this.state.trans["Sellers"]}</span>

            </div>
            <div className="card-body">
            <table className="table table-borderless " >

                    <tbody>
                        <tr style={{borderTop:"0"}}>
                        <th scope="row">{this.state.trans["Seller Numbers Activies"]}</th>
                        <td>{this.state.sellers.sellers_active}</td>
                        </tr>
                        <tr>
                        <th scope="row">{this.state.trans["Seller Numbers Not Activies"]}</th>
                        <td>{this.state.sellers.sellers_not_active}</td>
                        </tr>
                        <tr>
                        <th scope="row">{this.state.trans["Seller Orders"]}</th>
                        <td>{this.state.sellers.sellers_orders}</td>
                        </tr>
                        <tr >
                        <th scope="row">{this.state.trans["Seller Purchases"]}</th>
                        <td>{this.state.seller_price.seller_prices}</td>
                        </tr>

                    </tbody>
                    </table>
            </div>
        </div>

                </div>
            )

        }

    }
   }
