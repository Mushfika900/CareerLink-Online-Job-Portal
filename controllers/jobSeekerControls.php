<?php

session_start();

require_once "../config/dbConnect.php";
require_once "../models/jobSeekerModel.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "jobseeker") {
    header("Location: ../views/login.php");
    exit();
}

$userId = $_SESSION["user_id"];
$name = $_SESSION["name"];
$initials = strtoupper(substr($name, 0, 2));

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "dashboard";
}


if ($page == "dashboard")
{
    $seeker = getSeekerByUserId($userId);

    if ($seeker) {
        $stats = countApplicationsByStatus($seeker["seeker_id"]);
        $applications = getApplicationsBySeekerId($seeker["seeker_id"]);
        $recentApplications = array_slice($applications, 0, 5);
    } else {
        $stats = array(
            "Total" => 0,
            "pending" => 0,
            "accepted" => 0,
            "rejected" => 0
        );
        $recentApplications = array();
    }

    require_once "../views/jobSeeker/dashboard.php";
}


if ($page == "browseJobs")
{
    $keyword = trim($_GET["keyword"] ?? "");
    $category = $_GET["category"] ?? "";
    $location = $_GET["location"] ?? "";

    $jobs = getAllJobs($keyword, $category, $location);

    require_once "../views/jobSeeker/browseJobs.php";
}


if ($page == "jobDetails")
{
    $jobId = $_GET["id"] ?? null;

    if (!$jobId) {
        header("Location: jobSeekerControls.php?page=browseJobs");
        exit();
    }

    $job = getJobById($jobId);

    if (!$job) {
        header("Location: jobSeekerControls.php?page=browseJobs");
        exit();
    }

    $seeker = getSeekerByUserId($userId);

    $alreadyApplied = false;
    if ($seeker) {
        $alreadyApplied = hasAppliedToJob($jobId, $seeker["seeker_id"]);
    }

    require_once "../views/jobSeeker/jobDetails.php";
}


if ($page == "applyJob")
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $jobId = $_POST["job_id"] ?? "";

        $hasError = false;
        $jobError = "";
        $resumeError = "";

        if ($jobId == "" || !filter_var($jobId, FILTER_VALIDATE_INT)) {
            $jobError = "Invalid job";
            $hasError = true;
        }

        $seeker = getSeekerByUserId($userId);

        if (empty($seeker["resume_file"])) {
            $resumeError = "Please upload your resume on your Profile page before applying";
            $hasError = true;
        }

        if (!$hasError && hasAppliedToJob($jobId, $seeker["seeker_id"])) {
            $jobError = "You have already applied for this job";
            $hasError = true;
        }

        if ($hasError) {
            $url = "jobSeekerControls.php?page=jobDetails&id=" . urlencode($jobId)
                 . "&jobError=" . urlencode($jobError)
                 . "&resumeError=" . urlencode($resumeError);
            header("Location:" . $url);
            exit();
        } else {
            createApplication($jobId, $seeker["seeker_id"]);
            header("Location: jobSeekerControls.php?page=myApplications&applied=1");
            exit();
        }
    }

    header("Location: jobSeekerControls.php?page=browseJobs");
    exit();
}


if ($page == "myApplications")
{
    $seeker = getSeekerByUserId($userId);

    if ($seeker) {
        $applications = getApplicationsBySeekerId($seeker["seeker_id"]);
    } else {
        $applications = array();
    }

    require_once "../views/jobSeeker/myApplications.php";
}


