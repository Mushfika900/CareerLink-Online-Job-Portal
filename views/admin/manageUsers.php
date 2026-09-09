<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users - CareerLink</title>

    <link rel="stylesheet" href="../views/admin/css/admin.css">

</head>

<body>

    <main class="main-content">

        <header class="topbar">

            <div>
                <h1>Manage Users</h1>
                <p>View and manage registered users.</p>
            </div>

        </header>


        <section class="dashboard-section">

            <div class="section-header">

                <h2>Registered Users</h2>

                <p>All registered users of CareerLink.</p>

            </div>

            <form method="GET" action="/CareerLink-Online-Job-Portal/controllers/adminControls.php" class="user-filter">
            
                <input
                    type="hidden"
                    name="page"
                    value="users"
                >
            
                <input type="text" name="search" placeholder="Search by name or email..."
                    value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>"
                >
            
                <select name="role">
            
                    <option value="">All Roles</option>
            
                    <option value="jobseeker"
                        <?php echo (($_GET['role'] ?? '') == 'jobseeker') ? 'selected' : ''; ?>>
                        Job Seeker
                    </option>
            
                    <option value="employer"
                        <?php echo (($_GET['role'] ?? '') == 'employer') ? 'selected' : ''; ?>>
                        Employer
                    </option>
            
                </select>
            
                <button type="submit">
                    Search
                </button>
            
            </form>

            <div class="table-container">

                <table class="admin-table">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Created</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($user = mysqli_fetch_assoc($users)) { ?>

                            <tr>

                                <td>
                                    <?php echo $user['user_id']; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['name']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['email']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['phone']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['role']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['status']); ?>
                                </td>
                                <td>

                                    <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=userDetails&id=<?php echo $user['user_id']; ?>">
                                        View Details
                                    </a><br>

                                    <?php if ($user['status'] == 'active') { ?>
                            
                                        <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users&action=status&id=<?php echo $user['user_id']; ?>&status=inactive">
                                            Deactivate
                                        </a>
                            
                                    <?php } else { ?>
                            
                                        <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users&action=status&id=<?php echo $user['user_id']; ?>&status=active">
                                            Activate
                                        </a>
                            
                                    <?php } ?>
                                    <br>
                                    <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users&action=delete&id=<?php echo $user['user_id']; ?>">
                                        Delete
                                    </a>
                            
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user['created_at']); ?>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</body>

</html>