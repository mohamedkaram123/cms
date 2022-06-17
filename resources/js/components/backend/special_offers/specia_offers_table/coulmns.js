import ColumnFilter from "./coulmnFilter"
import DateFilter from "./dateFilter"


export const COLUMNS = [

    {
        Header: "Name",
        Footer: "Name",
        Filter: ColumnFilter,
        accessor: "name"
    },

    {
        Header: "Price",
        Footer: "Price",
        Filter: ColumnFilter,

        accessor: 'price'
    },

    {
        Header: "Created At",
        Footer: "created_at",
        Filter: DateFilter,
        filter: "dateBetween",

        accessor: 'created_at'
    },

]