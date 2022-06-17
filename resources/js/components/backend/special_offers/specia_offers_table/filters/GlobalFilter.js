import React from 'react'

export default function GlobalFilter({filter,setFilter,trans}) {
    return (
        <div>

            <span>
                {trans["Search"]}: {''}
                <input className="form-control" value={filter || ''} onChange={e=>setFilter(e.target.value)} />
            </span>

        </div>
    )
}
