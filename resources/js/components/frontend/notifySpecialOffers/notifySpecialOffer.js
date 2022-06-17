import axios from "axios";
import React, { Component } from "react";

import ReactNotification ,{store} from 'react-notifications-component';
import 'react-notifications-component/dist/theme.css'
import 'animate.css';
import customNotification from "./customNotification";
import Pusher from "pusher-js"
import { Urls } from "../../backend/urls";

export default class NotifySpecialOffers extends Component {


    constructor(props) {
        super(props)

        this.num = 0;
        this.state = {
            isLoading: true,
            carts: [],
            user_id:props.user_id,
            // coulmns: COLUMNS,
            numberPaginate:0,
            orders:"ASC",
            setting:{
                "PUSHER_APP_CLUSTER":"",
                "PUSHER_APP_SECRET":"",
                "PUSHER_APP_KEY":"",
                "PUSHER_APP_ID":""

            },
            trans:{
             "All products in Cart":"",
            "If you buy a number_var_x of product_var_x, you get a number_var_y of product_var_y": "",
                "If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price offer code var_code": "",
                "If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count offer code var_code": "",
                "If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price offer code var_code": "",
                "If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count offer code var_code": ""
            },
            check_data:false

        }


    }


     addNotify = (data)=>{

        store.addNotification({

            content:customNotification(data),
            type:"success",
            container:document.documentElement.dir == "rtl"? "bottom-right":"bottom-left",
            insert:"top",
            animationIn:["animated","fadeIn"],
            animationOut: ["animated", "fadeout"],
            dismiss: {
                duration: 5000,
                onScreen:false
            },

            // onRemoval:()=>{
            //     location.href = "www.google.com"
            // },


            width:450

        });

    }
    componentDidMount() {





        this.callTrans(this.state.trans)
                    this.special_offer_cart()

        setInterval(() => {
                    this.special_offer_cart()

        }, 600000  );
                // this.get_setting_data(this.state.setting)


    }


// componentDidUpdate(){
//     this.pusher_recieved();


// }


    special_offer_cart() {
        let data = {
            title: "",
            body: ""
        }
        axios.get(Urls.url + "special_offer_cart")
            .then(res => {
                // console.log({res:res.data});

                if (res.data.coupon_usage == 0) {
                         if (res.data.special_offer_cart.length != 0) {

                    if (res.data.special_offer_cart.type_discount == "percent" && res.data.special_offer_cart.min_type == "quantity") {

                        var title_trans = this.state.trans["If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count offer code var_code"];
            var title = title_trans.replace("var_type","All products in Cart" );
              var title1 =  title.replace("var_discount_perceent",res.data.special_offer_cart.discount );
         var title2 =  title1.replace("var_max_price_discount",res.data.special_offer_cart.maximum_discount  );
                var title3 =  title2.replace("var_count",res.data.special_offer_cart.min_qty  );
             var title4 =  title3.replace("var_code",res.data.special_offer_cart.code  );
         //   setContentSpecialOffer(title3)

        }else if (res.data.special_offer_cart.type_discount == "amount" && res.data.special_offer_cart.min_type == "quantity") {

         var title_trans = this.state.trans["If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count offer code var_code"];
            var title = title_trans.replace("var_type","All products in Cart" );
              var title1 =  title.replace("var_discount",res.data.special_offer_cart.discount );
         var title3 =  title1.replace("var_count",res.data.special_offer_cart.min_qty  );
             var title4 =  title3.replace("var_code",res.data.special_offer_cart.code  );

            //setContentSpecialOffer(title2)

        }else if (res.data.special_offer_cart.type_discount == "percent" && res.data.special_offer_cart.min_type == "price") {
                    var title_trans = this.state.trans["If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price offer code var_code"];
            var title = title_trans.replace("var_type","All products in Cart" );
              var title1 =  title.replace("var_discount_perceent",res.data.special_offer_cart.discount );
         var title2 =  title1.replace("var_max_price_discount",res.data.special_offer_cart.maximum_discount  );
                var title3 =  title2.replace("var_price",res.data.special_offer_cart.min_price  );
             var title4 =  title3.replace("var_code",res.data.special_offer_cart.code  );

            //setContentSpecialOffer(title3)
        }else if (res.data.special_offer_cart.type_discount == "amount" && res.data.special_offer_cart.min_type == "price") {


         var title_trans = this.state.trans["If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price offer code var_code"];
            var title = title_trans.replace("var_type","All products in Cart");
              var title1 =  title.replace("var_discount",res.data.special_offer_cart.discount );
         var title3 =  title1.replace("var_price",res.data.special_offer_cart.min_price  );
             var title4 =  title3.replace("var_code",res.data.special_offer_cart.code  );

            //setContentSpecialOffer(title2)

        }


                data.title = this.state.trans["offer cart"];
                data.body = title4;
                this.addNotify(data)
                }
                }


            })
            .catch(err => {
                console.log({err});

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
                trans:res.data,
                isLoading:false
            })
        })
        .catch(err=>{

        })
 }

 get_setting_data = (data)=>{

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      let  data_post = {
            data,
            "_token": csrf_token
        }
        let isLoading =true;


        axios.post(Urls.static_url+'setting_data', data_post)
        .then(res=>{




            this.setState({
                settings:res.data,
                isLoading:false

            })

        })
        .catch(err=>{

        })

    }


    // pusher_recieved() {

    //     if(!this.state.isLoading){



    //         const pusher = new Pusher(this.state.setting["PUSHER_APP_KEY"], {
    //             cluster: this.state.setting["PUSHER_APP_CLUSTER"],
    //           });
    //           const channel = pusher.subscribe('CartChannel.' + this.state.user_id);
    //           channel.bind('CartEvent', ({data}) => {



    //     var title_trans = this.state.trans["Add New Product var In baskets"];
    //     var title = title_trans.replace("var", data.product_name);


    //     var body_trans = this.state.trans["the Customer var_user Add New Product In Baskets a Price var_price Inclusive of Tax and Shipping"];
    //     var body = body_trans.replace("var_user", data.user_name);
    //     var body = body.replace("var_price", data.price);


    //    let data_notify = {
    //         title,
    //         body,
    //         src:Urls.public_url + "assets/img/avatar-place.png"

    //     }


    //             this.addNotify(data_notify);

    //            });

    //         }

    // }


    render() {


        // if (this.state.isLoading) {
        //     return (

        //         <div className="card">
        //         <div className="card-header">

        //         </div>
        //         <div className="row h-100 justify-content-center align-items-center card-body">
        //         <img src="/cart/public/assets/img/loading.gif"  width="50" height="50" />

        //         </div>
        //         </div>
        //     )
        // } else {



        if(!this.state.isLoading){



            return (

                <div>
                   <ReactNotification />
                </div>

                )
        }else{
            return(
                <div>

                </div>
            )
        }


    }

}




