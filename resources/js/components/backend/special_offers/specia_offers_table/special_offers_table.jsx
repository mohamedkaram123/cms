import axios from "axios";
import React, { Component, useEffect, useState } from "react";
import { useTable } from "react-table";
// import {COLUMNS }  from "./coulmns";
// import MockaData from "./MOCK_DATA.json";

// import Table from './filteringTable'

 import ColumnFilter from "./filters/coulmnFilter"
 import DateFilter from "./filters/dateFilter"
import Table from "./filteringTable";
import SelectColumnFilter from "./filters/filterStatus";
import NumberFilter from "./filters/numberFilter";
import FilterNumber from "./filters_query/filterNumber";
import FilterDate from "./filters_query/filterDate";
import FilterString from "./filters_query/filterString";
import FilterSelectDelieveryStatus from "./filters_query/filterSelectDelieveryStatus";
import LoadingTable from "./LoadingTable";
import { Urls } from "../../urls";
import FilterOfferType from "./filters/filterOfferType";
// import Skeleton from "react-loading-skeleton";
// import LoadingTable from "./LoadingTable";
// import LoadingInline from "./LoadingInline";

export default class SpecialOffersTable extends Component {


    constructor() {
        super()

        this.firstPaginate = false;
        this.pagination = -1;
        this.state = {
            isLoading: true,
            isLoadingInline:false,
            footerPaginate:false,
            paginateLoading:false,
            loadingOrdersCustomer:true,
            trans:{
             "Id":"",
             "Name":"",
             "Email":"",
             "Wallet Balance":"",
             "Payment Status":"",
             "Grand Total":"",
             "Code":"",
             "Created At":"",
             "All rows number":"",
             "Go to page":"",
             "Page":"",
             "to":"",
             "Desc":"",
             "Asc":"",
             "increase":"",
             "show":"",
             "Search":"",
             "All":"",
             "Pending":"",
             "Confirmed":"",
             "On Delivery":"",
             "Delivered":"",
             "Paid":"",
             "Un Paid":"",
             "Create New Order":"",
             "Toggle Paginate":"",
             "Close":"",
             "Save Changes":"",
             "Orders":"",
             "Delivery Status":"",
             "Order Id":"",
                "Total Price": "",
                "All products in Cart": "",
                "Products": "",
                "Categories": "",
             "Payments":"",
                "New Special Offer": "",
                "If you buy a number_var_x of product_var_x, you get a number_var_y of product_var_y": "",
                "If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price": "",
                "If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count": "",
                "If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price": "",
                "If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count": "",
                "Are you sure?": "",
                "Once deleted, you will not be able to recover this imaginary data!": "",
                "remove": "",
                "offer title": "",
                "offer type": "",
                "offer start date": "",
                "offer end date": "",
                "amount": "",
                "percent": "",
                "x_to_y": "",
             "not found any data":""
            },

            specialOffers:[],
            showModalOrder:false,
            customersOrders:[],
            total_price: 0,
            rows:[]
        }


    }

    componentDidMount() {
        this.callTrans(this.state.trans)

        this.CallSpecialOffers();



    }



    componentDidUpdate(){

        if(this.state.footerPaginate){

            window.onscroll = (ev)=>{
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {

                    this.scroll();
                }
            };
             }
    }


    scroll(){
        if(this.state.footerPaginate){
            this.pagination +=10;
            this.CallSpecialOffers();
        }
    }

    togglePginate = ()=>{
        if(this.state.footerPaginate){
            this.setState({
                footerPaginate:false,
            })
            this.firstPaginate = false;
            this.pagination =-1;
            this.CallSpecialOffers();
        }else{
            this.setState({
                footerPaginate:true
            })
            this.pagination =0;

            this.CallSpecialOffers();

        }

    }

    handleData = () => {
       this.pagination =0;

            this.CallSpecialOffers();

    }

    handleChange = (type,val,starDate = null,endDate = null)=>{


        this.setState({
            isLoadingInline:true

         })

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             value:val.target.value,
             type,
             starDate:starDate,
             endDate:endDate,
              "_token": csrf_token
          };
          axios.post("search_customers",data_post)
          .then(res=>{

            this.setState({
                customers:res.data.customers,
                isLoadingInline:false,

            })

          })
          .catch(err=>{

          })
    }
    onChangeValueName = (val)=>{
        this.setState({
            isLoadingInline:true

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
                trans: res.data,
                   isLoading:false,
            })
        })
        .catch(err=>{

        })
    }



    CallSpecialOffers(){

        axios.get("getSpecialOffers?paginate="+this.pagination)
        .then(res=>{

            let specialOffers  = [];

            if(this.state.footerPaginate){
                this.setState({
                    paginateLoading:true
                })
                if(!this.firstPaginate){
                    this.firstPaginate = true;

                    // this.orders = res.data.orders;
                    specialOffers = res.data.specialOffers

                }else{
                    specialOffers = this.state.specialOffers.concat(res.data.specialOffers)

                }

            }else{

                specialOffers  = res.data.specialOffers;

            }

            this.setState({
                specialOffers:specialOffers,
                 rows:specialOffers,
                paginateLoading:false

            })

        })
        .catch(err=>{

        })
    }



     filterrows(row) {

let str = row.offer_title

  return str.search("offer category1")
     }


    setGlobalFilter = (e) => {

        this.setState({
            globalFilter:e
        })

        this.setState({
            rows:this.filterItems(this.state.specialOffers,e)
        })

    }




/**
 * Filter array items based on search criteria (query)
 */
 filterItems(arr, query) {
  return arr.filter(function(el) {
      return el.offer_title.search(query) < 0?false:true
  })
}


    render() {


        if (this.state.isLoading) {
            return (

                <div>
                <LoadingTable />


                </div>

            )
        } else {


        const COLUMNS = [

                {
                    Header: this.state.trans["Id"],
                    Filter: NumberFilter,
                    accessor: "id",
                    FilterSql:FilterNumber

                },
                {
                    Header: this.state.trans["Offer Title"] ,
                    Filter: ColumnFilter,

                    accessor: 'offer_title',
                    FilterSql:FilterString

                },


                {
                    Header: this.state.trans["Offer Type"] ,
                    Filter: SelectColumnFilter,
                    filter: 'includes',
                    accessor: 'offer_type',
                    FilterSql:FilterOfferType

                },
                {
                    Header:this.state.trans["Created At"] ,
                    Filter: DateFilter,
                    filter: "dateBetween",

                    accessor: 'created_at',
                    FilterSql:FilterDate

                },

            ];


            return (
                <div>

            <Table
            paginateLoading={this.state.paginateLoading}
            togglePginate={this.togglePginate}
            footerPaginate={this.state.footerPaginate}
            globalFilter={this.state.globalFilter}
            setGlobalFilter={this.setGlobalFilter}
            trans={this.state.trans}
            columns={ COLUMNS }
            data={ this.state.rows }
CallSpecialOffers={this.handleData}

            />

                </div>
            )
        }
    }

}




