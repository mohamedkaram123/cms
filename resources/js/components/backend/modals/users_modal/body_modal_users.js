import React, { useEffect, useRef, useState } from 'react'
import { Urls } from '../../urls'

export default function BodyModalUser({ user,checked_all, ChooseUserArr, handleAddDataUser, handleremoveDataUser }) {

    const [CheckUser, setCheckUser] = useState(false)

const mounted = useRef(false);
    useEffect(() => {
      if (!mounted.current) {
        // do componentDidMount logic



        ChooseUserArr.forEach(element => {


            if (user.id == element.id) {

                setCheckUser(true)
            }


        });
          mounted.current = true;
      } else {

          if (checked_all) {

              setCheckUser(true)

          } else {
              setCheckUser(false)

          }

        // do componentDidUpdate logic
      }
    }, [checked_all]);

    return (
        <div >
            <div className="d-flex justify-content-between" style={{ border: "1px solid #eee", padding: 10 }}>
                <div className="p-2">
                <span className="d-flex align-items-center">
                        <img
                            src={Urls.public_url + "assets/img/avatar-place.png"}
                            className="img-fit lazyload size-60px rounded"
                        />
                        <span className="minw-0 pl-2 flex-grow-1">
                           <span className="fw-600 mb-1 text-truncate-2">
                                    {user.name}
                            </span>
                            <span className="fw-600 mb-1 text-truncate-2">
                                    {user.phone}
                            </span>

                            <span className="fw-600 mb-1 text-truncate-2">
                                    {user.email}
                            </span>
                        </span>
                </span>

                </div>
                <div className="p-2 ">
                    <div className="form-check">
                        <input checked={CheckUser} onChange={(e) => {
                            setCheckUser(e.target.checked)
                            if (e.target.checked) {
                              handleAddDataUser(user)

                            } else {
                            handleremoveDataUser(user)

                            }
                    }} className="form-check-input" type="checkbox" />
                    </div>

                </div>

            </div>
        </div>
    )
}
