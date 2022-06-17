import React from 'react'
import { Modal ,Button} from 'react-bootstrap';

export default function ModalRefundReason({show,handleClose,trans,reason}) {


    return (
      <div>

        <Modal show={show} onHide={handleClose}>
          <Modal.Header >
            <Modal.Title>{trans["Refund Reason"]}</Modal.Title>
          </Modal.Header>

          <Modal.Body>
              <div>
                  <p>{reason}</p>
              </div>
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
