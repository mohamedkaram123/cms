import React,{useContext} from 'react'
import Row1 from './row1'
import Row3 from './row3'
import Row5 from './row5'
import Row7 from './row7'
import Exclusive from './Exclusive';
import { CheckRoles } from '../../../../context/CheckRoles'
import Refurbished from './Refurbished'
import ForceFile from './ForceFile'
export default function MainRows({ i, cell, row, swalRemove,swalduplicate, trans,openModalAddRefurbished }) {
      const Roles = useContext(CheckRoles);

    switch (i) {
        case 1:

       return (
           <td key={i} {...cell.getCellProps()}>{
               <Row1 row={row} />
        }</td>
    )


           case  4:
            return (
                        <td key={i} {...cell.getCellProps()}>{
                           Roles[19]?<Row3 row={row} />:trans["not have permission"]
                        }</td>
            )
        case 6:
            return (
                        <td key={i} {...cell.getCellProps()}>{
                             Roles[18]?<Row5 row={row} />:trans["not have permission"]
                        }</td>
            )
           case 7:
            return (
                        <td key={i} {...cell.getCellProps()}>{
                            Roles[20]?<Exclusive row={row} />:trans["not have permission"]
                        }</td>
            )
        case 8:
            return (
                        <td key={i} {...cell.getCellProps()}>{
                            Roles[15]?<Refurbished row={row} trans={trans} />:trans["not have permission"]
                        }</td>
                    )
                      case 9:
            return (
                        <td key={i} {...cell.getCellProps()}>{
                           <ForceFile row={row} trans={trans} />
                        }</td>
                    )
        case 11:
            return (
                        <td key={i} {...cell.getCellProps()}>{
                            <Row7 openModalAddRefurbished={openModalAddRefurbished} swalduplicate={swalduplicate} swalRemove={swalRemove} trans={trans} row={row} />
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
