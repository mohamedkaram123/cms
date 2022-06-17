import React, { useEffect, useRef, useState } from 'react';
import clsx from 'clsx';
import { makeStyles } from '@material-ui/core/styles';
import Drawer from '@material-ui/core/Drawer';
import Button from '@material-ui/core/Button';
import List from '@material-ui/core/List';
import Divider from '@material-ui/core/Divider';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import { Urls } from '../../urls';
import axios from 'axios';

const useStyles = makeStyles({
  list: {
    width: 250,
  },
  fullList: {
    width: 'auto',
  },
});

export default function TemporaryDrawer({trans,fetchAPIData,endDataResponse,endData,handleDataDrawer}) {
  const classes = useStyles();
    const [toggleDrawerBottom, setToggleDrawerBottom] = useState(false);
    const [startDate, setStartDate] = useState(new Date(2020,12).toISOString().substring(0,10) )
    const [endtDate, setEndDate] = useState(new Date().toISOString().substring(0,10))


    const [DataSearchSellersTable, setDataSearchSellersTable] = useState({
        startDate: startDate,
        endDate: endtDate,
        address: "",
        city_name: "",
        cost: 0,
        shipping_days: 0,
        id:0

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
        fetchAPIData({ limit: 10, skip: 0, objectData: data ,advanceSearch:true})

    }
  const list = (anchor) => (
    <div
      className={clsx(classes.list, {
        [classes.fullList]: anchor === 'top' || anchor === 'bottom',
      })}
      role="presentation"
    //   onClick={toggleDrawer()}
    //   onKeyDown={toggleDrawer()}
      >
          <div className="row">
                  <div className="text-right" style={{margin:20}}>
                      <button onClick={toggleDrawer()}  className="btn btn-icon"><i className="las la-times"></i></button>
                  </div>

              </div>

    <div  className="card"  style={{padding:40,paddingInline:"20%"}}>

                                         <div className="row">

              <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Address"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-user-tag"></i>
                                                </span>
                                           </div>
                                        <input value={DataSearchSellersTable.address} type="text" onChange={e => {

                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                address: e.target.value ,
                                                            }));

                                             }}  placeholder={trans["address"]} className="form-control" />
                                           </div>
                                        </div>

      </div>
                 <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["City Name"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-at"></i>
                                                </span>
                                           </div>
                                        <input value={DataSearchSellersTable.city_name} type="text" onChange={e => {

                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                city_name: e.target.value ,
                                                     }));

                                             }}  placeholder={trans["search city name"]} className="form-control" />
                                           </div>
                                        </div>

                  </div>
                    <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["ID"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input value={DataSearchSellersTable.id} type="number" onChange={e=>{
                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                id: parseInt(e.target.value) ,
                                                            }));

                                             }}  placeholder={trans["search id"]} className="form-control" />
                                           </div>
                                        </div>

      </div>

              </div>
        <div className="row">

        <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Cost"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input value={DataSearchSellersTable.cost} type="number" onChange={e=>{
                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                cost: parseFloat(e.target.value) ,
                                                            }));

                                             }}  placeholder={trans["cost"]} className="form-control" />
                                           </div>
                                        </div>

      </div>        <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Shipping Days"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input value={DataSearchSellersTable.shipping_days} type="number" onChange={e=>{
                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                shipping_days: parseInt(e.target.value) ,
                                                            }));

                                             }}  placeholder={trans["search shipping days"]} className="form-control" />
                                           </div>
                                        </div>

      </div>

                                <div className="col-12 col-md-3">
                                   <div className="form-group">
                                            <label >{trans["Start Date"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-calendar"></i>
                                                </span>
                                           </div>
                                        <input  className="form-control" type="date" value={startDate} onChange={e => {
                                                        setStartDate(e.target.value)
                                                               setDataSearchSellersTable((prevState) => ({
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
                                                               setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                endDate: e.target.value ,
                                                               }));

                                                    }} />
                                           </div>
                                        </div>

                                     </div>

              </div>

        <div className="d-flex flex-row-reverse">
                                            <button onClick={()=>{
                                                handleClick(DataSearchSellersTable)
                                            }} disabled={loadingBtn} className="btn btn-primary">
                                            {trans["Search Data"]}
                                            {loadingBtn?<img style={{marginInline:10}} src={ Urls.public_url + "assets/img/loading.gif"} width={15} height={15} />:null  }
                                         </button>
        </div>

    </div>
    </div>
  );

  return (
    <div>
        <React.Fragment >
          <Button className="btn btn-light" onClick={toggleDrawer()}><i className="las la-angle-up"></i></Button>
          <Drawer anchor={"bottom"} open={toggleDrawerBottom} onClose={toggleDrawer()}>
            {list("bottom")}
          </Drawer>
        </React.Fragment>

    </div>
  );
}
