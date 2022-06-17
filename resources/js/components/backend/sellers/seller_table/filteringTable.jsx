
import { matchSorter } from "match-sorter";
import React, { useMemo, useState } from "react";
//import  { useTable,useGlobalFilter,useFilters , usePagination} from "react-table";
import { useTable, usePagination, useExpanded, useSortBy } from "react-table";



import FooterTable from "./footerTable";
import LoadingInline from "./LoadingInline";
// import LoadingInline from "./LoadingInline";
// import UserProfile from "./UserProfile";
// import ViewCart from "./view_cart";

import {

    Link
  } from "react-router-dom";
import { Urls } from "../../urls";
import { decrypt, encrypt } from "../../hashes";
import swal from "sweetalert";
import axios from "axios";

import TemporaryDrawer from "./drawerBottom";


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
    },
    useSortBy,
    useExpanded,
    usePagination
  );

    const [startDate, setStartDate] = useState(new Date(2020,12).toISOString().substring(0,10) )
    const [endtDate, setEndDate] = useState(new Date().toISOString().substring(0,10))
const [fetchdatas, setfetchdatas] = useState(true)

    const [DataSearchSellersTable, setDataSearchSellersTable] = useState({
        startDate: startDate,
        endDate: endtDate,
        name: "",
        email: "",
        phone:"",
        balance: 0,

  });

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
  buttons: trans["remove"],
     dangerMode: true,


})
.then((willDelete) => {
    if (willDelete) {
        loadingupdate();

        axios.get(Urls.static_url + `sellers/destroy/${id}`)
            .then(res => {
            //    deleteData(res.data.order)
                fetchData && fetchData({ pageIndex, pageSize });
            })
            .catch(err => {
            console.log({err});
        })

  } else {
    swal(trans["Your imaginary data is safe!"]);
  }
});
    }



        return (
            <>
                <div>
                <div className="card">
                    <div className="card-header">


                        <h1> <i className="las la-user-tag"></i> {trans["Sellers"]} </h1>


                    </div>
                    <div className="card-body ">
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
                                        <input type="text" onChange={e => {
                                                                                          setfetchdatas(false)

                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                name: e.target.value ,
                                                            }));

                                             _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "name",
                                                value:e.target.value
                                             })
                                            loadingupdate()
                                             }}  placeholder={trans["seller name"]} className="form-control" />
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
                                        <input type="text" onChange={e => {
                                              setfetchdatas(false)

                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                email: e.target.value ,
                                                     }));

                                             _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "email",
                                                value:e.target.value
                                             })
                                               loadingupdate()
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
                                        <input type="number" onChange={e => {
                                                             setfetchdatas(false)
                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                phone: e.target.value ,
                                                     }));
                                              _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "phone",
                                                value:e.target.value
                                              })
                                            loadingupdate()

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
                                        <input type="number" onChange={e => {
                                                             setfetchdatas(false)
                                                     setDataSearchSellersTable((prevState) => ({
                                                                ...prevState,
                                                                balance: parseInt(e.target.value) ,
                                                     }));
                                              _handleSearch(10, 0, DataSearchSellersTable, {
                                                type: "balance",
                                                value:e.target.value
                                              })
                                            loadingupdate()

                                             }}  placeholder={trans["search balance"]} className="form-control" />
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


                        <div className="table-responsive">
                            <table className="table  " {...getTableProps()}>
                                <thead className="thead-light">



                                    {headerGroups.map(headerGroup => (
                                        <tr {...headerGroup.getHeaderGroupProps()}>
                                            {headerGroup.headers.map(column => (
                                                <th {...column.getHeaderProps({})}>

                                                    {/* <div className="d-flex flex-row">{column.canFilter ? column.render('Filter') : null}</div> */}

                                                    <span>{column.render("Header")}</span>
                                                    {/* {column.canFilter ? column.render('Filter') : <div></div>} */}
                                                </th>
                                            ))}
                                        </tr>
                                    ))}
                                    </thead>
                                    {loading ? (<tbody >
                                            <tr  style={{textAlign:"center",verticalAlign:"middle"}} >
                                                    <td colSpan={10} ><LoadingInline/></td>
                                           </tr>
                                    </tbody>): (
                                        <tbody {...getTableBodyProps()}>

                                    {page.map((row, i) => {
                                        prepareRow(row);
                                        return (
                                            <tr key={i} {...row.getRowProps()}>
                                                {row.cells.map((cell, i) => {
                                                     if (cell.column.render("Header") == trans["Options"]) {
                                                        return (

                                                        <td key={i}  >
                                                                <div className="dropdown">
                                <button type="button" className="btn btn-sm btn-circle btn-soft-primary btn-icon dropdown-toggle no-arrow" data-toggle="dropdown" >
                                  <i className="las la-ellipsis-v"></i>
                                </button>
                                <div className="dropdown-menu dropdown-menu-right ">
                                    {/* <a href="#" onclick="show_seller_profile('{{$seller->id}}');"  className="dropdown-item">
                                      {trans['Profile']}
                                    </a> */}
                                    <a href={Urls.static_url + `sellers/loginjs/${encrypt((row.original.seller_id).toString()) }`} className="dropdown-item">
                                      {trans['Log in as this Seller']}
                                    </a>
                                    {/* <a href="#" onclick="show_seller_payment_modal('{{$seller->id}}');" className="dropdown-item">
                                      {trans['Go to Payment']}}
                                    </a> */}
                                    <a href={Urls.static_url + `seller/payments/showjs/${encrypt((row.original.seller_id).toString())}`} className="dropdown-item">
                                      {trans['Payment History']}
                                    </a>
                                    <a href={Urls.static_url + `seller/${encrypt((row.original.seller_id).toString())}/editjs`} className="dropdown-item">
                                      {trans['Edit']}
                                    </a>

                                    <button onClick={()=>{
                                        swalRemove(row.original.seller_id)
                                    }}  className="dropdown-item confirm-delete" >
                                      {trans['Delete']}
                                    </button>
                                </div>
                            </div>

                                                        </td>
                                                        )
                                                     } else if (cell.render("Header") == trans["Name"]) {
                                                         return (
                                                             <td key={i}>
                                                                 <Link  to={{
                                                pathname:Urls.static_url + "seller/seller_profile",
                                                state:{
                                                    seller:row.original
                                                }
                                            }}  >{cell.render("Cell")}</Link>
                                                             </td>
                                                         )
                                                     }else {
                                                        return (
                                                            <td key={i} {...cell.getCellProps()}>{

                                                                cell.render("Cell")

                                                            }</td>
                                                        )
                                                    }
                                                })}
                                            </tr>
                                        );
                                    })}
                                </tbody>
)}

                            </table>


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


