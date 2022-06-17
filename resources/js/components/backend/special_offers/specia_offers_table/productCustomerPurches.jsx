import React, { useEffect, useRef, useState } from 'react'
import Skeleton, { SkeletonTheme } from 'react-loading-skeleton'
import { Urls } from '../../urls'
import swal from "sweetalert";
import axios from "axios";
import ShowSpecialModal from './showSpecialModal';

export default function ProductCustomerPurches({ item,CallSpecialOffers, trans,show }) {


    const [ColumnsArray, setColumnsArray] = useState([])
    const [ColumnsArrayCategory, setColumnsArrayCategory] = useState([])
    const [ContentSpecialOffer, setContentSpecialOffer] = useState("")
    const [isLoading, setisLoading] = useState(true)

const  array_columns_images = () => {
        switch(item.special_offer_product.length) {
  case 1:
    setColumnsArray([12])
    break;
  case 2:
   setColumnsArray([6, 6])
       break;
  case 3:
    setColumnsArray([12,8, 4])
        break;
   case 4:
    setColumnsArray([6, 6,6,6])
        break;
   case 5:
    setColumnsArray([6, 6,4,4,4])
        break;
    case 6:
    setColumnsArray([4,4,4,4,4,4])
        break;
    case 7:
    setColumnsArray([6,3,3,3,3,3,3])
        break;
    case 8:
    setColumnsArray([3,3,3,3,3,3,3,3])
        break;
    case 9:
    setColumnsArray([4, 4,4,2,2,2,2,2,2])
        break;
    case 10:
    setColumnsArray([4,4,2,2,2,2,2,2,2,2])
    break;
  default:

    setColumnsArray([4,4,2,2,2,2,2,2,2,2])
}
}



    const  array_columns_images_categores = () => {
        switch(item.special_offer_product.length) {
  case 1:
    setColumnsArrayCategory([12])
    break;
  case 2:
   setColumnsArrayCategory([12, 12])
       break;
  case 3:
    setColumnsArrayCategory([12,8, 4])
        break;
   case 4:
    setColumnsArrayCategory([6, 6,6,6])
        break;

  default:

    setColumnsArray([6, 6,6,6])
}
}


    const makeContentspeciaOffersCustomerPurches = () => {

        let type_special_offer = [trans["All products in Cart"], trans["Products"], trans["Categories"], trans["Payments"]];

        if (item.special_offer_customer_purches.type_discount == "percent" && item.special_offer_customer_purches.min_type == "quantity") {

                        var title_trans = trans["If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count"];
            var title = title_trans.replace("var_type",type_special_offer[item.special_offer_customer_purches.offer_applies_type - 1] );
              var title1 =  title.replace("var_discount_perceent",item.special_offer_customer_purches.discount );
         var title2 =  title1.replace("var_max_price_discount",item.special_offer_customer_purches.maximum_discount  );
                var title3 =  title2.replace("var_count",item.special_offer_customer_purches.min_qty  );

            setContentSpecialOffer(title3)

        }else if (item.special_offer_customer_purches.type_discount == "amount" && item.special_offer_customer_purches.min_type == "quantity") {

         var title_trans = trans["If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count"];
            var title = title_trans.replace("var_type",type_special_offer[item.special_offer_customer_purches.offer_applies_type - 1] );
              var title1 =  title.replace("var_discount",item.special_offer_customer_purches.discount );
         var title2 =  title1.replace("var_count",item.special_offer_customer_purches.min_qty  );

            setContentSpecialOffer(title2)

        }else if (item.special_offer_customer_purches.type_discount == "percent" && item.special_offer_customer_purches.min_type == "price") {
                    var title_trans = trans["If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price"];
            var title = title_trans.replace("var_type",type_special_offer[item.special_offer_customer_purches.offer_applies_type - 1] );
              var title1 =  title.replace("var_discount_perceent",item.special_offer_customer_purches.discount );
         var title2 =  title1.replace("var_max_price_discount",item.special_offer_customer_purches.maximum_discount  );
                var title3 =  title2.replace("var_price",item.special_offer_customer_purches.min_price  );

            setContentSpecialOffer(title3)
        }else if (item.special_offer_customer_purches.type_discount == "amount" && item.special_offer_customer_purches.min_type == "price") {


         var title_trans = trans["If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price"];
            var title = title_trans.replace("var_type",type_special_offer[item.special_offer_customer_purches.offer_applies_type - 1] );
              var title1 =  title.replace("var_discount",item.special_offer_customer_purches.discount );
         var title2 =  title1.replace("var_price",item.special_offer_customer_purches.min_price  );

            setContentSpecialOffer(title2)

        }
setisLoading(false)
 }

     const mounted = useRef(false);
    useEffect(() => {
        if (!mounted.current) {
            makeContentspeciaOffersCustomerPurches()
            array_columns_images()
            array_columns_images_categores()
            mounted.current = true;
        } else {

        //                   var title_trans = trans["If you buy a number_var_x of product_var_x, you get a number_var_y of product_var_y"];
        //     var title = title_trans.replace("number_var_x",ObjectFrom.count );
        //       var title1 =  title.replace("product_var_x",ObjectFrom.name );
        //  var title2 =  title1.replace("number_var_y",ObjectTo.count );
        //   var title3 =  title2.replace("product_var_y", ObjectTo.name);
        //     setContentSpecialOffer(title3)
         }
    })
//  console.log({ObjectTo});
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
                        {/* <img className="card-img-top" src="https://source.unsplash.com/daily" alt="Card image top" /> */}
                      <div className="card-header">
                        <h6>{ item.offer_title}</h6>
                             </div>
                    <div className="card-body">
                        <div className="row">


                            <div className="col-12" >
                                        <Skeleton width="100%" height={ 350} />
                            </div>



                        </div>

                    </div>
                    <div className="card-footer">
                            <p className="card-text" style={{color:"#aaa",fontSize:12,fontWeight:600}}><Skeleton width={200} height={15} /></p>
                    </div>
                    </div>
                    </div>
                    </SkeletonTheme>
        </div>


        )

    } else {
          if (item.special_offer_customer_purches.offer_applies_type == 1) {
            return (
        <div>
            <div className="carousel-box">

                    <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        {/* <img className="card-img-top" src="https://source.unsplash.com/daily" alt="Card image top" /> */}
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
                    <div className="card-body">
                        <div className="row">


                            <div className="col-12" >
                                        <img src={Urls.public_url +"assets/img/sala.png"} className="img-thumbnail" style={{height:350,width:"100%"}} />
                            </div>


                        </div>

                    </div>
                    <div className="card-footer">
                            <p className="card-text" style={{color:"#aaa",fontSize:12,fontWeight:600}}>{ ContentSpecialOffer}</p>
                    </div>
                    </div>
            </div>


        </div>


    )
    } else if (item.special_offer_customer_purches.offer_applies_type == 2) {
            return (
        <div>
            <div className="carousel-box">

                    <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        {/* <img className="card-img-top" src="https://source.unsplash.com/daily" alt="Card image top" /> */}
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
                    <div className="card-body">
                        <div className="row">
                        {ColumnsArray.map((col,i) => (

                            <div key={i} className={"col-" + col} >
                                        <img src={item.special_offer_product[i].product.photos} className="img-thumbnail" style={{height:350,width:"100%"}} />
                            </div>


                        ))}
                        </div>

                    </div>
                    <div className="card-footer">
                                   <p className="card-text" style={{color:"#aaa",fontSize:12,fontWeight:600}}>{ ContentSpecialOffer}</p>

                    </div>
                    </div>
            </div>
        </div>

    )
    } else if (item.special_offer_customer_purches.offer_applies_type == 3) {
            return (
        <div>
            <div className="carousel-box">

                    <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        {/* <img className="card-img-top" src="https://source.unsplash.com/daily" alt="Card image top" /> */}
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
                    <div className="card-body">
                        <div className="row">
                        {ColumnsArrayCategory.map((col,i) => (

                            <div  key={i}  className={"col-" + col} >
                                        <img src={item.special_offer_product[i].category.banner} className="img-thumbnail" style={{height:250,width:"100%"}}  />
                            </div>


                        ))}
                        </div>

                    </div>
                    <div className="card-footer">
                                       <p className="card-text" style={{color:"#aaa",fontSize:12,fontWeight:600}}>{ ContentSpecialOffer}</p>

                    </div>
                    </div>
            </div>
        </div>

    )
    }else if (item.special_offer_customer_purches.offer_applies_type == 4) {
            return (
        <div>
            <div className="carousel-box">

                    <div className="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        {/* <img className="card-img-top" src="https://source.unsplash.com/daily" alt="Card image top" /> */}
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
                    <div className="card-body">
                        <div className="row">
                        {ColumnsArrayCategory.map((col,i) => (

                            <div  key={i}  className={"col-" + col} >
                                <img src={ Urls.public_url+ "assets/img/cards/"+item.special_offer_product[i].object_name + ".png"} className="img-thumbnail" style={{height:250,width:"100%"}}  />
                            </div>


                        ))}
                        </div>

                    </div>
                    <div className="card-footer">
                                       <p className="card-text" style={{color:"#aaa",fontSize:12,fontWeight:600}}>{ ContentSpecialOffer}</p>

                    </div>
                    </div>
            </div>
        </div>

    )
    }

    }


}
