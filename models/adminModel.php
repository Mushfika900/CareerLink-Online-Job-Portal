<?php

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

?>