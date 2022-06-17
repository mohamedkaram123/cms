import { encryptLocalStorage, decryptLocalStorage } from '../components/backend/hashes';
import { Urls } from '../components/backend/urls';
export const header = {
    headers: {
        "Accept-Language": !localStorage.getItem("lang") ? "en" : localStorage.getItem("lang"),
    }
}

export const header_auth = {
    headers: {
        "Accept-Language": !localStorage.getItem("lang") ? "en" : localStorage.getItem("lang"),
        "Authorization": !decryptLocalStorage("user") ? null : "Bearer " + decryptLocalStorage("user").access_token,
        "Accept": "application/json"
    }
}


export const csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


export const pathname = () => {
    let path = Urls.static_url;
    let arr_path = path.split("/");


    let end_path = arr_path[arr_path.length - 3] + "/" + arr_path[arr_path.length - 2];
    return end_path;
}