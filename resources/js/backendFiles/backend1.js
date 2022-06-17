/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('../bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import React from 'react';
import { Provider } from 'react-redux';
import store from '../store';
import '../custom_style.css';
import ReactDOM from 'react-dom';

import Dashboard from '../components/backend/dashboard/dashboard';
import Notify from '../components/backend/Notifications/notify';
import NotificationsItems from '../components/backend/Notifications/NotificationItems';



                if (document.getElementById('home_backend')) {

                    ReactDOM.render( < Dashboard /> , document.getElementById('home_backend'));
                }

                if (document.getElementById('notify_wrapper')) {
                        ReactDOM.render( < Notify user_id = { document.getElementById('notify_wrapper').dataset.user_id }
                            />, document.getElementById('notify_wrapper'));
                        }


    if (document.getElementById('Notififcation_items')) {
        ReactDOM.render( < NotificationsItems user_id = { document.getElementById('notify_wrapper').dataset.user_id }
            />, document.getElementById('Notififcation_items'));
        }


