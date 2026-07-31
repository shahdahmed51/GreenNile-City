<!-- sidebar.php -->

<style>

.sidebar{

    width:260px;
    height:100vh;
    background:#1F2937;
    position:fixed;
    left:0;
    top:0;
    padding:25px 20px;

    box-shadow:2px 0 15px rgba(0,0,0,0.06);

    z-index:1000;
}


/* Logo */

.logo{

    display:flex;
    align-items:center;
    gap:12px;

    font-size:22px;
    font-weight:700;

    color:white;

    margin-bottom:40px;

}


.logo-icon{

    width:42px;
    height:42px;

    background:#16A34A;

    color:white;

    border-radius:12px;

    display:flex;
    justify-content:center;
    align-items:center;

}



/* Menu */

.menu{

    list-style:none;

    padding:0;
    margin:0;

}


.menu li{

    margin-bottom:10px;

}


.menu a{

    display:flex;
    align-items:center;

    gap:15px;

    padding:13px 15px;

    text-decoration:none;
    color:#D1D5DB;

    font-size:15px;

    border-radius:12px;

    transition:.3s;

}


.menu a i{

    width:20px;

    font-size:17px;

}

.menu li.active a{
    background:#16A34A !important;
    color:white !important;
}

.menu a:hover{
    background:#374151;
    color:white;
}


/* Logout */

.logout{

    position:absolute;

    bottom:30px;

    width:calc(100% - 40px);

}


.logout a{

    display:flex;

    align-items:center;

    gap:15px;

    text-decoration:none;

    color:#ef4444;

    padding:13px 15px;

    border-radius:12px;

}


.logout a:hover{

    background:#fee2e2;

}


</style>



<div class="sidebar">


    <div class="logo">

        <span class="logo-icon">
            <i class="fa-solid fa-leaf"></i>
        </span>

        GreenNile

    </div>



    <ul class="menu">


        <li class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">

            <a href="dashboard.php">

                <i class="fa-solid fa-house"></i>

                Dashboard

            </a>

        </li>



        <li class="<?php echo ($current_page == 'resident.php') ? 'active' : ''; ?>">

            <a href="resident.php">

                <i class="fa-solid fa-users"></i>

                Residents

            </a>

        </li>



        <li class="<?php echo ($current_page == 'parking.php') ? 'active' : ''; ?>">

            <a href="parking.php">

                <i class="fa-solid fa-square-parking"></i>

                Parking

            </a>

        </li>



        <li class="<?php echo ($current_page == 'maintenance.php') ? 'active' : ''; ?>">

            <a href="maintenance.php">

                <i class="fa-solid fa-screwdriver-wrench"></i>

                Maintenance

            </a>

        </li>



        <li class="<?php echo ($current_page == 'billing.php') ? 'active' : ''; ?>">

            <a href="billing.php">

                <i class="fa-solid fa-file-invoice-dollar"></i>

                Billing

            </a>

        </li>



        <li class="<?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">

            <a href="settings.php">

                <i class="fa-solid fa-gear"></i>

                Settings

            </a>

        </li>


    </ul>

    <div class="logout">

        <a href="#">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>



</div>