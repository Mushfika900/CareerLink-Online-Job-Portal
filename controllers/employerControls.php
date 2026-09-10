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

?>