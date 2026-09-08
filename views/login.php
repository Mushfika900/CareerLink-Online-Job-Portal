<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerLink Login</title>
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
                <h1>Where job seekers and <br> employers link up.</h1>
                <p>
                    Search,apply and hire - one focused <br> workflow, no clutter.
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
                <h2>Welcome back</h2>
                <p>
                    Log in to continue to your dashboard.
                </p>
                <form method="post" action="../controllers/loginControl.php">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com">
                    <span id="emailError"></span><br>
                    <label for="pass" class="pass">Password</label>
                    <a href="forgot.php" class="forgot">Forgot Password?</a>
                    <input type="password" id="pass" name="pass" placeholder="Enter password">
                    <span id="passError"></span>
                    <button type="button" class="show-btn" id="showBtn" onclick="showPassword()">Show</button>
                    
                    <button  type="submit" class="btn">Log in</button>
                    <p class="create">
                        Now here?
                        <a href="#">Create an account</a>
                    </p>
                </form>
            </div>
        </div>
    <script src="../views/js/login.js"></script>
</body>
</html>