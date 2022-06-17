import React from 'react'
import FiltersQuery from './filtersQuery'
import LoadingInline from './LoadingInline'

export default function FooterTable({
    LoadingCheck,
    trans,
    columns,
    handleChange,
    divStyle,
    pageOptions,
    canPreviousPage,
    gotoPage,
    previousPage,
    pageCount,
    canNextPage,
    nextPage,
    pageIndex,
    pageSize,
    setPageSize,
    rows,
    footerPaginate,
    paginateLoading

}) {

    if(footerPaginate){
        return (
            <div>
                            <LoadingInline />

            </div>
            )
    }else{
        return (
            <div>

                                {LoadingCheck?<LoadingInline />:false}


    <FiltersQuery trans={trans} coulmns={columns} handleChange={handleChange}  />


    <div className="pagination">
    <button className="btn" style={divStyle} onClick={() => gotoPage(0)} disabled={!canPreviousPage}>
    {'<<'}
    </button>{' '}
    <button className="btn" style={divStyle} onClick={() => previousPage()} disabled={!canPreviousPage}>
    {'<'}
    </button>{' '}
    <button className="btn" style={divStyle} onClick={() => nextPage()} disabled={!canNextPage}>
    {'>'}
    </button>{' '}
    <button className="btn" style={divStyle} onClick={() => gotoPage(pageCount - 1)} disabled={!canNextPage}>
    {'>>'}
    </button>{' '}
    <span>
    {trans['Page']} {' '}
    <strong>
    {pageIndex + 1}  {trans['of']} {pageOptions.length}
    </strong>{' '}
    </span>
    <span>
    | {trans['Go to page']} :{' '}
    <input
    type="number"
    defaultValue={pageIndex + 1}
    onChange={e => {
    const page = e.target.value ? Number(e.target.value) - 1 : 0
    gotoPage(page)
    }}
    style={{ width: '100px' }}
    />
    </span>{' '}
    <select
    value={pageSize}
    onChange={e => {
    setPageSize(Number(e.target.value))
    }}
    >
    {[10, 20, 30, 40, 50].map(pageSize => (
    <option key={pageSize} value={pageSize}>
    {trans['show']} {pageSize}
    </option>
    ))}
    </select>
    <span style={{marginInline:10,fontSize:14}}> {trans['All rows number']} {rows.length}</span>


    </div>

            </div>
        )
    }

}
