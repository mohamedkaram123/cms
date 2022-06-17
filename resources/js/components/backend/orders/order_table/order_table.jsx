import axios from "axios";
import React, { Component} from "react";
import Table from "./filteringTable";
import { Urls } from "../../urls";
import LoadingInline from "./LoadingInline";
import _ from "lodash";
import ErrorConnection from "../../../errors/error_connect";
import { CheckRoles } from "../../../../context/CheckRoles";
import { checkPermissions } from "../../../../helpers/axiosHandle";
export default class OrdersTable extends Component {



    constructor() {
        super()

this.data= [];
this.fetchIdRef = React.createRef();
        // this.loading = true;
        this.searchTerm = "";
  //const [searchTerm, setSearchTerm] = useState("");
  this.pageCount = 0;

        this.firstPaginate = false;
        this.pagination = -1;
        this.state = {
            isLoading: true,
            loading: true,
            data: [],
             errorLoad:false,
            pageCount:0,
            isLoadingInline:false,
            footerPaginate:false,
            paginateLoading: false,
            toggleDrawerBottom: false,
            Roles:{},
            objectData: {
                 id: 0,
        startDate: new Date(2020,12).toISOString().substring(0,10),
        endDate: new Date((new Date()).setDate((new Date()).getDate()+1)).toISOString().substring(0,10),
        customer: "",
        delivery_status: "",
        payment_status: "",
        grand_total: 0,

        code:""
            },
            allrowsLength:0,
            trans:{
             "Id":"",
             "Customer":"",
             "Delivery Status":"",
             "Payment Status":"",
             "Grand Total":"",
             "Code":"",
             "Created At":"",
             "All rows number":"",
             "Go to page":"",
             "Page":"",
             "to":"",
             "Desc":"",
             "Asc":"",
             "increase":"",
             "show":"",
             "Search":"",
             "All":"",
             "Pending":"",
             "Confirmed":"",
             "On Delivery":"",
             "Delivered":"",
             "Paid":"",
             "Un Paid":"",
             "Create New Order":"",
             "Toggle Paginate":"",
             "ID":"",
             "search Id":"",
             "Search Data":"",
             "Customer Name":"",
             "search customer name":"",
             "Start Date":"",
             "End Date":"",
             "search grand total":"",
             "Order Code":"",
             "search order code":"",
             "of":"",
              "pending":"",
             "confirmed":"",
             "on delivery":"",
                "delivered": "",
                "cancelled": "",
             "on_delivery":"",
             "paid":"",
             "unpaid":"",
                "Orders": "",
                "Options": "",
                "Are you sure?": "",
                "Once deleted, you will not be able to recover this imaginary data!": "",
                "Poof! Your imaginary data has been deleted!": "",
                "Your imaginary data is safe!": "",
                "remove": "",
                "ok":""

            },

            orders: [],
                    goBack:false,

            endDataResponse:true
        }


    }

    componentDidMount() {


    //    this.fetchData({ pageSize:10, pageIndex:0 })
           checkPermissions([26,27,28,29], res => {
               this.setState({
                    Roles:res
                })
            })
        this.callTrans(this.state.trans)


    }



    clickbtnSaveData = (data) => {
            this.setState({
                orders:data,

            })
    }
    handleChange = (type,val,starDate = null,endDate = null)=>{


        this.setState({
            isLoadingInline:true

         })

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             value:val.target.value,
             type,
             starDate:starDate,
             endDate:endDate,
              "_token": csrf_token
          };
          axios.post("search_orders",data_post)
              .then(res => {
            this.setState({
                orders:res.data.orders,
                isLoadingInline:false,

            })

          })
          .catch(err=>{
this.setState({
                    errorLoad:true
                })
          })
    }
    onChangeValueName = (val)=>{
        this.setState({
            isLoadingInline:true

        })
    }
    callTrans(transes){

        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let  data_post = {
             data:transes,
              "_token": csrf_token
          }
        axios.post(Urls.static_url+"trans_data",data_post)
        .then(res=>{

            this.setState({
                trans:res.data,
                    // orders:this.props.orders,
                isLoading:false
            })
        })
        .catch(err=>{
this.setState({
                    errorLoad:true
                })
        })
    }


     toggleDrawer = () => (event) => {

         if (this.state.toggleDrawerBottom == true) {

             this.setState({
                 toggleDrawerBottom:false
             })

        } else {
                     this.setState({
                 toggleDrawerBottom:true
             })

        }
     };


