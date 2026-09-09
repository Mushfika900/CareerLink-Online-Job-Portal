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

?>