
import { matchSorter } from "match-sorter";
import React, { useMemo, useState } from "react";
//import  { useTable,useGlobalFilter,useFilters , usePagination} from "react-table";
import { useTable, usePagination, useExpanded, useSortBy } from "react-table";


import FooterTable from "./footerTable";
import LoadingInline from "./LoadingInline";
import { Urls } from "../../urls";
import swal from "sweetalert";
import axios from "axios";

import TemporaryDrawer from "./drawerBottom";
import AddModal from "../localShipmentModals/addModal";
import EditModal from "../localShipmentModals/editModal";
const TableComponent =  ({
  columns,
    data,
  trans,
  fetchData,
  pageCount: controlledPageCount,
    loading,
    _handleSearch,
    loadingupdate,
    goBack,
    handleBack,

                        endDataResponse,
                        endData,
                        fetchAPIData,
    // deleteData,
     allrowsLength,

  isPaginated = true,
  ...props
}) => {


  const defaultColumn = useMemo(
    () => ({
      // minWidth: 20,
      // maxWidth: 115
    }),
    []
  );
  const {
    getTableProps,
    getTableBodyProps,
    headerGroups,
    prepareRow,
    page,
    canPreviousPage,
    canNextPage,
    pageOptions,
    pageCount,
    gotoPage,
    nextPage,
    previousPage,
    setPageSize,
    // setHiddenColumns,
    state: { pageIndex, pageSize },
  } = useTable(
    {
      columns,
      data,
      defaultColumn,
      initialState: {
        pageIndex: 0,
        pageSize: 10,
        // hiddenColumns: columns
        //   .filter((column) => !column.show)
        //   .map((column) => column.id),
      },
      manualPagination: true,
      manualSortBy: true,
      autoResetPage: false,
      pageCount: controlledPageCount,
    },
    useSortBy,
    useExpanded,
    usePagination
  );

    const [startDate, setStartDate] = useState(new Date(2020,12).toISOString().substring(0,10) )
    const [endtDate, setEndDate] = useState(new Date().toISOString().substring(0,10))
const [fetchdatas, setfetchdatas] = useState(true)
const [addressId, setaddressId] = useState(0)
    const [DataSearchSellersTable, setDataSearchSellersTable] = useState({
        startDate: startDate,
        endDate: endtDate,
        address: "",
        city_name: "",
        cost: 0,
        shipping_days: 0,

  });

    const [show, setshow] = useState(false)
        const [showEdit, setshowEdit] = useState(false)

    React.useEffect(() => {
        if (fetchdatas) {
              fetchData && fetchData({ pageIndex, pageSize });

      }
  }, [fetchData, pageIndex, pageSize]);



  React.useEffect(() => {
            if (!fetchdatas) {
            gotoPage(0)
              //  fetchData && fetchData({ pageIndex, pageSize });

            }
              //        setfetchdatas(true)

  }, [fetchdatas]);

    React.useEffect(() => {

        if (goBack) {
                     setfetchdatas(true)
         handleBack()

        }

  }, [goBack]);

    const handleDataDrawer = () => {
                         setfetchdatas(false)

}

    const swalRemove = (id) => {


 swal({
  title: trans["Are you sure?"],
  text: trans["Once deleted, you will not be able to recover this imaginary data!"],
     icon: "warning",
  buttons: [trans["cancel"],trans["remove"]],
     dangerMode: true,


})
.then((willDelete) => {
    if (willDelete) {

        axios.get(Urls.static_url + `localShipment/address/${id}`)
            .then(res => {
              fetchData && fetchData({ pageIndex, pageSize });

            })
            .catch(err => {
            console.log({err});
        })
  }
});
    }

   const handleClose = () => {
    setshow(false)
   }

   const handleCloseEdit = () => {
    setshowEdit(false)
   }
    const handleSaveChangeAddAddress = () => {
                        fetchData && fetchData({ pageIndex, pageSize });

    }

        return (
            <>
                <div>
                <div className="card">
                    <div className="card-header">


                        <h1> <i className="las la-flag"></i> {trans["Local Shipment Address"]} </h1>

                            <button onClick={() => {
                                    setshow(true)

                        }} className="btn btn-primary">
                           {trans["Add Address"]}
                        </button>
                    </div>
                    <div className="card-body ">
                                         <div className="row">

              <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Address"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-flag"></i>
                                                </span>
                                           </div>
                                        <input type="text" onChange={e => {
                                                                                          setfetchdatas(false)

                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                address: e.target.value ,
                                                            }));

                                             _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "address",
                                                value:e.target.value
                                             })
                                            loadingupdate()
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
                                        <input type="text" onChange={e => {
                                              setfetchdatas(false)

                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                city_name: e.target.value ,
                                                     }));

                                             _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "city_name",
                                                value:e.target.value
                                             })
                                               loadingupdate()
                                             }}  placeholder={trans["search city name"]} className="form-control" />
                                           </div>
                                        </div>

                                </div>

                                                 <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Cost"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-at"></i>
                                                </span>
                                           </div>
                                        <input type="number" onChange={e => {
                                              setfetchdatas(false)

                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                cost: parseFloat(e.target.value)  ,
                                                     }));

                                             _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "cost",
                                                value:e.target.value
                                             })
                                               loadingupdate()
                                             }}  placeholder={trans["cost"]} className="form-control" />
                                           </div>
                                        </div>

                                </div>

                                                 <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Shipping Days"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-at"></i>
                                                </span>
                                           </div>
                                        <input type="number" onChange={e => {
                                              setfetchdatas(false)

                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                shipping_days: parseInt(e.target.value) ,
                                                     }));

                                             _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "shipping_days",
                                                value:e.target.value
                                             })
                                               loadingupdate()
                                             }}  placeholder={trans["shipping days"]} className="form-control" />
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
                                                               setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                startDate: e.target.value ,
                                                               }));

                                            _handleSearch(10, 0, DataSearchSellersTable, {
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
                                                               setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                endDate: e.target.value ,
                                                               }));

                                            _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "endDate",
                                                value:e.target.value
                                            })
                                            loadingupdate()
                                                    }} />
                                           </div>
                                        </div>

                                     </div>


              </div>


                        <div>


                        <div className="container">
                            <div className="card  " >

                                    {loading ? (<div className="card-body" >
                                            <div  style={{textAlign:"center",verticalAlign:"middle"}} >
                                                    <LoadingInline/>
                                           </div>
                                    </div>): (
                                        <div className="card-body " >
                                            <div className="row">
                                    {page.map((address, i) => {
                                        prepareRow(address);
                                        return (
                                             <div key={i} className="col-md-4 col-12 mb-3">
                                <span className="d-flex p-3 aiz-megabox-elem" style={{border:"1px solid #ddd"}}>
                                    <span className="flex-grow-1 pl-3 text-left">
                                        <div>
                                            <span className="opacity-60">{trans['Address']}:</span>
                                            <span className="fw-600 ml-2">{address.values.address}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['Shipping Days']}:</span>
                                                            <span className="fw-600 ml-2">{address.values.shipping_days }</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['City']}:</span>
                                            <span className="fw-600 ml-2">{address.values.city_name}</span>
                                        </div>
                                        <div>
                                            <span className="opacity-60">{trans['Cost']}:</span>
                                            <span className="fw-600 ml-2">{address.values.cost }</span>
                                        </div>

                                    </span>
                                </span>
                            <div className="dropdown position-absolute drop_menue_setting_address" >
                                <button className="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                    <i className="la la-ellipsis-v"></i>
                                </button>
                                <div className="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                     <button className="dropdown-item" onClick={() => {
                                        setaddressId(address.values.id)
                                        setshowEdit(true)
                                    }} >
                                        {trans['Edit']}
                                    </button>
                                    <button className="dropdown-item" onClick={() => {
                                        swalRemove(address.values.id)
                                    }} >
                                        {trans['Delete']}
                                    </button>
                                </div>
                            </div>

                        </div>
                                        );
                                    })}
                                                        </div>
                                </div>
)}

                            </div>


                                {Boolean(isPaginated) ? (
                                    <FooterTable
              trans={trans}
              allrowsLength={allrowsLength}
              pageOptions={pageOptions}
              canPreviousPage={canPreviousPage}
              gotoPage={gotoPage}
              previousPage={previousPage}
              pageCount={pageCount}
              canNextPage={canNextPage}
              nextPage={nextPage}
              pageIndex={pageIndex}
              pageSize={pageSize}
              setPageSize={setPageSize}

                        />) : null}
                        </div>

                          </div>
                    </div>

                    </div>
                    <div>
                        <AddModal handleSaveChange={handleSaveChangeAddAddress} trans={trans} handleClose={handleClose} show={show} />
                    </div>

                   <div>
                        {addressId != 0 ? <EditModal id={addressId} handleSaveChange={handleSaveChangeAddAddress} trans={trans} handleClose={handleCloseEdit} show={showEdit} /> : null}
                    </div>

                    <div style={{ display: "flex", justifyContent: "center",marginBlock:20 }}>
                                       <TemporaryDrawer handleDataDrawer={handleDataDrawer} endDataResponse={endDataResponse} endData={endData} fetchAPIData={fetchAPIData}  trans={trans}  />

                    </div>
                    </div>
            </>
        )

  }


  function dateBetweenFilterFn(rows, id, filterValues) {
    let sd = filterValues[0] ? new Date(filterValues[0]) : undefined
    let ed = filterValues[1] ? new Date(filterValues[1]) : undefined

    if (ed || sd) {
      return rows.filter(r => {
        var time = new Date(r.values[id])

        if (ed && sd) {
          return (time >= sd && time <= ed)
        } else if (sd){
          return (time >= sd)
        } else if (ed){
          return (time <= ed)
        }
      })
    } else {
      return rows
    }
  }

dateBetweenFilterFn.autoRemove = val => !val;



function fuzzyTextFilterFn(rows, id, filterValue) {
    return matchSorter(rows, filterValue, { keys: [row => row.values[id]] })
  }

  // Let the table remove the filter if the string is empty
  fuzzyTextFilterFn.autoRemove = val => !val
export default TableComponent;


