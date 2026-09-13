<?php
 
// User Management Functions
function getTotalUsers()
{
    global $conn;
 
    $sql = "SELECT COUNT(*) AS total FROM users";
 
    $result = mysqli_query($conn, $sql);
 
    $row = mysqli_fetch_assoc($result);
 
    return $row['total'];
}
 
 
function getTotalJobSeekers()
{
    global $conn;
 
    $sql = "SELECT COUNT(*) AS total FROM jobseekers";
 
    $result = mysqli_query($conn, $sql);
 
    $row = mysqli_fetch_assoc($result);
 
    return $row['total'];
}
 
 
function getTotalEmployers()
{
    global $conn;
 
    $sql = "SELECT COUNT(*) AS total FROM employers";
 
    $result = mysqli_query($conn, $sql);
 
    $row = mysqli_fetch_assoc($result);
 
    return $row['total'];
}
 
 
function getTotalJobs()
{
    global $conn;
 
    $sql = "SELECT COUNT(*) AS total FROM jobs";
 
    $result = mysqli_query($conn, $sql);
 
    $row = mysqli_fetch_assoc($result);
 
    return $row['total'];
}
 
// User Management Functions
function getAllUsers($search = '', $role = '')
{
    global $conn;
 
    if ($search != '' && $role != '') {
 
        $sql = "SELECT user_id, name, email, phone, role, status, created_at
                FROM users
                WHERE (name LIKE ? OR email LIKE ?)
                AND role = ?
                AND role != 'admin'
                ORDER BY user_id DESC";
 
        $stmt = mysqli_prepare($conn, $sql);
 
        $searchTerm = "%" . $search . "%";
 
        mysqli_stmt_bind_param($stmt, "sss", $searchTerm, $searchTerm, $role);
 
    } elseif ($search != '') {
 
        $sql = "SELECT user_id, name, email, phone, role, status, created_at
                FROM users
                WHERE (name LIKE ? OR email LIKE ?)
                AND role != 'admin'
                ORDER BY user_id DESC";
 
        $stmt = mysqli_prepare($conn, $sql);
 
        $searchTerm = "%" . $search . "%";
 
        mysqli_stmt_bind_param($stmt, "ss", $searchTerm, $searchTerm);
 
    } elseif ($role != '') {
 
        $sql = "SELECT user_id, name, email, phone, role, status, created_at
                FROM users
                WHERE role = ?
                AND role != 'admin'
                ORDER BY user_id DESC";
 
        $stmt = mysqli_prepare($conn, $sql);
 
        mysqli_stmt_bind_param($stmt, "s", $role);
 
    } else {
 
        $sql = "SELECT user_id, name, email, phone, role, status, created_at
                FROM users
                WHERE role != 'admin'
                ORDER BY user_id DESC";
 
        $stmt = mysqli_prepare($conn, $sql);
    }
 
    mysqli_stmt_execute($stmt);
 
    $result = mysqli_stmt_get_result($stmt);
 
    mysqli_stmt_close($stmt);
 
    return $result;
}
 
