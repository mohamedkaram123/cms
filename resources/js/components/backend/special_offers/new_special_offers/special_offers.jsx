import axios from "axios";
import { Component } from "react";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import SpecialOfferBody from './special_offer_body';
import { Urls } from "../../urls";
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import CustomerPurchases from './specialOffersBody/customer_purchases';
import LoadingInline from "../specia_offers_table/LoadingInline";
import history from '../../history';
export default class SpecialOffers extends Component {

    constructor() {
        super()

        this.state = {
            trans: {
                "Offer Data": "",
                "Add a suitable title for the Offer": "",
                "Offer Title": "",
                "End Date Offer": "",
                "Offer Type": "",
                "Select the type of discount to be applied to the cart": "",
                "When the customer buy X get on y": "",
                "Fixed amount of customer purchases": "",
                "Percent of customer purchases": "",
                "products": "",
                "categories": "",
                "Offer Options": "",
                "Quantify": "",
                "quantify": "",
                "Choose Products": "",
                "Choose Categories": "",
                "Products Items are Choosing ": "",
                "If the customer buys": "",
                "Select the products and quantity to be available in the cart to apply the discount": "",
                "Determine what the customer gets when the previous condition is met": "",
                "Customer gets": "",
                "Discount Type": "",
                "Discount Percent": "",
                "discount percent": "",
                "free product": "",
                "discount": "",
                "Products from": "",
                "discount value": "",
                "The customer received the discount": "",
                "Maximum discount": "",
                "The total cost of the stimulus that the customer will receive may be": "",
                "All products in the cart": "",
                "Selected Products": "",
                "Selected Categories": "",
                "Selected Payment Methods": "",
                "Offer applies to": "",
                "Choose one of the following conditions to apply the offer": "",
                "Fawry": "",
                "TapPayment": "",
                "Paytab saudi": "",
                "Paytab egypt": "",
                "Cash on delivery": "",
                "Payments": "",
                "Choose Payments": "",
                "Limit Offer": "",
                "Limit for Purchese Price": "",
                "Limit for Products Quantity": "",
                "Apply the offer with the discount coupon": "",
                "Create Special Offers": "",
                "please check var is empty": "",
                "quantify1": "",
                "quantify2": "",
                "products1": "",
                "products2": "",
                "categories1": "",
                "categories2": "",
                "Price": "",
                "quantity": "",
                "Data saved": ""


            },
            isLoading: true,
            end_date: new Date(),
            offer_check: 2,
            optionsCategories: [],
            offer_title: "",
            dataXtoY: {
                products1: [],
                products2: [],
                categories1: [],
                categories2: [],
                quantify1: 0,
                quantify2: 0,
                product_or_category1: "product",
                product_or_category2: "product",

                discount_type: "discount",
                discount: 0


            },
            dataFixedCustomerPurches: {

                discount: 0,
                offer_applies: 1,
                limit_price_or_product: 'price',
                price: 0,
                quantity: 0,
                with_coupon: 0,
                products: [],
                categories: [],
                payments: []


            },
            dataPercentCustomerPurches: {

                discount_percent: 0,
                max_discount: 0,
                offer_applies: 1,
                limit_price_or_product: 'price',
                price: 0,
                quantity: 0,
                with_coupon: 0,
                products: [],
                categories: [],
                payments: []


            },
            loadingBtn: false,

        }
    }

