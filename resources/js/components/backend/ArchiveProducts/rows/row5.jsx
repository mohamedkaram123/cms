import React,{useState} from 'react'
export default function Row5({ row }) {

    const [published, setpublished] = useState(row.original.published == 1 ? 1 : 0)
    return (
         <label className="aiz-switch aiz-switch-success mb-0">
            <input onChange={(e) => {
                update_published(e,row.original.id)
                if (e.target.checked) {
                    setpublished(1)
                } else {
                    setpublished(0)
                }
            }}  value={published} type="checkbox" defaultChecked={row.original.published == 1} />
            <span className="slider round"></span>
        </label>
    )
}
