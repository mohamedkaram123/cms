import React from 'react'

const is_rtl = document.querySelector('html').getAttribute("dir") == 'rtl';

export default function FooterTable({
    trans,
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
    allrowsLength


}) {


    { /* <FiltersQuery trans={trans} coulmns={columns} handleChange={handleChange}  /> */ }
    return (

        <
        div className = "d-flex flex-row col-12"
        style = {
            { alignItems: "center" } } >
        <
        div className = "p-2" >
        <
        button className = "btn"
        onClick = {
            () => gotoPage(0) }
        disabled = {!canPreviousPage } > { '<<' } <
        /button>{' '} <
        button className = "btn"
        onClick = {
            () => previousPage() }
        disabled = {!canPreviousPage } > { '<' } <
        /button>{' '} <
        button className = "btn"
        onClick = {
            () => nextPage() }
        disabled = {!canNextPage } > { '>' } <
        /button>{' '} <
        button className = "btn"
        onClick = {
            () => gotoPage(pageCount - 1) }
        disabled = {!canNextPage } > { '>>' } <
        /button>{' '} <
        /div> <
        div className = "p-2" >

        <
        span > { trans['Page'] } { ' ' } <
        strong > { pageIndex + 1 } { trans['of'] } { pageOptions.length } <
        /strong>{' '} <
        /span> <
        span >
        |
        { trans['Go to page'] }: { ' ' }

        <
        /span>{' '} <
        /div>

        <
        div className = "p-2" >

        <
        input className = "form-control"
        style = {
            { width: 100 } }
        type = "number"
        value = { pageIndex + 1 }
        onChange = {
            e => {
                const page = e.target.value ? Number(e.target.value) - 1 : 0
                gotoPage(page)
            }
        }
        /> <
        /div> <
        div className = "p-2" >

        <
        select className = "form-control"
        style = {
            { width: 100 } }
        value = { pageSize }
        onChange = {
            e => {
                setPageSize(Number(e.target.value))
            }
        } >

        {
            [10, 20, 30, 40, 50].map(pageSize => ( <
                option key = { pageSize }
                value = { pageSize } > { trans['show'] } { pageSize } <
                /option>
            ))
        } <
        /select> <
        /div> <
        div className = "p-2" >
        <
        span style = {
            { marginInline: 10, fontSize: 14 } } > { trans['All rows number'] } { allrowsLength } < /span>

        <
        /div>


        <
        /div>

    )


}
