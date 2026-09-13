<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Details - CareerLink</title>

    <link rel="stylesheet" href="../views/admin/css/admin.css">

</head>

<body>

    <?php require_once 'sidebar.php'; ?>

    <main class="main-content">

        <header class="topbar">

            <div>
                <h1>User Details</h1>
                <p>View registered user information.</p>
            </div>

        </header>


        <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users"
           class="back-button">
            ← Back to Manage Users
        </a>


        <?php if ($user) { ?>

            <section class="user-details-layout">

                <div class="user-information">

                    <div class="detail-field">
                        <label>Name</label>
                        <div class="detail-box">
                            <?php echo htmlspecialchars($user['name']); ?>
                        </div>
                    </div>


                    <div class="detail-field">
                        <label>Email</label>
                        <div class="detail-box">
                            <?php echo htmlspecialchars($user['email']); ?>
                        </div>
                    </div>


                    <div class="detail-field">
                        <label>Phone</label>
                        <div class="detail-box">
                            <?php echo htmlspecialchars($user['phone']); ?>
                        </div>
                    </div>


                    <div class="detail-field">
                        <label>Role</label>
                        <div class="detail-box">

                            <?php
                            if ($user['role'] == 'jobseeker') {
                                echo "Job Seeker";
                            } elseif ($user['role'] == 'employer') {
                                echo "Employer";
                            } else {
                                echo "Admin";
                            }
                            ?>

                        </div>
                    </div>


                    <div class="detail-field">
                        <label>Account Status</label>
                        <div class="detail-box">
                            <?php echo ucfirst($user['status']); ?>
                        </div>
                    </div>


                    <div class="detail-field">
                        <label>Registration Date</label>
                        <div class="detail-box">
                            <?php echo date("M d, Y", strtotime($user['created_at'])); ?>
                        </div>
                    </div>

                </div>


                <div class="admin-actions">

                    <h3>Admin Actions</h3>


                    <?php if ($user['status'] == 'active') { ?>

                        <a
                            href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users&action=status&id=<?php echo $user['user_id']; ?>&status=inactive"
                            class="action-button full-button">
                            Deactivate User
                        </a>

                    <?php } else { ?>

                        <a
                            href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users&action=status&id=<?php echo $user['user_id']; ?>&status=active"
                            class="action-button full-button">
                            Activate User
                        </a>

                    <?php } ?>


                    <a
                        href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users&action=delete&id=<?php echo $user['user_id']; ?>"
                        class="delete-button full-button">
                        Delete User
                    </a>

                </div>

            </section>

        <?php } else { ?>

            <section class="dashboard-section">

                <p>User not found.</p>

            </section>

        <?php } ?>

    </main>

</body>

</html>