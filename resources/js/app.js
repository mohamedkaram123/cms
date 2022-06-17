/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import React from 'react';
import ReactDOM from 'react-dom';
import BasicExample from './components/backend/payment_methods/paytabs/Router';
import FawrPayment from './components/backend/payment_methods/fawryPayment/fawryPayment';
import RouterabandonedBasket from './components/backend/abandoned_baskets/router_abandoned_baskets';
import Notify from './components/backend/Notifications/notify';
import NotificationsItems from './components/backend/Notifications/NotificationItems';
import MainReport from './components/backend/reports/main_report';
import OrdersTable from './components/backend/orders/order_table/order_table';
import NewOrder from './components/backend/orders/new_order/new_order';
import RouterCustomer from './components/backend/customers/router_customer';
import RouterSeller from './components/backend/sellers/router_seller';
import RouterOrder from './components/backend/orders/router_order';
import RouterSpecialOffers from './components/backend/special_offers/router_speial_offers';
import RouterFirebase from './components/backend/firebase/router_firebase';
import SettingSmtpMail from './components/backend/setting_smtp/setting_smtp_mail';
import SmsSetting from './components/backend/sms_setting/sms_setting';
//  import { BrowserRouter as Router, Link, Route } from "react-router-dom";
import Dashboard from './components/backend/dashboard/dashboard';
import NewsLetter from './components/backend/newsletter/newsletter';
import TopSelling from './components/frontend/product_details/top_selling/top_selling_products';
import Products from './components/frontend/product_details/related_product/related_product';
import RelatedProducts from './components/frontend/product_details/related_product/related_product';
import RatingShop from './components/frontend/product_details/ratting_shop/rating_shop';
import Boxes from './components/frontend/dashboard/boxes/boxes';
import Categories from './components/frontend/dashboard/categories/categories';
import SaidBarPanel from './components/frontend/dashboard/saidbarPanel/saidbarPanel';
import StoreHome from './components/frontend/shops/store_home';
import NotifySpecialOffers from './components/frontend/notifySpecialOffers/notifySpecialOffer';
import GovernorateTable from './components/backend/governorates/governorate_table/governorate_table';
import Index from './components/frontend/shipping_data';
import { Provider } from 'react-redux';
import store from './store';
import LocalShippingTable from './components/backend/local_shipment/local_shipment_table/local_shipment_table';
import './custom_style.css';
import AddAddress from './components/frontend/customers/add_address';


if (document.getElementById('pay_tabs')) {

    ReactDOM.render( < BasicExample / > , document.getElementById('pay_tabs'));
}


if (document.getElementById('fawry_payment')) {
    ReactDOM.render( < FawrPayment / > , document.getElementById('fawry_payment'));
}


if (document.getElementById('abandoned_baskets')) {
    ReactDOM.render( < RouterabandonedBasket / > , document.getElementById('abandoned_baskets'));
}

if (document.getElementById('notify_wrapper')) {
    ReactDOM.render( < Notify user_id = { document.getElementById('notify_wrapper').dataset.user_id }
        />, document.getElementById('notify_wrapper'));
    }

    if (document.getElementById('notify_special_offers')) {
        ReactDOM.render( < NotifySpecialOffers / > , document.getElementById('notify_special_offers'));
    }


    if (document.getElementById('Notififcation_items')) {
        ReactDOM.render( < NotificationsItems user_id = { document.getElementById('notify_wrapper').dataset.user_id }
            />, document.getElementById('Notififcation_items'));
        }


        if (document.getElementById('main_reports')) {
            ReactDOM.render( < MainReport user_id = { document.getElementById('main_reports').dataset.user_id }
                />, document.getElementById('main_reports'));
            }

            if (document.getElementById('orders')) {
                ReactDOM.render( < RouterOrder / > , document.getElementById('orders'));
            }




            if (document.getElementById('new_order')) {

                ReactDOM.render( < NewOrder sellers = { $("#new_order").data("sellers") }
                    />, document.getElementById('new_order'));
                }



                if (document.getElementById('special_offers')) {

                    ReactDOM.render( < RouterSpecialOffers / > , document.getElementById('special_offers'));
                }

                if (document.getElementById('customers_js')) {

                    ReactDOM.render( < RouterCustomer / > , document.getElementById('customers_js'));
                }
                if (document.getElementById('sellers_js')) {

                    ReactDOM.render( < RouterSeller / > , document.getElementById('sellers_js'));
                }


                if (document.getElementById('firebase')) {

                    ReactDOM.render( < RouterFirebase / > , document.getElementById('firebase'));
                }
                if (document.getElementById('setting_smtp_mailer')) {

                    ReactDOM.render( < SettingSmtpMail / > , document.getElementById('setting_smtp_mailer'));
                }

                if (document.getElementById('sms_setting')) {

                    ReactDOM.render( < SmsSetting / > , document.getElementById('sms_setting'));
                }


                if (document.getElementById('home_backend')) {

                    ReactDOM.render( < Dashboard / > , document.getElementById('home_backend'));
                }



                if (document.getElementById('newsletter')) {

                    ReactDOM.render( < NewsLetter / > , document.getElementById('newsletter'));
                }


                if (document.getElementById('top_selling_product')) {

                    ReactDOM.render( < TopSelling detailedProduct = { $("#top_selling_product").data("details") }
                        /> , document.getElementById('top_selling_product'));
                    }

                    if (document.getElementById('related_products')) {

                        ReactDOM.render( < RelatedProducts detailedProduct = { $("#related_products").data("details") }
                            /> , document.getElementById('related_products'));
                        }

                        if (document.getElementById('rating_shop')) {

                            ReactDOM.render( < RatingShop detailedProduct = { $("#rating_shop").data("details") }
                                /> , document.getElementById('rating_shop'));
                            }
                            if (document.getElementById('dashboard_boxes')) {

                                ReactDOM.render( < Boxes / > , document.getElementById('dashboard_boxes'));
                            }
                            if (document.getElementById('dashboard_Categories')) {

                                ReactDOM.render( < Categories / > , document.getElementById('dashboard_Categories'));
                            }

                            if (document.getElementById('dashboard_side_nav')) {

                                ReactDOM.render( < SaidBarPanel / > , document.getElementById('dashboard_side_nav'));
                            }
                            if (document.getElementById('home_store')) {
                                console.log("ddddddddddd");

                                ReactDOM.render( < StoreHome type = { $("#home_store").data("type") }
                                    user_id = { $("#home_store").data("user_id") }
                                    /> , document.getElementById('home_store'));
                                }


                                if (document.getElementById('governorate_table')) {

                                    ReactDOM.render( < GovernorateTable / > , document.getElementById('governorate_table'));
                                }



                                if (document.getElementById('shipping_data')) {

                                    ReactDOM.render( < Provider store = { store } > < Index / > < /Provider> , document.getElementById('shipping_data'));
                                    }


                                    if (document.getElementById('localShipment')) {

                                        ReactDOM.render( < LocalShippingTable / > , document.getElementById('localShipment'));
                                    }

                                    if (document.getElementById('add_address')) {

                                        ReactDOM.render( < AddAddress / > , document.getElementById('add_address'));
                                    }