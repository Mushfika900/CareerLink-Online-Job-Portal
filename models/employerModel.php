<?php

function getEmployerInfo($employerId)
{
    global $conn;

    $employerId = (int)$employerId;

    $sql = "SELECT employers.*, users.name, users.email, users.phone
            FROM employers
            JOIN users
            ON employers.user_id = users.user_id
            WHERE employers.employer_id = $employerId";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}


function getTotalJobs($employerId)
{
    global $conn;

    $employerId = (int)$employerId;

    $sql = "SELECT COUNT(*) AS total
            FROM jobs
            WHERE employer_id = $employerId";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row["total"];
}


function getActiveJobs($employerId)
{
    global $conn;

    $employerId = (int)$employerId;

    $sql = "SELECT COUNT(*) AS total
            FROM jobs
            WHERE employer_id = $employerId
            AND status = 'active'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row["total"];
}


function getTotalApplicants($employerId)
{
    global $conn;

    $employerId = (int)$employerId;

    $sql = "SELECT COUNT(applications.application_id) AS total
            FROM applications
            JOIN jobs
            ON applications.job_id = jobs.job_id
            WHERE jobs.employer_id = $employerId";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row["total"];
}


function getPendingApplications($employerId)
{
    global $conn;

    $employerId = (int)$employerId;

    $sql = "SELECT COUNT(applications.application_id) AS total
            FROM applications
            JOIN jobs
            ON applications.job_id = jobs.job_id
            WHERE jobs.employer_id = $employerId
            AND applications.status = 'pending'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row["total"];
}


function getRecentJobs($employerId)
{
    global $conn;

    $employerId = (int)$employerId;

    $sql = "SELECT jobs.job_id,
                   jobs.title,
                   jobs.location,
                   jobs.status,
                   jobs.posted_date,
                   COUNT(applications.application_id) AS applicants
            FROM jobs
            LEFT JOIN applications
            ON jobs.job_id = applications.job_id
            WHERE jobs.employer_id = $employerId
            GROUP BY jobs.job_id
            ORDER BY jobs.posted_date DESC
            LIMIT 5";

    return mysqli_query($conn, $sql);
}


function addJob($employerId, $title, $description, $requirements, $category, $location, $salary, $deadline)
{
    global $conn;

    $employerId = (int)$employerId;

    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $requirements = mysqli_real_escape_string($conn, $requirements);
    $category = mysqli_real_escape_string($conn, $category);
    $location = mysqli_real_escape_string($conn, $location);
    $salary = mysqli_real_escape_string($conn, $salary);
    $deadline = mysqli_real_escape_string($conn, $deadline);

    $fullDescription = $description;

    if ($requirements != "")
    {
        $fullDescription = $description . "\n\nRequirements:\n" . $requirements;
    }

    $sql = "INSERT INTO jobs
            (employer_id, title, description, category, location, salary, deadline, status)
            VALUES
            ($employerId, '$title', '$fullDescription', '$category', '$location', '$salary', '$deadline', 'active')";

    return mysqli_query($conn, $sql);
}
function getEmployerJobs($employerId)
{
    global $conn;

    $employerId = (int)$employerId;

    $sql = "SELECT jobs.job_id,
                   jobs.title,
                   jobs.location,
                   jobs.salary,
                   jobs.deadline,
                   jobs.status,
                   jobs.posted_date,
                   COUNT(applications.application_id) AS applicants
            FROM jobs

            LEFT JOIN applications
            ON jobs.job_id = applications.job_id

            WHERE jobs.employer_id = $employerId

            GROUP BY jobs.job_id

            ORDER BY jobs.posted_date DESC";

    return mysqli_query($conn, $sql);
}
?>