<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Jobs - CareerLink</title>

    <link rel="stylesheet" href="../views/admin/css/admin.css">

</head>

<body>
    <?php require_once 'sidebar.php'; ?>

<main class="main-content">

    <header class="topbar">

        <div>

            <h1>Manage Jobs</h1>

            <p>View and manage all job postings.</p>

        </div>

    </header>


    <section class="dashboard-section">

        <div class="section-header">

            <h2>Job Postings</h2>

            <p>Manage jobs posted by employers.</p>

        </div>


        <!-- Search and Filter -->

        <form
            method="GET"
            action="/CareerLink-Online-Job-Portal/controllers/adminControls.php"
            class="user-filter"
        >

            <input
                type="hidden"
                name="page"
                value="jobs"
            >


            <input
                type="text"
                name="search"
                placeholder="Search by job title or company..."
                value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>"
            >


            <select name="status">

                <option value="">All Status</option>

                <option
                    value="active"
                    <?php echo (($_GET['status'] ?? '') == 'active') ? 'selected' : ''; ?>
                >
                    Active
                </option>

                <option
                    value="closed"
                    <?php echo (($_GET['status'] ?? '') == 'closed') ? 'selected' : ''; ?>
                >
                    Closed
                </option>

            </select>


            <button type="submit">
                Search
            </button>

        </form>


        <!-- Jobs Table -->

        <div class="table-container">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Job Title</th>

                        <th>Company</th>

                        <th>Category</th>

                        <th>Location</th>

                        <th>Salary</th>

                        <th>Deadline</th>

                        <th>Status</th>

                        <th>Action</th>

                        <th>Posted</th>

                    </tr>

                </thead>


                <tbody>

                <?php if (mysqli_num_rows($jobs) > 0) { ?>

                    <?php while ($job = mysqli_fetch_assoc($jobs)) { ?>

                        <tr>

                            <td>
                                <?php echo $job['job_id']; ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($job['title']); ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($job['company_name']); ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($job['category']); ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($job['location']); ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($job['salary']); ?>
                            </td>


                            <td>
                                <?php echo htmlspecialchars($job['deadline']); ?>
                            </td>


                            <td>

                                <?php if ($job['status'] == 'active') { ?>

                                    <span class="status-badge active">
                                        Active
                                    </span>

                                <?php } else { ?>

                                    <span class="status-badge inactive">
                                        Closed
                                    </span>

                                <?php } ?>

                            </td>


                            <td class="action-buttons">

                                <a
                                    class="action-button"
                                    href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=jobDetails&id=<?php echo $job['job_id']; ?>"
                                >
                                    View Details
                                </a>
                            
                            
                                <?php if ($job['status'] == 'active') { ?>
                            
                                    <a
                                        class="action-button"
                                        href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=jobs&action=status&id=<?php echo $job['job_id']; ?>&status=closed"
                                    >
                                        Close
                                    </a>
                            
                                <?php } else { ?>
                            
                                    <a
                                        class="action-button"
                                        href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=jobs&action=status&id=<?php echo $job['job_id']; ?>&status=active"
                                    >
                                        Re-open
                                    </a>
                            
                                <?php } ?>
                            
                            
                                <a
                                    class="delete-button"
                                    href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=jobs&action=delete&id=<?php echo $job['job_id']; ?>"
                                >
                                    Delete
                                </a>
                            
                            </td>


                            <td>
                                <?php echo htmlspecialchars($job['posted_date']); ?>
                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>

                        <td colspan="10">
                            No jobs found.
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