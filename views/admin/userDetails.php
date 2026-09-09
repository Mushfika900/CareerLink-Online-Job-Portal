<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Details - CareerLink</title>

    <link rel="stylesheet" href="../views/admin/css/admin.css">

</head>

<body>

    <main class="main-content">

        <header class="topbar">

            <div>
                <h1>User Details</h1>
                <p>View registered user information.</p>
            </div>

        </header>


        <section class="dashboard-section">

            <div class="section-header">

                <h2><?php echo htmlspecialchars($user['name']); ?></h2>

                <p>User ID: <?php echo $user['user_id']; ?></p>

            </div>


            <div class="user-details">

                <p>
                    <strong>Name:</strong>
                    <?php echo htmlspecialchars($user['name']); ?>
                </p>

                <p>
                    <strong>Email:</strong>
                    <?php echo htmlspecialchars($user['email']); ?>
                </p>

                <p>
                    <strong>Phone:</strong>
                    <?php echo htmlspecialchars($user['phone']); ?>
                </p>

                <p>
                    <strong>Role:</strong>
                    <?php echo htmlspecialchars($user['role']); ?>
                </p>

                <p>
                    <strong>Status:</strong>
                    <?php echo htmlspecialchars($user['status']); ?>
                </p>

                <p>
                    <strong>Created At:</strong>
                    <?php echo htmlspecialchars($user['created_at']); ?>
                </p>

            </div>

        </section>

    </main>

</body>

</html>