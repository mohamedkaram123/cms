
import React,{useState} from 'react'
export default function Exclusive({ row }) {

    const [exclusiveToWebsite, setexclusiveToWebsite] = useState(row.original.exclusive_to_website == 1 ? 1 : 0)
    return (
         <label className="aiz-switch aiz-switch-success mb-0">
            <input onChange={(e) => {
                update_exclusiveToWebsite(e,row.original.id)
                if (e.target.checked) {
                    setexclusiveToWebsite(1)
                } else {
                    setexclusiveToWebsite(0)
                }
            }}  value={exclusiveToWebsite} type="checkbox" defaultChecked={row.original.exclusive_to_website == 1} />
            <span className="slider round"></span>
        </label>
    )
}

