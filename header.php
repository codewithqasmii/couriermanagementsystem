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


    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


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
    <style>
        body {
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
    </style>
</head>

<body>
    <div class="container-xxl position-relative bg-danger d-flex p-0" style="background-color: yellow;">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->




        <!-- Sidebar Start -->
        <div class="sidebar">
            <nav class="navbar bg-light navbar-light">
                <a href="" class="navbar-brand mx-4 mb-3">
                    <img src="img/logo.png" alt="" class="logo" style="width: 150px; margin-top:-30px">
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0 text-danger">Admin</h5>
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user') {
                        ?>
                            <span class="d-none d-lg-inline-flex">

                            <?php }
                        echo $_SESSION['username'];

                            ?>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <a href="dashboard.php"
                        class="nav-item nav-link 
         <?php if (
                basename($_SERVER['PHP_SELF']) == 'dashboard.php' ||
                basename($_SERVER['PHP_SELF']) == 'delivered.php' ||
                basename($_SERVER['PHP_SELF']) == 'ontheway.php' ||
                basename($_SERVER['PHP_SELF']) == 'recieved.php' ||
                basename($_SERVER['PHP_SELF']) == 'userlist.php' ||
                basename($_SERVER['PHP_SELF']) == 'returned.php' ||
                basename($_SERVER['PHP_SELF']) == 'pending.php'
            )
                echo 'active'; ?>">
                        <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'addbranch.php' || basename($_SERVER['PHP_SELF']) == 'viewBranch.php' || basename($_SERVER['PHP_SELF']) == 'branchAgent.php' || basename($_SERVER['PHP_SELF']) == 'addCity.php')  echo 'active'; ?>" data-bs-toggle="dropdown"><i class="fa fa-code-branch"></i>Branch</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="addCity.php" class="dropdown-item  ">Add City</a>
                            <a href="addbranch.php" class="dropdown-item  ">Add Branch</a>
                            <a href="viewBranch.php" class="dropdown-item">View Branch</a>
                            <a href="branchAgent.php" class="dropdown-item">City Branch</a>
                        </div>
                    </div>

                    <a href="agentRegister.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'agentRegister.php') echo 'active'; ?>"><i class="fa fa-user-secret"></i></i>Add Agent</a>
                    <a href="agent.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'agent.php') echo 'active'; ?>"><i class="fa fa-users"></i></i>Agents</a>
                    <a href="getAgentDetail.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'getAgentDetail.php') echo 'active'; ?>"><i class="fa fa-boxes"></i></i>Agents Parcels</a>



                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php if (basename($_SERVER['PHP_SELF']) == 'addCourier.php' || basename($_SERVER['PHP_SELF']) == 'parcelslist.php') echo 'active'; ?>" data-bs-toggle="dropdown"><i class="fa fa-boxes"></i>Courier</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="addCourier.php" class="dropdown-item  ">Add</a>
                            <a href="parcelslist.php" class="dropdown-item">View</a>
                        </div>
                    </div>
                    <a href="trackAdmin.php" class="nav-item nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'trackAdmin.php') echo 'active'; ?>"><i class="fa fa-search"></i>Track Courier</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="" class="navbar-brand d-flex d-lg-none me-4">
                    <!-- <h2 class="text-dark mb-0">CMS</h2> -->
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars text-danger"></i>
                </a>

                <div class="mx-auto text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)">
                    <h3 class="text-danger d-none d-sm-block d-lg-block"> COURIER -- MANAGEMENT -- SYSTEM</h3>
                    <h1 class="text-danger d-lg-none d-sm-block logo"><img src="img/logo.png" alt="" style="width: 130px;"></h1>                
                </div>
                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                            ?>
                                <span class="d-none d-lg-inline-flex">
                                    <?php echo $_SESSION['username']; ?> </span>

                            <?php }

                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-danger border-0 rounded-0 rounded-bottom m-0">
                            <a href="logout.php" class="dropdown-item hover:text-white bg-transparent">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Navbar End -->