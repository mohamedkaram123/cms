
import React,{useState} from 'react'
export default function ForceFile({ row }) {

    const [ForceFiledata, setForceFile] = useState(row.original.force_file == 1 ? 1 : 0)
    return (
         <label className="aiz-switch aiz-switch-success mb-0">
            <input onChange={(e) => {
                update_force_file(e,row.original.id)
                if (e.target.checked) {
                    setForceFile(1)
                } else {
                    setForceFile(0)
                }
            }}  value={ForceFiledata} type="checkbox" defaultChecked={row.original.force_file == 1} />
            <span className="slider round"></span>
        </label>
    )
}

