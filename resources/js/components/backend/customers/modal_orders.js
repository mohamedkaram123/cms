import React from 'react'
import { Modal ,Button} from 'react-bootstrap';
import BodyOrders from './body_orders';
import BodyOrdersLoading from './body_orders_loading';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function ModalOrders({show,handleClose,trans,orders,isLoading,total_price}) {


    return (
      <div>

        <Modal show={show} onHide={handleClose}>
          <Modal.Header >
            <Modal.Title>{trans["Orders"]}</Modal.Title>
          </Modal.Header>

          <Modal.Body>

              {isLoading?   <div>
                        <div style={{maxHeight:300,border:'1px solid #aaa',overflow:"auto",padding:20}} >
                   {


                           [1,2,3,4].map((item , i)=>(
                            <div style={{display:"flex",justifyContent:"center",alignItems:"center"}} key={item.id} className="d-flex flex-column">
                                <BodyOrdersLoading />
                                <span ><Skeleton width={250} height={4} /></span>
                            </div>

                        ))
                   }
             </div>


             <div className="d-flex flex-row-reverse" style={{marginTop:10}}>
             <h3 >{trans["Total Price"]} : {total_price}</h3>

             </div>
                  </div> :


              <div>
                  {orders.length != 0 ?
                  <div>
                        <div style={{maxHeight:300,border:'1px solid #aaa',overflow:"auto",padding:20}} >
                   {


                           orders.map((item , i)=>(
                            <div style={{display:"flex",justifyContent:"center",alignItems:"center"}} key={item.id} className="d-flex flex-column">
                                <BodyOrders item={item} trans={trans} />
                                 {(orders.length -1 ) != i?<span style={{width:400,height:2,background:"#aaa",}}></span>: null }
                            </div>

                        ))
                   }
             </div>


             <div className="d-flex flex-row-reverse" style={{marginTop:10}}>
             <h3 >{trans["Total Price"]} : {total_price}</h3>

             </div>
                  </div>:<div>
                      <span>{trans["No Orders for this customer"]}</span>
                  </div>
                  }

             </div>

              }

          </Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={handleClose}>
              {trans["Close"]}
            </Button>

          </Modal.Footer>
        </Modal>
      </div>
    );
  }
