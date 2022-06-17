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

export default function ArchiveProductTable({search}) {

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
       "ProductS Archive": "",
                   "Are you sure from return the product?": "",
       "return": "",
       "cancel":""

   })


      const mounted = useRef(false);
    useEffect(() => {
        if (!mounted.current) {
    checkPermissions([5], res => {
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
            fetchAPIData({
                limit: pageSize,
                skip: pageSize * pageIndex,
            });
        }
   };

     const  _handleSearch = _.debounce(
         (limit, skip, data) => {

             objectData_data[data.type]= data.value
            fetchAPIData({ limit, skip })
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
                .then(res=>{
                    settrans(res.data);
                      dispatch(setTranslations(res.data))
                    setisLoading(false)

                })
                .catch(err=>{

                })
}



    const fetchAPIData = ({ limit, skip,data = null, advanceSearch = false }) => {

        // objectData = objectData_data;
        try {


            setloading(true)
            console.log({objectData_data});
            if (advanceSearch) {
                objectData_data = data
            }
            let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

           objectData_data["_token"] = csrf_token
                objectData_data["limit"] = limit
                objectData_data["skip"] = skip
            objectData_data["search"] = search;

            axios.post(Urls.static_url + `products/products_data_archive`,objectData_data )
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
                    Header: trans["Price"],
                    accessor: 'price',
                },
                {
                    Header: trans["Current Stock"],
                    accessor: 'current_stock',
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
