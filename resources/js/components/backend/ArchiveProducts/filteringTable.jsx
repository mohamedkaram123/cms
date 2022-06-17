
import React, { useMemo, useState } from "react";
import { useTable, usePagination, useExpanded, useSortBy } from "react-table";



import FooterTable from "./footerTable";
import LoadingInline from "../../../helpers/LoadingInline";
import HeaderSearch from "./search/header_search";
import MainRows from "./rows/main_rows";
import { useSelector } from 'react-redux';
import TemporaryDrawer from "./search/drawerBottom";
import { Urls } from "../urls";
import swal from "sweetalert";
import axios from "axios";
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
    categories,
    brands,
    // deleteData,
     allrowsLength,

  isPaginated = true,
  ...props
}) => {

        const state = useSelector(state => state);


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



    const [fetchdatas, setfetchdatas] = useState(true)


    React.useEffect(() => {
        if (fetchdatas) {
            fetchData && fetchData({ pageIndex, pageSize });


      }
  }, [/*fetchData,*/ pageIndex, pageSize]);



  React.useEffect(() => {
            if (!fetchdatas) {
                gotoPage(0)

            }

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
            const destroy_url = Urls.url + `products/destroy/${id}`;

 swal({
  title: trans["Are you sure from return the product?"],

  icon: "warning",
     buttons: [trans["cancel"],trans["return"]],
     dangerMode: true,


})
.then((willDelete) => {
    if (willDelete) {
        loadingupdate();

        axios.get(destroy_url)
            .then(res => {

                // deleteData(res.data.order)
                                fetchData && fetchData({ pageIndex, pageSize });

            })
            .catch(err => {
            console.log({err});
        })

  }
});
    }

        return (
            <>
                <div>
                    <div className="card">
                        <div className="card-header">
                            <h1> <i className="las la-tshirt"></i> {trans["ProductS Archive"]} </h1>
                        </div>
                        <div className="card-body ">

                            <HeaderSearch trans={trans} categories={categories} brands={brands} _handleSearch={_handleSearch} loadingupdate={loadingupdate} setfetchdatas={setfetchdatas} />
                            <div className="table-responsive">
                                <table className="table  " {...getTableProps()}>
                                    <thead className="thead-light">
                                        {headerGroups.map(headerGroup => (
                                            <tr {...headerGroup.getHeaderGroupProps()}>
                                                {headerGroup.headers.map(column => (
                                                    <th {...column.getHeaderProps({})}>
                                                        <span>{column.render("Header")}</span>
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

                                                                        return (
                                                                                <MainRows swalRemove={swalRemove} key={i} trans={trans} row={row} cell={cell} i={i} />
                                                                            )
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

                    <div style={{ display: "flex", justifyContent: "center",marginBlock:20 }}>
                                        <TemporaryDrawer categories={categories} brands={brands} handleDataDrawer={handleDataDrawer} endDataResponse={endDataResponse} endData={endData} fetchAPIData={fetchAPIData}  trans={trans}  />
                    </div>
                </div>
            </>
        )

  }

export default TableComponent;


