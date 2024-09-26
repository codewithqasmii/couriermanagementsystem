<?php

session_start();

?>

                        <?php
                        $role = $_SESSION['user_role'];
                        $username = $_SESSION['username'];


                        ?>

                        <?php if ($role == 'user') {
                            include('includes/userMenu.php');

                        } ?>


                        <?php if ($role == 'agent') {
                            include('includes/agentMenu.php');
                        } ?>


                        <?php if ($role == 'admin') {
                            include('includes/admin-menu.php');
                        } ?>

