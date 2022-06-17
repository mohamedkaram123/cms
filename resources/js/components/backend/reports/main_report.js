import axios from 'axios';
import { Component, createRef } from 'react';
import './../../../../../public/assets/css/react-tabs-active2.css';
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import MainReportTabs from './MainReportTabs';
import { Urls } from '../urls';



let inc = 0;
export default class MainReport extends Component {

    constructor() {
        super();
        this.isTabletOrMobile = window.matchMedia("(max-width: 768px)").matches;

        this.startDate = new Date().setDate((new Date()).getDate() - 30)
        this.myRef = createRef();
        this.state = {
            classTab: {
                fontSize: 20,
                padding: 10,
                fontWeight: 400,
                paddingInline: 30
            },
            selectdClass: {

                color: "#fff"
            },
            index: 0,
            start_date: new Date().setDate((new Date()).getDate() - 90),
            end_date: new Date(),

            trans: {
                "Sales": "",
                "Products": "",
                "Customers": "",
                "Sellers": "",
                "Visits": "",
                "Orders": "",
                "Choose Branch Report": "",
                "Summary": "",
                "Sales Products": "",
                "Sales Brands": "",
                "Sales Categories": "",
                "Sales Coupons": "",
                "Product": "",
                "Abandoned Baskets": "",
                "show": "",
                "Date From": "",
                "Date To": "",
                "Search": "",
                "Payment & Shipping": ""

            },
            isLoading: true
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
                    isLoading: false
                })
            })
            .catch(err => {

            })
    }
    render() {
        return (

            <
            div >

            <
            div className = { this.isTabletOrMobile ? "row center_content" : "row m-2" } >
            <
            div className = "card" >
            <
            div className = "card-header" >
            <
            h6 > { this.state.trans["Date From"] } < /h6> <
            /div> <
            div className = "card-body" >
            <
            DatePicker className = "form-control"
            selected = { this.state.start_date }
            onSelect = {
                (date) => {
                    this.setState({
                        start_date: date
                    })
                }
            }
            onKeyDown = {
                (e) => {
                    if (e.key === 'Enter') {
                        this.setState({
                            start_date: new Date(e.nativeEvent.target.value)
                        })
                    }
                }
            }

            />

            <
            /div>

            <
            /div>

            <
            div className = "card" >
            <
            div className = "card-header" >
            <
            h6 > { this.state.trans["Date To"] } < /h6> <
            /div>

            <
            div className = "card-body" >
            <
            DatePicker className = "form-control"
            selected = { this.state.end_date }
            onSelect = {
                (date) => {
                    this.setState({
                        end_date: date
                    })
                }
            }
            onKeyDown = {
                (e) => {
                    if (e.key === 'Enter') {
                        this.setState({
                            end_date: new Date(e.nativeEvent.target.value)
                        })
                    }
                }
            }

            />

            <
            /div>

            <
            /div>

            <
            /div> <
            MainReportTabs isLoading = { this.state.isLoading }
            trans = { this.state.trans }
            start_date = { this.state.start_date }
            end_date = { this.state.end_date }
            />

            <
            /div>
        )


    }
}