import React ,{useState,useRef,useEffect} from 'react'
import { Urls } from "../urls";
import LoadingInline from "../../../helpers/LoadingInline";
import axios from "axios";
import ErrorConnection from '../../errors/error_connect';
import _ from "lodash";
import Table from "./filteringTable";
import { useDispatch} from 'react-redux';
import { setProducts } from '../../../redux/actions/ProductsActions';
import { setTranslations } from '../../../redux/actions/langsActions';
import { checkPermissions } from '../../../helpers/axiosHandle';
import { CheckRoles } from '../../../context/CheckRoles';

export default function ProductTable({search}) {

    const [goBack, setgoBack] = useState(false)
    const [loading, setloading] = useState(true)
    const [pageCount, setpageCount] = useState(0)
    const [data, setdata] = useState([])
    const [allrowsLength, setallrowsLength] = useState(0)
    const [endDataResponse, setendDataResponse] = useState(true)
    const [isLoading, setisLoading] = useState(true)
    const [errorLoad, seterrorLoad] = useState(false)
        const [categories, setcategories] = useState([])
    const [brands, setbrands] = useState([])
    const [Roles, setRoles] = useState({})

    var objectData_data = {
                startDate: new Date(2020, 12).toISOString().substring(0, 10),
                endDate: new Date().toISOString().substring(0, 10),
                name:"",
        category_id: "",
                brand_id:""

    }
  const [datat_obj, setData_obj] = useState({
                startDate: new Date(2020, 12).toISOString().substring(0, 10),
                endDate: new Date().toISOString().substring(0, 10),
                name:"",
        category_id: "",
                brand_id:""

    })
    const fetchIdRef = useRef(null)
    const dispatch = useDispatch()

   const [trans, settrans] = useState({
       "Id": "",
       "Price": "",
       "Featured": "",
       "Current Stock": "",
       "Name":"",
       "Published": "",
       "Created At": "",
       "Options": "",
       "Go to page":"",
       "Page":"",
       "to":"",
       "Desc":"",
       "Asc":"",
       "increase":"",
       "show":"",
       "Search":"",
       "All": "",
       "category name":"",
       "of": "",
       "View": "",
       "Edit": "",
       "Duplicate": "",
       "Delete": "",
       "Products": "",
       "Search Data": "",
       "Advanced Search": "",
       "Product Name": "",
       "product name": "",
       "please choose category": "",
       "please choose brand": "",
       "Brands": "",
              "Are you sure?": "",
       "remove": "",
       "not have permission": "",
       "Are you want to copy this product?": "",
       "copy": "",
       "Category": "",
       "Exclusive To Website": "",
       "Add Refurbished Product": "",
       "Refurbished Degree": "",
       "Close": "",
       "Save Changes":"",
       "Refurbished": "",
       "unRefurbished": "",
        "Forece File":""

   })

const [refurbushedDegrees, setrefurbushedDegrees] = useState([])

      const mounted = useRef(false);
    useEffect(() => {
        if (!mounted.current) {
                    get_refurbished_degrees()

            checkPermissions([15, 16, 17,18,19,20], res => {
                setRoles(res)
            })
          callTrans(trans);
        mounted.current = true;
      } else {


        // do componentDidUpdate logic
      }
    }, []);

    const handleBack = () => {
        setgoBack(false)
    }

    const loadingupdate = () => {
        setloading(true)
    }

   const  fetchData = ({ pageSize, pageIndex }) => {
        const fetchId = ++ fetchIdRef.current;
                setloading(true)

            //setLoading(true);
       if (fetchId === fetchIdRef.current) {
                         console.log("next");

            fetchAPIData({
                limit: pageSize,
                skip: pageSize * pageIndex
                ,data:datat_obj
            });
        }
   };

     const  _handleSearch = _.debounce(
         (limit, skip, data) => {
             setData_obj(prevState => ({
                 ...prevState,
                 [data.type]: data.value
             }))
             objectData_data[data.type]= data.value
            fetchAPIData({ limit, skip,data:objectData_data })
        },
        500, {
            maxWait: 500,
        }
     );

       const callTrans = (transes)=>{
                let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let  data_post = {
                    data:transes,
                    "_token": csrf_token
                }
                axios.post(Urls.static_url+"trans_data",data_post)
                    .then(res => {
                    settrans(res.data);
                      dispatch(setTranslations(res.data))
                    setisLoading(false)

                })
                .catch(err=>{

                })
}

    const get_refurbished_degrees = ()=>{

                axios.get(Urls.static_url+"get_refurbished_degrees")
                    .then(res => {
                        console.log({res:res.data});
                    setrefurbushedDegrees(res.data.data);

                })
                .catch(err=>{

                })
}

    const fetchAPIData = ({ limit, skip,data = null, advanceSearch = false }) => {

        // objectData = objectData_data;

        try {


            setloading(true)
            if (advanceSearch) {
                              setData_obj(data)
            }
            let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

           data["_token"] = csrf_token
                data["limit"] = limit
                data["skip"] = skip
            data["search"] = search;

            console.log({data});
            axios.post(Urls.static_url + `products/products_data`,data )
                .then(res => {
                    setdata(res.data.products)
                    setpageCount(res.data.counter)
                    setallrowsLength(res.data.rows)
                    dispatch(setProducts(res.data.products))
                    setcategories(res.data.categories)
                    setbrands(res.data.brands)
                    setendDataResponse(false)
                    setloading(false)
                    setgoBack(true)
                })
                .catch(err => {
                        seterrorLoad(true)
                })

        } catch (e) {
            console.log("Error while fetching", e);
            // setLoading(false)
        }
    };


     const  endData = () => {
        setendDataResponse(true)
    }
         const COLUMNS = [
                {
                    Header: trans["Id"],
                    accessor: "id",
                },
                {
                    Header: trans["Name"],
                    accessor: 'name',
             },
                {
                    Header: trans["Category"],
                    accessor: 'cat_name',
               },
                {
                    Header: trans["Price"],
                    accessor: 'price',
                },
                {
                    Header: trans["Featured"],
                    accessor: 'featured',
                },
                {
                    Header: trans["Current Stock"],
                    accessor: 'current_stock',
                },
                {
                    Header: trans["Published"],
                    accessor: 'published',
             },
                 {
                    Header: trans["Exclusive To Website"],
                    accessor: 'exclusive_to_website',
             },
                 {
                    Header: trans["Refurbished"],
                    accessor: 'refurbished',
             },
                  {
                    Header: trans["Forece File"],
                    accessor: 'force_file',
                },
                {
                    Header: trans["Created At"],
                    accessor: 'created_at',
                },
                {
                    Header: trans["Options"],
                },
            ];
    if (!errorLoad) {
        if (isLoading) {
            return (
                <div >
                    <LoadingInline />
                </div>
            )
        } else {
            return (
                <div>

                    <CheckRoles.Provider value={Roles} >

                           <Table handleBack = { handleBack }
                loadingupdate = { loadingupdate }
                pageCount = { pageCount }
                fetchData = { fetchData }
                columns = { COLUMNS }
                trans = { trans }
                data = { data }
                loading = { loading }
                _handleSearch = { _handleSearch }
                allrowsLength = { allrowsLength }
                goBack = { goBack }
                endDataResponse = { endDataResponse }
                endData = { endData }
                        fetchAPIData={fetchAPIData}
                        categories={categories}
                            brands={brands}
                            refurbushedDegrees={refurbushedDegrees}

                />
            </CheckRoles.Provider>

                </div>
            )
        }
    }else {
        return (
                      <ErrorConnection />
                )
            }
}
