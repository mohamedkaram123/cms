import React from 'react'
import NewOrder from './new_order/new_order';
import OrderTable from './order_table/order_table';

import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
  } from "react-router-dom";
import { Urls } from '../urls';
export default function RouterOrder() {
    return (
        <div>
          <Router>
            <Switch>
          <Route path={Urls.static_url + "NewerOrders/new_order"} >
            <NewOrder sellers={$("#orders").data("sellers") } />
          </Route>

          <Route  path="/">
            <OrderTable search={$("#orders").data("search") } orders={$("#orders").data("orders")} order_search={$("#orders").data("order_search") }  />
          </Route>
        </Switch>

    </Router>
        </div>
    )
}
