<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account</title>

    <link rel="stylesheet" href="../views/css/style.css">
</head>

<body>

<div class="login-container">
    <!-- left side -->
    <div class="left">
        <div class="logo">
            <span class="logo-circle"></span>
            <span>CareerLink</span>
        </div>

        <div class="left-text">
            <h1>Create your account.</h1>

            <p>
                Join CareerLink and start <br>
                your career jouney today.
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
            <h2>Create Account</h2>
            <p>Register as a jobseeker or employer</p>
            <div class="account-type">
                <button type="button" class="btn_jobseeker active" data-role="jobseeker">Job Seeker </button>
                <button type="button" class="btn_employer" data-role="employer">Employer </button>
            </div>
            <form method="post" action="../controllers/registrationControl.php">
                <input type="hidden" name="role" value="jobseeker">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter your name">
                <br>
                <label>Email</label>
                <input type="email" name="email" placeholder="you@xample.com">
                <br>
                <label>Phone</label>
                <input type="text" name="phone" placeholder="01XXXXXXXXX">
                <br>

                <label>Password</label>
                <div class="pass-box">
                <input type="password" id="password" name="password" placeholder="Enter password">
                <button type="button" id="show-pass">Show</button>
                </div>

                <button type="submit" class="btn">Create Account</button>
                <p class="create">Already have an account?
                    <a href="login.php">Login</a>
                </p>

            </form>
        </div>
    </div>
     <script src="../views/js/registration.js"></script>

</body>
</html>