<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="../views/css/style.css">
    <script src="../views/js/verify.js"></script>
</head>
<body>
    <!-- left side -->
    <div class="login-container">
        <div class="left">
            <div class="logo">
                <span class="logo-circle"></span>
                CareerLink
            </div>
            <div class="left-text">
                <h1> Almost there - verify <br> your code.</h1>
                <p>
                    Enter the 6-digit OTP we sent to your <br> registered email to continue.
                </p>
            </div>
            <div class="dot">
                <span class="dot1"></span>
                <span class="dot2"></span>
                <span class="dot2"></span>
            </div>
        </div>

        <!-- Right-side -->
        <div class="right">
            <div class="login-form">
                <h2>Verify OTP</h2>
                <p>
                    Code sent to your email. Enter it below to continue.
                </p>
                <form method="post" action="../controllers/verifyOtpControl.php">
                    <label for="otp">6-Digit OTP</label>
                    <input type="text" id="otp" name="otp" placeholder="Enter 6-digit OTP" maxlength="6" onkeyup="checkOTP()">
                    <span id="otpError"></span>
                    <p class="otp-time">Expires in 02:00</p>
                    <button type="submit" class="btn" id="btn" name="verify">Verify OTP</button>
                    <p class="resend-text">Didn't get the code?
                        <a href="../controllers/resendOtpControl.php">Resend OTP</a></p>
                        <a href="login.php" class="back-login">
                            &larr;Back to Login
                        </a>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>