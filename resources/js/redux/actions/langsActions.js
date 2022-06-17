import { ActionTypes } from "../constans/action-type"

export const setTranslations = (trans) => {
    return {
        type: ActionTypes.SET_TRANS,
        payload: trans
    }
}