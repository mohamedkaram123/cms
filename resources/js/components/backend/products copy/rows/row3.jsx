import React,{useState} from 'react'
export default function Row3({ row }) {

    const [featured, setfeatured] = useState(row.original.featured == 1 ? 1 : 0)
    return (
         <label className="aiz-switch aiz-switch-success mb-0">
            <input onChange={(e) => {
                update_featured(e,row.original.id)
                if (e.target.checked) {
                    setfeatured(1)
                } else {
                    setfeatured(0)
                }
            }}  value={featured} type="checkbox" defaultChecked={row.original.featured == 1} />
            <span className="slider round"></span>
        </label>
    )
}
