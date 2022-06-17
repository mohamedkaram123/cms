import React from 'react'

export default function NumberFilter({ column: { filterValue,setFilter}}) {
    return (
        <div>

            <span>
                <input type="number" className="form-control" value={filterValue || ''} onChange={e=>setFilter(e.target.value)} />
            </span>

        </div>
    )
}
