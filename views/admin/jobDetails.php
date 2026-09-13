<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Job Details - CareerLink</title>

    <link rel="stylesheet" href="../views/admin/css/admin.css">

</head>

<body>
    <?php require_once 'sidebar.php'; ?>

<main class="main-content">

    <header class="topbar">

        <div>

            <h1>Job Details</h1>

            <p>View complete job posting information.</p>

        </div>

    </header>

    <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=jobs" class="back-button">
        ← Back
    </a>


    <section class="dashboard-section">

        <?php if ($job) { ?>

            <div class="section-header">

                <h2>
                    <?php echo htmlspecialchars($job['title']); ?>
                </h2>

                <p>
                    Job ID: <?php echo $job['job_id']; ?>
                </p>

            </div>


            <div class="user-details">

                <p>
                    <strong>Job Title:</strong>
                    <?php echo htmlspecialchars($job['title']); ?>
                </p>


                <p>
                    <strong>Company:</strong>
                    <?php echo htmlspecialchars($job['company_name']); ?>
                </p>


                <p>
                    <strong>Category:</strong>
                    <?php echo htmlspecialchars($job['category']); ?>
                </p>


                <p>
                    <strong>Location:</strong>
                    <?php echo htmlspecialchars($job['location']); ?>
                </p>


                <p>
                    <strong>Salary:</strong>
                    <?php echo htmlspecialchars($job['salary']); ?>
                </p>


                <p>
                    <strong>Deadline:</strong>
                    <?php echo htmlspecialchars($job['deadline']); ?>
                </p>


                <p>
                    <strong>Status:</strong>
                    <?php echo htmlspecialchars($job['status']); ?>
                </p>


                <p>
                    <strong>Posted Date:</strong>
                    <?php echo htmlspecialchars($job['posted_date']); ?>
                </p>


                <p>
                    <strong>Description:</strong>
                </p>

                <p>
                    <?php echo nl2br(htmlspecialchars($job['description'])); ?>
                </p>

            </div>

        <?php } else { ?>

            <p>
                Job not found.
            </p>

        <?php } ?>

    </section>

</main>

</body>

</html>