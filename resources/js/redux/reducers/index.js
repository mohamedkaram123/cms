import { combineReducers } from "redux";
import { langsReducer } from "./langsReducer";
import { productsReducer } from "./productsReducer";

const reducers = combineReducers({
    allTanslations: langsReducer,
    all_rows: productsReducer
})

console.log({ reducers });

export default reducers;