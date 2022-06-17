import React, { useState } from "react";
import ReactDOM from "react-dom";

import IconButton from "@material-ui/core/IconButton";
import Paper from "@material-ui/core/Paper";
import Table from "@material-ui/core/Table";
import TableBody from "@material-ui/core/TableBody";
import TableCell from "@material-ui/core/TableCell";
import TableFooter from "@material-ui/core/TableFooter";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";

export default function CartNestedTable({item,trans,chooseCart,objectChoose,HandleOutUser}) {

    const [ShowCarts, setShowCarts] = useState(false)
    const [styleButtonCart, setStyleButtonCart] = useState({})

    return (

                     <TableBody key={item.id} >
                        <TableRow>
                          <TableCell>{item.name}</TableCell>
                          <TableCell>{item.phone}</TableCell>
                          <TableCell>{item.carts.length}</TableCell>
                          <TableCell>{item.price}</TableCell>
                          <TableCell><button style={{borderRadius:30}} onClick={()=>{
                              if(ShowCarts){
                                setShowCarts(false);

                              }else{
                                setShowCarts(true);

                              }
                          }} className="btn btn-icon btn-light">{ShowCarts?<i className="las la-angle-up"></i>:<i className="las la-angle-down"></i>}</button> </TableCell>
                         <TableCell><button onClick={()=>{
                         HandleOutUser(item)

                         }}  style={objectChoose[item.id]?chooseCart:null} className="btn btn-icon btn-light"><i className="las la-shopping-cart"></i></button></TableCell>
                        </TableRow>

                        {ShowCarts?
                            <TableRow >
                            <TableCell colSpan={3}>
                            <Table style={{
                                    border:"1px solid #aaa",
                                    boxShadow: "1px 3px 1px #9E9E9E"

                                }}>
                                <TableHead style={{
                                    background:"#FF6900",


                                }}>
                                <TableRow >
                                    <TableCell style={{
                                     fontWeight:'bold',
                                     color:"#fff",
                                }}>{trans["Product Name"]}</TableCell>
                                    <TableCell style={{
                                     fontWeight:'bold',
                                     color:"#fff",
                                }}>{trans["Product Price"]}</TableCell>
                                    <TableCell style={{
                                     fontWeight:'bold',
                                     color:"#fff",
                                }}>{trans["Product Color"]}</TableCell>
                                </TableRow>
                                </TableHead>
                                <TableBody  >

                        {item.carts.map(cart=>
                        (
                                <TableRow key={cart.id}>
                                    <TableCell>{cart.product_name}</TableCell>
                                    <TableCell>{(cart.price + cart.tax + cart.shipping_cost) * cart.quantity}</TableCell>
                                    <TableCell>{cart.variation}</TableCell>
                                </TableRow>
                                ))}
                                </TableBody>
                            </Table>
                            </TableCell>
                        </TableRow>:null}
                      </TableBody>



    );

}

