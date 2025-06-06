// Declare globally accessible variables
let confirmationResult;
let recaptchaVerifier; // make this scoped and managed
let recaptchaWidgetId;
const sendOTPButton = document.getElementById("sendOTPButton"); // Assuming you have a button with this ID

// Firebase config
const firebaseConfig = {
    apiKey: "",
    authDomain: "",
    projectId: " ",
    storageBucket: " ",
    messagingSenderId: " ",
    appId: " ",
    measurementId: ""
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Initialize reCAPTCHA ONLY ONCE
window.onload = function () {
    recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        size: 'normal',
        callback: function (response) {
            console.log('reCAPTCHA solved');
            if (sendOTPButton) {
                sendOTPButton.disabled = false;
            }
        },
        'expired-callback': function () {
            alert("reCAPTCHA expired. Please reload the page.");
            if (sendOTPButton) {
                sendOTPButton.disabled = true; // Disable on expiry
            }
        }
    });

    recaptchaVerifier.render().then(function (widgetId) {
        console.log(recaptchaVerifier)
        recaptchaWidgetId = widgetId;
        // Initially disable the button until reCAPTCHA is ready
        if (sendOTPButton) {
            sendOTPButton.disabled = true;
        }
    }).catch(error => {
        console.error("Error rendering reCAPTCHA:", error);
        if (sendOTPButton) {
            sendOTPButton.disabled = true; // Disable on render failure
        }
    });
}


function sendOTP() {
    let phoneNumber = document.getElementById("phoneNumber").value.trim();
    phoneNumber = phoneNumber.replace(/[-\s]/g, "");

    if (!phoneNumber.startsWith("+91")) {
        if (/^[6-9]\d{9}$/.test(phoneNumber)) {
            phoneNumber = "+91" + phoneNumber;
        } else {
            alert("Please enter a valid 10-digit mobile number.");
            return;
        }
    }

    if (!recaptchaVerifier) {
        alert("reCAPTCHA not initialized. Please reload the page.");
        return;
    }

    const sendOTPButton = document.getElementById("sendOTPButton");
    if (sendOTPButton) {
        sendOTPButton.disabled = true;
    }

    recaptchaVerifier.verify()
        .then(function (recaptchaToken) {
            return firebase.auth().signInWithPhoneNumber(phoneNumber, recaptchaVerifier);
        })
        .then((result) => {
            confirmationResult = result;
            alert("OTP Sent!");
            document.getElementById("otpSection").style.display = "block";
        })
        .catch((error) => {
            console.error("SMS not sent", error);
            alert("Failed to send OTP: " + error.message);
            if (recaptchaVerifier && typeof recaptchaVerifier.clear === 'function') {
                recaptchaVerifier.clear();
            }
        })
        .finally(() => {
            if (sendOTPButton) {
                sendOTPButton.disabled = false;
            }
        });
}

function verifyOTP() {
    const code = document.getElementById("otp").value;

    if (!confirmationResult) {
        alert("OTP not sent yet. Please try again.");
        return;
    }

    confirmationResult.confirm(code)
        .then((result) => {
            const user = result.user;

            let phoneNumber = document.getElementById("phoneNumber").value.trim();
            phoneNumber = phoneNumber.replace(/\+91/, ''); // Store only 10-digit number

            document.getElementById("inputField1").value = phoneNumber;
            console.log("Submitting number to backend:", phoneNumber);

            document.getElementById("storePhoneForm").submit();
        })
        .catch((error) => {
            alert("Incorrect OTP: " + error.message);
            console.error("OTP verification failed", error);
        });
}
