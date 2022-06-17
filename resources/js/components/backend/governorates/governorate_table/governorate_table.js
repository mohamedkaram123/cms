import axios from "axios";
import React, { Component } from "react";

import Table from "./filteringTable";

import { Urls } from "../../urls";
import LoadingInline from "./LoadingInline";
import _ from "lodash";


export default class GovernorateTable extends Component {



    constructor() {
        super()

        this.data = [];
        this.fetchIdRef = React.createRef();
        this.searchTerm = "";
        this.pageCount = 0;

        this.firstPaginate = false;
        this.pagination = -1;
        this.state = {
            isLoading: true,
            loading: true,
            data: [],
            pageCount: 0,
            isLoadingInline: false,
            footerPaginate: false,
            paginateLoading: false,
            toggleDrawerBottom: false,
            objectData: {
                id: 0,
                startDate: new Date(2020, 12).toISOString().substring(0, 10),
                endDate: new Date().toISOString().substring(0, 10),
                name: "",
                country_name: "",
            },
            allrowsLength: 0,
            trans: {
                "Id": "",
                "Governorate Name": "",
                "governorate name": "",
                "Governorates": "",
                "Country Name": "",
                "add governorate": "",
                "Created At": "",
                "Sellers": "",
                "seller name": "",
                "search email": "",
                "search balance": "",
                "search Phone": "",
                "Phone": "",
                "All rows number": "",
                "Go to page": "",
                "Page": "",
                "to": "",
                "Desc": "",
                "Asc": "",
                "increase": "",
                "show": "",
                "Search": "",
                "All": "",
                "of": "",
                "Options": "",
                "Log in as this Seller": "",
                "Delete": "",
                "Are you sure?": "",
                "Once deleted, you will not be able to recover this imaginary data!": "",
                "remove": "",
                "Your imaginary data is safe!": "",
                "Search Data": "",
                "Payment History": "",
                "Edit": "",
                "Add governorate": "",
                "Add Governorate": "",
                "country name": "",
                "Close": "",
                "Save Data": "",
                "please enter governorate name": "",
                "Start Date": "",
                "End Date": "",

            },

            sellers: [],
            goBack: false,

            endDataResponse: true
        }


    }

    componentDidMount() {


        this.callTrans(this.state.trans)


    }


    callTrans(transes) {

        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        let data_post = {
            data: transes,
            "_token": csrf_token
        }
        axios.post(Urls.static_url + "trans_data", data_post)
            .then(res => {

                this.setState({
                    trans: res.data,
                    // sellers:this.props.sellers,
                    isLoading: false
                })
            })
            .catch(err => {

            })
    }


    toggleDrawer = () => (event) => {

        if (this.state.toggleDrawerBottom == true) {

            this.setState({
                toggleDrawerBottom: false
            })

        } else {
            this.setState({
                toggleDrawerBottom: true
            })

        }
    };


    componentDidUpdate(prevProps, prevState) {
        // استخدام نموذجي (لا تنس مقارنة الخاصيات)
        if (this.props.userID !== prevState.userID) {
            // this.fetchData(this.props.userID);
        }
    }
    loadingupdate = () => {
        this.setState({
            loading: true
        })
    }

    fetchAPIData = ({ limit, skip, objectData, advanceSearch = false }) => {
        try {

            this.setState({
                loading: true
            })
            let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (advanceSearch) {

                objectData["_token"] = csrf_token
                objectData["limit"] = limit
                objectData["skip"] = skip
                objectData["search"] = this.props.search

            } else {
                for (const [key, value] of Object.entries(objectData)) {

                    this.setState(prevState => ({
                        objectData: { // object that we want to update
                            ...prevState.objectData, // keep all other key-value pairs
                            [key]: value // update the value of specific key
                        }
                    }))
                }




                let data_post = {
                    limit,
                    skip,
                    "_token": csrf_token
                }


                this.state.objectData["_token"] = csrf_token
                this.state.objectData["limit"] = limit
                this.state.objectData["skip"] = skip
                this.state.objectData["search"] = this.props.search


            }

            axios.post(Urls.static_url + `governorate/governorate_data`, advanceSearch ? objectData : this.state.objectData)
                .then(res => {

                    this.setState({
                        data: res.data.governorates,
                        pageCount: res.data.counter,
                        allrowsLength: res.data.rows,
                        endDataResponse: false,
                        loading: false,
                        goBack: true

                    })

                })
                .catch(err => {
                    console.log({ err });
                })

        } catch (e) {
            console.log("Error while fetching", e);
        }
    };


    fetchData = ({ pageSize, pageIndex }) => {
        const fetchId = ++this.fetchIdRef.current;
        this.setState({
                loading: true
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
        (limit, skip, objectData, data) => {
            //  this.state.objectData = search;


            objectData[data.type] = data.value;
            this.fetchAPIData({ limit, skip, objectData })
                //   setSearchTerm(search);
        },
        500, {
            maxWait: 500,
        }
    );

    endData = () => {
        this.setState({
            endDataResponse: true

        })
    }
    handleBack = () => {
        this.setState({
            goBack: false

        })
    }

    render() {


        if (this.state.isLoading) {
            return (

                <div >
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
                    Header: this.state.trans["Governorate Name"],

                    accessor: 'name',

                },
                {
                    Header: this.state.trans["Country Name"],

                    accessor: 'country_name',

                },
                {
                    Header: this.state.trans["Created At"],
                    filter: "dateBetween",

                    accessor: 'created_at',

                },

                {
                    Header: this.state.trans["Options"],

                },
            ];


            return ( <div>


                <Table handleBack = { this.handleBack }
                loadingupdate = { this.loadingupdate }
                pageCount = { this.state.pageCount }
                fetchData = { this.fetchData }
                columns = { COLUMNS }
                trans = { this.state.trans }
                data = { this.state.data }
                loading = { this.state.loading }
                _handleSearch = { this._handleSearch }
                allrowsLength = { this.state.allrowsLength }
                goBack = { this.state.goBack }
                endDataResponse = { this.state.endDataResponse }
                endData = { this.endData }
                fetchAPIData = { this.fetchAPIData }

                />

                </div>
            )
        }
    }

}
