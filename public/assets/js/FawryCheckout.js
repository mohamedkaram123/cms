const apiBaseUrl = "https://atfawry.fawrystaging.com/ECommerceWeb/api";
const pluginOrigin = "https://atfawry.fawrystaging.com";
const deployPath = "/atfawry/plugin/";
const divId = 'fawry-payments'

export const DISPLAY_MODE = {
    POPUP: 'POPUP',
    INSIDE_PAGE: 'INSIDE_PAGE',
    SIDE_PAGE: 'SIDE_PAGE',
    SEPARATED: 'SEPARATED',
}

export default class FawryPay {

    static checkout(chargeRequest, config, accessToken) {
        config.returnUrl = chargeRequest.returnUrl;
        FawryPay.config = config;
        this.captureOrderInfo(chargeRequest, config, accessToken);
    }

    static captureOrderInfo(chargeRequest, config, accessToken) {
        var div = document.getElementById(divId) || FawryPay.createDiv();
        div.innerHTML = config.locale === 'en' ? "loading..., wait a moment please!" : '\u062c\u0627\u0631\u064a \u0627\u0644\u062a\u062d\u0645\u064a\u0644\u060c \u0628\u0631\u062c\u0627\u0621 \u0627\u0644\u0625\u0646\u062a\u0638\u0627\u0631'
        document.body.appendChild(div);
        const params = {
            headers: {
                'Accept': "application/json, text/plain, */*",
                'Content-Type': "application/json;charset=utf-8",
                'Authorization': accessToken && 'Bearer ' + accessToken
            },
            body: JSON.stringify(chargeRequest),
            method: "POST"
        };

        fetch(`${apiBaseUrl}/payments/init`, params)
            .then(response => {
                if (!response.ok) throw response;
                return response.text();
            })
            .then(paymentId => {
                FawryPay.loadPlugin(paymentId, config);
            })
            .catch(error => {
                div.innerHTML = null
                if (typeof error.json === "function") {
                    error.json()
                        .then((body) => {
                            onFailureCallBack(body);
                        })
                } else {
                    onFailureCallBack({ statusDescription: 'Connection refused!' });
                }
            });
    }


    static loadPlugin(payemtnId, config) {
        const url = `${pluginOrigin + deployPath}?payment-id=${payemtnId}&locale=${config.locale || 'en'}&mode=${config.mode || DISPLAY_MODE.SEPARATED}`;
        const style = FawryPay.getIframStyleBasedOnMode(config.mode);

        if (config.mode == DISPLAY_MODE.SEPARATED || config.mode == null) {
            window.open(url, "_self");
        } else if (config.mode === DISPLAY_MODE.POPUP) {
            var div = document.getElementById(divId) || FawryPay.createDiv();
            div.innerHTML = `<div id="id01" class="modal-f">
			<div class="modal-content">
				<div id="fawry-payments">
					<iframe src=${url}  class="responsive-iframe" frameBorder="0">

					</iframe>
				</div>
				<div id="error"></div>
				</div>
			</div>`
            document.getElementById('id01').style.display = 'block';
            document.body.appendChild(div);

        } else if (config.mode === DISPLAY_MODE.SIDE_PAGE) {
            var div = document.getElementById(divId) || FawryPay.createDiv();
            div.innerHTML = `<div id="id02">
				  	<div class="container">
						<div id="fawry-payments">
							<iframe id='fawryPayPaymentFrame' src=${url} scrolling="yes" style="border: 0; height: 100vh !important; ${style}"/>

							<div id="error"></div>
						</div>
				  	</div>
				  </div>`
            document.getElementById('id02').style.display = 'block';
            config.mode == DISPLAY_MODE.SIDE_PAGE && (div.classList.add('side-page'));
            document.body.appendChild(div);

        } else {
            var div = document.getElementById(divId) || FawryPay.createDiv();
            div.innerHTML = `<iframe id='fawryPayPaymentFrame' src=${url} scrolling="${config.mode == DISPLAY_MODE.SIDE_PAGE ? 'yes' : 'no'}" style="border: 0; ${style}"/>`;
            config.mode == DISPLAY_MODE.SIDE_PAGE && (div.classList.add('side-page'));
            document.body.appendChild(div);
        }
    }

    static getIframStyleBasedOnMode(mode) {
        switch (mode) {
            case DISPLAY_MODE.INSIDE_PAGE:
            case DISPLAY_MODE.SIDE_PAGE:
                return 'width:100%; height:800px;'
        }
    }

    static createDiv() {
        const div = document.createElement('div');
        div.setAttribute('id', divId);
        return div;
    }
}

// const eventMethod = window.addEventListener ? "addEventListener" : "attachEvent"; // to support IE-8
// const eventListener = window[eventMethod];
// var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message"; // to support IE-8

// eventListener(messageEvent, receiveMessage, false);

// function receiveMessage(message) {
//     if (message.origin != pluginOrigin) {
//         return; // message dispatched from another origin rather than target origin
//     }
//     document.getElementById(divId) ? .remove();
//     const data = message.data;
//     if (data) {
//         (data.status == 200 || data.statusCode == 200) ?
//         onSuccessCallBack(data):
//             onFailureCallBack(data);
//     }
// }

// function onSuccessCallBack(data) {
//     FawryPay.config.onSuccess ?
//         FawryPay.config.onSuccess(data) :
//         (window.location.href = FawryPay.config.returnUrl + mapToUrlParams(data));
// }

// function onFailureCallBack(data) {
//     FawryPay.config.onFailure ?
//         FawryPay.config.onFailure(data) :
//         (window.location.href = FawryPay.config.returnUrl + mapToUrlParams(data));
// }

// function mapToUrlParams(object) {
//     return (FawryPay.config.returnUrl.includes('?') ? '&' : '?') +
//         Object.keys(object)
//         .map(prop => [prop, object[prop]]
//             .map(encodeURIComponent).join("="))
//         .join("&");
// }
