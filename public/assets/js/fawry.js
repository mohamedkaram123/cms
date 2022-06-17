import Sha256 from '../../../public/assets/js/sha256.js';
import FawryPay, { DISPLAY_MODE } from './FawryCheckout.js';


export function functionaddlog() {
    console.log("dsddsdssd");
}

export function checkout(merchantCode, merchantRefNum, itemId, price, merchant_sec_key, returnUrl, user) {
    const configuration = {
        locale: "en", //default en
        mode: DISPLAY_MODE.SEPARATED, // required, set to SEPARATED for checkout link integration
    };
    FawryPay.checkout(buildChargeRequest(merchantCode, merchantRefNum, itemId, price, merchant_sec_key, returnUrl, user), configuration);
}


function buildChargeRequest(merchantCode, merchantRefNum, itemId, price, merchant_sec_key, returnUrl, user) {


    // let merchantCode = "1tSa6uxz2nSDBAu4fGpqXw==";
    // let merchantRefNum = "99900642041";
    // let customerProfileId = "458626698";

    // let itemId =   '6b5fdea340e31b3b0339d4d4ae5';
    let quantity = 1;
    // let price = 50.00;

    // let merchant_sec_key = "d876355df7d24c4da1a09c03f63ec0bc";
    // let returnUrl = 'http://www.merchanturl.com/returnpage';
    let signature_body = Sha256(
        merchantCode + merchantRefNum +
        user.id + itemId +
        quantity + price + merchant_sec_key

    )
    const chargeRequest = {
        merchantCode,
        merchantRefNum,
        customerMobile: user.phone,
        customerEmail: user.email,
        customerName: user.name,
        customerProfileId: user.id,
        paymentExpiry: '1631138400000',

        chargeItems: [{
                itemId,
                description: 'Product Description',
                price,
                quantity,
                imageUrl: 'https://your-site-link.com/photos/45566.jpg',

            },

        ],
        returnUrl,
        authCaptureModePayment: false,
        signature: signature_body
    };
    return chargeRequest;
}
