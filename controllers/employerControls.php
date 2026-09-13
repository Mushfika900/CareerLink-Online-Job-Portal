<?php
 
session_start();
 
require_once "../config/dbConnect.php";
require_once "../models/employerModel.php";
 
if (!isset($_SESSION["user_id"]))
{
    header("Location: ../views/login.php");
    exit();
}
 
if (!isset($_SESSION["role"]) || $_SESSION["role"] != "employer")
{
    header("Location: ../views/login.php");
    exit();
}
 
$userId = (int)$_SESSION["user_id"];
 
$employerId = getEmployerIdByUserId($userId);
 
if (!$employerId)
{
    session_unset();
    session_destroy();
 
    header("Location: ../views/login.php");
    exit();
}
 
if (isset($_GET["page"]))
{
    $page = $_GET["page"];
}
else
{
    $page = "dashboard";
}
 
if ($page == "dashboard")
{
    $employer = getEmployerInfo($employerId);
 
    $totalJobs = getTotalJobs($employerId);
 
    $activeJobs = getActiveJobs($employerId);
 
    $totalApplicants = getTotalApplicants($employerId);
 
    $pendingApplications = getPendingApplications($employerId);
 
    $recentJobs = getRecentJobs($employerId);
 
    require_once "../views/employer/dashboard.php";
}
 
else if ($page == "postJob")
{
    $employer = getEmployerInfo($employerId);
 
    $message = "";
 
    if (isset($_POST["postJob"]))
    {
        $title = trim($_POST["title"] ?? "");
 
        $description = trim($_POST["description"] ?? "");
 
        $requirements = trim($_POST["requirements"] ?? "");
 
        $category = trim($_POST["category"] ?? "");
 
        $location = trim($_POST["location"] ?? "");
 
        $salary = trim($_POST["salary"] ?? "");
 
        $deadline = trim($_POST["deadline"] ?? "");
 
        if (
            $title == "" ||
            $description == "" ||
            $category == "" ||
            $location == "" ||
            $salary == "" ||
            $deadline == ""
        )
        {
            $message = "Please fill in all required fields.";
        }
 
        else
        {
            $result = addJob(
                $employerId,
                $title,
                $description,
                $requirements,
                $category,
                $location,
                $salary,
                $deadline
            );
 
            if ($result)
            {
                header("Location: employerControls.php?page=dashboard");
                exit();
            }
 
            else
            {
                $message = "Job could not be posted.";
            }
        }
    }
 
    require_once "../views/employer/postJob.php";
}
 
else if ($page == "myJobs")
{
    $employer = getEmployerInfo($employerId);
 
    $jobs = getEmployerJobs($employerId);
 
    require_once "../views/employer/myJobs.php";
}
 
else if ($page == "editJob")
{
    $employer = getEmployerInfo($employerId);
 
    $message = "";
 
    if (isset($_GET["id"]))
    {
        $jobId = (int)$_GET["id"];
 
        $job = getEmployerJobById(
            $jobId,
            $employerId
        );
    }
 
    else
    {
        header("Location: employerControls.php?page=myJobs");
        exit();
    }
 
    if (!$job)
    {
        header("Location: employerControls.php?page=myJobs");
        exit();
    }
 
    if (isset($_POST["updateJob"]))
    {
        $title = trim($_POST["title"] ?? "");
 
        $description = trim($_POST["description"] ?? "");
 
        $category = trim($_POST["category"] ?? "");
 
        $location = trim($_POST["location"] ?? "");
 
        $salary = trim($_POST["salary"] ?? "");
 
        $deadline = trim($_POST["deadline"] ?? "");
 
        if (
            $title == "" ||
            $description == "" ||
            $category == "" ||
            $location == "" ||
            $salary == "" ||
            $deadline == ""
        )
        {
            $message = "Please fill in all required fields.";
        }
 
        else
        {
            $result = updateEmployerJob(
                $jobId,
                $employerId,
                $title,
                $description,
                $category,
                $location,
                $salary,
                $deadline
            );
 
            if ($result)
            {
                header("Location: employerControls.php?page=myJobs");
                exit();
            }
 
            else
            {
                $message = "Job could not be updated.";
            }
        }
    }
 
    require_once "../views/employer/editJob.php";
}
 
