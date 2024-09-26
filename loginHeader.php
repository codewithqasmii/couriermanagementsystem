<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width
    , initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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


    </style>
</head>

<body>
    <div class="container-xxl position-relative bg-light d-flex p-0">
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
                <a href="" class="navbar-brand mx-4 mb-3 disabled">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>CMS</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Admin</h6>
                    </div>
                </div>

                <div class="navbar-nav w-100">
                    <a href="dashboard.php" class="nav-item nav-link disabled "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                    <!-- <span class="nav-item nav-link" style=" cursor: pointer;" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user-secret"></i>Add Agent</span> -->

                    <a href="agentRegister.php" class="nav-item nav-link disabled "><i class="fa fa-user-secret"></i></i>Add Agent</a>
                    <a href="user.php" class="nav-item nav-link disabled "><i class="fa fa-users"></i></i>Agents/Users</a>
                    <!-- <a href="parcels.php" class="nav-item nav-link "><i class="fa fa-users"></i></i>Parcles</a> -->

                    <!-- Agent register Modal -->
                    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form method="post">
                                        <h2 class="text-center text-black">Registration form</h2>
                                        <div class="mb-3 mt-3">
                                            <label for="email" class="text-black">Username:</label>
                                            <input type="text" class="form-control" id="email" placeholder="Enter username" name="uname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pwd" class="text-black">Password:</label>
                                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="upwd" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="pwd" class="text-black">Role:</label>
                                            <select class="form-control" name="role" required>
                                                <option value="" disabled selected>Select Role</option>
                                                <option value="agent">Agent</option>
                                            </select>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div> -->


                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Category</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="addCategory.php" class="dropdown-item">Add</a>
                            <a href="viewCategory.php" class="dropdown-item">View</a>
                        </div>
                    </div> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle disabled" data-bs-toggle="dropdown"><i class="fa fa-boxes"></i>Courier</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="addCourier.php" class="dropdown-item">Add</a>
                            <a href="parcels.php" class="dropdown-item">View</a>
                        </div>
                    </div>
                    <a href="track.php" class="nav-item nav-link disabled"><i class="fa fa-search"></i>Track Courier</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                <div class=" mx-auto" >
                    <h2 class="text-danger text-center"  style="text-align: center;">  COURIER -- MANAGEMENT -- SYSTEM</h2>
                </div>
                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle disabled" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                            ?>
                                <span class="d-none d-lg-inline-flex">
                                    <?php echo $_SESSION['username']; ?> </span>

                            <?php }

                            ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-info border-0 rounded-0 rounded-bottom m-0">
                            <a href="logout.php" class="dropdown-item hover:text-white bg-transparent dia" >Log Out</a>
                            </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->