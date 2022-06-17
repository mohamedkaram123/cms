import React from 'react'
import Row1 from './row1'
import Row3 from './row3'
import Row5 from './row5'
import Row7 from './row7'

export default function MainRows({ i,swalRemove, cell,row ,trans}) {
    switch (i) {
        case 1:

       return (
           <td key={i} {...cell.getCellProps()}>{
               <Row1 row={row} />
        }</td>
    )


        case 5:
            return (
                        <td key={i} {...cell.getCellProps()}>{
                            <Row7 swalRemove={swalRemove} trans={trans} row={row} />
                        }</td>
                    )
        default:
               return (
        <td key={i} {...cell.getCellProps()}>{
            cell.render("Cell")
        }</td>
    )
    }


}
