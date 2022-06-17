import axios from "axios";
import Pusher from "pusher-js";
import { useState,useRef,useEffect } from "react";
import { Urls } from "../urls";
import swal from "sweetalert";
import LoadingInline from "../../../helpers/LoadingInline";

export default function NotificationsItems({user_id}) {


    const [isLoading, setisLoading] = useState(true)
    const [notifications, setnotifications] = useState([])
    const [trnasNotifies, settrnasNotifies] = useState({})
    const [settings, setsettings] = useState({
            "PUSHER_APP_CLUSTER":"",
            "PUSHER_APP_SECRET":"",
            "PUSHER_APP_KEY":"",
            "PUSHER_APP_ID":""
    })

const [trans, settrans] = useState({
    "you want to play notify sound ?": "",
    "Notify": "",
    "Clear All Notifications": "",
    "the Customer var_user Add New Product In Baskets a Price var_price": "",
    "Add New Product var In baskets": "",
    "cancel": "",
    "approval":""
    })


 const callTrans = (transes)=>{

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{


            settrans(res.data);


        })
        .catch(err=>{

        })
 }
    const mounted = useRef(false)
    useEffect(() => {

        if (!mounted.current) {
            callTrans(trans)
    get_setting_data(settings)

    get_notification();


            mounted.current = true;
        } else {




        }

    }, [])



    if (!isLoading) {
                const pusher = new Pusher(settings["PUSHER_APP_KEY"], {
            cluster: settings["PUSHER_APP_CLUSTER"],
          });
            const channel = pusher.subscribe('CartChannel.' + user_id);
    channel.bind('CartNotificationEvent', ({ data }) => {

                  var counter = $("#notify_counter").text();
                  $("#notify_counter").text(parseInt(counter) + 1)

        lang([data])
        // var audio = new Audio('../../../public/audio/notify1.wav');
        // audio.play();

        var audio = new Audio();
        audio.src = Urls.public_url +'audio/notify1.wav';
        // audio.play();
// when the sound has been loaded, execute your code
audio.oncanplaythrough = (event) => {
    var playedPromise = audio.play();
    if (playedPromise) {
        playedPromise.catch((e) => {
             if (e.name === 'NotAllowedError' || e.name === 'NotSupportedError') {
                  swal({
                      title: trans["Notify"],
                      text:trans["you want to play notify sound ?"],
                      buttons:[trans["cancel"], trans["approval"]],
                      icon: Urls.public_url +"assets/img/notify.png",


                }).then(btnPress => {
                    var allowed = btnPress;
})
              }
         }).then((allowed) => {
         });
     }
}
channel.unsubscribe()

           });



    }





const get_setting_data = (data)=>{

    let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  let  data_post = {
        data,
        "_token": csrf_token
    }

    axios.post(Urls.static_url+'setting_data', data_post)
    .then(res=>{


        setsettings(res.data)


    })
    .catch(err=>{

    })

}

const get_notification = ()=>{
    axios.get(Urls.static_url+"get_notification")
    .then(res=>{


        let notifies = {};

        setnotifications(res.data.notifications)

        setisLoading(false)



    })
    .catch(err=>{
    })
}


const lang = (items)=>{


    let lang = "";


items.map(item=>{
    let _data = JSON.parse(item.data);
   let i = 0;

  let data = {
       [item.title]:"",
       [item.body]:""

   }
   let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        axios.post(Urls.static_url+'trans_data', {data:data,"_token": csrf_token})

            .then((response) => {

                            var title_trans = trans["Add New Product var In baskets"];
            var title = title_trans.replace("var", _data.product_name);


            var body_trans = trans["the Customer var_user Add New Product In Baskets a Price var_price"];
            var body = body_trans.replace("var_user", _data.user_name);
            var body = body.replace("var_price", _data.price);

          item.title = title
          item.body = body
          item.data = _data


            let all_notifications = [item, ...notifications];
            setnotifications(all_notifications)


          if(items.length == notifications.length){
                      setisLoading(false)

          }
        })

        .catch(function (error) {
        // handle error
        });



})



}


  const  onClickNotify = (notify) => {
   let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data = {
        notify,
             "_token": csrf_token
        }
        axios.post(Urls.static_url + "delete_notify", data)
            .then(res => {
                        location.href = Urls.static_url + "main/report";

            })
            .catch(err => {
        })
  }

    const clearAll = (e) => {
          e.stopPropagation();

    //$(this).siblings().toggleClass('show');
        setisLoading(true)
        axios.get(Urls.static_url + "delete/all/notify")
            .then(res => {
                get_notification()
                                          $("#notify_counter").text(0)

            })
            .catch(err => {
        })
    }



    if(isLoading){
        return(
            <div>
                 <li className="list-group-item">
                     <div  className="text-reset">
                            <LoadingInline />
                     </div>
                 </li>
            </div>
     )
    }else{

        return(
            <div>
                <ul className="list-group " >
                    <div className="c-scrollbar-light overflow-auto" style={{ maxHeight: 400 }}>
        {notifications.map(notify=>(
     <div onClick={onClickNotify.bind(this,notify)}  key={Math.random()}  >

   <div
  className="row notify_hover" style={{margin:10,padding:10}}>
       <div className="col-2" >
       <img src={Urls.url + notify.data.src} style={{width:80,height:80,borderRadius:50,marginBottom:10}} />

       </div>

       <div className="col-10">
           <div className="col-12">
           <p style={{fontSize:14,fontWeight:"bold"}}>{notify.title}</p>

           </div>
           <div className="col-12">
           <p style={{fontSize:12}}>{notify.body}</p>

           </div>

       </div>

   </div>


   </div>

        ))}
                    </div>

                    <button onClick={clearAll} className="dropdown-item text-center" >{trans["Clear All Notifications"]}</button>

                </ul>


            </div>


        )




}

}




