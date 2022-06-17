import React,{useState} from 'react'
import { Collapse,Card,Button } from 'react-bootstrap';

export default function Attribute({attr,check_attr}) {
      const [open, setOpen] = useState(false);

  return (
     <li className="list-group-item" >
                        <div style={ {cursor:"pointer"}}
                                                className="fs-15 attr_collaspe p-3 fw-600 border-bottom "
                            onClick={() => setOpen(!open)}
                            aria-controls="open-collapse-text"
                            aria-expanded={open}
                        >

                            {attr.name}
                              <i style={{marginInline:10}} className="las la-angle-down "></i>
                        </div>
                        <Collapse in={open} >
                            <div id="example-collapse-text"  >
                                <div style={{ marginInlineStart: 20 }} className="form-check d-flex flex-column mt-4">
                                    {
                                        attr.values.map((item, i) => {
                                            return (
                                                <label key={i} className=" mt-4">
                                                    <input onChange={()=>{check_attr(`attribute_${attr.id}`,item)}} className='form-check-input checked-data-search' type="checkbox" value="" />
                                                    <span style={{ fontSize: 14, marginInline: 10 ,wordWrap:"break-word"}}>{ item}</span>
                                                </label>
                                            )
                                        })
                                    }

                                </div>

                            </div>
                        </Collapse>
                        </li>
  )
}
