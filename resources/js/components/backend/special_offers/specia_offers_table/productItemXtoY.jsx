import React, { useEffect, useRef, useState } from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import swal from "sweetalert";
import axios from "axios";
import { Urls } from '../../urls'

export default function ProductItemXtoY({ item, trans,show,CallSpecialOffers }) {

    const [ObjectFrom, setObjectFrom] = useState({
        photo: "",
        name: "",
        count:0
    })
   const [ObjectTo, setObjectTo] = useState({
        photo: "",
        name: "",
        count:0
    })

    const [ContentSpecialOffer, setContentSpecialOffer] = useState("")
    const [isLoading, setisLoading] = useState(true)

    const image_from = () => {

        item.special_offer_product.forEach(element => {

            if (element.type == "category" && element.type_x_to_y == "from") {

                setObjectFrom({
                    photo: element.category.banner,
                    name: element.category.name,
                     count : item.special_offer_xto_y.customer_qty_buy,
            })
            } else if (element.type == "product" && element.type_x_to_y == "from") {

                         setObjectFrom({
                    photo: element.product.photos,
                    name: element.product.name,
                     count : item.special_offer_xto_y.customer_qty_buy,
            })

        }
        });
    }


        const image_to = () => {

        item.special_offer_product.forEach(element => {

            if (element.type == "category" && element.type_x_to_y == "to") {

                       setObjectTo({
                    photo: element.category.banner,
                    name: element.category.name,
                     count : item.special_offer_xto_y.customer_qty_get,
                       })

            } else if (element.type == "product" && element.type_x_to_y == "to") {

             setObjectTo({
                    photo: element.product.photos,
                    name: element.product.name,
                     count : item.special_offer_xto_y.customer_qty_get,
            })

        }
        });

    }


     const mounted = useRef(false);
    useEffect(() => {
        if (!mounted.current) {
            image_from()
            image_to()

            mounted.current = true;
        } else {

                          var title_trans = trans["If you buy a number_var_x of product_var_x, you get a number_var_y of product_var_y"];
            var title = title_trans.replace("number_var_x",ObjectFrom.count );
              var title1 =  title.replace("product_var_x",ObjectFrom.name );
         var title2 =  title1.replace("number_var_y",ObjectTo.count );
          var title3 =  title2.replace("product_var_y", ObjectTo.name);
            setContentSpecialOffer(title3)
            setisLoading(false)
         }
    },[ObjectFrom,setObjectTo])

const swalRemove = (id) => {


 swal({
  title: trans["Are you sure?"],
  text: trans["Once deleted, you will not be able to recover this imaginary data!"],
  icon: "warning",
  buttons: trans["remove"],
     dangerMode: true,


})
.then((willDelete) => {
    if (willDelete) {

        axios.get(Urls.static_url + `spcialOffer/destroy/${id}`)
            .then(res => {
                CallSpecialOffers()
            //    deleteData(res.data.order)
            })
            .catch(err => {
            console.log({err});
        })


  }
});
    }
    if (isLoading) {
            return (
                <div>
                                <SkeletonTheme color="#fff"  highlightColor="#eee" >

            <div className="carousel-box">

                    <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                    <div className="card-header">
                        <h6>{ item.offer_title}</h6>
                             </div>
                            <Skeleton style={{height:200}} />
                            <div className="card-body">
                        <p className="card-text" style={{color:"#aaa",fontSize:12,fontWeight:600}}><Skeleton width={200} height={15} /></p>

                            </div>
                            <Skeleton style={{height:200}} />



                    </div>
                        </div>
                        </SkeletonTheme>
        </div>

    )
    } else {
            return (
        <div>
            <div className="carousel-box">

                    <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                    <div className="card-header">
                                <h6>{item.offer_title}</h6>

                                <div className="d-flex flex-row">
                                      <button style={{marginInline:10}} onClick={() => {
                                    swalRemove(item.id)
                                }} className="btn btn-icon"><i style={{color:"#dc3545"}} className="las la-trash"></i></button>

                                 <button onClick={() => {
                                    show(item)
                                }} className="btn btn-icon"><i style={{color:"#007bff"}} className="las la-eye"></i></button>

                                </div>

                             </div>
                            <img className="card-img-top" src={ObjectFrom.photo}  alt="Card image top" style={{height:200}} />
                            <div className="card-body">
                        <p className="card-text" style={{color:"#aaa",fontSize:12,fontWeight:600}}>{ ContentSpecialOffer}</p>

                            </div>
                            <img className="card-img-bottom" src={ObjectTo.photo} alt="Card image top" style={{height:200}} />



                    </div>
            </div>
        </div>

    )
    }

}
