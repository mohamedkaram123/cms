import axios from 'axios';
import Pusher from 'pusher-js';
import React, { Component } from 'react'
import { Urls } from '../../../urls';
import LoadingInline from '../../LoadingInline';

export default class VisitsReport extends Component {

    constructor(props){
        super(props);
        this.state = {
            isLoading:true,
            start_date:"",
            end_date:"",

        settings:{
            "PUSHER_APP_CLUSTER":"",
            "PUSHER_APP_SECRET":"",
            "PUSHER_APP_KEY":"",
            "PUSHER_APP_ID":""
        },

        visits:{
            admins_visits:0,
            guests_visits:0,
            customers_visits:0,
            sellers_visits:0
        },
            trans:{
                "Visitors":"",
                "Admins Visitors":"",
                "Sellers Visitors":"",
                "Customers Visitors":"",
                "Guests Visitors":"",

             }
        }
    }

componentDidMount(){
    this.get_setting_data(this.state.settings)

    this.callDataVisits(this.props.start_date,this.props.end_date);
    this.callTrans(this.state.trans)



}


// UNSAFE_componentWillReceiveProps(){


//      this.callDataVisits(this.props.start_date,this.props.end_date);
// }


 componentDidUpdate(prevProps, prevState) {
  if (prevProps.start_date !== this.props.start_date) {
       this.callDataVisits(this.props.start_date,this.props.end_date);
  }

          if (prevProps.end_date !== this.props.end_date) {
       this.callDataVisits(this.props.start_date,this.props.end_date);
          }
                        this.pusher_recieved();
}

// componentDidUpdate(){

//     this.pusher_recieved();
// }



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
    callDataVisits(startDate,endDate,from = null){

        if(from == null){
            this.setState({
                    isLoading:true
                })
        }

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
            from:startDate,
            to:endDate,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+"main/report/visits",data)
        .then(res=>{



            this.setState({
                visits:{
                    admins_visits:res.data.admins_visits,
                    guests_visits:res.data.guests_visits,
                    customers_visits:res.data.customers_visits,
                    sellers_visits:res.data.sellers_visits,

                },
                isLoading:false

            })

        })
        .catch(err=>{
            this.props.handleErrorLoad()

        })
    }



    pusher_recieved() {

        if(!this.state.isLoading){




            const pusher = new Pusher(this.state.settings["PUSHER_APP_KEY"], {
                cluster: this.state.settings["PUSHER_APP_CLUSTER"],
              });
              const channel = pusher.subscribe('VistorChannel');
              channel.bind('VistorEvent', ({data}) => {

                this.callDataVisits(this.props.start_date,this.convertDate(),"pusher");


               });

            }

    }


    get_setting_data(data){

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      let  data_post = {
            data,
            "_token": csrf_token
        }

        axios.post(Urls.static_url+'setting_data', data_post)
        .then(res=>{


            this.setState({
                settings:res.data
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
                <div  className="col-12" style={{justifyContent:"space-around"}}>

        <div className="card " >

            <div className="card-header" style={{background:"#eee"}}>

               <span>{this.state.trans["Visitors"]}</span>

            </div>
            <div className="card-body">
            <table className="table table-borderless " >

                    <tbody>
                        <tr style={{borderTop:"0"}}>
                        <th scope="row">{this.state.trans["Admins Visitors"]}</th>
                        <td>{this.state.visits.admins_visits}</td>
                        </tr>
                        <tr>
                        <th scope="row">{this.state.trans["Customers Visitors"]}</th>
                        <td>{this.state.visits.customers_visits}</td>
                        </tr>
                        <tr>
                        <th scope="row">{this.state.trans["Sellers Visitors"]}</th>
                        <td>{this.state.visits.sellers_visits}</td>
                        </tr>
                        <tr >
                        <th scope="row">{this.state.trans["Guests Visitors"]}</th>
                        <td>{this.state.visits.guests_visits}</td>
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