if ($page == "profile")
{
    $seeker = getSeekerByUserId($userId);

    if (isset($_POST["saveProfile"]))
    {
        $pname = trim($_POST["name"]);
        $phone = trim($_POST["phone"]);
        $education = trim($_POST["education"] ?? "");
        $experience = trim($_POST["experience"] ?? "");
        $skills = trim($_POST["skills"] ?? "");

        $hasError = false;
        $nameError = "";
        $phoneError = "";

        if ($pname == "") {
            $nameError = "Name cannot be empty";
            $hasError = true;
        } elseif (!preg_match('/^[a-zA-Z\' -]+$/', $pname)) {
            $nameError = "Name cannot have numbers or special characters";
            $hasError = true;
        }

        if ($phone == "") {
            $phoneError = "Phone cannot be empty";
            $hasError = true;
        } elseif (!preg_match('/^[0-9+ -]{7,15}$/', $phone)) {
            $phoneError = "Please provide a valid phone number";
            $hasError = true;
        }

        if ($hasError) {

            $url = "jobSeekerControls.php?page=profile&nameError=" . urlencode($nameError)
                 . "&phoneError=" . urlencode($phoneError)
                 . "&name=" . urlencode($pname)
                 . "&phone=" . urlencode($phone)
                 . "&education=" . urlencode($education)
                 . "&experience=" . urlencode($experience)
                 . "&skills=" . urlencode($skills);

            header("Location:" . $url);
            exit();

        } else {

            ensureJobSeekerRow($userId);
            updateSeekerProfile($userId, $pname, $phone, $education, $experience, $skills);

            $_SESSION["name"] = $pname;

            header("Location: jobSeekerControls.php?page=profile&success=1");
            exit();
        }
    }

    require_once "../views/jobSeeker/profile.php";
}


if ($page == "uploadResume")
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $file_error = $_FILES["resume"]["error"];
        $file_type = $_FILES["resume"]["type"];
        $allowedType = ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
        $file_size = $_FILES["resume"]["size"];
        $max_size = 2 * 1024 * 1024;
        $file_name = $_FILES["resume"]["name"];

        $hasError = false;
        $resumeError = "";

        $existingResume = getSeekerResumePath($userId);

        if (!empty($existingResume)) {
            $resumeError = "You already have a resume uploaded. Please delete it first before uploading a new one.";
            $hasError = true;
        } elseif ($file_error == 4) {
            $resumeError = "Please choose a file to upload";
            $hasError = true;
        } elseif (!in_array($file_type, $allowedType)) {
            $resumeError = "Only PDF, DOC or DOCX files are allowed";
            $hasError = true;
        } elseif ($file_size > $max_size) {
            $resumeError = "File is too large (max 2MB)";
            $hasError = true;
        } else {

            $uploadDir = __DIR__ . "/../uploads/cv/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $safeFileName = "seeker_" . $userId . "_" . time() . "_" . basename($file_name);
            $destination = $uploadDir . $safeFileName;
            $temp_loc = $_FILES["resume"]["tmp_name"];

            $success = move_uploaded_file($temp_loc, $destination);

            if ($success) {
                ensureJobSeekerRow($userId);
                updateSeekerResume($userId, "uploads/cv/" . $safeFileName);
            } else {
                $resumeError = "Could not upload the file, please try again";
                $hasError = true;
            }
        }

        if ($hasError) {
            header("Location: jobSeekerControls.php?page=profile&resumeError=" . urlencode($resumeError));
            exit();
        } else {
            header("Location: jobSeekerControls.php?page=profile&resumeSuccess=1");
            exit();
        }
    }

    header("Location: jobSeekerControls.php?page=profile");
    exit();
}


if ($page == "deleteResume")
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $resumePath = getSeekerResumePath($userId);

        if (!empty($resumePath)) {
            $fullPath = __DIR__ . "/../" . $resumePath;
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            clearSeekerResume($userId);
        }

        header("Location: jobSeekerControls.php?page=profile&resumeDeleted=1");
        exit();
    }

    header("Location: jobSeekerControls.php?page=profile");
    exit();
}


if ($page == "deleteAccount")
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        deleteSeekerAccount($userId);
        session_destroy();
        header("Location: ../views/login.php");
        exit();
    }

    header("Location: jobSeekerControls.php?page=profile");
    exit();
}
?>