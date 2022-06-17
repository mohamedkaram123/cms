import { ActionTypes } from "../constans/action-type";

const initialState = {
    trans: [],

}

export const langsReducer = (state = initialState, { type, payload }) => {

    switch (type) {
        case ActionTypes.SET_TRANS:

            return {...state, trans: payload };
        default:
            return state;
    }

}