import React ,{useState,useRef,useEffect} from 'react'

export default function HeaderSearch({ trans, _handleSearch,loadingupdate, setfetchdatas,categories,brands }) {



        const [startDate, setStartDate] = useState(new Date(2020,12).toISOString().substring(0,10) )
    const [endtDate, setEndDate] = useState(new Date().toISOString().substring(0, 10))


    return (
        <div>

                          <div className="row">
                                <div className="col-12 col-md-4">
                                                <div className="form-group">
                                                        <label >{trans["Product Name"]} </label>
                                                        <div className="input-group">
                                                        <div className="input-group-prepend">
                                                        <span className="input-group-text" style={{background:"#fff"}}>
                                                        <i className="las la-tshirt"></i>
                                                            </span>
                                                    </div>
                                                    <input type="text" onChange={e => {
                                                        setfetchdatas(false)
                                                        _handleSearch(10, 0, {
                                                            type: "name",
                                                            value:e.target.value
                                                        })
                                                        loadingupdate()
                                                        }}  placeholder={trans["product name"]} className="form-control" />
                                                    </div>
                                                    </div>
                                </div>
                                  <div className="col-12 col-md-4">
                                        <div className="form-group">
                                                    <label >{trans["category name"]} </label>
                                                    <div className="input-group">
                                                    <div className="input-group-prepend">
                                                    <span className="input-group-text" style={{background:"#fff"}}>
                                                    <i className="las la-tags"></i>
                                                </span>
                                                </div>

                                                <select onChange={e=>{
                                                                setfetchdatas(false)
                                                                _handleSearch(10, 0, {
                                                                    type: "category_id",
                                                                    value:e.target.value
                                                                })
                                                                loadingupdate()
                                                    }} className="form-control">
                                                    <option  value="">{trans["please choose category"]}</option>
                                                            {
                                                    categories.map((item, i) => (
                                                            <option key={i} value={item.id}>{item.name}</option>
                                                                ))
                                                            }
                                                        </select>
                                                </div>
                                        </div>
                              </div>
                              <div className="col-12 col-md-4">
                                        <div className="form-group">
                                                    <label >{trans["Brands"]} </label>
                                                    <div className="input-group">
                                                    <div className="input-group-prepend">
                                                    <span className="input-group-text" style={{background:"#fff"}}>
                                                    <i className="las la-tags"></i>
                                                </span>
                                                </div>

                                                <select onChange={e=>{
                                                                setfetchdatas(false)
                                                                _handleSearch(10, 0, {
                                                                    type: "brand_id",
                                                                    value:e.target.value
                                                                })
                                                                loadingupdate()
                                                    }} className="form-control">
                                                    <option  value="">{trans["please choose brand"]}</option>
                                                            {
                                                    brands.map((item, i) => (
                                                            <option key={i} value={item.id}>{item.name}</option>
                                                                ))
                                                            }
                                                        </select>
                                                </div>
                                        </div>
                              </div>
                          </div>
                          <div className="row">
                                <div className="col-12 col-md-3">
                                   <div className="form-group">
                                            <label >{trans["Start Date"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-calendar"></i>
                                                </span>
                                           </div>
                                        <input className="form-control" type="date" value={startDate} onChange={e => {
                                                                                          setfetchdatas(false)
                                             setStartDate(e.target.value)

                                            _handleSearch(10, 0,  {
                                                type: "startDate",
                                                value:e.target.value
                                            })
                                            loadingupdate()
                                                    }} />
                                           </div>
                                        </div>

                                </div>
                                <div className="col-12 col-md-3">
                                   <div className="form-group">
                                            <label >{trans["End Date"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-calendar"></i>
                                                </span>
                                           </div>
                                        <input className="form-control" type="date" value={endtDate} onChange={e => {
                                             setfetchdatas(false)
                                             setEndDate(e.target.value)
                                            _handleSearch(10, 0, {
                                                type: "endDate",
                                                value:e.target.value
                                            })
                                            loadingupdate()
                                                    }} />
                                           </div>
                                        </div>
                               </div>
                         </div>

        </div>
    )
}
