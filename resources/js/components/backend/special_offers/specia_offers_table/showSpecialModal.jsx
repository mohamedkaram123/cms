import React , {useRef,useEffect,useState} from 'react'
import axios from 'axios';
import { Urls } from "../../../backend/urls";
import LoadingInline from '../../../../helpers/LoadingInline';
import { Modal ,Button} from 'react-bootstrap';
import { csrf_token } from '../../../../helpers/Headers';
export default function ShowSpecialModal({handleClose,show,offer,trans}) {

    // const [address, setaddress] = useState([])
        const [isLoading, setisLoading] = useState(true)

    const mounted = useRef(false)
        useEffect(() => {

            if (!mounted.current) {
                // adress();
            mounted.current = true;
        }


    }, [])

    return (
          <Modal  size="md" show={show} onHide={handleClose}>
{/*
{isLoading?<LoadingInline />: */}

                <div>

                <Modal.Header closeButton>
                <Modal.Title>{trans["Special Offer"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>
                    <table className="table table-striped  text-center " >
                        <tbody>
                            <tr>
                            <td style={{ padding: 0 }}>{trans["offer title"] }</td>
                            <td style={{ padding: 0 }} >{ offer.offer_title}</td>
                            </tr>
                            <tr>
                            <td style={{ padding: 0 }} >{ trans["offer start date"]}</td>
                                <td style={{padding:0}} >{ (offer.created_at).slice(0,10)}</td>
                            </tr>
                            <tr>
                                <td style={{padding:0}}>{ trans["offer end date"]}</td>
                                <td style={{padding:0}} >{ (offer.end_date).slice(0,10)}</td>
                            </tr>
                                <tr>
                                <td style={{padding:0}} >{ trans["offer type"]}</td>
                                <td style={{padding:0}} >{ trans[offer.offer_type]}</td>
                            </tr>

                        </tbody>

                        </table>


                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={handleClose}>

                    {trans["Close"]}
                  </Button>

                </Modal.Footer>
                </div>
            {/*}*/}
              </Modal>
    )
}
