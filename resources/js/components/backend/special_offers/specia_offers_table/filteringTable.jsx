
import { matchSorter } from "match-sorter";
import React, { useState } from "react";
import  { useTable,useGlobalFilter,useFilters , usePagination} from "react-table";
import { Urls } from "../../urls";
import {
    BrowserRouter as Router,

    Link
  } from "react-router-dom";

import GlobalFilter from "./filters/GlobalFilter";
import FiltersQuery from "./filtersQuery";
import FooterTable from "./footerTable";
import LoadingInline from "./LoadingInline";
import ProductItemXtoY from "./productItemXtoY";
import ProductCustomerPurches from "./productCustomerPurches";
import ShowSpecialModal from "./showSpecialModal";
// import LoadingInline from "./LoadingInline";
// import UserProfile from "./UserProfile";
// import ViewCart from "./view_cart";

export default function Table({ columns, data , trans , globalFilter,setGlobalFilter,CallSpecialOffers,footerPaginate,togglePginate,paginateLoading}) {


    const filterTypes = React.useMemo(
        () => ({
            // Add a new fuzzyTextFilterFn filter type.
            fuzzyText: fuzzyTextFilterFn,
            dateBetween: dateBetweenFilterFn,   /*<- LIKE THIS*/
            text: (rows, id, filterValue) => {
                return rows.filter(row => {
                    const rowValue = row.values[id];
                    return rowValue !== undefined
                        ? String(rowValue)
                            .toLowerCase()
                            .startsWith(String(filterValue).toLowerCase())
                        : true;
                });
            }
        }),
        []
    );




    const divStyle = {
        height:10,
        width:15,
        display:"flex",
        justifyContent:"center",
        alignItems:"center",
        marginInline:5,
        background:"#fd7e14",
        color:"#fff"
      };

const [show, setshow] = useState(false)
    const [offer, setoffer] = useState({
        offer_title:"",
        offer_type:"",
        created_at:"",
        end_date:""
})


const showModal = (item)=>{
    setoffer(item)
setshow(true)
}

const handleClose = ()=>{
setshow(false)

}



    return (
        <>
        <div className="card">
            <div  className="card-header">


                <h1> <i className="las la-shopping-bag"></i> {trans["SpecialOffers"]} </h1>
           <div className="d-flex flex-row" style={{alignItems:"flex-end"}}>

               <div className="p-2">
               <GlobalFilter  trans={trans} filter={globalFilter} setFilter={setGlobalFilter}  />

               </div>


                        <div className="p-2">
                            <a href={Urls.static_url + "sapecialOffers/new_spcial_offers"}>
                                <button className="btn btn-primary">
                                    {trans["New Special Offer"]}
                                </button>
                            </a>
                        </div>

           </div>

            </div>
                <div className="card-body">
                    <div className="row"   >
                        {data.length == 0 ?

                            <div className="d-flex w-100 p-4" style={{justifyContent:'center'}}>
                               <h3>{ trans["not found any data"]}</h3>

                            </div>
                            :data.map(item => {


                                if (item.offer_type == "x_to_y") {
                                return(
                            <div  className="col-6" style={{marginBlock:10}}  key={item.id}>
                                        <ProductItemXtoY CallSpecialOffers={CallSpecialOffers} show={showModal} trans={trans} item={item} />
                                        <div>
                                        </div>
                            </div>
                        )
                                } else if (item.offer_type == "amount" || item.offer_type == "percent"){
                                          return(
                            <div  className="col-6" style={{marginBlock:10}}  key={item.id}>
                                <ProductCustomerPurches CallSpecialOffers={CallSpecialOffers} show={showModal} trans={trans} item={item} />

                            </div>
                        )

                            }
                        })
                    }
                    </div>


            </div>
                   <div>
                                    <ShowSpecialModal  show={show} offer={offer} handleClose={handleClose} trans={trans} />
                                </div>
        </div>
        </>
          );
  }


  function dateBetweenFilterFn(rows, id, filterValues) {
    let sd = filterValues[0] ? new Date(filterValues[0]) : undefined
    let ed = filterValues[1] ? new Date(filterValues[1]) : undefined

    if (ed || sd) {
      return rows.filter(r => {
        var time = new Date(r.values[id])

        if (ed && sd) {
          return (time >= sd && time <= ed)
        } else if (sd){
          return (time >= sd)
        } else if (ed){
          return (time <= ed)
        }
      })
    } else {
      return rows
    }
  }

dateBetweenFilterFn.autoRemove = val => !val;



function fuzzyTextFilterFn(rows, id, filterValue) {
    return matchSorter(rows, filterValue, { keys: [row => row.values[id]] })
  }

  // Let the table remove the filter if the string is empty
  fuzzyTextFilterFn.autoRemove = val => !val


