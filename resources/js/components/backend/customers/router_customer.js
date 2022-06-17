import React from 'react'
import CustomersTable from './customer_table/customer_table';

import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
  } from "react-router-dom";
import { Urls } from '../urls';
import { pathname } from '../../../helpers/Headers';

export default function RouterCustomer() {
        const basename = pathname();

    console.log({basename});
    return (
        <div>
            <Router >
                <Switch>


          <Route path="/">
            <CustomersTable customers={$("#customers_js").data("customers")} search={$("#customers_js").data("search") } />
                    </Route>


                        </Switch>

    </Router>
        </div>
    )
}