else if ($page == "jobAction")
{
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        isset($_POST["jobId"]) &&
        isset($_POST["action"])
    )
    {
        $jobId = (int)$_POST["jobId"];
 
        $action = $_POST["action"];
 
        if ($action == "close")
        {
            changeJobStatus(
                $jobId,
                $employerId,
                "closed"
            );
        }
 
        else if ($action == "activate")
        {
            changeJobStatus(
                $jobId,
                $employerId,
                "active"
            );
        }
 
        else if ($action == "delete")
        {
            deleteEmployerJob(
                $jobId,
                $employerId
            );
        }
    }
 
    header("Location: employerControls.php?page=myJobs");
    exit();
}
 

 
else if ($page == "applicants")
{
    $employer = getEmployerInfo($employerId);
 
    if (isset($_GET["id"]))
    {
        $jobId = (int)$_GET["id"];
 
        $job = getEmployerJobById(
            $jobId,
            $employerId
        );
    }
 
    else
    {
        header("Location: employerControls.php?page=myJobs");
        exit();
    }
 
    if (!$job)
    {
        header("Location: employerControls.php?page=myJobs");
        exit();
    }
 
    $applicants = getJobApplicants(
        $jobId,
        $employerId
    );
 
    require_once "../views/employer/applicants.php";
}
 
else if ($page == "updateApplication")
{
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        isset($_POST["applicationId"]) &&
        isset($_POST["jobId"]) &&
        isset($_POST["status"])
    )
    {
        $applicationId = (int)$_POST["applicationId"];
 
        $jobId = (int)$_POST["jobId"];
 
        $status = $_POST["status"];
 
        updateApplicationStatus(
            $applicationId,
            $jobId,
            $employerId,
            $status
        );
 
        header(
            "Location: employerControls.php?page=applicants&id=" . $jobId
        );
 
        exit();
    }
 
    header("Location: employerControls.php?page=myJobs");
    exit();
}
 
else if ($page == "profile")
{
    $employer = getEmployerInfo($employerId);
 
    $message = "";
 
    if (isset($_POST["saveProfile"]))
    {
        $name = trim($_POST["name"] ?? "");
 
        $email = trim($_POST["email"] ?? "");
 
        $phone = trim($_POST["phone"] ?? "");
 
        $companyName = trim($_POST["companyName"] ?? "");
 
        $companyAddress = trim($_POST["companyAddress"] ?? "");
 
        if (
            $name == "" ||
            $email == "" ||
            $phone == "" ||
            $companyName == "" ||
            $companyAddress == ""
        )
        {
            $message = "Please fill in all fields.";
        }
 
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $message = "Please enter a valid email.";
        }
 
        else
        {
            $result = updateEmployerProfile(
                $employerId,
                $name,
                $email,
                $phone,
                $companyName,
                $companyAddress
            );
 
            if ($result)
            {
                header(
                    "Location: employerControls.php?page=profile"
                );
 
                exit();
            }
 
            else
            {
                $message = "Profile could not be updated.";
            }
        }
    }
 
    $employer = getEmployerInfo($employerId);
 
    require_once "../views/employer/profile.php";
}
 
else if ($page == "deleteAccount")
{
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        isset($_POST["deleteAccount"])
    )
    {
        $result = deleteEmployerAccount(
            $employerId
        );
 
        if ($result)
        {
            session_unset();
 
            session_destroy();
 
            header("Location: ../views/login.php");
 
            exit();
        }
 
        else
        {
            header(
                "Location: employerControls.php?page=profile"
            );
 
            exit();
        }
    }
 
    header(
        "Location: employerControls.php?page=profile"
    );
 
    exit();
}
 
else
{
    header(
        "Location: employerControls.php?page=dashboard"
    );
 
    exit();
}
 
?>