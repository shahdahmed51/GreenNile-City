<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php 
include("../includes/header.php");
include("../includes/sidebar.php");
?>
<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/user.css">
<body>
    <div class="main-content">

    <div class="profile-container">
<!-- left -->
        <div class="profile-card">

            <img src="../assets/images/profileimg.jfif" alt="Profile">

            <h3>Shahd Ahmed</h3>

            <p class="role">Resident</p>

            <span class="member">Member since Jan 2023</span>

            <button>Edit Profile</button>

        </div>
<!-- mid -->
        <div class="profile-form">

            <div class="input-group">
                <label>Full Name</label>
                <input type="text" value="Shahd Ahmed">
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" value="shahdahmed@email.com">
            </div>

            <div class="input-group">
                <label>Phone</label>
                <input type="text" value="+20 101 234 5678">
            </div>

            <div class="input-group">
                <label>Unit / Block</label>
                <input type="text" value="A-101">
            </div>

            <div class="input-group">
                <label>Move In Date</label>
                <input type="text" value="12 Jan 2022">
            </div>

            <div class="input-group">
                <label>Emergency Contact</label>
                <input type="text" value="+20 100 000 0000">
            </div>

        </div>
<!-- right -->
        <div class="right-side">

            <!-- Statistics -->
            <div class="statistics-card">

                <h3>Profile Statistics</h3>

                <div class="stat-item">
                    <span>Total Requests</span>
                    <strong>12</strong>
                </div>

                <div class="stat-item">
                    <span>Completed</span>
                    <strong>9</strong>
                </div>

                <div class="stat-item">
                    <span>In Progress</span>
                    <strong>2</strong>
                </div>

                <div class="stat-item">
                    <span>Cancelled</span>
                    <strong>1</strong>
                </div>

            </div>

            <!-- Recent Activity -->
            <div class="activity-card">

                <h3>Recent Activity</h3>

                <div class="activity-item">
                    <span>Maintenance Request</span>
                    <small>12 May 2024</small>
                </div>

                <div class="activity-item">
                    <span>Payment Received</span>
                    <small>10 May 2024</small>
                </div>

                <div class="activity-item">
                    <span>Parking Reserved</span>
                    <small>08 May 2024</small>
                </div>

                <a href="#">View All Activity</a>

            </div>

        </div>

    </div>

</div>
</body>
<script src="/GREENNILE-CITY/assets/js/user.js"></script>
</body>
<?php include '../includes/footer.php'; ?>