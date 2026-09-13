<?php

session_start();

require_once '../config/dbConnect.php';
require_once '../models/adminModel.php';

if (!isset($_SESSION["user_id"]))
{
    header("Location: ../views/login.php");
    exit();
}

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin")
{
    header("Location: ../views/login.php");
    exit();
}

$page = $_GET['page'] ?? 'dashboard';


if ($page == 'dashboard')
{
    $totalUsers = getTotalUsers();
    $totalJobSeekers = getTotalJobSeekers();
    $totalEmployers = getTotalEmployers();
    $totalJobs = getTotalJobs();

    require_once '../views/admin/dashboard.php';
}


else if ($page == 'users')
{
    if (
        isset($_GET['action']) &&
        $_GET['action'] == 'status' &&
        isset($_GET['id']) &&
        isset($_GET['status'])
    )
    {
        $userId = (int)$_GET['id'];
        $status = $_GET['status'];

        if ($status == "active" || $status == "inactive")
        {
            updateUserStatus($userId, $status);
        }

        header("Location: adminControls.php?page=users");
        exit();
    }

    if (
        isset($_GET['action']) &&
        $_GET['action'] == 'delete' &&
        isset($_GET['id'])
    )
    {
        $userId = (int)$_GET['id'];

        deleteUser($userId);

        header("Location: adminControls.php?page=users");
        exit();
    }

    $search = $_GET['search'] ?? '';
    $role = $_GET['role'] ?? '';

    $users = getAllUsers($search, $role);

    require_once '../views/admin/manageUsers.php';
}


else if ($page == 'userDetails')
{
    if (!isset($_GET['id']))
    {
        header("Location: adminControls.php?page=users");
        exit();
    }

    $userId = (int)$_GET['id'];

    $user = getUserById($userId);

    if (!$user)
    {
        header("Location: adminControls.php?page=users");
        exit();
    }

    require_once '../views/admin/userDetails.php';
}


else if ($page == 'jobs')
{
    if (
        isset($_GET['action']) &&
        $_GET['action'] == 'status' &&
        isset($_GET['id']) &&
        isset($_GET['status'])
    )
    {
        $jobId = (int)$_GET['id'];
        $status = $_GET['status'];

        if ($status == "active" || $status == "closed")
        {
            updateJobStatus($jobId, $status);
        }

        header("Location: adminControls.php?page=jobs");
        exit();
    }

    if (
        isset($_GET['action']) &&
        $_GET['action'] == 'delete' &&
        isset($_GET['id'])
    )
    {
        $jobId = (int)$_GET['id'];

        deleteJob($jobId);

        header("Location: adminControls.php?page=jobs");
        exit();
    }

    $search = $_GET['search'] ?? '';
    $status = $_GET['status'] ?? '';

    $jobs = getAllJobs($search, $status);

    require_once '../views/admin/manageJobs.php';
}


else if ($page == 'jobDetails')
{
    if (!isset($_GET['id']))
    {
        header("Location: adminControls.php?page=jobs");
        exit();
    }

    $jobId = (int)$_GET['id'];

    $job = getJobById($jobId);

    if (!$job)
    {
        header("Location: adminControls.php?page=jobs");
        exit();
    }

    require_once '../views/admin/jobDetails.php';
}


else if ($page == 'statistics')
{
    $totalUsers = getTotalUsers();
    $totalJobSeekers = getTotalJobSeekers();
    $totalEmployers = getTotalEmployers();
    $totalJobs = getTotalJobs();
    $totalApplications = getTotalApplications();

    $jobStatusStatistics = getJobStatusStatistics();

    $applicationStatusStatistics = getApplicationStatusStatistics();

    require_once '../views/admin/statistics.php';
}


else
{
    header("Location: adminControls.php?page=dashboard");
    exit();
}

?>