<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>C M S</title>
    <meta content="width=device-width
    , initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" type="image/png" href="img/logo.png" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    body{
        background-color: red;
    }
    .logo {
            animation: rotate 2s linear forwards;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        .view-all {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            width: 95%;
        }

        .view-all:hover {
            opacity: 1 !important;
        }
        .small-box:hover .view-all {
    opacity: 1;
}

</style>

<body>
    <div class="container-xxl position-relative bg-danger d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
            <a href="" class="navbar-brand mx-4 mb-3">
                    <img src="img/logo.png" alt="" class="logo" style="width: 150px; margin-top:-30px">
                </a>

                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0 text-danger">Agent Name</h5>
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'agent') {
                        ?>
                            <span class="d-none d-lg-inline-flex">

                            <?php 
                            }
                            ?>
                                <span class="text-dark"><?php echo $_SESSION['username']; ?></span>
                                <?php
                            

                            ?>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <a href="dashboard.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'active'; ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                    <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?php if ( basename($_SERVER['PHP_SELF']) == 'agentAddCourier.php' || basename($_SERVER['PHP_SELF']) == 'parcelslistAgent.php') echo 'active'; ?>" data-bs-toggle="dropdown"><i class="fa fa-boxes"></i>Courier</a>
                    <div class="dropdown-menu bg-transparent border-0">
                            <a href="agentAddCourier.php" class="dropdown-item">Add</a>
                            <a href="parcelslistAgent.php" class="dropdown-item">View</a>
                        </div>
                    </div>
                    <a href="trackAgent.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'trackAgent.php') echo 'active'; ?>"><i class="fa fa-table me-2"></i>Track Courier</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <!-- <h2 class="text-dark mb-0">CMS</h2> -->
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars text-danger"></i>
                </a>

                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                <div class="mx-auto text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">
                    <h3 class="text-danger d-none d-sm-block d-lg-block"> COURIER -- MANAGEMENT -- SYSTEM</h3>
                    <h1 class="text-danger d-lg-none d-sm-block logo"><img src="img/logo.png" alt="" style="width: 130px;"></h1>                
                </div>
                <div class="navbar-nav align-items-center ms-auto">

                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">

                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user1.jpg" alt="" style="width: 40px; height: 40px;">
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'agent') {
                            ?>
                                <span class="d-none d-lg-inline-flex">
                                    
                                    <?php echo $_SESSION['user_role']; ?> </span>

                            <?php }
                            ?>
                                <span class="text-danger"><?php echo $_SESSION['username']; ?></span>

                            <?Php

                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-danger border-0 rounded-0 rounded-bottom m-0">
                            <!-- <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a> -->
                            <a href="logout.php" class="dropdown-item hover:text-white bg-transparent">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->