import axios from 'axios';
import Pusher from 'pusher-js';
import React, { Component } from 'react'
import { Urls } from '../../../urls';
import LoadingInline from '../../LoadingInline';

export default class SearchReport extends Component {

    constructor(props){
        super(props);
        this.static_url_cat = Urls.url + "category/";
                this.static_url_prod = Urls.url + "product/";

        this.state = {
            isLoading:true,
            start_date:"",
            end_date: "",
            products: [],
            categories:[],

            trans:{
                "Top 10 Most searched products":"",
                "Product Search times":"",
                "Categories Search times":"",
                "Top 10 Most searched Categories":"",
                "Products":"",
                "Categories": "",
                 "search words":""
             }
        }
    }

componentDidMount(){

    this.callTrans(this.state.trans)
    this.callDataSearches(this.props.start_date,this.props.end_date);



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
    convertDate(){
        let date = new Date();
            date = date.getUTCFullYear() + '-' +
         ('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
         ('00' + date.getUTCDate()).slice(-2) + ' ' +
         ('00' + date.getUTCHours()).slice(-2) + ':' +
         ('00' + date.getUTCMinutes()).slice(-2) + ':' +
         ('00' + date.getUTCSeconds()).slice(-2);
         return date;
         }
    callDataSearches(startDate,endDate,from = null){


        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.get(Urls.static_url+"main/report/searches")
        .then(res=>{



            this.setState({
                products: res.data.products,
                categories:res.data.categories,
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
            <div className="row">
                <div  className="col-md-6 col-12" style={{justifyContent:"space-around"}}>
                    <div className="card " >
                        <div className="card-header" style={{background:"#eee"}}>
                        <span>{this.state.trans["Top 10 Most searched products"]}</span>
                        </div>
                        <div className="card-body">
                                <div className="row" style={{marginBlock:10}}>
                                    <div className="col-4">
                                        <span style={{fontSize:14}}>{this.state.trans["Products"]}</span>
                                    </div>
                                    <div className="col-4">
                                        <span style={{fontSize:14}}>{this.state.trans["search words"]}</span>
                                    </div>
                                    <div className="col-4">
                                        <span style={{fontSize:14}}>{this.state.trans["Product Search times"]}</span>
                                    </div>
                                </div>

                                {
                                    this.state.products.map((item, i) => (
                                        <div className="row" key={i}>
                                            <div className="col-4">
                                                <div className="d-flex flex-row">
                                                    <div className="p-2">
                                                        <img src={ item.photo} style={{width:50,height:50}} />
                                                    </div>
                                                    <div className="p-2">
                                                                <a href={ this.static_url_prod +item.slug}>{ item.name}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-4 p-2">
                                                        <a href={this.static_url_prod + item.slug}>{ item.query}</a>
                                            </div>
                                            <div className="col-4 p-2">
                                                        <a href={this.static_url_prod + item.slug}>{ item.count}</a>
                                            </div>
                                        </div>
                                    ))
                                }
                        </div>
                    </div>
                </div>
                <div  className="col-md-6 col-12" style={{justifyContent:"space-around"}}>
                    <div className="card " >
                        <div className="card-header" style={{background:"#eee"}}>
                        <span>{this.state.trans["Top 10 Most searched Categories"]}</span>
                        </div>
                        <div className="card-body">
                                <div className="row" style={{marginBlock:10}}>
                                    <div className="col-4">
                                        <span style={{fontSize:14}}>{this.state.trans["Categories"]}</span>
                                    </div>
                                    <div className="col-4">
                                        <span style={{fontSize:14}}>{this.state.trans["search words"]}</span>
                                    </div>
                                    <div className="col-4">
                                        <span style={{fontSize:14}}>{this.state.trans["Categories Search times"]}</span>
                                    </div>
                                </div>

                                {
                                    this.state.categories.map((item, i) => (
                                        <div className="row" key={i}>
                                            <div className="col-4 ">
                                                <div className="d-flex flex-row">
                                                    <div className="p-2">
                                                        <img src={ item.icon} style={{width:50,height:50}} />
                                                    </div>
                                                    <div className="p-2">
                                                                <a href={this.static_url_cat+ item.slug}>{ item.name}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-4 p-2">
                                                        <a href={this.static_url_cat+ item.slug}>{ item.query}</a>
                                            </div>
                                            <div className="col-4 p-2">
                                                        <a href={this.static_url_cat+ item.slug}>{ item.count}</a>
                                            </div>
                                        </div>
                                    ))
                                }
                        </div>
                    </div>
                </div>
                {/* <div  className="col-md-6 col-12" style={{justifyContent:"space-around"}}>
                    <div className="card " >
                        <div className="card-header" style={{background:"#eee"}}>
                        <span>{this.state.trans["Most searched Shops"]}</span>
                        </div>
                        <div className="card-body">
                                <div className="row" style={{marginBlock:10}}>
                                    <div className="col-8">
                                        <span style={{fontSize:14}}>{state.trans["Top 10 Most searched Shops"]}</span>
                                    </div>
                                    <div className="col-4">
                                        <span style={{fontSize:14}}>{state.trans["Shops Search times"]}</span>
                                    </div>
                                </div>

                                {
                                    products.map((item, i) => (
                                        <div className="row" key={i}>
                                            <div className="col-8">
                                                <div className="d-flex flex-row">
                                                    <div className="p-2">
                                                        <img src={ item.icon} style={{width:50,height:50}} />
                                                    </div>
                                                    <div className="p-2">
                                                                <a href={item.slug}>{ item.name}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-4">
                                                        <a href={item.slug}>{ item.count}</a>
                                            </div>
                                        </div>
                                    ))
                                }
                        </div>
                    </div>
                </div> */}
            </div>
            )

        }

    }
   }
