<?php

session_start();

require_once "../models/userModel.php";

if (isset($_POST["login"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = loginUser($email, $password);

    if ($user)
    {
        if ($user["status"] != "active")
        {
            echo "Your account is inactive.";
            exit();
        }

        session_regenerate_id(true);

        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["role"] = $user["role"];

        if ($user["role"] == "admin")
        {
            header("Location: ../controllers/adminControls.php?page=dashboard");
            exit();
        }

        else if ($user["role"] == "jobseeker")
        {
            header("Location: ../controllers/jobSeekerControls.php?page=dashboard");
            exit();
        }

        else if ($user["role"] == "employer")
        {
            header("Location: ../controllers/employerControls.php?page=dashboard");
            exit();
        }

        else
        {
            session_unset();
            session_destroy();

            header("Location: ../views/login.php");
            exit();
        }
    }

    else
    {
        echo "Invalid email or password";
    }
}

else
{
    header("Location: ../views/login.php");
    exit();
}

?>