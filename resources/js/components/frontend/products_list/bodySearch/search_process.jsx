import React from 'react'

export default function SearchProcess({ trans, poplur_search, user_search }) {
    const sendData = (val) => {
        console.log({val});
        $("#search").val(val);
         $("#search").text(val);
        $(".stop-propagation").submit()

    }
  return (
      <div className='d-flex flex-column'>
          <span className='main-title-search'>{ trans["please write 2 chracters at least"]}</span>
          <div className="d-flex flex-column my-4">
              <span className='title-search'>{trans["Recent searches"]}</span>
              <div className="d-flex flex-md-row flex-column my-2">
                  {
                    user_search.map((item, i) => {
                          if (i < 3) {
                             return (

                      <button key={i} onClick={()=>{sendData(item)}} className='btn-login_data mx-md-1 my-1'>
                          <span className='mx-1'>{item}</span>
                      <i className="la la-search la-flip-horizontal nav-box-icon"></i>
                      </button>
                  )
                          } else {
                              return null;
                          }
                      })
              }
              </div>

          </div>
          <div className="d-flex flex-column y-4">
              <span className='title-search'>{trans["Popular Searches"]}</span>
              <div className="d-flex flex-md-row flex-column my-2">
                  {
                      poplur_search.map((item, i) => {
                          if (i < 5) {
                             return (

                      <button key={i} onClick={()=>{sendData(item)}} className='btn-login_data mx-md-1 my-1'>
                          <span className='mx-1'>{item}</span>
                      <i className="la la-search la-flip-horizontal nav-box-icon"></i>
                      </button>
                  )
                          } else {
                              return null;
                          }
                      })
              }
              </div>

          </div>
    </div>
  )
}
