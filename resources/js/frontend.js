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


import TopSelling from './components/frontend/product_details/top_selling/top_selling_products';
import Products from './components/frontend/product_details/related_product/related_product';
import RelatedProducts from './components/frontend/product_details/related_product/related_product';
import RatingShop from './components/frontend/product_details/ratting_shop/rating_shop';
import Boxes from './components/frontend/dashboard/boxes/boxes';
import Categories from './components/frontend/dashboard/categories/categories';
import SaidBarPanel from './components/frontend/dashboard/saidbarPanel/saidbarPanel';
import StoreHome from './components/frontend/shops/store_home';
// import NotifySpecialOffers from './components/frontend/notifySpecialOffers/notifySpecialOffer';
import Index from './components/frontend/shipping_data';
import AddAddress from './components/frontend/customers/add_address';
import CategoriesSliderOffers from './components/frontend/specialOffer/CategoriesSliderOffers';
import Login from './components/frontend/user_login3';
import ModalSearch from './components/frontend/products_list/modal_search';

                if (document.getElementById('top_selling_product')) {

                    ReactDOM.render(< TopSelling detailedProduct={  $("#top_selling_product").data("details") } /> , document.getElementById('top_selling_product'));
                }

                  if (document.getElementById('related_products')) {

                      ReactDOM.render(< RelatedProducts
                          user={$("#related_products").data("user")}
                          auth={$("#related_products").data("auth")}
                          detailedProduct={$("#related_products").data("details")} />, document.getElementById('related_products'));
                }

        if (document.getElementById('rating_shop')) {

                    ReactDOM.render(< RatingShop detailedProduct={  $("#rating_shop").data("details") } /> , document.getElementById('rating_shop'));
        }
           if (document.getElementById('dashboard_boxes')) {

                    ReactDOM.render(< Boxes  /> , document.getElementById('dashboard_boxes'));
           }
            if (document.getElementById('dashboard_Categories')) {

                    ReactDOM.render(< Categories  /> , document.getElementById('dashboard_Categories'));
            }

  if (document.getElementById('dashboard_side_nav')) {

                    ReactDOM.render(< SaidBarPanel  /> , document.getElementById('dashboard_side_nav'));
            }
if (document.getElementById('home_store')) {
      console.log("ddddddddddd");

                    ReactDOM.render(< StoreHome type={$("#home_store").data("type") } user_id={$("#home_store").data("user_id") }  /> , document.getElementById('home_store'));
            }




            if (document.getElementById('shipping_data')) {

                ReactDOM.render(<Provider store={store}>< Index
                    product_manage_by_admin={$("#shipping_data").data("product_manage_by_admin")}
                /></Provider>, document.getElementById('shipping_data'));
            }



            if (document.getElementById('add_address')) {

                    ReactDOM.render(<AddAddress   /> , document.getElementById('add_address'));
            }

if (document.getElementById('section_categories_offer')) {

                    ReactDOM.render(<CategoriesSliderOffers   /> , document.getElementById('section_categories_offer'));
}

   if (document.getElementById('user_login3')) {

                    ReactDOM.render(<Login   /> , document.getElementById('user_login3'));
            }

              if (document.getElementById('modal_search')) {

                    ReactDOM.render(<ModalSearch   /> , document.getElementById('modal_search'));
            }



