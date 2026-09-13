<?php

require_once "../config/dbConnect.php";
require_once "../models/employerModel.php";

$employerId = 1;

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

if ($page == "postJob")
{
    $employer = getEmployerInfo($employerId);

    if (isset($_POST["postJob"]))
    {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $requirements = $_POST["requirements"];
        $category = $_POST["category"];
        $location = $_POST["location"];
        $salary = $_POST["salary"];
        $deadline = $_POST["deadline"];

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

    require_once "../views/employer/postJob.php";
}
    if ($page == "postJob")
{
    $employer = getEmployerInfo($employerId);

    if (isset($_POST["postJob"]))
    {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $requirements = $_POST["requirements"];
        $category = $_POST["category"];
        $location = $_POST["location"];
        $salary = $_POST["salary"];
        $deadline = $_POST["deadline"];

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

    require_once "../views/employer/postJob.php";
}
if ($page == "myJobs")
{
    $employer = getEmployerInfo($employerId);

    $jobs = getEmployerJobs($employerId);

    require_once "../views/employer/myJobs.php";
}
    if ($page == "editJob")
{
    $employer = getEmployerInfo($employerId);

    if (isset($_GET["id"]))
    {
        $jobId = $_GET["id"];

        $job = getEmployerJobById($jobId, $employerId);
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
        $title = $_POST["title"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $location = $_POST["location"];
        $salary = $_POST["salary"];
        $deadline = $_POST["deadline"];

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

    require_once "../views/employer/editJob.php";
}

if ($page == "jobAction")
{
    if (isset($_POST["jobId"]) && isset($_POST["action"]))
    {
        $jobId = $_POST["jobId"];
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
function getJobApplicants($jobId, $employerId)
{
    global $conn;

    $jobId = (int)$jobId;
    $employerId = (int)$employerId;

    $sql = "SELECT applications.application_id,
                   applications.applied_date,
                   applications.status,
                   jobseekers.resume_file,
                   users.name
            FROM applications

            JOIN jobs
            ON applications.job_id = jobs.job_id

            JOIN jobseekers
            ON applications.seeker_id = jobseekers.seeker_id

            JOIN users
            ON jobseekers.user_id = users.user_id

            WHERE applications.job_id = $jobId
            AND jobs.employer_id = $employerId

            ORDER BY applications.applied_date DESC";

    return mysqli_query($conn, $sql);
}
if ($page == "applicants")
{
    $employer = getEmployerInfo($employerId);

    if (isset($_GET["id"]))
    {
        $jobId = $_GET["id"];

        $job = getEmployerJobById($jobId, $employerId);
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

if ($page == "updateApplication")
{
    if (isset($_POST["applicationId"]) &&
        isset($_POST["jobId"]) &&
        isset($_POST["status"]))
    {
        $applicationId = $_POST["applicationId"];
        $jobId = $_POST["jobId"];
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
if ($page == "profile")
{
    $employer = getEmployerInfo($employerId);


    if (isset($_POST["saveProfile"]))
    {
        $name = $_POST["name"];

        $email = $_POST["email"];

        $phone = $_POST["phone"];

        $companyName = $_POST["companyName"];

        $companyAddress = $_POST["companyAddress"];


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
            header("Location: employerControls.php?page=profile");
            exit();
        }
        else
        {
            $message = "Profile could not be updated.";
        }
    }


    $employer = getEmployerInfo($employerId);


    require_once "../views/employer/profile.php";
}
if ($page == "deleteAccount")
{
    if (isset($_POST["deleteAccount"]))
    {
        $result = deleteEmployerAccount($employerId);

        if ($result)
        {
            header("Location: ../views/login.php");
            exit();
        }
        else
        {
            header("Location: employerControls.php?page=profile");
            exit();
        }
    }

    header("Location: employerControls.php?page=profile");
    exit();
}
?>