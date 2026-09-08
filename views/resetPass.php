<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
    <link rel="stylesheet" href="../views/css/style.css">
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
                <h1>One last step.</h1>
                <p>
                    Choose a new password to secure your account.
                </p>
            </div>
            <div class="dot">
                <span class="dot1"></span>
                <span class="dot2"></span>
                <span class="dot2"></span>
            </div>
        </div>

         <div class="right">
            <div class="login-form">
                <h2>Create new password</h2>
                <p>
                    Your OTP has been verified. Set a new password below.
                </p>
                <form method="post" action="../controllers/resetPassControl.php">
                    <label for="newPass">New Password</label>
                    <div class="pass-box">
                    <input type="password" id="newPass" name="newPass" placeholder="Enter New Password">
                    <button type="button" class="show-pass" onclick="showNewPassword()">Show</button>
                    </div>

                    <span id="newPassError"></span>

                    <label for="confirmPass">Confirm Password</label>
                    <div class="pass-box">
                    <input type="password" id="confirmPass" name="confirmPass" placeholder="Confirm new password">
                    <button type="button" class="show-pass" onclick="showConfirmPassword()">Show</button>
                    </div>

                    <span id="confirmPassError"></span>
                    
                    <p class="pass-text">&#10003; Minimum 8 characters - passwords must match</p>
                    <button type="submit" class="btn">Reset Password</button>
                    <a href="login.php" class="back">
                        &larr;Back to Login</a>
                </form>
            </div>
         </div>
    </div>
<script src="../views/js/resetPass.js"></script>
</body>
</html>