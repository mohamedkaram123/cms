import React,{useState,useRef,useEffect} from 'react';
import LoadingInline from '../../../helpers/LoadingInline';
import axios from 'axios';
import { Urls } from '../../backend/urls';



export default function List() {

            const [trans, settrans] = useState({

            })

       const mounted = useRef(false);
            useEffect(() => {
            if (!mounted.current) {


            callTrans(trans)
            mounted.current = true;
            } else {


            }
            }, []);

            const [isLoading, setisLoading] = useState(true)

            const  callTrans = (transes)=>{
                let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                  let data_post = {
                 data: transes,
                '_token': csrf_token
                         }

                 axios.post(Urls.static_url + 'trans_data', data_post)
                 .then(res => {
                   settrans(res.data)
                   setisLoading(false)
                  })
                  .catch(err => {
                   })
            }



        if (isLoading) {

             return <LoadingInline />

         } else {

          return (
                   <div>

                   </div>
             )
        }


       }
