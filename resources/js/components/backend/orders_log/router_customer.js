import React from 'react'
import CustomersTable from './customer_table/customer_table';
import CustomerProfile from './customer_profile/customer_profile';

import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
  } from "react-router-dom";
import { Urls } from '../urls';
export default function RouterCustomer() {
    return (
        <div>
            <Router>
                <Switch>
          <Route
           path={Urls.static_url + "customer/customer_profile"}>
            <CustomerProfile  />
          </Route>

          <Route path="/">
            <CustomersTable customers={$("#customers_js").data("customers")} search={$("#customers_js").data("search") } />
          </Route>
                        </Switch>

    </Router>
        </div>
    )
}