    componentDidMount() {
        this.callCategries();
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

    callCategries() {
        axios.get(Urls.static_url + "products/all_categories")
            .then(res => {
                this.setState({
                    optionsCategories: res.data.categories
                })
            })
            .catch(err => {

            })
    }

    convertDate(date_covert) {
        let date = new Date(date_covert);
        date = date.getUTCFullYear() + '-' +
            ('00' + (date.getUTCMonth() + 1)).slice(-2) + '-' +
            ('00' + date.getUTCDate()).slice(-2) + ' ' +
            ('00' + date.getUTCHours()).slice(-2) + ':' +
            ('00' + date.getUTCMinutes()).slice(-2) + ':' +
            ('00' + date.getUTCSeconds()).slice(-2);
        return date;
    }

    handleOfferCheck = (e) => {
        this.setState({
            offer_check: e.target.value
        })
    }

    createSpecialOffice = () => {

        let checkDone = true;

        if (this.state.offer_title == "") {
            var title_trans = this.state.trans["please check var is empty"];
            var title = title_trans.replace("var", this.state.trans["Offer Title"]);

            toast.error(title, {
                position: "top-right",
                autoClose: 5000,
                hideProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                draggable: true,
                progress: undefined,
            });
            checkDone = false;

        }

        if (this.state.offer_check == 1) {

            for (const [key, value] of Object.entries(this.state.dataXtoY)) {
                if (key == "quantify1" && value == 0 || key == "quantify2" && value == 0) {

                    var title_trans = this.state.trans["please check var is empty"];
                    var title = title_trans.replace("var", this.state.trans[key]);

                    toast.error(title, {
                        position: "top-right",
                        autoClose: 5000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });
                    checkDone = false;

                }
            }

            if (this.state.dataXtoY["product_or_category1"] == "product" && this.state.dataXtoY["products1"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["products1"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;

            } else if (this.state.dataXtoY["product_or_category1"] == "category" && this.state.dataXtoY["categories1"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["categories1"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;

            }

            if (this.state.dataXtoY["product_or_category2"] == "product" && this.state.dataXtoY["products2"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["products2"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;

            } else if (this.state.dataXtoY["product_or_category2"] == "category" && this.state.dataXtoY["categories2"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["categories2"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;

            }

            if (this.state.dataXtoY["discount_type"] == "discount" && this.state.dataXtoY["discount"] == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["discount"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            }

            if (checkDone) {
                let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let dataXtoY = this.state.dataXtoY;
                dataXtoY._token = csrf_token;
                dataXtoY.title_offer = this.state.offer_title;
                dataXtoY.endDate = this.convertDate(this.state.end_date);


                axios.post(Urls.static_url + "special/storeXtoY", dataXtoY)
                    .then(res => {

                        if (res.data.result == "done") {

                            var title_trans = this.state.trans["Data saved"];

                            toast.success(title_trans, {
                                position: "top-right",
                                autoClose: 5000,
                                hideProgressBar: false,
                                closeOnClick: true,
                                pauseOnHover: true,
                                draggable: true,
                                progress: undefined,
                            });

                            history.goBack()
                        }

                    })
                    .catch(err => {
                        console.log({ err });
                    })

            }
        } else if (this.state.offer_check == 2) {


            if (this.state.dataFixedCustomerPurches["discount"] == 0) {

                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["discount value"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            }

            if (this.state.dataFixedCustomerPurches["offer_applies"] == 2 && this.state.dataFixedCustomerPurches["products"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["products"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            } else if (this.state.dataFixedCustomerPurches["offer_applies"] == 3 && this.state.dataFixedCustomerPurches["categories"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["categories"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            } else if (this.state.dataFixedCustomerPurches["offer_applies"] == 4 && this.state.dataFixedCustomerPurches["payments"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["Payments"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            }

            if (this.state.dataFixedCustomerPurches["limit_price_or_product"] == "price" && this.state.dataFixedCustomerPurches["price"] == 0) {

                if (this.state.dataFixedCustomerPurches["offer_applies"] != 2) {

                    var title_trans = this.state.trans["please check var is empty"];
                    var title = title_trans.replace("var", this.state.trans["Price"]);

                    toast.error(title, {
                        position: "top-right",
                        autoClose: 5000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });
                    checkDone = false;
                }
            } else if (this.state.dataFixedCustomerPurches["limit_price_or_product"] == "quantity" && this.state.dataFixedCustomerPurches["quantity"] == 0) {
                if (this.state.dataFixedCustomerPurches["offer_applies"] != 2) {

                    var title_trans = this.state.trans["please check var is empty"];
                    var title = title_trans.replace("var", this.state.trans["quantity"]);

                    toast.error(title, {
                        position: "top-right",
                        autoClose: 5000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });
                    checkDone = false;
                }
            }
            if (checkDone) {
                this.setState({
                    loadingBtn: true
                })
                let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let customerFixedPurches = this.state.dataFixedCustomerPurches;
                customerFixedPurches._token = csrf_token;
                customerFixedPurches.title_offer = this.state.offer_title;
                customerFixedPurches.endDate = this.convertDate(this.state.end_date);


                axios.post(Urls.static_url + "special/customerFixedPurches", customerFixedPurches)
                    .then(res => {
                        if (res.data.result == "done") {

                            var title_trans = this.state.trans["Data saved"];

                            toast.success(title_trans, {
                                position: "top-right",
                                autoClose: 5000,
                                hideProgressBar: false,
                                closeOnClick: true,
                                pauseOnHover: true,
                                draggable: true,
                                progress: undefined,
                            });

                            history.goBack()
                        }
                    })
                    .catch(err => {
                        console.log({ err });
                    })

            }

        } else if (this.state.offer_check == 3) {

            if (this.state.dataPercentCustomerPurches["discount_percent"] == 0) {

                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["discount value"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            }
            if (this.state.dataPercentCustomerPurches["max_discount"] == 0) {

                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["Maximum discount"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            }
            if (this.state.dataPercentCustomerPurches["offer_applies"] == 2 && this.state.dataPercentCustomerPurches["products"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["products"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            } else if (this.state.dataPercentCustomerPurches["offer_applies"] == 3 && this.state.dataPercentCustomerPurches["categories"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["categories"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            } else if (this.state.dataPercentCustomerPurches["offer_applies"] == 4 && this.state.dataPercentCustomerPurches["payments"].length == 0) {
                var title_trans = this.state.trans["please check var is empty"];
                var title = title_trans.replace("var", this.state.trans["Payments"]);

                toast.error(title, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                });
                checkDone = false;
            }

            if (this.state.dataPercentCustomerPurches["limit_price_or_product"] == "price" && this.state.dataPercentCustomerPurches["price"] == 0) {
                if (this.state.dataPercentCustomerPurches["offer_applies"] != 2) {
                    var title_trans = this.state.trans["please check var is empty"];
                    var title = title_trans.replace("var", this.state.trans["Price"]);

                    toast.error(title, {
                        position: "top-right",
                        autoClose: 5000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });
                    checkDone = false;
                }

            } else if (this.state.dataPercentCustomerPurches["limit_price_or_product"] == "quantity" && this.state.dataPercentCustomerPurches["quantity"] == 0) {
                if (this.state.dataPercentCustomerPurches["offer_applies"] != 2) {

                    var title_trans = this.state.trans["please check var is empty"];
                    var title = title_trans.replace("var", this.state.trans["quantity"]);

                    toast.error(title, {
                        position: "top-right",
                        autoClose: 5000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });
                    checkDone = false;
                }
            }

            if (checkDone) {
                this.setState({
                    loadingBtn: true
                })
                let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let customerPercentPurches = this.state.dataPercentCustomerPurches;
                customerPercentPurches._token = csrf_token;
                customerPercentPurches.title_offer = this.state.offer_title;
                customerPercentPurches.endDate = this.convertDate(this.state.end_date);


                axios.post(Urls.static_url + "special/customerPercentPurches", customerPercentPurches)
                    .then(res => {
                        if (res.data.result == "done") {

                            var title_trans = this.state.trans["Data saved"];

                            toast.success(title_trans, {
                                position: "top-right",
                                autoClose: 5000,
                                hideProgressBar: false,
                                closeOnClick: true,
                                pauseOnHover: true,
                                draggable: true,
                                progress: undefined,
                            });
                            history.goBack()
                        }
                    })
                    .catch(err => {
                        console.log({ err });
                    })

            }




        }
    }
    dataXTOY = (item) => {

        for (const [key, value] of Object.entries(item)) {
            this.setState(prevState => ({
                dataXtoY: { // object that we want to update
                    ...prevState.dataXtoY, // keep all other key-value pairs
                    [key]: value // update the value of specific key
                }
            }))
        }

    }


    dataFixedCustomerPurches = (item) => {

        for (const [key, value] of Object.entries(item)) {
            this.setState(prevState => ({
                dataFixedCustomerPurches: { // object that we want to update
                    ...prevState.dataFixedCustomerPurches, // keep all other key-value pairs
                    [key]: value // update the value of specific key
                }
            }))
        }

    }

    dataPercentCustomerPurches = (item) => {

        for (const [key, value] of Object.entries(item)) {
            this.setState(prevState => ({
                dataPercentCustomerPurches: { // object that we want to update
                    ...prevState.dataPercentCustomerPurches, // keep all other key-value pairs
                    [key]: value // update the value of specific key
                }
            }))
        }

    }
    render() {
        if (this.state.isLoading) {
            return ( <div >
                <LoadingInline />
                </div>

            )
        } else {
            return (
                <div >
                <ToastContainer />
                <div className = "card" >
                <div className = "card-header" >
                <span > { this.state.trans["Offer Data"] } </span>
                </div>
                <div className = "card-body" >
                <div className = "row" >
                <div className = "col-6" >
                <div className = "form-group" >
                <label > { this.state.trans["Offer Title"] } </label>
                <div className = "input-group" >
                <div className = "input-group-prepend" >
                <span className = "input-group-text"
                style = {
                    { background: "#fff" }
                } >
                <i className = "las la-store" > </i></span >
                </div>
                <input type = "text"
                className = "form-control"
                onChange = {
                    (e) => {
                        this.setState({
                            offer_title: e.target.value
                        })
                    }
                }
                placeholder = { this.state.trans["Add a suitable title for the Offer"] }
                />
                </div>
                </div>

                </div>

                <div className = "col-6" >
                <div className = "form-group" >
                <label > { this.state.trans["End Date Offer"] } </label>
                <div className = "input-group" >
                <div className = "input-group-prepend" >
                <span className = "input-group-text"
                style = {
                    { background: "#fff" }
                } >
                <i className = "las la-calendar" >
                </i>
                </span>
                </div>
                <DatePicker className = "form-control datePicker-react"
                selected = { this.state.end_date }
                onChange = {
                    (date) => {
                        this.setState({
                            end_date: date
                        })
                    }
                }
                />
                </div>
                </div>

                </div>
                </div>
                <div className = "row" >
                <div className = "col-6" >
                <label>
                     { this.state.trans["Offer Type"] } </label>
                     <p style = {
                    { color: "#aaa" }
                } > { this.state.trans["Select the type of discount to be applied to the cart"] } </p>

                <div className = "form-check d-none" >
                <input className = "form-check-input"
                type = "radio"
                name = "flexRadioDefault"

                value = { 1 }
                checked = { this.state.offer_check == 1 }
                id = "x_and_y_lable"

                onChange = { this.handleOfferCheck }/>
                <label htmlFor = "x_and_y_lable"
                className="form-check-label" > { this.state.trans["When the customer buy X get on y"] }
                </label>
                </div>

                <div className = "form-check" >
                <input className = "form-check-input"
                type = "radio"
                name = "flexRadioDefault"
                id = "fixed_amount"

                value = { 2 }
                checked = { this.state.offer_check == 2 }
                onChange = { this.handleOfferCheck }

                />
                 <label htmlFor = "fixed_amount"
                className = "form-check-label" > { this.state.trans["Fixed amount of customer purchases"] }
                </label> </div> <div className = "form-check" >
                <input className = "form-check-input"
                type = "radio"
                name = "flexRadioDefault"
                id = "percent_amount"

                value = { 3 }
                checked = { this.state.offer_check == 3 }
                onChange = { this.handleOfferCheck }
                />
                <label htmlFor = "percent_amount"
                className="form-check-label" > { this.state.trans["Percent of customer purchases"] } </label> </div>
                </div>
                </div>

                </div>
                </div>


                <SpecialOfferBody dataPercentCustomerPurches = { this.dataPercentCustomerPurches }
                dataFixedCustomerPurches = { this.dataFixedCustomerPurches }
                dataXTOY = { this.dataXTOY }
                optionsCategories = { this.state.optionsCategories }
                trans = { this.state.trans }
                specialoffercheck = { this.state.offer_check }
                />


                <div className="d-flex flex-row-reverse"
                style = {
                    { marginBottom: 10 }
                } >
                <div className = "p-2" >
                <button disabled = { this.state.loadingBtn }
                onClick = { this.createSpecialOffice }
                className = "btn btn-primary" > { this.state.trans["Create Special Offers"] } {
                    this.state.loadingBtn ? < img style = {
                        { marginInline: 10 }
                    }
                    src = { Urls.public_url + "assets/img/loading.gif" }
                    width = { 15 }
                    height = { 15 }/>:null  }

                    </button> </div> </div> </div>
                )
            }

        }
    }
