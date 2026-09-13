<?php

require_once '../config/dbConnect.php';
require_once '../models/adminModel.php';

$page = $_GET['page'] ?? 'dashboard';


if ($page == 'dashboard') {
    $totalUsers = getTotalUsers();
    $totalJobSeekers = getTotalJobSeekers();
    $totalEmployers = getTotalEmployers();
    $totalJobs = getTotalJobs();

    require_once '../views/admin/dashboard.php';
}
if ($page == 'users') {

    if (isset($_GET['action']) && $_GET['action'] == 'status') {

        $userId = $_GET['id'];
        $status = $_GET['status'];

        updateUserStatus($userId, $status);
    }

    if (isset($_GET['action']) && $_GET['action'] == 'delete') {

        $userId = $_GET['id'];

        deleteUser($userId);
    }

    $search = $_GET['search'] ?? '';
    $role = $_GET['role'] ?? '';
    $users = getAllUsers($search, $role);

    require_once '../views/admin/manageUsers.php';
}

if ($page == 'userDetails') {
    $userId = $_GET['id'];
    $user = getUserById($userId);
    require_once '../views/admin/userDetails.php';
}


if ($page == 'jobs') {

    if (isset($_GET['action']) && $_GET['action'] == 'status') {
        $jobId = $_GET['id'];
        $status = $_GET['status'];
        updateJobStatus($jobId, $status);
    }

    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $jobId = $_GET['id'];
        deleteJob($jobId);
    }
    $search = $_GET['search'] ?? '';
    $status = $_GET['status'] ?? '';
    $jobs = getAllJobs($search, $status);

    require_once '../views/admin/manageJobs.php';
}

if ($page == 'jobDetails') {

    $jobId = $_GET['id'];

    $job = getJobById($jobId);

    require_once '../views/admin/jobDetails.php';
}

if ($page == 'statistics') {

    $totalUsers = getTotalUsers();
    $totalJobSeekers = getTotalJobSeekers();
    $totalEmployers = getTotalEmployers();
    $totalJobs = getTotalJobs();
    $totalApplications = getTotalApplications();

    $jobStatusStatistics = getJobStatusStatistics();

    $applicationStatusStatistics = getApplicationStatusStatistics();

    require_once '../views/admin/statistics.php';
}


?>