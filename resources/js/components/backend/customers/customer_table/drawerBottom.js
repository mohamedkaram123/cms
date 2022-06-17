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


    const [DataSearchCustomersTable, setDataSearchCustomersTable] = useState({
        startDate: startDate,
        endDate: endtDate,
        name: "",
        email: "",
        phone:"",
        balance: 0,

  });
  const [loadingBtn, setloadingBtn] = useState(false);

    const toggleDrawer = () => (event) => {

        if (toggleDrawerBottom == true) {
  setToggleDrawerBottom(false)

        } else {
              setToggleDrawerBottom(true)

        }
  };

    //    const convertDate = (date_covert)=>{
    //     let date = new Date(date_covert);
    //         date = date.getUTCFullYear() + '-' +
    //      ('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
    //      ('00' + date.getUTCDate()).slice(-2) + ' ' +
    //      ('00' + date.getUTCHours()).slice(-2) + ':' +
    //      ('00' + date.getUTCMinutes()).slice(-2) + ':' +
    //      ('00' + date.getUTCSeconds()).slice(-2);
    //      return date;
    // }
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

          <div className="card" style={{ padding: 40, paddingInline: "20%" }}>


                                         <div className="row">

              <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Name"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-user-tag"></i>
                                                </span>
                                           </div>
                                        <input value={DataSearchCustomersTable.name} type="text" onChange={e => {

                                                     setDataSearchCustomersTable((prevState) => ({
                                                                ...prevState,
                                                                name: e.target.value ,
                                                            }));

                                             }}  placeholder={trans["customer name"]} className="form-control" />
                                           </div>
                                        </div>

      </div>
                 <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Email"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-at"></i>
                                                </span>
                                           </div>
                                        <input value={DataSearchCustomersTable.email} type="text" onChange={e => {

                                                     setDataSearchCustomersTable((prevState) => ({
                                                                ...prevState,
                                                                email: e.target.value ,
                                                     }));

                                             }}  placeholder={trans["search email"]} className="form-control" />
                                           </div>
                                        </div>

                                </div>
                                         <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Phone"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-phone"></i>
                                                </span>
                                           </div>
                                        <input value={DataSearchCustomersTable.phone} type="number" onChange={e => {
                                                     setDataSearchCustomersTable((prevState) => ({
                                                                ...prevState,
                                                                phone: e.target.value ,
                                                     }));

                                             }}  placeholder={trans["search Phone"]} className="form-control" />
                                           </div>
                                        </div>

                            </div>

         <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Wallet Balance"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-wallet"></i>
                                                </span>
                                           </div>
                                        <input value={DataSearchCustomersTable.balance} type="number" onChange={e => {
                                                     setDataSearchCustomersTable((prevState) => ({
                                                                ...prevState,
                                                                balance: parseInt(e.target.value) ,
                                                     }));

                                             }}  placeholder={trans["search balance"]} className="form-control" />
                                           </div>
                                        </div>

                            </div>

              </div>
        <div className="row">

              <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["ID"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-key"></i>
                                                </span>
                                           </div>
                                             <input value={DataSearchCustomersTable.id} type="number" onChange={e=>{
                                                     setDataSearchCustomersTable((prevState) => ({
                                                                ...prevState,
                                                                id: parseInt(e.target.value) ,
                                                            }));

                                             }}  placeholder={trans["search id"]} className="form-control" />
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
                                        <input className="form-control" type="date" value={startDate} onChange={e => {
                                                        setStartDate(e.target.value)
                                                               setDataSearchCustomersTable((prevState) => ({
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
                                                               setDataSearchCustomersTable((prevState) => ({
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
                                                handleClick(DataSearchCustomersTable)
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