componentDidUpdate(prevProps,prevState) {
  // استخدام نموذجي (لا تنس مقارنة الخاصيات)
  if (this.props.userID !== prevState.userID) {
    // this.fetchData(this.props.userID);
  }
}
    loadingupdate = () => {
        this.setState({
        loading:true
    })
}
handleremoveDataOrder = (orderObject)=>{
    this.handleDelete(orderObject)
}


  handleDelete = orderObject => {
    const items = this.state.orders.filter(item => item.id !== orderObject.id);
      this.setState({
          orders: items,
                  isLoading:false

      });
  };

         fetchAPIData =  ({ limit, skip, objectData,advanceSearch=false }) => {

             try {

        this.setState({
            loading:true
        })
        let csrf_token =   document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                 if (advanceSearch) {
                  //   this.setState({
                        //  objectData
                    // })

        objectData["_token"] = csrf_token
        objectData["limit"] = limit
        objectData["skip"] = skip
        objectData["search"] = this.props.search

                 } else {
                             for (const [key, value] of Object.entries(objectData)) {

                 this.setState(prevState => ({
                                                    objectData: {                   // object that we want to update
                                                        ...prevState.objectData,    // keep all other key-value pairs
                                                        [key]: value     // update the value of specific key
                                                    }
                                                }))
        }




        let  data_post = {
            limit,
            skip,
              "_token": csrf_token
        }


        this.state.objectData["_token"] = csrf_token
            this.state.objectData["limit"] = limit
        this.state.objectData["skip"] = skip
                this.state.objectData["search"] = this.props.search


                 }

        axios.post(Urls.static_url + `NewerOrders/orders_data`,advanceSearch?objectData:this.state.objectData)
            .then(res => {


        this.setState({
            data: res.data.orders,
            pageCount: res.data.counter,
            allrowsLength:res.data.rows,
            endDataResponse: false,
            loading: false,
           goBack:true

       })

        })
            .catch(err => {
            this.setState({
                    errorLoad:true
                })
        })
    //     //setData(data.orders);

    //    setPageCount(data.counter);
    //    setLoading(false);
    } catch (e) {
      console.log("Error while fetching", e);
      // setLoading(false)
    }
  };

    // useEffect(() => {
    //     fetchAPIData({limit:15,skip:0,search:""});
    // }, [])

    fetchData = ({ pageSize, pageIndex }) => {
        // console.log("fetchData is being called")
        // This will get called when the table needs new data
        // You could fetch your data from literally anywhere,
        // even a server. But for this example, we'll just fake it.
        // Give this fetch an ID
        const fetchId = ++this.fetchIdRef.current;
 this.setState({
           loading:true
       })
        //setLoading(true);
        if (fetchId === this.fetchIdRef.current) {
            this.fetchAPIData({
                limit: pageSize,
                skip: pageSize * pageIndex,
                objectData: {},
            });
        }
    };
   _handleSearch = _.debounce(
       (limit,skip,objectData,data) => {
         //  this.state.objectData = search;


           objectData[data.type] = data.value;
           this.fetchAPIData({limit,skip,objectData})
   //   setSearchTerm(search);
    },
    500,
    {
      maxWait: 500,
    }
  );

    endData = () => {
        this.setState({
                        endDataResponse:true

        })
    }
    handleBack = () => {
        this.setState({
           goBack:false

        })
    }

    render() {


        if (this.state.isLoading) {
            return (

                <div>
                <LoadingInline />


                </div>

            )
        } else {


        const COLUMNS = [

                {
                    Header: this.state.trans["Id"],
                    accessor: "id",

                },
                {
                    Header: this.state.trans["Customer"] ,
                    accessor: 'customer',

                },

                {
                    Header: this.state.trans["Delivery Status"] ,
                    filter: 'includes',
                    accessor: 'delivery_status',

                },

                {
                    Header:this.state.trans["Payment Status"] ,
                    filter: 'includes',
                    accessor: 'payment_status',

                },

                {
                    Header:this.state.trans["Grand Total"] ,
                    accessor: 'grand_total',

                },

                {
                    Header:this.state.trans["Code"] ,
                    accessor: 'code',

                },


                {
                    Header:this.state.trans["Created At"] ,
                    filter: "dateBetween",
                    accessor: 'created_at',

                },

                {
                    Header:this.state.trans["Options"] ,

                },

            ];

            if (!this.state.errorLoad) {
                return (
                <div>

 <CheckRoles.Provider value={this.state.Roles} >
                    <Table
                        handleBack={this.handleBack}
          loadingupdate={this.loadingupdate}
          pageCount={this.state.pageCount}
          fetchData={this.fetchData}
          columns={COLUMNS}
            trans={this.state.trans}
                 data={this.state.data}
                        loading={this.state.loading}
                        _handleSearch={this._handleSearch}
                        allrowsLength={this.state.allrowsLength}
                        goBack={this.state.goBack}
                        endDataResponse={this.state.endDataResponse}
                        endData={this.endData}
                        fetchAPIData={this.fetchAPIData}

            />
</CheckRoles.Provider>
                </div>
            )
            } else {
                   return (
                      <ErrorConnection />
                )
            }

        }
    }

}




