import React , {useState} from 'react'
import ModalLogin from './modal_login'
export default function BtnLogin() {

    const [show, setshow] = useState(false)

    const showModal = () => {
        setshow(true);
    }

    const handleClose = () => {
                setshow(false);

    }
    return (
        <div>
            <button className="btn btn-primary fw-600" onClick={showModal} >dssdsd  jdks</button>

            <div>
                <ModalLogin show={show} handleClose={handleClose} />
            </div>
        </div>
    )
}
