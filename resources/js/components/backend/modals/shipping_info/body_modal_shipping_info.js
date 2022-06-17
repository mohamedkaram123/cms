import axios from 'axios'
import React, { useEffect, useRef, useState } from 'react'
import Select from 'react-select';

export default function BodyModalShippingInfo({trans,countries,getShippingData,objectGetData,objShippingInfo}) {
    const [dataShippingInfo, setDataShippingInfo] = useState(objShippingInfo != null?objShippingInfo:{
        address:"",
        postal_code:"",
        phone:"",
        country_id:"",
        country:"",
        city:"",
        city_id:""
    })
    const [cities, setCities] = useState([])
    const getCities = (id)=>{
        axios.get('/cart/admin/all_cities?country_id='+id)
        .then(res=>{

            setCities(res.data.cities)

        })
        .catch(err=>{

        })
    }
    const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic
        mounted.current = true;
      } else {

        getShippingData(dataShippingInfo)

        // do componentDidUpdate logic
      }
    }, [objectGetData]);
    return (
        <div >
          <div className="container">
                <div className="row" style={{margin:10}}>


                        <div className="col-3">
                            <label>{trans["Address"]}</label>
                        </div>
                        <div className="col-9">
                            <input type="text" value={dataShippingInfo.address} onChange={(e)=>{
                                  setDataShippingInfo((prevState) => ({
                                    ...prevState,
                                    address: e.target.value,
                                  }));
                            }} className="form-control" placeholder={trans["please,write your address*"]}  />
                        </div>


                </div>

                <div className="row" style={{margin:10}}>

                       <div className="col-3">
                           <label>{trans["Phone"]}</label>
                       </div>
                       <div className="col-9">
                           <input type="number" value={dataShippingInfo.phone} onChange={(e)=>{
                                 setDataShippingInfo((prevState) => ({
                                   ...prevState,
                                   phone: e.target.value,
                                 }));
                           }} className="form-control" placeholder={trans["please,write your phone number*"]}  />
                       </div>

               </div>

                <div className="row" style={{margin:10}}>

                       <div className="col-3">
                           <label>{trans["Postal Code"]}</label>
                       </div>
                       <div className="col-9">
                           <input type="number"  value={dataShippingInfo.postal_code} onChange={(e)=>{
                                 setDataShippingInfo((prevState) => ({
                                   ...prevState,
                                   postal_code: e.target.value,
                                 }));
                           }} className="form-control" placeholder={trans["please,write your postal code*"]}  />
                       </div>

               </div>
               <div className="row" style={{margin:10}}>

                       <div className="col-3">
                           <label>{trans["Country"]}</label>
                       </div>
                       <div className="col-9">
                       <Select placeholder={trans["Country*"]}
                      value={countries.filter(option => option.value == dataShippingInfo.country_id )}

                        maxMenuHeight={200}
                          menuPosition={'fixed'}

                       onChange={e=>{
                    getCities(e.value)
                    setDataShippingInfo((prevState) => ({
                        ...prevState,
                        country_id: e.value,
                        country:e.label

                      }));

                }}
               options={countries}/>
                       </div>

               </div>

               <div className="row" style={{margin:10}} >

                       <div className="col-3">
                           <label>{trans["City"]}</label>
                       </div>
                       <div className="col-9">
                       <Select
                            maxMenuHeight={200}
                            menuPosition={'fixed'}
                 onChange={e=>{
                    setDataShippingInfo((prevState) => ({
                                ...prevState,
                                city_id: e.value,
                                city:e.label
                              }));

                 }}
                placeholder={trans["City*"]} options={cities}/>
                       </div>

               </div>

            </div>
        </div>
    )
}
