
import { matchSorter } from "match-sorter";
import React, { useMemo, useState } from "react";
import { useTable, usePagination, useExpanded, useSortBy } from "react-table";
import FooterTable from "./footerTable.jsx";
import LoadingInline from "./LoadingInline";
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

    const [DataSearchOrdersTable, setDataSearchOrdersTable] = useState({
        startDate: startDate,
        endDate: endtDate,
        user_name: "",
        order_code: "",
        status:"",

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

        return (
            <>
                <div>
                <div className="card">
                    <div className="card-header">


                        <h1> <i className="las la-truck"></i> {trans["Orders Log"]} </h1>

                    </div>
                    <div className="card-body ">
                                         <div className="row">

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
                                                                order_code: e.target.value ,
                                                            }));

                                             _handleSearch(10, 0, DataSearchOrdersTable, {
                                                type: "order_code",
                                                value:e.target.value
                                             })
                                            loadingupdate()
                                             }}  placeholder={trans["search order code"]} className="form-control" />
                                           </div>
                                        </div>

      </div>
                 <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["user name"]} </label>
                                            <div className="input-group">
                                            <div className="input-group-prepend">
                                            <span className="input-group-text" style={{background:"#fff"}}>
                                            <i className="las la-users-tag"></i>
                                                </span>
                                           </div>
                                        <input type="text" onChange={e => {
                                              setfetchdatas(false)

                                                     setDataSearchOrdersTable((prevState) => ({
                                                                ...prevState,
                                                                user_name: e.target.value ,
                                                     }));

                                             _handleSearch(10, 0, DataSearchOrdersTable, {
                                                type: "user_name",
                                                value:e.target.value
                                             })
                                               loadingupdate()
                                             }}  placeholder={trans["search Users Name"]} className="form-control" />
                                           </div>
                                        </div>

                                </div>
                                         <div className="col-12 col-md-3">
            <div className="form-group">
                                            <label >{trans["Status Dlievery"]} </label>
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
                                                    <option value="cancelled">{trans["Cancel"]}</option>

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
                                                {row.cells.map((cell, i) => {
                                                     if (cell.column.render("Header") == trans["Options"]) {
                                                        return (

                                                        <td key={i} className="text-right" >

                                                        </td>
                                                        )
                                                     } else if (cell.column.render("Header") == trans["Status"]) {
                                                        return (
                                                            <td key={i} {...cell.getCellProps()}>{

                                                                    trans[row.original.status]

                                                            }</td>
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


