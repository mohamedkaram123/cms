import axios from "axios";
import React, { useState,useEffect,useRef } from "react";

import ReactNotification ,{store} from 'react-notifications-component';
import 'react-notifications-component/dist/theme.css'
import 'animate.css';
import customNotification from "./customNotification";
import Pusher from "pusher-js"
import { Urls } from "../urls";

export default function Notify({user_id}) {

var isLoadData = 0
    const [isLoading, setisLoading] = useState(true)
    const [orders, setorders] = useState("ASC")
    const [setting, setsetting] = useState({
                "PUSHER_APP_CLUSTER":"",
                "PUSHER_APP_SECRET":"",
                "PUSHER_APP_KEY":"",
                "PUSHER_APP_ID":""

            })
    const [trans, settrans] = useState({
             "Add New Product var In baskets":"",
             "the Customer var_user Add New Product In Baskets a Price var_price":""
    })
    const [check_data, setcheck_data] = useState(false)

    const addNotify = (data)=>{

        store.addNotification({

            content:customNotification(data),
            type:"success",
            container:"bottom-right",
            insert:"top",
            animationIn:["animated","fadeIn"],
            animationOut: ["animated", "fadeout"],
              dismiss: {
    duration: 5000,
  },

            // onRemoval:()=>{
            //     location.href = "www.google.com"
            // },

            width:450

        });

    }

    const mounted = useRef(false)
    useEffect(() => {

        if (!mounted.current) {
                    //         get_setting_data(setting)

                    // callTrans(trans)



            mounted.current = true;
        } else {


        }

    }, [])




 const callTrans = (transes)=>{

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{


            settrans(res.data);
            isLoadData += 1;
            if (isLoadData == 2) {
                            setisLoading(false)

            }

        })
        .catch(err=>{

        })
 }

 const get_setting_data = (data)=>{

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      let  data_post = {
            data,
            "_token": csrf_token
        }
        let isLoading =true;


        axios.post(Urls.static_url+'setting_data', data_post)
        .then(res=>{



            setsetting(res.data);
            isLoadData += 1;
            if (isLoadData == 2) {
                            setisLoading(false)

            }


        })
        .catch(err=>{

        })

    }



    if (!isLoading) {



        const pusher = new Pusher(setting["PUSHER_APP_KEY"], {
            cluster: setting["PUSHER_APP_CLUSTER"],
        });
        const channel = pusher.subscribe('CartChannel.' + user_id);
        channel.bind('CartEvent', ({ data }) => {



            var title_trans = trans["Add New Product var In baskets"];
            var title = title_trans.replace("var", data.product_name);


            var body_trans = trans["the Customer var_user Add New Product In Baskets a Price var_price"];
            var body = body_trans.replace("var_user", data.user_name);
            var body = body.replace("var_price", data.price);


            let data_notify = {
                title,
                body,
                src: Urls.public_url + "assets/img/avatar-place.png"

            }

            // channel.unsubscribe()

            addNotify(data_notify);

        });
    }


        if(!isLoading){


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




