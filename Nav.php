<?php
$link = mysqli_connect(hostname: "localhost", username: "root", password: "", database: "project");
extract($_POST);
if (isset($cancle)) {
    session_unset();
    session_destroy();
    header("location: ./HomePage.php");
    // if (!isset($_SESSION['id'])) {
    //     $result = "<div class='container-fluid alert alert-success fade show'><a href='#' class='close' data-dismiss='alert'>&times;</a><h6>WARNING</h6>LogOut Successfull!!</div>";
    // }
}
?>
<div class="container-fluid p-0 main">
    <nav class="navbar navbar-expand-lg main b fixed-top p-5" id="dynamic">
        <!-- logo -->
        <sapn class="logo mr-5" id="logo">SKILL VANTAGE</sapn>
        <!-- toggler icon -->
        <button type="button" class="navbar-toggler navbar-dark" data-toggle="collapse" data-target="#collapsibleNavbar">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <div class=" icon nav-icon-5">
                <span></span>
                <span></span>
                <span></span>
            </div> 
        </button>
        <!-- tab list -->
        <div class="collapse navbar-collapse ml-5" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item mr-lg-4"><a href="./HomePage.php" class="nav-link text-md-lg">Skill Vantage</a></li>
                <li class="nav-item mr-lg-4 dropdown">
                    <a href="#" class="nav-link text-md-lg dropdown-toggle" data-toggle="dropdown">Courses</a>
                    <div class="dropdown-menu" style="background-color: black;">
                        <ul class="list-group list-group-horizontal">
                            <?php
                            $qry = "select * from category";
                            $row = mysqli_query($link, $qry);
                            while ($row2 = mysqli_fetch_assoc($row)) {
                            ?>
                                <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="./display.php?id=<?php echo $row2['cat_id']; ?>" style="display: inline-block;"><?php echo $row2['cat_name']; ?> </a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mr-lg-4 dropdown">
                    <a href="#" class="nav-link text-md-lg dropdown-toggle" data-toggle="dropdown">Contact Us</a>
                    <div class="dropdown-menu" style="background-color: black;">
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="mailto: shivanshikaagarwal7275@gmail.com" style="display: inline-block;"><i class="fa-solid fa-envelope fa-xl" style="color: #ffffff;"></i></a></li>
                            <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="tel: 7275503320" style="display: inline-block;"><i class="fa-solid fa-phone fa-xl" style="color: #fafafa;"></i></a></li>
                            <li class="list-group-item p-0" style="background-color: black; color: #fff;"><a class="dropdown-item" href="telegram.com@shivanshikaagarwal" style="display: inline-block;"><i class="fa-solid fa-paper-plane fa-xl" style="color: #ffffff;"></i></a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mr-lg-4"><a href="./Admin/a_login.php" class="nav-link text-md-lg">Teach Here</a></li>
                <li class="nav-item mr-lg-4">

                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-lg-4">
                    <a href="./display.php?id=0" class="nav-link"><i class="fa-solid fa-magnifying-glass fa-xl" style="color: #ffffff;"></i></a>
                </li>
                <!-- interchange after SiginUp/Log In -->
                <?php
                if (isset($_SESSION['id'])) {
                    echo ' <form method="post">';
                    echo '<li class="nav-item mr-lg-4"><button type="submit" name="cancle" class="nav-link" style="background-color: transparent; border: none;"><i class="fa-solid fa-right-from-bracket  fa-xl" style="color: #ffffff;"></i></button></li>';
                    echo '</form>';
                    echo '<li class="nav-item mr-lg-4"><a href="./Dashboard.php" class="nav-link"><i class="fa-solid fa-user fa-xl" style="color: #fff;"></i></a></li>';
                    echo '<li class="nav-item mr-lg-4"><a href="./Dashboard.php" class="nav-link"><i class="fa-solid fa-heart fa-xl" style="color: #fff;"></i></a></li>';
                    echo '<li class="nav-item "><a href="./Dashboard.php" class="nav-link"><i class="fa-solid fa-cart-shopping fa-xl" style="color: #fafafa;"></i></a></li>';
                } else {
                    echo '<li class="nav-item mr-lg-4"><a href="./login.php" class="nav-link"><i class="fa-solid fa-arrow-right-to-bracket fa-xl" style="color: #fff;"></i></a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>
</div>