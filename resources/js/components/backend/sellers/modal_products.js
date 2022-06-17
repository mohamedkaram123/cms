import React from 'react'
import { Modal ,Button} from 'react-bootstrap';
import BodyProducts from './body_products';
import BodyOrdersLoading from './body_orders_loading';
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'

export default function ModalProduct({show,handleClose,trans,orders,isLoading,total_price}) {


    return (
      <div>

         <Modal size="lg" show={show} onHide={handleClose}>
          <Modal.Header >
            <Modal.Title>{trans["Products"]}</Modal.Title>
          </Modal.Header>

          <Modal.Body>

              {isLoading?   <div>
                        <div style={{maxHeight:300,overflow:"auto",padding:20}} >
                   {


                           [1,2,3,4].map((item , i)=>(

                            <div  key={i} className="d-flex flex-column">
                                                        <SkeletonTheme color="#fff"  highlightColor="#eee" >

                                <BodyOrdersLoading />
                                <span ><div style={{display:"flex",justifyContent:"center",alignItems:"center",marginBlock:20}}><span><Skeleton width={600} height={4}/></span></div></span>
                            </SkeletonTheme>
                            </div>

                        ))
                   }
             </div>



                  </div> :


              <div>
                  {orders.length != 0 ?
                  <div>
                        <div style={{maxHeight:300,overflow:"auto",padding:20}} >
                   {


                           orders.map((item , i)=>(
                            <div  key={item.id} className="d-flex flex-column">
                                <BodyProducts product={item} trans={trans} />
                                 {(orders.length -1 ) != i?<div style={{display:"flex",justifyContent:"center",alignItems:"center",marginBlock:20}}><span style={{width:"90%",height:2,background:"#aaa"}}></span></div>: null }
                            </div>

                        ))
                   }
             </div>



                  </div>:<div>
                      <span >{trans["No Products for this seller"]}</span>
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
