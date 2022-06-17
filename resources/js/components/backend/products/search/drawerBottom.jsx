import React, { useEffect, useRef, useState } from 'react';
import clsx from 'clsx';
import { makeStyles } from '@material-ui/core/styles';
import Drawer from '@material-ui/core/Drawer';
import Button from '@material-ui/core/Button';
import { Urls } from '../../urls';

const useStyles = makeStyles({
  list: {
    width: 250,
  },
  fullList: {
    width: 'auto',
  },
});

export default function TemporaryDrawer({trans,fetchAPIData,endDataResponse,endData,handleDataDrawer,categories,brands}) {
  const classes = useStyles();
    const [toggleDrawerBottom, setToggleDrawerBottom] = useState(false);
    const [startDate, setStartDate] = useState(new Date(2020,12).toISOString().substring(0,10) )
    const [endtDate, setEndDate] = useState(new Date().toISOString().substring(0,10))


    const [DataSearchproductsTable, setDataSearchProductsTable] = useState({
        startDate: startDate,
        endDate: endtDate,
        name: "",
        category_id: "",
        brand_id:""


  });
  const [loadingBtn, setloadingBtn] = useState(false);

    const toggleDrawer = () => (event) => {

        if (toggleDrawerBottom == true) {
  setToggleDrawerBottom(false)

        } else {
              setToggleDrawerBottom(true)

        }
  };

        const mounted = useRef(false);

 useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic
        mounted.current = true;
      } else {

                setloadingBtn(false)
          setToggleDrawerBottom(false)
          if (endDataResponse == false) {
                        endData()

          }
        // do componentDidUpdate logic
      }
    }, [endDataResponse]);
    const  handleClick = (data)=>{


        setloadingBtn(true)
        handleDataDrawer()
        fetchAPIData({ limit: 10, skip: 0,  data ,advanceSearch:true})


    }
  const list = (anchor) => (
          <div  className={clsx(classes.list, { [classes.fullList]: anchor === 'top' || anchor === 'bottom', })} role="presentation">
              <div className="card-header">
                <h1> <i className="las la-tshirt"></i> {trans["Products"]} </h1>
                  <button onClick={toggleDrawer()}  className="btn btn-soft-danger"><i className="las la-times"></i></button>
              </div>
          <div className="card-body">
                  <div className="row">
                    <div className="col-12 col-md-4">
                        <div className="form-group">
                            <label >{trans["Product Name"]} </label>
                                <div className="input-group">
                                <div className="input-group-prepend">
                                    <span className="input-group-text" style={{background:"#fff"}}>
                                        <i className="las la-calendar"></i>
                                    </span>
                                    </div>
                                    <input className="form-control" value={DataSearchproductsTable.name} type="text"  onChange={e => {
                                        setDataSearchProductsTable((prevState) => ({
                                        ...prevState,
                                            name: e.target.value ,
                                            }));
                                            }} />
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

                                                <select value={DataSearchproductsTable.category_id} onChange={e=>{
                                                                   setDataSearchProductsTable((prevState) => ({
                                                                            ...prevState,
                                                                                category_id: e.target.value ,
                                                                                }));
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

                                                <select  value={DataSearchproductsTable.brand_id} onChange={e=>{
                                                                   setDataSearchProductsTable((prevState) => ({
                                                                            ...prevState,
                                                                                brand_id: e.target.value ,
                                                                                }));
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
                                                                    setStartDate(e.target.value)
                                                                        setDataSearchProductsTable((prevState) => ({
                                                                            ...prevState,
                                                                            startDate: e.target.value ,
                                                                        }));

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
                                                                    setEndDate(e.target.value)
                                                                        setDataSearchProductsTable((prevState) => ({
                                                                            ...prevState,
                                                                            endDate: e.target.value ,
                                                                        }));

                                                                }} />
                                                    </div>
                                                    </div>

                            </div>
                  </div>
              </div>
              <div className="card-footer">
                  <div className='left-btn-search'>
                      <button onClick={()=>{
                            handleClick(DataSearchproductsTable)
                            }} disabled={loadingBtn} className="btn btn-primary">
                                {trans["Search"]}
                            {/* {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  } */}
                       </button>
                  </div>
              </div>

                </div>


  );

  return (
    <div>
        <React.Fragment >
          <button className="btn btn-soft-primary" onClick={toggleDrawer()}><i className="las la-search"></i> {trans["Advanced Search"]}</button>
              <Drawer className="card" style={{position:'relative'}} anchor={"bottom"} open={toggleDrawerBottom} onClose={toggleDrawer()}>

                      {list("bottom")}

              </Drawer>
        </React.Fragment>

    </div>
  );
}
