import axios from 'axios';
import React, { useState } from 'react'
import Select from 'react-select';
import { Urls } from '../../urls';
// import Select from 'react-s
// import 'react-select-2/dist/css/react-select-2.css';

export default function HeaderModalCustomer({trans,countries,onChange,loadSearch}) {

    const [validateEmail, setValidateEmail] = useState(false)
    const [borderValidateEmail, setBorderValidateEmail] = useState({
        border:"1px solid red"

    })
    const [cities, setCities] = useState([])
    const [dataCustomer, setDataCustomer] = useState({
        name:"",
        phone:"",
        email:"",
        country_id:"",
        city_id:""
    })


     const getCities = (id)=>{
        axios.get(Urls.static_url+'all_cities?country_id='+id)
        .then(res=>{

            setCities(res.data.cities)

        })
        .catch(err=>{

        })
    }

    return (
        <div>
            <div className="container">

              <div className="row" style={{margin:10}}>
                  <div className="col-4">
                  <input onChange={e=>{
                     setDataCustomer((prevState) => ({
                        ...prevState,
                        name: e.target.value,
                      }));
                  }
                  }
                   placeholder={trans["Customer Name"]} className="form-control" type="text" />

                  </div>

                  <div className="col-4">
                  <input  onChange={e=>{
                     setDataCustomer((prevState) => ({
                        ...prevState,
                        phone: e.target.value,
                      }));

                  }
                  }
                 placeholder={trans["Customer Phone"]} className="form-control" type="number" />

                  </div>

                  <div className="col-4">
                  <input onChange={e=>{
                      if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(e.target.value) || e.target.value == "" )
                      {
                        setValidateEmail(false)
                        setDataCustomer((prevState) => ({
                            ...prevState,
                            email: e.target.value,
                          }));

                      }else{
                        setValidateEmail(true)
                        setDataCustomer((prevState) => ({
                            ...prevState,
                            email: "",
                          }));

                    }



                  }}
                  placeholder={trans["Customer Email"]} style={validateEmail?borderValidateEmail:null} className="form-control" type="email" />
                  <span style={{fontSize:10,color:"red"}}>{validateEmail?trans["* Please, the field only accepts email"]:""}</span>

                  </div>
              </div>
              <div className="row" style={{margin:10}}>
                 <div className="col-4">
                 <Select
                           maxMenuHeight={200}
                           menuPosition={'fixed'}
                 placeholder={trans["Country"]} onChange={e=>{
                    getCities(e.value)
                    setDataCustomer((prevState) => ({
                        ...prevState,
                        country_id: e.value,
                      }));

                }}
               options={countries}/>

                 </div>
                 <div className="col-4">
                 <Select
                           maxMenuHeight={200}
                           menuPosition={'fixed'}
                 onChange={e=>{
                              setDataCustomer((prevState) => ({
                                ...prevState,
                                city_id: e.value,
                              }));

                 }}
                placeholder={trans["City"]} options={cities}/>

                 </div>
              </div>
              <div className="row" style={{margin:10}}>

                <div className="col-2 offset-10">
                <button style={{display:'flex'}} onClick={()=>{

                    onChange(dataCustomer)

                    }} className="btn btn-primary">{trans["Search"]}{loadSearch?<img style={{marginInline:10}} src={Urls.public_url +  "assets/img/loading.gif"} width={15} height={15} />:null  }</button>

                </div>

                </div>

          </div>
        </div>
    )
}
