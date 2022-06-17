import React, { useState } from 'react'
import Select from 'react-select';
import { Urls } from '../../urls';
import SketchExample from './SwitchColor';

export default function HeaderModalProduct({trans,loadSearch,categories,getDataProducts}) {

    const [dataProduct, setDataProduct] = useState({
        name:"",
        price:"",
        category_id:"",
        color:"",
        tags:""
    })
    const groupStyles = {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
      };
      const groupBadgeStyles = {
        backgroundColor: '#EBECF0',
        borderRadius: '2em',
        color: '#172B4D',
        display: 'inline-block',
        fontSize: 12,
        fontWeight: 'normal',
        lineHeight: '1',
        minWidth: 1,
        padding: '0.16666666666667em 0.5em',
        textAlign: 'center',
      };
    const formatGroupLabel = data => (
        <div style={groupStyles}>
          <span>{data.label}</span>
          <span style={groupBadgeStyles}>{data.options.length}</span>
        </div>
      );

      const handleChangeColor = (color)=>{
        setDataProduct((prevState) => ({
            ...prevState,
            color:color,
          }));
      }
    return (
        <div>
       <div>
            <div className="container">

              <div className="row" style={{margin:10}}>

              <div className="col-2">
                 <SketchExample   handleChangeColor={handleChangeColor}    />
                 </div>
                  <div className="col-4">
                  <input onChange={e=>{
                     setDataProduct((prevState) => ({
                        ...prevState,
                        name: e.target.value,
                      }));
                  }
                  }
                   placeholder={trans["Product Name"]} className="form-control" type="text" />

                  </div>

                  <div className="col-4">
                  <input  onChange={e=>{
                     setDataProduct((prevState) => ({
                        ...prevState,
                        price: e.target.value,
                      }));

                  }
                  }
                 placeholder={trans["Product Price"]} className="form-control" type="number" />

                  </div>


              </div>
              <div className="row" style={{margin:10}}>
                 <div className="col-4 offset-2">

                 <Select
                       maxMenuHeight={200}
                       menuPosition={'fixed'}
               placeholder={trans["Category"]} onChange={e=>{
                    setDataProduct((prevState) => ({
                        ...prevState,
                        category_id: e.value,
                      }));

                }}
               options={categories}/>

                 </div>
                 <div className="col-4">
                 <input onChange={e=>{
                     setDataProduct((prevState) => ({
                        ...prevState,
                        tags: e.target.value,
                      }));
                  }
                  }
                   placeholder={trans["Tags"]} className="form-control" type="text" />

                 </div>
              </div>
              <div className="row" style={{margin:10}}>

                <div className="col-2 offset-10">
                <button style={{display:'flex'}} onClick={()=>{
                  getDataProducts(dataProduct)
                }} className="btn btn-primary">{trans["Search"]}{loadSearch?<img style={{marginInline:10}} src={Urls.public_url +  "assets/img/loading.gif" } width={15} height={15} />:null  }</button>

                </div>

                </div>

          </div>
        </div>

        </div>
    )
}
