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


function getAllUsers($search = '', $role = '')
{
    global $conn;

    if ($search != '' && $role != '') {

        $sql = "SELECT user_id, name, email, phone, role, status, created_at
                FROM users
                WHERE (name LIKE ? OR email LIKE ?)
                AND role = ?
                ORDER BY user_id DESC";

        $stmt = mysqli_prepare($conn, $sql);

        $searchTerm = "%" . $search . "%";

        mysqli_stmt_bind_param($stmt, "sss", $searchTerm, $searchTerm, $role);

    } elseif ($search != '') {

        $sql = "SELECT user_id, name, email, phone, role, status, created_at
                FROM users
                WHERE name LIKE ? OR email LIKE ?
                ORDER BY user_id DESC";

        $stmt = mysqli_prepare($conn, $sql);

        $searchTerm = "%" . $search . "%";

        mysqli_stmt_bind_param($stmt, "ss", $searchTerm, $searchTerm);

    } elseif ($role != '') {

        $sql = "SELECT user_id, name, email, phone, role, status, created_at
                FROM users
                WHERE role = ?
                ORDER BY user_id DESC";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $role);

    } else {

        $sql = "SELECT user_id, name, email, phone, role, status, created_at
                FROM users
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

    $sql = "UPDATE users SET status = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $userId);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function deleteUser($userId)
{
    global $conn;

    $sql = "DELETE FROM users WHERE user_id = ?";

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


?>