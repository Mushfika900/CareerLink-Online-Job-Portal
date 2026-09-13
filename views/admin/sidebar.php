<aside class="sidebar">

    <div class="logo">

        <span class="logo-circle"></span>

        CareerLink

    </div>


    <nav class="sidebar-menu">

        <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=dashboard"
           class="menu-item <?php echo ($page == 'dashboard') ? 'active' : ''; ?>">

            Dashboard

        </a>


        <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=users"
           class="menu-item <?php echo ($page == 'users' || $page == 'userDetails') ? 'active' : ''; ?>">

            Manage Users

        </a>


        <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=jobs"
           class="menu-item <?php echo ($page == 'jobs' || $page == 'jobDetails') ? 'active' : ''; ?>">

            Manage Jobs

        </a>


        <a href="/CareerLink-Online-Job-Portal/controllers/adminControls.php?page=statistics"
           class="menu-item <?php echo ($page == 'statistics') ? 'active' : ''; ?>">

            Statistics

        </a>


        <a href="/CareerLink-Online-Job-Portal/views/logout.php"
           class="menu-item logout">

            Logout

        </a>

    </nav>

</aside>