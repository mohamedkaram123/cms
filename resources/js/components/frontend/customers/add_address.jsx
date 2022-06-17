import React ,{useState} from 'react'
import AddAddressModal from './add_address_modal';
export default function AddAddress() {

    const [show, setshow] = useState(false)
    const handleClose = () => {
        setshow(false);
    }

    const handleSaveChange = () => {
window.location.reload();
    }
    return (
        <div>
            <button onClick={() => {
                setshow(true)
            }} className="btn btn-icon btn-primary">
                <i className="las la-plus"></i>
            </button>

            <div>
                <AddAddressModal show={show} handleClose={handleClose} handleSaveChange={handleSaveChange} />
            </div>
        </div>
    )
}
