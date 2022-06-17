import React from "react";

 export default function DateRangeColumnFilter({
column: {
filterValue = [],
preFilteredRows,
setFilter,
id
}})
{
const [min, max] = React.useMemo(() => {
let min = preFilteredRows.length ? new Date(preFilteredRows[0].values[id]) : new Date(0)
let max = preFilteredRows.length ? new Date(preFilteredRows[0].values[id]) : new Date(0)

preFilteredRows.forEach(row => {
  const rowDate = new Date(row.values[id])

  min = rowDate <= min ? rowDate : min
  max = rowDate >= max ? rowDate : max
})

return [min, max]
}, [id, preFilteredRows])

return (
<div style={{display:"flex",  alignItems: 'center',
    justifyContent: 'center',}}>
  <input

    className="form-control"
    min={min.toISOString()}
    onChange={e => {
      const val = e.target.value
      setFilter((old = []) => [val ? val : undefined, old[1]])
    }}
    type="date"
    value={filterValue[0] || ''}
  />
  <span style={{marginInline:20,fontSize:16}}> to </span>
  <input

   className="form-control"
    max={max.toISOString()}
    onChange={e => {
      const val = e.target.value
      setFilter((old = []) => [old[0], val ? val.concat('T23:59:59.999Z') : undefined])
    }}
    type="date"
    value={filterValue[1]?.slice(0, 10) || ''}
  />
</div>
)
}
