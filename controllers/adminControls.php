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

?>