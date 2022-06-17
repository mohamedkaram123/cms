import React , {useRef,useEffect,useState} from 'react'
import axios from 'axios';
import { Urls } from '../../backend/urls';
import LoadingInline from '../../../helpers/LoadingInline';
import { Modal, Button } from 'react-bootstrap';
import $, { inArray } from "jquery"
import { csrf_token } from '../../../helpers/Headers';
import SearchProcess from './bodySearch/search_process';
import SearchProducts from './bodySearch/search_products';
import LoadingCircle from '../../../helpers/LoadingCircle';

    var data_post_attrs = {};

export default function ModalSearch() {

    // const [address, setaddress] = useState([])
        const [isLoading, setisLoading] = useState(true)
    const [trans, settrans] = useState({
        "Close": "",
        "Save Changes": "",
        "Search": "",
        "please write 2 chracters at least": "",
        "Popular Searches": "",
        "Recent searches": "",
        "filter results": "",
        "categories": "",
        "brands": "",
        "colors": "",
        "prices": "",
        "reticle display": "",
        "List view": "",
        "Sort by": "",
        "please choice": "",
        "From the lowest price to the highest": "",
        "From the highest price to the lowest":""
    })
    const [show, setshow] = useState(false)
    const [loadingBtn, setloadingBtn] = useState(false)
    const [SearchType, setSearchType] = useState(1)
    const [poplur_search, setpoplur_search] = useState([])
    const [user_search, setuser_search] = useState([])
    const [LoadSearch, setLoadSearch] = useState(false)
    const [categories, setcategories] = useState([])
    const [products, setproducts] = useState([])
    const [brands, setbrands] = useState([])
    const [attributes, setattributes] = useState([])
    const [rangePrice, setrangePrice] = useState([])
const [colors, setcolors] = useState([])
    const mounted = useRef(false)
        useEffect(() => {


            if (!mounted.current) {

                // adress();
                $('#search_group').on('click', function () {
                        $(".search_overlay").removeClass("d-none")
                     $("#search_group").addClass("z-search_modal")
                    $("#header_sticky").removeClass("z-search_modal")
                    $("body").addClass("body-fixed")
                        $("#modal_search").removeClass("d-none")


                    //     setshow(true)
                });
                   $('.search_overlay').on('click', function () {
                        $(".search_overlay").addClass("d-none")
                     $("#search_group").removeClass("z-search_modal")
                       $("#header_sticky").addClass("z-search_modal")
                            $("body").removeClass("body-fixed")
                        $("#modal_search").addClass("d-none")

                    //     setshow(true)
                });


                callTrans(trans);
            mounted.current = true;
        }


        }, [])


    const handleClose = () => {
        $("#search_group").removeClass("z-search_modal")
        $("#header_sticky").addClass("sticky-top")
        $("#search").addClass("z-1")

 setshow(false)
 }
    const handleSaveChange = () => {

 }

            const  callTrans = (transes)=>{
                let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                  let data_post = {
                 data: transes,
                '_token': csrf_token
                  }


                 axios.post(Urls.static_url + 'trans_data', data_post)
                     .then(res => {
                                        settrans(res.data)

                     get_poplur_search()
                     get_user_search()
                  })
                  .catch(err => {
                   })
            }

    const get_poplur_search = () => {

                 axios.get(Urls.url + 'poplur_search')
                     .then(res => {
                     setpoplur_search(res.data)
                  })
                  .catch(err => {
                   })
    }

    const get_user_search = () => {

                 axios.get(Urls.url + 'user_search')
                     .then(res => {
                         setuser_search(res.data == "" ? [] : res.data)
                         search_query()
                                            setisLoading(false)

                  })
                  .catch(err => {
                   })
    }
    const setSearch = (val) => {
        setSearchType(val)
    }

    function delay(callback, ms) {
  var timer = 0;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}

    const search_query = () => {

        $('#search').keyup(delay(function (e) {
  if ($(this).val().length > 2) {
      setLoadSearch(true)
      fetch_search()
      console.log("done");

                    } else {

                        setSearchType(1)
                        setLoadSearch(false)
                  }
}, 500));
        //    $("#search").on("keyup", function (e) {
        //        if ($(this).val().length > 2) {
        //              setLoadSearch(true)
        //            setTimeout(() => {
        //                     console.log("send");
        //                                           fetch_search()

        //                 }, 500);
        //             } else {

        //                 setSearchType(1)
        //                 setLoadSearch(false)
        //           }
        //         })
    }

    const fetch_search = () => {

        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        data_post_attrs = {};
                        data_post_attrs["_token"] = csrf_token;
                        data_post_attrs["q"] = $("#search").val();
                          axios.post(Urls.url + 'search_react',data_post_attrs)
                              .then(res => {

                                                                    console.log({res});
                                 setproducts(res.data.products)
                                  setrangePrice([res.data.min_price,res.data.max_price])
                                  setcolors(res.data.all_colors)
                                  setcategories(res.data.cats)
                                  setbrands(res.data.brands)
                                  setattributes(res.data.attributes)
                           // setSearchType(1)
                                  setSearchType(2)

                        setLoadSearch(false)

                  })
                  .catch(err => {
                   })
    }

        const fetch_search2 = () => {
          setLoadSearch(true)
                        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


                        data_post_attrs["_token"] = csrf_token;
            data_post_attrs["q"] = $("#search").val();
                        data_post_attrs["attrs"] = attributes


                          axios.post(Urls.url + 'search_react',data_post_attrs)
                              .then(res => {
                                  console.log({res});
                                 setproducts(res.data.products)

                         setSearchType(2)
                        setLoadSearch(false)

                  })
                  .catch(err => {
                   })
    }

    const check_attr = (key, val) => {
        if (key == "price" ) {
            data_post_attrs["min_price"] = val[0];
                        data_post_attrs["max_price"] = val[1];

        } else if (key == "order_by") {
               data_post_attrs["order_by"] = val;
        } else {
             if (key in data_post_attrs) {

                if(jQuery.inArray(val,  data_post_attrs[key]) !== -1){

                 const index = data_post_attrs[key].indexOf(val);
                if (index > -1) {
                data_post_attrs[key].splice(index, 1); // 2nd parameter means remove one item only
                }
            } else {
                     data_post_attrs[key] = [...data_post_attrs[key], val];
            }

        } else {
            if (data_post_attrs[key] == undefined) {
                data_post_attrs[key] = [val];

            }

        }
        }

        fetch_search2()
    }
    return (

        <div  className="card  " style={{overflow:"scroll",maxHeight:"600px"}}>

            <div className="card-body">
                {isLoading ? <LoadingInline /> :
                    <>
                        {SearchType == 1 ?
                            <>
                                { LoadSearch?<LoadingCircle size={40} />:null}
                             <SearchProcess user_search={user_search} poplur_search={poplur_search} trans={trans} />
                            </> :
                            <SearchProducts products={products} colors={colors} rangePrice={rangePrice} check_attr={check_attr} loading={LoadSearch} attributes={attributes} brands={brands} categories={categories} trans={trans}  />
                        }
                    </>
                  }
              </div>

        </div>

    )
}
