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
import { Provider } from 'react-redux';
import store from './store';
import './custom_style.css';
import ReactDOM from 'react-dom';

import BasicExample from './components/backend/payment_methods/paytabs/Router';
import FawrPayment from './components/backend/payment_methods/fawryPayment/fawryPayment';
import RouterabandonedBasket from './components/backend/abandoned_baskets/router_abandoned_baskets';
// import Notify from './components/backend/Notifications/notify';
import NotificationsItems from './components/backend/Notifications/NotificationItems';
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
import NewsLetter from './components/backend/newsletter/newsletter';
import GovernorateTable from './components/backend/governorates/governorate_table/governorate_table';
import LocalShippingTable from './components/backend/local_shipment/local_shipment_table/local_shipment_table';
import Pusher from './components/backend/pusher/pusher';
import ProductTable from './components/backend/products/product_table';
import FekraPayment from './components/backend/payment_methods/fekraPayment/fekraPayment';
import CustomerProfile from './components/backend/customers/customer_profile/customer_profile';
import SpecialOffersTable from './components/backend/special_offers/new_special_offers/special_offers';
import ArchiveProductTable from './components/backend/ArchiveProducts/arcive_product_table';

            if (document.getElementById('governorate_table')) {

                    ReactDOM.render(< GovernorateTable   /> , document.getElementById('governorate_table'));
            }

if (document.getElementById('pay_tabs')) {

    ReactDOM.render( < BasicExample /> , document.getElementById('pay_tabs'));
}


if (document.getElementById('fawry_payment')) {
    ReactDOM.render( < FawrPayment /> , document.getElementById('fawry_payment'));
}

if (document.getElementById('fekra_payment')) {
    ReactDOM.render( < FekraPayment /> , document.getElementById('fekra_payment'));
}


if (document.getElementById('abandoned_baskets')) {
    ReactDOM.render( < RouterabandonedBasket /> , document.getElementById('abandoned_baskets'));
}




    if (document.getElementById('Notififcation_items')) {
        ReactDOM.render( < NotificationsItems user_id = { document.getElementById('notify_wrapper').dataset.user_id }
            />, document.getElementById('Notififcation_items'));
        }




            if (document.getElementById('orders')) {
                ReactDOM.render( < RouterOrder /> , document.getElementById('orders'));
            }




            if (document.getElementById('new_order')) {

                ReactDOM.render( < NewOrder sellers = { $("#new_order").data("sellers") }
                    />, document.getElementById('new_order'));
                }



                if (document.getElementById('special_offers')) {

                    ReactDOM.render( < RouterSpecialOffers /> , document.getElementById('special_offers'));
                }

                if (document.getElementById('customers_js')) {

                    ReactDOM.render( < RouterCustomer /> , document.getElementById('customers_js'));
                }

                  if (document.getElementById('customer_profile')) {

                    ReactDOM.render( < CustomerProfile customer={ $("#customer_profile").data("customer") } /> , document.getElementById('customer_profile'));
                }
                if (document.getElementById('sellers_js')) {

                    ReactDOM.render( < RouterSeller /> , document.getElementById('sellers_js'));
                }
                if (document.getElementById('new_sprcial_offer')) {

                    ReactDOM.render( < SpecialOffersTable /> , document.getElementById('new_sprcial_offer'));
                }


                if (document.getElementById('firebase')) {

                    ReactDOM.render( < RouterFirebase /> , document.getElementById('firebase'));
                }
                if (document.getElementById('setting_smtp_mailer')) {

                    ReactDOM.render( < SettingSmtpMail /> , document.getElementById('setting_smtp_mailer'));
                }

                if (document.getElementById('sms_setting')) {

                    ReactDOM.render( < SmsSetting /> , document.getElementById('sms_setting'));
                }




                if (document.getElementById('newsletter')) {

                    ReactDOM.render( < NewsLetter /> , document.getElementById('newsletter'));
                }


            if (document.getElementById('localShipment')) {

                    ReactDOM.render(<LocalShippingTable   /> , document.getElementById('localShipment'));
            }

                        if (document.getElementById('pusher')) {

                    ReactDOM.render(<Pusher   /> , document.getElementById('pusher'));
                        }
            //  if (document.getElementById('products')) {
            //      ReactDOM.render(<ProductTable search={null} />, document.getElementById('products'));
            //  }
                    if (document.getElementById('products')) {

                        ReactDOM.render(<Provider store={store}>

                                 < ProductTable search={$("#products").data("search")} />

                        </Provider>, document.getElementById('products'));
                    }


                                   if (document.getElementById('product_archive')) {

                    ReactDOM.render(<Provider  store={store}>< ArchiveProductTable search=""   /></Provider> , document.getElementById('product_archive'));
            }


