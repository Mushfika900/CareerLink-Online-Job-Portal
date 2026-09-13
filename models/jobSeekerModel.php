<?php

require_once __DIR__ . "/../config/dbConnect.php";

/* ---------------------------------------------------
   SEEKER PROFILE FUNCTIONS
--------------------------------------------------- */

function getSeekerByUserId($userId)
{
    global $conn;

    $sql = "SELECT js.*, u.name, u.email, u.phone
            FROM jobseekers js
            JOIN users u ON js.user_id = u.user_id
            WHERE js.user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $userId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}

function ensureJobSeekerRow($userId)
{
    global $conn;

    $sql = "SELECT seeker_id
            FROM jobseekers
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $userId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $exists = mysqli_fetch_assoc($result);

    if (!$exists) {

        $sql = "INSERT INTO jobseekers (user_id)
                VALUES (?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $userId);

        mysqli_stmt_execute($stmt);
    }
}

function updateSeekerProfile($userId, $name, $phone, $education, $experience, $skills)
{
    global $conn;

    $sql = "UPDATE users
            SET name = ?, phone = ?
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssi", $name, $phone, $userId);

    $ok1 = mysqli_stmt_execute($stmt);


    $sql = "UPDATE jobseekers
            SET education = ?, experience = ?, skills = ?
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssi", $education, $experience, $skills, $userId);

    $ok2 = mysqli_stmt_execute($stmt);

    return $ok1 && $ok2;
}

function updateSeekerResume($userId, $resumePath)
{
    global $conn;

    $sql = "UPDATE jobseekers
            SET resume_file = ?
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "si", $resumePath, $userId);

    return mysqli_stmt_execute($stmt);
}

function getSeekerResumePath($userId)
{
    global $conn;

    $sql = "SELECT resume_file
            FROM jobseekers
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $userId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($result);

    return $row["resume_file"] ?? null;
}

function clearSeekerResume($userId)
{
    global $conn;

    $sql = "UPDATE jobseekers
            SET resume_file = NULL
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $userId);

    return mysqli_stmt_execute($stmt);
}

function deleteSeekerAccount($userId)
{
    global $conn;

    $sql = "DELETE FROM users
            WHERE user_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $userId);

    return mysqli_stmt_execute($stmt);
}

/* ---------------------------------------------------
   JOB BROWSING FUNCTIONS
--------------------------------------------------- */

function getAllJobs($keyword = "", $category = "", $location = "")
{
    global $conn;

    $sql = "SELECT j.*, e.company_name
            FROM jobs j
            JOIN employers e ON j.employer_id = e.employer_id
            WHERE j.status = 'active'";

    $params = array();
    $types = "";

    if ($keyword !== "") {
        $sql .= " AND j.title LIKE ?";
        $params[] = "%$keyword%";
        $types .= "s";
    }

    if ($category !== "" && $category !== "All Categories") {
        $sql .= " AND j.category = ?";
        $params[] = $category;
        $types .= "s";
    }

    if ($location !== "" && $location !== "All Locations") {
        $sql .= " AND j.location = ?";
        $params[] = $location;
        $types .= "s";
    }

    $sql .= " ORDER BY j.posted_date DESC";

    $stmt = mysqli_prepare($conn, $sql);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getJobById($jobId)
{
    global $conn;

    $sql = "SELECT j.*, e.company_name
            FROM jobs j
            JOIN employers e ON j.employer_id = e.employer_id
            WHERE j.job_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $jobId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}

/* ---------------------------------------------------
   APPLICATION FUNCTIONS
--------------------------------------------------- */

function getApplicationsBySeekerId($seekerId)
{
    global $conn;

    $sql = "SELECT a.*, j.title, e.company_name
            FROM applications a
            JOIN jobs j ON a.job_id = j.job_id
            JOIN employers e ON j.employer_id = e.employer_id
            WHERE a.seeker_id = ?
            ORDER BY a.applied_date DESC";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $seekerId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function countApplicationsByStatus($seekerId)
{
    global $conn;

    $counts = array(
        "Total" => 0,
        "pending" => 0,
        "accepted" => 0,
        "rejected" => 0
    );

    $sql = "SELECT status, COUNT(*) AS total
            FROM applications
            WHERE seeker_id = ?
            GROUP BY status";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $seekerId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    while ($row = mysqli_fetch_assoc($result)) {

        $status = $row["status"];
        $total = (int)$row["total"];

        $counts[$status] = $total;

        $counts["Total"] += $total;
    }

    return $counts;
}

function hasAppliedToJob($jobId, $seekerId)
{
    global $conn;

    $sql = "SELECT application_id
            FROM applications
            WHERE job_id = ? AND seeker_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $jobId, $seekerId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function createApplication($jobId, $seekerId)
{
    global $conn;

    $sql = "INSERT INTO applications (job_id, seeker_id)
            VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $jobId, $seekerId);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}
?>