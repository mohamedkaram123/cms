import React from 'react'
import SellersTable from './seller_table/seller_table';
import SellerProfile from './seller_profile/seller_profile';

import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
  } from "react-router-dom";
import { Urls } from '../urls';
export default function RouterSeller() {
    return (
        <div>
          <Router>
            <Switch>
          <Route
           path={Urls.static_url + "seller/seller_profile"}>
            <SellerProfile  />
          </Route>

          <Route path="/">
                        <SellersTable  search={$("#sellers_js").data("search")}  />
          </Route>
        </Switch>

    </Router>
        </div>
    )
}
