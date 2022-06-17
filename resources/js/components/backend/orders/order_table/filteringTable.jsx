
import { matchSorter } from "match-sorter";
import React, { useMemo, useState,useContext } from "react";
import { useTable, usePagination, useExpanded, useSortBy } from "react-table";

import FooterTable from "./footerTable";
import LoadingInline from "./LoadingInline";
import { Urls } from "../../urls";
import { decrypt, encrypt,hash_role } from "../../hashes";
import swal from "sweetalert";
import axios from "axios";
import { CheckRoles } from "../../../../context/CheckRoles";

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
    state: { pageIndex, pageSize  },
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

      const Roles = useContext(CheckRoles);

    const [startDate, setStartDate] = useState(new Date(2020,12).toISOString().substring(0,10) )
    const [endtDate, setEndDate] = useState(new Date((new Date()).setDate((new Date()).getDate()+1)).toISOString().substring(0,10))
const [fetchdatas, setfetchdatas] = useState(true)

    const [DataSearchOrdersTable, setDataSearchOrdersTable] = useState({
        id: 0,
        startDate: startDate,
        endDate: endtDate,
        customer: "",
        delivery_status: "",
        payment_status: "",
        grand_total: 0,
        code:""
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

        axios.get(Urls.static_url + `orders/destroy/${id}`)
            .then(res => {

                // deleteData(res.data.order)
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


                        <h1> <i className="las la-truck"></i> {trans["Orders"]} </h1>

                    </div>
                    <div className="card-body ">
                                         <div className="row">

                 <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Customer Name"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-users"></i>
                                                </span>
                                           </div>
                                        <input type="text" onChange={e => {
                                              setfetchdatas(false)

                                                     setDataSearchOrdersTable((prevState) => ({
                                                                ...prevState,
                                                                customer: e.target.value ,
                                                     }));

                                             _handleSearch(10, 0, DataSearchOrdersTable, {
                                                type: "customer",
                                                value:e.target.value
                                             })
                                               loadingupdate()
                                             }}  placeholder={trans["search customer name"]} className="form-control" />
                                           </div>
                                        </div>

      </div>
         <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Grand Total"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-money-bill"></i>
                                                </span>
                                           </div>
                                        <input type="number" onChange={e => {
                                                             setfetchdatas(false)
                                                     setDataSearchOrdersTable((prevState) => ({
                                                                ...prevState,
                                                                grand_total: parseInt(e.target.value) ,
                                                     }));
                                              _handleSearch(10, 0, DataSearchOrdersTable, {
                                                type: "grand_total",
                                                value:e.target.value
                                              })
                                            loadingupdate()

                                             }}  placeholder={trans["search grand total"]} className="form-control" />
                                           </div>
                                        </div>

                            </div>

                                     <div className="col-12 col-md-3">
                                           <div className="form-group">
                                            <label >{trans["Order Code"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-barcode"></i>
                                                </span>
                                           </div>
                                        <input type="text" onChange={e => {
                                                              setfetchdatas(false)
                                                     setDataSearchOrdersTable((prevState) => ({
                                                                ...prevState,
                                                                code: e.target.value ,
                                                     }));
                                            _handleSearch(10, 0, DataSearchOrdersTable, {
                                                type: "code",
                                                value:e.target.value
                                            })
                                            loadingupdate()

                                             }}  placeholder={trans["search order code"]} className="form-control" />
                                           </div>
                                        </div>

                                    </div>

              </div>
        <div className="row">

                             <div className="col-12 col-md-3">
                                 <div className="form-group">
                                            <label >{trans["Delivery Status"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-truck"></i>
                                                </span>
                                           </div>
                                        <select onChange={e => {
                                                          setfetchdatas(false)
                                                            setDataSearchOrdersTable((prevState) => ({
                                                                ...prevState,
                                                                delivery_status: e.target.value ,
                                                            }));
                                             _handleSearch(10, 0, DataSearchOrdersTable, {
                                                type: "delivery_status",
                                                value:e.target.value
                                             })
                                            loadingupdate()

                                                 }} className="form-control">
                                                    <option value="">{trans["All"]}</option>
                                                    <option value="pending">{trans["Pending"]}</option>
                                                    <option value="confirmed">{trans["Confirmed"]}</option>
                                                    <option value="on_delivery">{trans["On Delivery"]}</option>
                                                    <option value="delivered">{trans["Delivered"]}</option>

                                                </select>
                                           </div>
                                        </div>
                              </div>
                           <div className="col-12 col-md-3">
                                 <div className="form-group">
                                            <label >{trans["Payment Status"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="lab la-cc-amazon-pay"></i>
                                                </span>
                                           </div>
                                        <select onChange={e => {
                                                        setfetchdatas(false)
                                                            setDataSearchOrdersTable((prevState) => ({
                                                                ...prevState,
                                                                payment_status: e.target.value ,
                                                            }));
                                             _handleSearch(10, 0, DataSearchOrdersTable, {
                                                type: "payment_status",
                                                value:e.target.value
                                             })
                                            loadingupdate()

                                                 }} className="form-control">
                                               <option value="">{trans["All"]}</option>
                                                <option value="paid">{trans["Paid"]}</option>
                                                <option value="unpaid">{trans["Un Paid"]}</option>

                                                </select>
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
                                                                                          setfetchdatas(false)
                                                        setStartDate(e.target.value)
                                                               setDataSearchOrdersTable((prevState) => ({
                                                                ...prevState,
                                                                startDate: e.target.value ,
                                                               }));

                                            _handleSearch(10, 0, DataSearchOrdersTable, {
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
                                                               setDataSearchOrdersTable((prevState) => ({
                                                                ...prevState,
                                                                endDate: e.target.value ,
                                                               }));

                                            _handleSearch(10, 0, DataSearchOrdersTable, {
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
                                                {row.cells.map((cell,i) => {
                                                    if (cell.column.render("Header") == trans["Delivery Status"]) {
                                                        return (
                                                            <td key={i} {...cell.getCellProps()}>{

                                                                trans[row.original.delivery_status]
                                                            }</td>
                                                        )
                                                    } else if (cell.column.render("Header") == trans["Payment Status"]) {
                                                        return (
                                                            <td key={i} {...cell.getCellProps()}>{

                                                                trans[row.original.payment_status]
                                                            }</td>
                                                        )
                                                    } else if (cell.column.render("Header") == trans["Options"]) {
                                                        return (
                                                            <td key={i}  >
                                                                <div className="d-flex flex-row" style={{ justifyContent: "center", alignItems: "center" }}>
                                                                   {Roles[27]?<a className="btn btn-soft-primary btn-icon btn-circle btn-sm" href={Urls.static_url + "all_orders/" + encrypt((row.original.id).toString()) + "/show" + hash_role(27) } title="{{ translate('View') }}">
                                                                        <i className="las la-eye"></i>
                                                                    </a>:null}
                                                                    {Roles[28] ? <a className="btn btn-soft-primary btn-icon btn-circle btn-sm" href={Urls.url + `invoice/${row.original.id + hash_role(28)}`} title="{{ translate('Download Invoice') }}">
                                                                        <i className="las la-download"></i>
                                                                    </a>:null}

                                                                </div>

                                                            </td>
                                                        )
                                                    } else {
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


