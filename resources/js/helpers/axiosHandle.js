import axios from "axios";
import { Urls } from '../components/backend/urls';
import { csrf_token } from "./Headers";
export function post(url, data, success, error) {

    axios.post(url, data)
        .then(function(res) {
            success(res)
        })
        .catch(function(err) {
            error(err)
        })

}


export function get(url, success, error) {

    axios.get(url)
        .then(function(res) {
            success(res)
        })
        .catch(function(err) {
            error(err)
        })

}


export function checkPermissions(nums, success, error) {

    let data = {
        _token: csrf_token,
        nums
    }

    axios.post(Urls.static_url + "roles/checks", data)
        .then(function(res) {
            success(res.data.checks)
        })
        .catch(function(err) {
            error(err)
        })

}