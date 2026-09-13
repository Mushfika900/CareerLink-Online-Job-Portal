<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../views/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="left">
            <div class="logo">
                <span class="logo-circle"></span>
                CareerLink
            </div>
            <div class="left-text">
                <h1>
                    Locked out happens. <br>
                    Let's get you back in.
                </h1>
                <p>
                    We will send a 6-digit OTP to your registered <br> email to verify it's you.
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
                <h2>Reset your password</h2>
                <p>
                    Enter the email linked to your account - an OTP will be sent to verify it's you.
                </p>
                <form method="post" action="../controllers/forgotControl.php">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required onkeyup="checkEmail()">
                    <span id="emailError"></span>
          
                    <button type="submit" name="submit" class="btn">Send Verification Code</button>
                    <a href="login.php" class="back-login">&larr;Back to Login</a>
                </form>
            </div>
        </div>
    </div>
    <!-- <script src=""></script> -->
</body>
</html>