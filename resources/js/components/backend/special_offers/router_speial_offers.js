import React from 'react'
import SpecialOffersTable from './specia_offers_table/special_offers_table';

import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
} from "react-router-dom";
  import { createBrowserHistory } from 'history';
import { pathname } from '../../../helpers/Headers';

export default function RouterSpecialOffers() {
        const historyInstance = createBrowserHistory();
    const basename = pathname();

    return (
        <div>
            <Router >
                <Switch>


          <Route   path="/">
            <SpecialOffersTable />
          </Route>
                        </Switch>

    </Router>
        </div>
    )
}
