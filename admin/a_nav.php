<?php
session_start();
extract($_POST);
if (isset($cancle)) {
    session_unset();
    session_destroy();
    header("location: ../HomePage.php");
}
?>
<div class="container-fluid p-0 main">
    <nav class="navbar navbar-expand-md main b fixed-top p-5" id="dynamic">
        <!-- logo -->
        <sapn class="logo mr-5" id="logo">SKILL VANTAGE <sub>ADMIN</sub></sapn>
        <!-- toggler icon -->
        <button type="button" class="navbar-toggler navbar-dark" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- tab list -->
        <div class="collapse navbar-collapse ml-5" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item mr-lg-4">
                    <a href="./a_HomePage.php" class="nav-link text-md-l">Skill Vantage</a>
                </li>
                <li class="nav-item mr-lg-4 dropdown">
                    <a href="./a_yourCourses.php" class="nav-link text-md-l dropdown-toggle" data-toggle="dropdown">Courses</a>
                    <div class="dropdown-menu" style="background-color: black;">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="./a_uploadNew.php" style="display: inline-block;"> Upload New </a></li>
                            <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="./a_yourCourses.php" style="display: inline-block;"> All Your Courses</a></li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item mr-lg-4"><a href="#" class="nav-link text-md-l">Upload New</a></li> -->
                <li class="nav-item mr-lg-4 dropdown">
                    <a href="#" class="nav-link text-md-l dropdown-toggle" data-toggle="dropdown">Contact Us</a>
                    <div class="dropdown-menu" style="background-color: black;">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="mailto: shivanshikaagarwal7275@gmail.com" style="display: inline-block;"><i class="fa-solid fa-envelope fa-xl" style="color: #ffffff;"></i></a></li>
                            <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="tel: 7275503320" style="display: inline-block;"><i class="fa-solid fa-phone fa-xl" style="color: #fafafa;"></i></a></li>
                            <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="telegram.com@shivanshikaagarwal" style="display: inline-block;"><i class="fa-solid fa-paper-plane fa-xl" style="color: #ffffff;"></i></a></li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item mr-lg-4 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navdrop" data-toggle="dropdown">Dropdown</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li> -->
            </ul>
            <!-- </div>
        <div class="collapse navbar-collapse"> -->
            <ul class="navbar-nav ml-auto">
                <!-- interchange after SiginUp/Log In -->
                <?php
                if (isset($_SESSION['id'])) {
                    echo ' <form method="post">';
                    echo '<li class="nav-item mr-lg-4"><button type="submit" name="cancle" class="nav-link" style="background-color: transparent; border: none;"><i class="fa-solid fa-right-from-bracket  fa-xl" style="color: #ffffff;"></i></button></li>';
                    echo '</form>';
                } else {
                    echo '<li class="nav-item mr-lg-4"><a href="./a_login.php" class="nav-link"><i class="fa-solid fa-arrow-right-to-bracket fa-xl" style="color: #fff;"></i></a></li>';
                }
                ?>

            </ul>
        </div>
    </nav>
</div>