function updateUserStatus($userId, $status)
{
    global $conn;
 
    $sql = "UPDATE users SET status = ? WHERE user_id = ? AND role != 'admin'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $userId);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}
 
function deleteUser($userId)
{
    global $conn;
 
    $sql = "DELETE FROM users WHERE user_id = ? AND role != 'admin'";
 
    $stmt = mysqli_prepare($conn, $sql);
 
    mysqli_stmt_bind_param($stmt, "i", $userId);
 
    $result = mysqli_stmt_execute($stmt);
 
    mysqli_stmt_close($stmt);
 
    return $result;
}
 
 
function getUserById($userId)
{
    global $conn;
 
    $sql = "SELECT user_id, name, email, phone, role, status, created_at
            FROM users
            WHERE user_id = ?";
 
    $stmt = mysqli_prepare($conn, $sql);
 
    mysqli_stmt_bind_param($stmt, "i", $userId);
 
    mysqli_stmt_execute($stmt);
 
    $result = mysqli_stmt_get_result($stmt);
 
    $user = mysqli_fetch_assoc($result);
 
    mysqli_stmt_close($stmt);
 
    return $user;
}
 
// Job Management Functions
function getAllJobs($search = '', $status = '')
{
    global $conn;
 
    if ($search != '' && $status != '') {
 
        $sql = "SELECT jobs.job_id, jobs.title, jobs.category,
                       jobs.location, jobs.salary, jobs.deadline,
                       jobs.status, jobs.posted_date,
                       employers.company_name
                FROM jobs
                INNER JOIN employers
                ON jobs.employer_id = employers.employer_id
                WHERE (jobs.title LIKE ? OR employers.company_name LIKE ?)
                AND jobs.status = ?
                ORDER BY jobs.job_id DESC";
 
        $stmt = mysqli_prepare($conn, $sql);
 
        $searchTerm = "%" . $search . "%";
 
        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $searchTerm,
            $searchTerm,
            $status
        );
 
    } elseif ($search != '') {
 
        $sql = "SELECT jobs.job_id, jobs.title, jobs.category,
                       jobs.location, jobs.salary, jobs.deadline,
                       jobs.status, jobs.posted_date,
                       employers.company_name
                FROM jobs
                INNER JOIN employers
                ON jobs.employer_id = employers.employer_id
                WHERE jobs.title LIKE ?
                   OR employers.company_name LIKE ?
                ORDER BY jobs.job_id DESC";
 
        $stmt = mysqli_prepare($conn, $sql);
 
        $searchTerm = "%" . $search . "%";
 
        mysqli_stmt_bind_param(
            $stmt,
            "ss",
            $searchTerm,
            $searchTerm
        );
 
    } elseif ($status != '') {
 
        $sql = "SELECT jobs.job_id, jobs.title, jobs.category,
                       jobs.location, jobs.salary, jobs.deadline,
                       jobs.status, jobs.posted_date,
                       employers.company_name
                FROM jobs
                INNER JOIN employers
                ON jobs.employer_id = employers.employer_id
                WHERE jobs.status = ?
                ORDER BY jobs.job_id DESC";
 
        $stmt = mysqli_prepare($conn, $sql);
 
        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $status
        );
 
    } else {
 
        $sql = "SELECT jobs.job_id, jobs.title, jobs.category,
                       jobs.location, jobs.salary, jobs.deadline,
                       jobs.status, jobs.posted_date,
                       employers.company_name
                FROM jobs
                INNER JOIN employers
                ON jobs.employer_id = employers.employer_id
                ORDER BY jobs.job_id DESC";
 
        $stmt = mysqli_prepare($conn, $sql);
    }
 
    mysqli_stmt_execute($stmt);
 
    $result = mysqli_stmt_get_result($stmt);
 
    mysqli_stmt_close($stmt);
 
    return $result;
}
 
function updateJobStatus($jobId, $status)
{
    global $conn;
 
    $sql = "UPDATE jobs SET status = ? WHERE job_id = ?";
 
    $stmt = mysqli_prepare($conn, $sql);
 
    mysqli_stmt_bind_param($stmt, "si", $status, $jobId);
 
    $result = mysqli_stmt_execute($stmt);
 
    mysqli_stmt_close($stmt);
 
    return $result;
}
 
function deleteJob($jobId)
{
    global $conn;
 
    $sql = "DELETE FROM jobs WHERE job_id = ?";
 
    $stmt = mysqli_prepare($conn, $sql);
 
    mysqli_stmt_bind_param($stmt, "i", $jobId);
 
    $result = mysqli_stmt_execute($stmt);
 
    mysqli_stmt_close($stmt);
 
    return $result;
}
 
// Job Management Functions
function getJobById($jobId)
{
    global $conn;
 
    $sql = "SELECT jobs.job_id,jobs.title,jobs.description,jobs.category,jobs.location,jobs.salary,jobs.deadline,jobs.status,jobs.posted_date,employers.company_name FROM jobs INNER JOIN employers ON jobs.employer_id = employers.employer_id WHERE jobs.job_id = ?";
 
    $stmt = mysqli_prepare($conn, $sql);
 
    mysqli_stmt_bind_param($stmt, "i", $jobId);
 
    mysqli_stmt_execute($stmt);
 
    $result = mysqli_stmt_get_result($stmt);
 
    $job = mysqli_fetch_assoc($result);
 
    mysqli_stmt_close($stmt);
 
    return $job;
}
 
function getTotalApplications()
{
    global $conn;
 
    $sql = "SELECT COUNT(*) AS total FROM applications";
 
    $result = mysqli_query($conn, $sql);
 
    $row = mysqli_fetch_assoc($result);
 
    return $row['total'];
}
 
function getJobStatusStatistics()
{
    global $conn;
 
    $sql = "SELECT status, COUNT(*) AS total
            FROM jobs
            GROUP BY status";
 
    $result = mysqli_query($conn, $sql);
 
    return $result;
}
 
function getApplicationStatusStatistics()
{
    global $conn;
 
    $sql = "SELECT status, COUNT(*) AS total
            FROM applications
            GROUP BY status";
 
    $result = mysqli_query($conn, $sql);
 
    return $result;
}
 
 
?>