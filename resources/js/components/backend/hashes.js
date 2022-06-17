import CryptoJS from 'crypto-js';


export const encryptLocalStorage = (data, storage_name, secret = "cms_fekra") => {

    var ciphertext = CryptoJS.AES.encrypt(JSON.stringify(data), secret);
    localStorage.setItem(storage_name, ciphertext);
    return ciphertext
}

export const hash = "b75524255a7f54d2726a951bb39204df";

export const decryptLocalStorage = (storage_name, secret = "cms_fekra") => {

    if (localStorage.getItem(storage_name) == null) {
        return null;
    }
    var bytes = CryptoJS.AES.decrypt(localStorage.getItem(storage_name), secret);
    var decryptedData = JSON.parse(bytes.toString(CryptoJS.enc.Utf8));

    return decryptedData;
}


export const decrypt = function(encryptStr) {
    encryptStr = CryptoJS.enc.Base64.parse(encryptStr);
    let encryptData = encryptStr.toString(CryptoJS.enc.Utf8);
    encryptData = JSON.parse(encryptData);
    let iv = CryptoJS.enc.Base64.parse(encryptData.iv);
    var decrypted = CryptoJS.AES.decrypt(encryptData.value, CryptoJS.enc.Utf8.parse("q+nOsOK0kHwbCw58zNt0xUYd3V0eKCaY/7OKADxCDWE="), {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });
    decrypted = CryptoJS.enc.Utf8.stringify(decrypted);
    return decrypted;
};

export const encrypt = function(data) {
    let iv = CryptoJS.lib.WordArray.random(16),
        key = CryptoJS.enc.Utf8.parse(hash);
    let options = {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    };
    let encrypted = CryptoJS.AES.encrypt(data, key, options);
    encrypted = encrypted.toString();
    iv = CryptoJS.enc.Base64.stringify(iv);
    let result = {
        iv: iv,
        value: encrypted,
        mac: CryptoJS.HmacSHA256(iv + encrypted, key).toString()
    }
    result = JSON.stringify(result);
    result = CryptoJS.enc.Utf8.parse(result);
    return CryptoJS.enc.Base64.stringify(result);
};

export const hash_role = (role_id) => {
    return "?role_id=" + encrypt(role_id.toString()) + "&react=1";
}