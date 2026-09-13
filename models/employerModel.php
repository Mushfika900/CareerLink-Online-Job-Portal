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


    function getEmployerJobById($jobId, $employerId)
{
    global $conn;

    $jobId = (int)$jobId;
    $employerId = (int)$employerId;

    $sql = "SELECT *
            FROM jobs
            WHERE job_id = $jobId
            AND employer_id = $employerId";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}


function updateEmployerJob($jobId, $employerId, $title, $description, $category, $location, $salary, $deadline)
{
    global $conn;

    $jobId = (int)$jobId;
    $employerId = (int)$employerId;

    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $category = mysqli_real_escape_string($conn, $category);
    $location = mysqli_real_escape_string($conn, $location);
    $salary = mysqli_real_escape_string($conn, $salary);
    $deadline = mysqli_real_escape_string($conn, $deadline);

    $sql = "UPDATE jobs
            SET title = '$title',
                description = '$description',
                category = '$category',
                location = '$location',
                salary = '$salary',
                deadline = '$deadline'
            WHERE job_id = $jobId
            AND employer_id = $employerId";

    return mysqli_query($conn, $sql);
}

function changeJobStatus($jobId, $employerId, $status)
{
    global $conn;

    $jobId = (int)$jobId;
    $employerId = (int)$employerId;

    if ($status != "active" && $status != "closed")
    {
        return false;
    }

    $sql = "UPDATE jobs
            SET status = '$status'
            WHERE job_id = $jobId
            AND employer_id = $employerId";

    return mysqli_query($conn, $sql);
}


function deleteEmployerJob($jobId, $employerId)
{
    global $conn;

    $jobId = (int)$jobId;
    $employerId = (int)$employerId;

    $sql = "DELETE FROM jobs
            WHERE job_id = $jobId
            AND employer_id = $employerId";

    return mysqli_query($conn, $sql);
}
function updateApplicationStatus($applicationId, $jobId, $employerId, $status)
{
    global $conn;

    $applicationId = (int)$applicationId;
    $jobId = (int)$jobId;
    $employerId = (int)$employerId;

    if ($status != "pending" &&
        $status != "accepted" &&
        $status != "rejected")
    {
        return false;
    }

    $sql = "UPDATE applications

            JOIN jobs
            ON applications.job_id = jobs.job_id

            SET applications.status = '$status'

            WHERE applications.application_id = $applicationId
            AND applications.job_id = $jobId
            AND jobs.employer_id = $employerId";

    return mysqli_query($conn, $sql);
}

function updateEmployerProfile($employerId, $name, $email, $phone, $companyName, $companyAddress)
{
    global $conn;

    $employerId = (int)$employerId;

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $companyName = mysqli_real_escape_string($conn, $companyName);
    $companyAddress = mysqli_real_escape_string($conn, $companyAddress);


    $sql = "SELECT user_id
            FROM employers
            WHERE employer_id = $employerId";

    $result = mysqli_query($conn, $sql);

    $employer = mysqli_fetch_assoc($result);


    if (!$employer)
    {
        return false;
    }


    $userId = $employer["user_id"];


    $sql1 = "UPDATE users
             SET name = '$name',
                 email = '$email',
                 phone = '$phone'
             WHERE user_id = $userId";


    $sql2 = "UPDATE employers
             SET company_name = '$companyName',
                 company_address = '$companyAddress'
             WHERE employer_id = $employerId";


    $result1 = mysqli_query($conn, $sql1);

    $result2 = mysqli_query($conn, $sql2);


    if ($result1 && $result2)
    {
        return true;
    }
    else
    {
        return false;
    }
}
function deleteEmployerAccount($employerId)
{
    global $conn;

    $employerId = (int)$employerId;

    $sql = "SELECT user_id
            FROM employers
            WHERE employer_id = $employerId";

    $result = mysqli_query($conn, $sql);

    $employer = mysqli_fetch_assoc($result);

    if (!$employer)
    {
        return false;
    }

    $userId = $employer["user_id"];

    $sql = "DELETE FROM users
            WHERE user_id = $userId";

    return mysqli_query($conn, $sql);
}
function getEmployerIdByUserId($userId)
{
    global $conn;

    $userId = (int)$userId;

    $sql = "SELECT employer_id
            FROM employers
            WHERE user_id = $userId";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);

        return $row["employer_id"];
    }

    return false;
}

?>