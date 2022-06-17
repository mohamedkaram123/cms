import React from 'react'

export default function CoulmnFilter({ column: { filterValue,setFilter}}) {
    return (
        <div>

            <span>
                <input className="form-control" value={filterValue || ''} onChange={e=>setFilter(e.target.value)} />
            </span>

        </div>
    )
}
