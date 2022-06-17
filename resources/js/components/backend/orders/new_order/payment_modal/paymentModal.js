import { Modal , Button} from 'react-bootstrap'
import React, { useState } from 'react'
import { Urls } from '../../../urls';

export default function PaymentModal({trans,show,handleClose,paymenyValue}) {

    const [FawryImg, setFawryImg] = useState(Urls.public_url + "assets/img/cards/fawry.png");
    const [TapPayment, setTapPaymentImg] = useState(Urls.public_url +"assets/img/cards/tappayment.png");
    const [PayTabImg, setPayTabImg] = useState(Urls.public_url +"assets/img/cards/Paytabs.jpeg");
    const [CashDelivery, setCashDeliveryImg] = useState(Urls.public_url +"assets/img/cards/cod.png");

    return (
        <div>

<Modal size="lg" show={show} onHide={handleClose}>
                <Modal.Header closeButton>
                <Modal.Title>{trans["Payment Method"]}</Modal.Title>

                </Modal.Header>
                <Modal.Body>
                     <div className="row">
                         <div className="col-4">
                            <label className="aiz-megabox d-block mb-3">
                                <input onClick={paymenyValue.bind(this,"fawry",FawryImg)} value="fawry" className="online_payment" type="radio" name="payment_option"  />
                                <span className="d-block p-3 aiz-megabox-elem">
                                    <img src={Urls.public_url +  "assets/img/cards/fawry.png"} className="img-fluid mb-2" />
                                    <span className="d-block text-center">
                                        <span className="d-block fw-600 fs-15">{ trans['Fawry']}</span>
                                    </span>
                                </span>
                            </label>
                          </div>
                          <div className="col-6 col-md-4">
                             <label className="aiz-megabox d-block mb-3">
                                <input onClick={paymenyValue.bind(this,"tappayment",TapPayment)} value="tappayment" className="online_payment" type="radio" name="payment_option" />
                                <span className="d-block p-3 aiz-megabox-elem">
                                <img src={ Urls.public_url + "assets/img/cards/tappayment.png"} className="img-fluid mb-2" />
                                <span className="d-block text-center">
                               <span className="d-block fw-600 fs-15">{ trans['TapPayment']}</span>
                               </span>
                             </span>
                           </label>
                        </div>

                        <div className="col-6 col-md-4">

                        <div className="row">
                            <label className="aiz-megabox d-inline " style={{marginInline:40}}>
                                <input onClick={paymenyValue.bind(this,"paytabegypt",PayTabImg)} value="paytabegypt" className="online_payment" type="radio" name="payment_option" />
                                <span className="d-block aiz-megabox-elem" >
                                <img src={ Urls.public_url + "assets/img/flags/eg.svg"} style={{width: 40,height: 20}} />

                            </span>
                            </label>


                            <label className="aiz-megabox d-inline ">
                                <input onClick={paymenyValue.bind(this,"paytabsaudi",PayTabImg)} value="paytabsaudi" className="online_payment" type="radio" name="payment_option" />
                                <span className="d-block aiz-megabox-elem" >
                                <img src={ Urls.public_url + "assets/img/flags/sa.svg"} style={{width: 40,height: 20}} />

                            </span>
                            </label>

                        </div>

                        <label className="aiz-megabox d-block " >
                            <span className="d-block aiz-megabox-elem" style={{padding: 10}}>
                            <img src={ Urls.public_url + "assets/img/cards/Paytabs.jpeg"} className="img-fluid mb-2" />

                        </span>
                        </label>
                        </div>

                        <div className="col-6 col-md-4">
                             <label className="aiz-megabox d-block mb-3">
                                    <input onClick={paymenyValue.bind(this,"cash_on_delivery",CashDelivery)} value="cash_on_delivery" className="online_payment" type="radio" name="payment_option" />
                                     <span className="d-block p-3 aiz-megabox-elem">
                                            <img src={Urls.public_url +  "assets/img/cards/cod.png"} className="img-fluid mb-2" />
                                      <span className="d-block text-center">
                                       <span className="d-block fw-600 fs-15">{ trans['Cash on Delivery']}</span>
                                        </span>
                                        </span>
                            </label>
                        </div>



                     </div>

                </Modal.Body>
                <Modal.Footer>
                  <Button variant="secondary" onClick={handleClose}>
                    Close
                  </Button>
                  <Button variant="primary" onClick={handleClose}>
                    Save Changes
                  </Button>
                </Modal.Footer>
              </Modal>
                 </div>
    )
}
